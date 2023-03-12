<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = Product::with("wishlist")->whereHas("wishlist", function($query) {
            $query->where("user_id", auth()->user()->id);
        })->get();
        return view("user.wishlist", compact("wishlists"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $wishlist = Wishlist::where("user_id", auth()->user()->id)->where("product_id", $request->product_id)->first();
        if($wishlist) {
            Alert::error("Error", "Product already added to wishlist");
            return redirect()->back();
        }

        Wishlist::create([
            "user_id" => auth()->user()->id,
            "product_id" => $request->product_id
        ]);

        Alert::success("Success", "Product added to wishlist");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($wishlist)
    {
        $wishlist = Wishlist::where("user_id", auth()->user()->id)->where("product_id", $wishlist)->first();
        $wishlist->delete();

        Alert::success("Success", "Product removed from wishlist");
        return redirect()->back();
    }
}
