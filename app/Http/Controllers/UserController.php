<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\RajaOngkirController;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("created_at", "desc")->limit(5)->get();

        $recomendation_products = Product::inRandomOrder()->limit("3")->get();
        $index_recomendation_products = 0;

        return view("user.index", compact("products", "recomendation_products", "index_recomendation_products"));
    }

    public function detailProduct(Product $product)
    {
//        render view detail product
        return view("user.detail-product", compact("product"))->render();
    }

    public function profile()
    {
        $user = auth()->user();
        return view("user.profile", compact("user"));
    }

    public function destroyUser()
    {
        $user = auth()->user();
        Auth::logout($user);

        $user->wishlist()->delete();
        $user->transaction()->delete();

        if($user->photo_profile != "default.png" && $user->photo_profile != null && substr($user->photo_profile, 0, 4) != "http")
            unlink("storage/photo_profile/" . $user->photo_profile);

        $user->delete();

        Alert::success("Berhasil", "Akun berhasil dihapus");
        return redirect()->route("login");
    }

    public function editUser()
    {
        $provinces = RajaOngkirController::provinces();

        $user = auth()->user();
        $cities = $user->address ? RajaOngkirController::cities($user->province[0]) : [];

        return view("user.edit", compact("user", "provinces", "cities"));
    }

    public function getCity()
    {
        $cities = RajaOngkirController::cities(request()->province_id);
        return response()->json($cities);
    }

    public function updateUser(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email," . $user->id,
            "phone_number" => "required|numeric",
            "address" => "required",
            "password" => "nullable",
            "photo_profile" => "nullable|file",
            "province" => "required",
            "city" => "required"
        ]);

        if($request->hasFile("photo_profile")) {
            $file = $request->file("photo_profile");

            $image_name = time() . "_" . $file->getClientOriginalName();
            $file->move("storage/photo_profiles", $image_name);
            $data["photo_profile"] = $image_name;
        }

        if($data["password"] == null) {
            unset($data["password"]);
        } else {
            $data["password"] = bcrypt($data["password"]);
        }

//        change data to json type for database
        $data["province"] = json_encode(explode(":", $data["province"]));
        $data["city"] = json_encode(explode(":", $data["city"]));

        $user->update($data);

        Alert::success("Success", "Profile has been updated");
        return redirect()->route("user.profile");
    }

    public function checkout(Product $product)
    {
        if(auth()->user()->address == null) {
            Alert::error("Error", "Please fill your address first");
            return redirect()->route("user.edit");
        } else if(auth()->user()->phone_number == null) {
            Alert::error("Error", "Please fill your phone number first");
            return redirect()->route("user.edit");
        }
        $arr_ongkir = RajaOngkirController::ongkir(auth()->user()->city[0], $product->weight);
        return view("user.checkout", compact("product", "arr_ongkir"));
    }

    public function createTransaction(Request $request, Product $product)
    {
        $data = $request->validate([
            "quantity" => "required|numeric|min:1",
            "payment_method" => "required",
            "shipping_method" => "required",
            "total_price" => "required|numeric",
        ]);

        $data["created_at"] = date("Y-m-d H:i:s");
        $data["product_id"] = $product->id;
        $data["status"] = "pending";
        $data["shipping_method"] = explode(":", $data["shipping_method"])[0];

        auth()->user()->transaction()->create($data);

        Alert::success("Success", "Transaction has been created");
        return redirect()->route("user.order");
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        $transaction = auth()->user()->transaction()->where("id", request()->transaction_id)->first();

        $data = $request->validate([
            "bukti_pembayaran" => "required|file"
        ]);

        if($request->hasFile("bukti_pembayaran")) {
            $file = $request->file("bukti_pembayaran");

            $image_name = time() . "_" . $file->getClientOriginalName();
            $file->move("storage/bukti_pembayaran", $image_name);
            $data["bukti_pembayaran"] = $image_name;
        }
        $data["status"] = "menunggu_konfirmasi";
        $transaction->update($data);

        Alert::success("Success", "Bukti pembayaran berhasil diupload, mohon tunggu konfirmasi dari admin");
        return redirect()->route("user.order");
    }

    public function order()
    {
        $transactions = auth()->user()->transaction()->orderBy("created_at", "desc")->get();
        return view("user.order", compact("transactions"));
    }

    public function pesananTelahDiterima(Transaction $transaction)
    {
        $transaction->update([
            "status" => "selesai"
        ]);

        Alert::success("Success", "Pesanan telah diterima!");
        return redirect()->route("user.order");
    }
}
