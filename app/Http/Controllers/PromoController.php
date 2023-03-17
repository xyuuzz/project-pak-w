<?php

namespace App\Http\Controllers;

use App\Models\{
    Promo,
    Product
};
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = 1 + (request()->page ?? 1) * 3 - 3;

        $promos = Promo::with("product")->orderBy("created_at", "desc")->simplePaginate(3);
        return view("admin.promo.index", compact("promos", "index"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view("admin.promo.create", compact("products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "product_id" => "required",
            "description" => "required",
            "start" => "required|date|after:now",
            "end" => "required|date|after:start",
            "new_price" => "required"
        ]);

        if($data["new_price"] > Product::firstWhere($data["product_id"])?->price) {
            Alert::error("Error", "New price must be lower than the original price");
            return redirect()->back();
        }

        Promo::create($data);

        Alert::success("Success", "Promo has been added");
        return redirect()->route("promo.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promo $promo)
    {
        $products = Product::all();
        return view("admin.promo.edit", compact("promo", "products"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        $data = $request->validate([
            "product_id" => "required",
            "description" => "required",
            "start" => "required|date|after:now",
            "end" => "required|date|after:start",
            "new_price" => "required"
        ]);

        if($data["new_price"] > $promo->product->price) {
            Alert::error("Error", "New price must be lower than the original price");
            return redirect()->back();
        }

        $promo->update($data);

        Alert::success("Success", "Promo has been updated");
        return redirect()->route("promo.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        $promo->delete();

        Alert::success("Success", "Promo has been deleted");
        return redirect()->route("promo.index");
    }
}
