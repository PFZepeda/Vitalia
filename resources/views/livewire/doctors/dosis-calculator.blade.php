<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Calculador de Dosis</h1>

    <!-- Selección de Paciente -->
    <div class="mb-8 p-4 bg-blue-50 rounded-lg">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Seleccionar Paciente</label>
        <select wire:model.live="selectedPatientId" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">-- Selecciona un paciente --</option>
            @foreach($patients as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Información del Paciente -->
    @if($patient)
        <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Información del Paciente</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded border border-gray-200">
                    <p class="text-xs text-gray-500 uppercase">Nombre</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $patient->name }}</p>
                </div>

                <div class="bg-white p-4 rounded border border-gray-200">
                    <p class="text-xs text-gray-500 uppercase">Edad</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $this->getAge() }} años</p>
                </div>

                <div class="bg-white p-4 rounded border border-gray-200">
                    <p class="text-xs text-gray-500 uppercase">Peso</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $patient->weight ?? 'N/A' }} kg</p>
                </div>

                <div class="bg-white p-4 rounded border border-gray-200">
                    <p class="text-xs text-gray-500 uppercase">Altura</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $patient->height ?? 'N/A' }} cm</p>
                </div>
            </div>

            @if(!$patient->weight || !$patient->height)
                <div class="mt-4 p-3 bg-yellow-100 border border-yellow-400 text-yellow-800 rounded">
                    ⚠️ Faltan datos de peso o altura. Los cálculos pueden no ser precisos.
                </div>
            @endif
        </div>

        <!-- Selección de Medicamento y Método -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Medicamento -->
            <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Medicamento</label>
                <select wire:model.live="selectedMedication" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Selecciona medicamento --</option>
                    @foreach(array_keys($medications) as $med)
                        <option value="{{ $med }}">{{ $med }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Método de Cálculo -->
            <div class="p-4 bg-purple-50 rounded-lg border border-purple-200">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Método de Cálculo</label>
                <select wire:model.live="dosisMethod" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="weight">Por Peso (Fórmula de Clark)</option>
                    <option value="age">Por Edad (Fórmula de Young)</option>
                    <option value="bsa">Por Superficie Corporal (Mosteller)</option>
                </select>
                <p class="text-xs text-gray-600 mt-2">
                    @switch($dosisMethod)
                        @case('weight')
                            Dosis = Peso (kg) × Base (mg/kg)
                            @break
                        @case('age')
                            Dosis = (Edad / Edad + 12) × Dosis Adulto
                            @break
                        @case('bsa')
                            Dosis = (BSA / 1.73) × Dosis Adulto
                            @break
                    @endswitch
                </p>
            </div>
        </div>

        <!-- Resultado del Cálculo -->
        @if($calculatedDosis)
            <div class="mb-8 p-6 bg-green-50 rounded-lg border-2 border-green-400">
                <h2 class="text-2xl font-bold text-green-800 mb-4">Dosis Calculada</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white p-4 rounded border-l-4 border-green-500">
                        <p class="text-xs text-gray-500 uppercase mb-1">Dosis Recomendada</p>
                        <p class="text-3xl font-bold text-green-600">{{ $calculatedDosis['dose'] }}</p>
                        <p class="text-sm text-gray-600">{{ $calculatedDosis['unit'] }}</p>
                    </div>

                    <div class="bg-white p-4 rounded border-l-4 border-blue-500">
                        <p class="text-xs text-gray-500 uppercase mb-1">Dosis Máxima</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $calculatedDosis['max_dose'] }}</p>
                        <p class="text-sm text-gray-600">mg/dosis</p>
                    </div>

                    <div class="bg-white p-4 rounded border-l-4 border-purple-500">
                        <p class="text-xs text-gray-500 uppercase mb-1">Método Utilizado</p>
                        <p class="text-sm font-semibold text-purple-600">{{ $calculatedDosis['method'] }}</p>
                    </div>
                </div>

                <!-- Observaciones -->
                @if(!empty($calculatedDosis['observations']))
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                        <h3 class="font-semibold text-yellow-800 mb-2">Observaciones:</h3>
                        <ul class="space-y-1">
                            @foreach($calculatedDosis['observations'] as $obs)
                                <li class="text-sm text-yellow-800">{{ $obs }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif
    @endif
</div>

<style>
    [wire\:model] {
        @apply shadow-sm;
    }
</style>
