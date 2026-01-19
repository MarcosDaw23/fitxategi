<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Header Mobile -->
        <div class="bg-white dark:bg-gray-800 shadow sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Fitxategi
                    </h2>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('attendance.history') }}" class="text-gray-600 dark:text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="text-gray-600 dark:text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            
            <!-- Card de Cronómetro -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 mb-6">
                <div class="text-center">
                    <!-- Icono de reloj -->
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <!-- Cronómetro -->
                    @if($activeAttendance)
                        <div class="text-6xl font-bold text-gray-900 dark:text-white mb-4" id="timer">
                            00:00:00
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">
                            Entrada: {{ $activeAttendance->check_in->format('H:i') }}
                        </p>
                    @else
                        <div class="text-6xl font-bold text-gray-900 dark:text-white mb-4">
                            00:00<span class="text-4xl">:00</span>
                        </div>
                        <p class="text-rose-400 bg-rose-50 dark:bg-rose-900/20 px-4 py-2 rounded-full inline-block mb-6">
                            Sin registros hoy
                        </p>
                    @endif

                    <!-- Botón de acción -->
                    @if($activeAttendance)
                        <form action="{{ route('attendance.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-2xl text-lg transition duration-200 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                                </svg>
                                Finalizar
                            </button>
                        </form>
                    @else
                        <form action="{{ route('attendance.checkin') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-gray-800 dark:bg-gray-700 hover:bg-gray-900 dark:hover:bg-gray-600 text-white font-semibold py-4 px-8 rounded-2xl text-lg transition duration-200 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Iniciar
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Calendario -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Mi calendario
                    </h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navegación del calendario -->
                <div class="flex justify-between items-center mb-6">
                    <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">
                        {{ $today->locale('es')->isoFormat('MMMM YYYY') }}
                    </h4>
                    <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Grid del calendario -->
                <div class="grid grid-cols-7 gap-2 mb-4">
                    @php
                        $daysOfWeek = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
                    @endphp
                    @foreach($daysOfWeek as $day)
                        <div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400 py-2">
                            {{ $day }}
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-2">
                    @php
                        $startOfMonth = $today->copy()->startOfMonth();
                        $endOfMonth = $today->copy()->endOfMonth();
                        $startDay = $startOfMonth->copy()->startOfWeek();
                        $endDay = $endOfMonth->copy()->endOfWeek();
                        $currentDay = $startDay->copy();
                        $attendanceDates = $monthAttendances->pluck('date')->map(fn($d) => $d->format('Y-m-d'))->toArray();
                    @endphp

                    @while($currentDay <= $endDay)
                        @php
                            $isCurrentMonth = $currentDay->month == $today->month;
                            $isToday = $currentDay->isToday();
                            $hasAttendance = in_array($currentDay->format('Y-m-d'), $attendanceDates);
                        @endphp
                        
                        <div class="aspect-square flex items-center justify-center relative">
                            <button class="w-full h-full flex flex-col items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition
                                {{ $isToday ? 'ring-2 ring-gray-900 dark:ring-white' : '' }}
                                {{ !$isCurrentMonth ? 'opacity-40' : '' }}
                                {{ $hasAttendance ? 'bg-yellow-100 dark:bg-yellow-900/30' : '' }}">
                                <span class="text-sm {{ $isCurrentMonth ? 'text-gray-900 dark:text-white' : 'text-gray-400' }}">
                                    {{ $currentDay->day }}
                                </span>
                                @if($hasAttendance)
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mt-1"></span>
                                @endif
                            </button>
                        </div>
                        
                        @php $currentDay->addDay(); @endphp
                    @endwhile
                </div>

                <!-- Tiempo disponible -->
                <div class="mt-6 p-4 bg-cyan-50 dark:bg-cyan-900/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-cyan-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="text-cyan-700 dark:text-cyan-300 font-medium">
                        {{ floor($monthTotal / 60) }}h {{ $monthTotal % 60 }}m
                    </span>
                    <span class="text-cyan-600 dark:text-cyan-400 ml-2">
                        este mes
                    </span>
                </div>
            </div>

            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="mt-4 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mt-4 p-4 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

    @if($activeAttendance)
    <script>
        // Timer actualizado en tiempo real
        const startTime = new Date('{{ $activeAttendance->check_in->toIso8601String() }}');
        
        function updateTimer() {
            const now = new Date();
            const diff = Math.floor((now - startTime) / 1000);
            
            const hours = Math.floor(diff / 3600);
            const minutes = Math.floor((diff % 3600) / 60);
            const seconds = diff % 60;
            
            const timerElement = document.getElementById('timer');
            if (timerElement) {
                timerElement.textContent = 
                    String(hours).padStart(2, '0') + ':' +
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');
            }
        }
        
        updateTimer();
        setInterval(updateTimer, 1000);
    </script>
    @endif
</x-app-layout>

