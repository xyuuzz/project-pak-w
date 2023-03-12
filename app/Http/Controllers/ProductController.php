<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(["auth", "can:admin"])->except(["index", "show"]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = 1 + (request()->page ?? 1) * 3 - 3;

        $products = Product::orderBy("created_at", "desc")->simplePaginate(3);
        return view("admin.product.index", compact("products", "index"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "price" => "required|numeric",
            "description" => "required",
            "photo" => "required|file",
            "stock" => "required|numeric",
            "size" => "required"
        ]);

        $image = $request->file("photo");
        $image_name = time() . "_" . $image->getClientOriginalName();
        $image->move("storage/product_photo", $image_name);

        $data["photo"] = $image_name;

        Product::create($data);
        return redirect()->route("products.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("admin.product.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            "name" => "required",
            "price" => "required|numeric",
            "description" => "required",
            "photo" => "nullable|file",
            "stock" => "required|numeric",
            "size" => "required"
        ]);
        $data["photo"] = $product->photo;

        if($request->hasFile("photo")) {
            $image = $request->file("photo");
            $image_name = time() . "_" . $image->getClientOriginalName();
            $image->move("storage/product_photo", $image_name);

            $data["photo"] = $image_name;
        }

        $product->update($data);
        Alert::success("Success", "Product has been updated");
        return redirect()->route("products.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        unlink("storage/product_photo/" . $product->photo);
        $product->delete();

        Alert::success("Success", "Product has been deleted");
        return redirect()->route("products.index");
    }
}
