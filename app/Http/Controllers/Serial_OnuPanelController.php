<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Serial_OnuPanelController extends Controller
{
    public function quantPorTipo(?int $ano = null)
    {
        $complaints = Serial::select('tipo_onu_estoque', DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', $ano ?? (int) date('Y'))
            ->groupBy('tipo_onu_estoque')
            ->get();

        return $complaints;
    }

    public function quantMes(int $ano)
    {
        $serial = Serial::select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', $ano)
            ->groupBy('month')
            ->get();

        return $serial;
    }
}
