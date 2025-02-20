<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Karyawan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|customer service|approval|appraisal');
    }

    public function index(Request $request)
    {
        // $user = Auth::user();
        // dd($user->roles->pluck('name'));

        $selectedYear = $request->input('year', Carbon::now()->year);

        $totalNasabah = Nasabah::whereYear('created_at', $selectedYear)->count();
        $totalKaryawan = Karyawan::whereYear('created_at', $selectedYear)->count();
        $totalTransaksi = Transaksi::whereYear('created_at', $selectedYear)->count();

        $monthlyDataTransaksi = Transaksi::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyDataNasabah = Nasabah::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $selectedYear)
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

        $availableYears = Transaksi::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('dashboard.index', compact(
            'months',
            'totalNasabah',
            'totalKaryawan',
            'totalTransaksi',
            'transactionCounts',
            'nasabahCounts',
            'selectedYear',
            'availableYears'
        ));
    }
}
