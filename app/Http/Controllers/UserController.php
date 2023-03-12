<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
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
        $user->wishlist()->delete();
        $user->transaction()->delete();
        $user->delete();
        return redirect()->route("login");
    }

    public function editUser()
    {
        $user = auth()->user();
        return view("user.edit", compact("user"));
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
            "photo_profile" => "nullable|file"
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

        $user->update($data);

        Alert::success("Success", "Profile has been updated");
        return redirect()->route("user.profile");
    }
}
