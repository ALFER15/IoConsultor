<div>
    @if ($modalC)
        <h3 class="p-7 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Nueva Asignación</h3>
        <div class="mb-6">
            <form wire:submit.prevent='save'>
                <!-- Selección de Paciente -->
                <x-label class="ml-6" for="patient_id" value="Paciente"/>
                <select wire:model="patient_id" id="patient_id" class="ml-6 form-control">
                    <option value="">-- Seleccionar Paciente --</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select><br>

                <!-- Selección de Doctor -->
                <x-label class="ml-6" for="doctor_id" value="Doctor"/>
                <select wire:model="doctor_id" id="doctor_id" class="ml-6 form-control">
                    <option value="">-- Seleccionar Doctor --</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select><br>

                <!-- Selección de Diagnóstico -->
                <x-label class="ml-6" for="diagnose_id" value="Diagnóstico"/>
                <select wire:model="diagnose_id" id="diagnose_id" class="ml-6 form-control">
                    <option value="">-- Seleccionar Diagnóstico --</option>
                    @foreach ($diagnoses as $diagnose)
                        <option value="{{ $diagnose->id }}">{{ $diagnose->name }}</option>
                    @endforeach
                </select><br>

                <!-- Selección de Medicamento -->
                <x-label class="ml-6" for="medication_id" value="Medicamento"/>
                <select wire:model="medication_id" id="medication_id" class="ml-6 form-control">
                    <option value="">-- Seleccionar Medicamento --</option>
                    @foreach ($medications as $medication)
                        <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                    @endforeach
                </select><br>

                <x-label class="ml-6" for="date" value="Fecha"/>
                <input type="date" wire:model="date" id="date" class="ml-6 form-control">

                <x-button class="ml-6 mt-2">Guardar</x-button>
                <x-danger-button wire:click="$set('modalC', false)">Cerrar</x-danger-button>
            </form>
        </div>
    @endif

    <div class="relative overflow-x-auto">
        <div class="flex justify-between items-center p-7">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Asignaciones</h2>
            <div class="flex items-center space-x-4">
                <button wire:click="$set('modalC', true)" class="px-3 py-2 text-sm bg-gray-200 hover:bg-gray-300 rounded">Crear</button>
                <div class="relative">
                    <x-input name="search-category" placeholder="Busqueda" wire:model.live='search' />
                </div>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Paciente</th>
                    <th scope="col" class="px-6 py-3">Doctor</th>
                    <th scope="col" class="px-6 py-3">Diagnóstico</th>
                    <th scope="col" class="px-6 py-3">Medicamento</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignments as $assignment)
                <tr wire:key="{{ $assignment->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $assignment->id }}</th>
                    <td class="px-6 py-4">{{ $assignment->patient->name ?? 'Sin Paciente' }}</td>
                    <td class="px-6 py-4">{{ $assignment->doctor->name ?? 'Sin Doctor' }}</td>
                    <td class="px-6 py-4">{{ $assignment->diagnose->name ?? 'Sin Diagnóstico' }}</td>
                    <td class="px-6 py-4">{{ $assignment->medication->name ?? 'Sin Medicamento' }}</td>
                    <td class="px-6 py-4">
                        <x-danger-button wire:click='delete({{$assignment->id}})'>Eliminar</x-danger-button>
                        <x-button class="text-orange-600 active:bg-orange-400 bg-white hover:bg-orange-300 border-orange-600 border-2" wire:click='edit({{$assignment->id}})'>Editar</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $assignments->links() }}
        </div>
    </div>

    @if ($modalE)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
        <div class="py-12">
            <div class="bg-white shadow rounded-lg p-6">
                <form class="max-w-lg mx-auto" wire:submit.prevent='update'>
                    <div class="mb-4"><span>Editar Asignación:</span></div>
                    <!-- Similar fields as the create form -->
                    <x-label class="w-full" for="patient_id" value="Paciente"/>
                    <select wire:model="Edit.patient_id" id="patient_id" class="w-full form-control">
                        <option value="">-- Seleccionar Paciente --</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select><br>

                    <!-- Añadiendo los campos faltantes en el modal de edición -->
                    <x-label class="w-full" for="doctor_id" value="Doctor"/>
                    <select wire:model="Edit.doctor_id" id="doctor_id" class="w-full form-control">
                        <option value="">-- Seleccionar Doctor --</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select><br>

                    <x-label class="w-full" for="diagnose_id" value="Diagnóstico"/>
                    <select wire:model="Edit.diagnose_id" id="diagnose_id" class="w-full form-control">
                        <option value="">-- Seleccionar Diagnóstico --</option>
                        @foreach ($diagnoses as $diagnose)
                            <option value="{{ $diagnose->id }}">{{ $diagnose->name }}</option>
                        @endforeach
                    </select><br>

                    <x-label class="w-full" for="medication_id" value="Medicamento"/>
                    <select wire:model="Edit.medication_id" id="medication_id" class="w-full form-control">
                        <option value="">-- Seleccionar Medicamento --</option>
                        @foreach ($medications as $medication)
                            <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                        @endforeach
                    </select><br>
                    <x-label class="ml-6" for="date" value="Fecha"/>
                    <input type="date" wire:model="date" id="date" class="ml-6 form-control">

                    <x-danger-button class="mt-2" wire:click="$set('modalE', false)">Cancelar</x-danger-button>
                    <x-button class="mt-2">Actualizar</x-button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
