<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="mr-4 text-gray-600 dark:text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Historial de Asistencias
                    </h2>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Lista de asistencias -->
            <div class="space-y-4">
                @forelse($attendances as $attendance)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $attendance->date->locale('es')->isoFormat('dddd, D [de] MMMM') }}
                                    </span>
                                    <span class="ml-3 px-3 py-1 rounded-full text-xs font-medium
                                        {{ $attendance->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : '' }}
                                        {{ $attendance->status === 'active' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : '' }}
                                        {{ $attendance->status === 'incomplete' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : '' }}">
                                        {{ $attendance->status === 'completed' ? 'Completado' : ($attendance->status === 'active' ? 'Activo' : 'Incompleto') }}
                                    </span>
                                </div>
                                
                                <div class="space-y-1 text-sm text-gray-600 dark:text-gray-400">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Entrada: {{ $attendance->check_in->format('H:i') }}</span>
                                    </div>
                                    
                                    @if($attendance->check_out)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Salida: {{ $attendance->check_out->format('H:i') }}</span>
                                        </div>
                                    @endif

                                    @if($attendance->notes)
                                        <div class="mt-2 text-xs italic">
                                            <span class="font-medium">Nota:</span> {{ $attendance->notes }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            @if($attendance->total_minutes)
                                <div class="text-right ml-4">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $attendance->formatted_duration }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        Total
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">
                            No tienes asistencias registradas aún
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $attendances->links() }}
            </div>

            <!-- Estadísticas -->
            @if($attendances->count() > 0)
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total de asistencias</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $attendances->total() }}
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Horas totales</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ floor($attendances->sum('total_minutes') / 60) }}h {{ $attendances->sum('total_minutes') % 60 }}m
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Promedio diario</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">
                            @php
                                $avg = $attendances->count() > 0 ? $attendances->sum('total_minutes') / $attendances->count() : 0;
                            @endphp
                            {{ floor($avg / 60) }}h {{ floor($avg % 60) }}m
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

