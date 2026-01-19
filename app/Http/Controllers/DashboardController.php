<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();
        
        // Obtener asistencia activa del día si existe
        $activeAttendance = $user->getTodayActiveAttendance();
        
        // Obtener asistencias del mes actual para el calendario
        $monthAttendances = $user->attendances()
            ->whereYear('date', $today->year)
            ->whereMonth('date', $today->month)
            ->get();
        
        // Calcular total de horas del día
        $todayTotal = $user->attendances()
            ->whereDate('date', $today)
            ->where('status', 'completed')
            ->sum('total_minutes');
        
        // Calcular total de horas del mes
        $monthTotal = $user->attendances()
            ->whereYear('date', $today->year)
            ->whereMonth('date', $today->month)
            ->where('status', 'completed')
            ->sum('total_minutes');
        
        return view('dashboard.index', compact(
            'activeAttendance',
            'monthAttendances',
            'todayTotal',
            'monthTotal',
            'today'
        ));
    }
}
