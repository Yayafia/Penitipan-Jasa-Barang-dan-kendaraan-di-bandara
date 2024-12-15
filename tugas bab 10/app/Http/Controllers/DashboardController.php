<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.dashboard ', compact('categories'));
    }

    public function cetak()
    {
        $categories = Category::all();
        $transaction = Transaction::all();
        $pdf = Pdf::loadview('dashboard.dashboard-cetak', compact('categories', 'transactions'));
        return $pdf->download('laporan-categories-transactions.pdf');
    }
}
