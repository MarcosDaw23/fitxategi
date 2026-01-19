<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Registrar entrada (check-in)
     */
    public function checkIn()
    {
        $user = auth()->user();
        $today = Carbon::today();
        
        // Verificar si ya existe una asistencia activa
        $activeAttendance = $user->getTodayActiveAttendance();
        
        if ($activeAttendance) {
            return redirect()->back()->with('error', 'Ya tienes una asistencia activa.');
        }
        
        // Crear nueva asistencia
        Attendance::create([
            'user_id' => $user->id,
            'check_in' => Carbon::now(),
            'date' => $today,
            'status' => 'active',
        ]);
        
        return redirect()->back()->with('success', 'Entrada registrada correctamente.');
    }
    
    /**
     * Registrar salida (check-out)
     */
    public function checkOut()
    {
        $user = auth()->user();
        
        // Obtener asistencia activa
        $activeAttendance = $user->getTodayActiveAttendance();
        
        if (!$activeAttendance) {
            return redirect()->back()->with('error', 'No tienes una asistencia activa.');
        }
        
        // Actualizar con hora de salida
        $checkOut = Carbon::now();
        $totalMinutes = $activeAttendance->check_in->diffInMinutes($checkOut);
        
        $activeAttendance->update([
            'check_out' => $checkOut,
            'total_minutes' => $totalMinutes,
            'status' => 'completed',
        ]);
        
        return redirect()->back()->with('success', 'Salida registrada correctamente.');
    }
    
    /**
     * Mostrar historial de asistencias
     */
    public function history()
    {
        $user = auth()->user();
        
        $attendances = $user->attendances()
            ->orderBy('date', 'desc')
            ->orderBy('check_in', 'desc')
            ->paginate(20);
        
        return view('attendance.history', compact('attendances'));
    }
    
    /**
     * Ver todas las asistencias (solo para profesores y administradores)
     */
    public function all()
    {
        $attendances = Attendance::with('user')
            ->orderBy('date', 'desc')
            ->orderBy('check_in', 'desc')
            ->paginate(50);
        
        return view('attendance.all', compact('attendances'));
    }
}
