<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'identification',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relación con el rol
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relación con las asistencias
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Verificar si el usuario es estudiante
     */
    public function isStudent(): bool
    {
        return $this->role && $this->role->name === 'estudiante';
    }

    /**
     * Verificar si el usuario es profesor
     */
    public function isTeacher(): bool
    {
        return $this->role && $this->role->name === 'profesor';
    }

    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin(): bool
    {
        return $this->role && $this->role->name === 'administrador';
    }

    /**
     * Obtener la asistencia activa del día
     */
    public function getTodayActiveAttendance()
    {
        return $this->attendances()
            ->whereDate('date', today())
            ->where('status', 'active')
            ->first();
    }
}
