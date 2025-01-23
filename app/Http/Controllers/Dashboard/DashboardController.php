<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Karyawan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNasabah = Nasabah::count();
        $totalKaryawan = Karyawan::count();
        $totalTransaksi = Transaksi::count();

        $monthlyDataTransaksi = Transaksi::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyDataNasabah = Nasabah::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $transactionCounts = [];
        foreach ($months as $index => $month) {
            $transactionCounts[] = $monthlyDataTransaksi->where('month', $index + 1)->first()->count ?? 0;
        }

        $nasabahCounts = [];
        foreach ($months as $index => $month) {
            $nasabahCounts[] = $monthlyDataNasabah->where('month', $index + 1)->first()->count ?? 0;
        }

        return view('dashboard.index', compact('months', 'totalNasabah', 'totalKaryawan', 'totalTransaksi', 'transactionCounts', 'nasabahCounts'));
    }
}
