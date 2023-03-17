<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Transaction;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.index");
    }

    public function listPesanan()
    {
        $index = 1 + (request()->page ?? 1) * 5 - 5;

        $transactions = Transaction::orderBy("created_at", "desc")->paginate(5);
        return view("admin.list-pesanan", compact("transactions", "index"));
    }

    public function updateStatusPesanan(Request $request, Transaction $transaction, $desc)
    {
        if($desc == "batal") {
            $transaction->alasan_pembatalan = $request->alasan_pembatalan;
        }
        if($desc == "dikirim") {
            $transaction->no_resi = $request->no_resi;
            // upload image
            $image = $request->file("bukti_telah_kirim");
            $image_name = time() . "." . $image->getClientOriginalName();
            $image->move("storage/bukti_pengiriman_jersey", $image_name);
            $transaction->bukti_telah_dikirim = $image_name;
        }
        if($desc == "diproses") {
            $product = $transaction->product;
            $product->update([
                "stock" => $product->stock - $transaction->quantity
            ]);
        }

        $transaction->status = $desc;
        $transaction->save();

        Alert::success("Berhasil", "Status pesanan dengan berhasil diubah");
        return redirect()->back();
    }
}
