<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        $paymentAmount = $request->input('payment_amount');
        $registrationPrice = Auth::user()->registration_price;

        if ($paymentAmount < $registrationPrice) {
            $amountUnderpaid = $registrationPrice - $paymentAmount;
            return back()->with('warning', "Anda masih kurang membayar Rp $amountUnderpaid.");
        } elseif ($paymentAmount > $registrationPrice) {
            $amountOverpaid = $paymentAmount - $registrationPrice;
            return back()->with('info', "Maaf, Anda membayar lebih Rp $amountOverpaid. Apakah Anda ingin memasukkan ke saldo?");   
        } else {
            // Jumlah pembayaran sesuai dengan harga registrasi, lanjutkan dengan pembayaran berhasil.
            $user = Auth::user();

            // Simpan data pembayaran ke dalam basis data menggunakan model Payment
            Payment::create([
                'user_id' => $user->id,
                'amount' => $paymentAmount,
            ]);

            Session::flash('success', 'Pembayaran berhasil! Terima kasih telah mendaftar.');
            return redirect()->route('home');
        }
    }
}
