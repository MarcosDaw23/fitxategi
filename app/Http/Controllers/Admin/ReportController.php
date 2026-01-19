<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());
        $userId = $request->input('user_id');

        $query = Attendance::with('user')
            ->whereBetween('date', [$startDate, $endDate]);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        // Estadísticas
        $stats = [
            'total_attendances' => $attendances->count(),
            'total_hours' => floor($attendances->sum('total_minutes') / 60),
            'total_minutes' => $attendances->sum('total_minutes') % 60,
            'unique_users' => $attendances->pluck('user_id')->unique()->count(),
            'avg_hours_per_day' => $attendances->count() > 0 
                ? floor(($attendances->sum('total_minutes') / $attendances->count()) / 60)
                : 0,
        ];

        // Usuarios para el filtro
        $users = User::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('reports.index', compact('attendances', 'stats', 'users', 'startDate', 'endDate', 'userId'));
    }

    public function export(Request $request)
    {
        $format = $request->input('format', 'csv'); // csv, pdf, excel
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());
        $userId = $request->input('user_id');

        $query = Attendance::with('user')
            ->whereBetween('date', [$startDate, $endDate]);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        if ($format === 'csv') {
            return $this->exportCSV($attendances);
        }

        // Para PDF y Excel, se necesitarían paquetes adicionales
        return redirect()->back()->with('info', 'Formato de exportación en desarrollo');
    }

    private function exportCSV($attendances)
    {
        $filename = 'asistencias_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($attendances) {
            $file = fopen('php://output', 'w');
            
            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Cabeceras
            fputcsv($file, [
                'Usuario',
                'Email',
                'Fecha',
                'Entrada',
                'Salida',
                'Duración (minutos)',
                'Estado',
                'Notas'
            ]);

            // Datos
            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    $attendance->user->name,
                    $attendance->user->email,
                    $attendance->date->format('d/m/Y'),
                    $attendance->check_in->format('H:i'),
                    $attendance->check_out ? $attendance->check_out->format('H:i') : '',
                    $attendance->total_minutes ?? 0,
                    $attendance->status,
                    $attendance->notes ?? ''
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
