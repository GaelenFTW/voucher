<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Winner;

class VoucherController extends Controller
{
    public function index()
    {
        $winners = \App\Models\Winner::latest()->get(); // ambil semua pemenang
        return view('voucher.index', compact('winners'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
        ]);

        $voucher = Voucher::where('voucher_code', $request->voucher_code)->first();
        $winners = \App\Models\Winner::latest()->get();

        if (!$voucher) {
            return redirect()->route('voucher.index')->with('error', 'Voucher not found');
        }

        return view('voucher.winner', compact('voucher', 'winners'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
            'gift_type'    => 'required|string',
        ]);

        $voucher = Voucher::where('voucher_code', $request->voucher_code)->first();

        if (!$voucher) {
            return redirect()->route('voucher.index')->with('error', 'Voucher not found');
        }

        // Cek apakah sudah menang
        if (Winner::where('voucher_code', $voucher->voucher_code)->exists()) {
            return redirect()->route('voucher.index')->with('error', 'This voucher has already won.');
        }

        // Simpan ke tabel winners
        Winner::create([
            'voucher_code' => $voucher->voucher_code,
            'customer_id'  => $voucher->customer_id,
            'full_name'    => $voucher->full_name,
            'promo_name'   => $voucher->promo_name,
            'gift_type'    => $request->gift_type,
        ]);

        return redirect()->route('voucher.index')->with('success', 'Winner processed successfully!');
    }
}
