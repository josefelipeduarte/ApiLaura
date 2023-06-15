<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function amountPerClassification(?int $year = null)
    {
        $complaints = Complaint::select('classification', DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', $year ?? (int) date('Y'))
            ->groupBy('classification')
            ->get();

        return $complaints;
    }

    public function amountPerMonth(int $year)
    {
        $complaints = Complaint::select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', $year)
            ->groupBy('month')
            ->get();

        return $complaints;
    }

    public function amountPerSchool(?int $year = null)
    {
        $complaints = Complaint::select(
            DB::raw('(select x.name from schools x where x.id = school_id) as name'),
            DB::raw('count(*) as total'),
        )
            ->whereYear('created_at', '=', $year ?? (int) date('Y'))
            ->groupBy('name')
            ->get();

        return $complaints;
    }
}
