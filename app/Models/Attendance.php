<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $table = 'historial';
    
    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
        'total_minutes',
        'date',
        'status',
        'notes',
        'location',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'date' => 'date',
    ];

    /**
     * Relación con el usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calcular duración en minutos
     */
    public function calculateDuration(): int
    {
        if ($this->check_in && $this->check_out) {
            return $this->check_in->diffInMinutes($this->check_out);
        }
        return 0;
    }

    /**
     * Formatear duración como horas y minutos
     */
    public function getFormattedDurationAttribute(): string
    {
        $minutes = $this->total_minutes ?? 0;
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;
        return sprintf('%dh %dm', $hours, $mins);
    }
}
