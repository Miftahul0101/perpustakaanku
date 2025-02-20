<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DendaPayment;
class DendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:petugas');
    }

    public function index()
    {
        $dendaPayments = DendaPayment::with('user')->where('payment_status', 'unpaid')->get();
        return view('denda.index', compact('dendaPayments'));
    }

    public function processPayment(Request $request)
    {
        $payment = DendaPayment::findOrFail($request->payment_id);
        $payment->payment_status = 'paid';
        $payment->notes = $request->notes;
        $payment->save();

        return redirect()->route('denda.index')->with('success', 'Pembayaran denda berhasil diproses');
    }
}