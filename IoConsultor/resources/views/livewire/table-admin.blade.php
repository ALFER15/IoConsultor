<div>
    <div class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg">
        <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-4">Administrar Tablas</h2>

        <style>
            .custom-button {
    padding: 0.5rem 1rem;
    background: linear-gradient(45deg, #000, #333); /* Degradado oscuro */
    color: white;
    border-radius: 0.5rem;
    font-size: 1rem;
    transition: background 0.3s ease, transform 0.2s ease;
}

.custom-button:hover {
    background: linear-gradient(45deg, #e53e3e, #e53e3e);
    transform: scale(1.05);
}

.custom-button:active {
    background: #e53e3e;
}

.custom-button:focus {
     background: linear-gradient(45deg, #e53e3e, #e53e3e);
    transform: scale(1.05);
}
        </style>

        <!-- Botones para alternar entre CRUDs -->
        <div class="flex space-x-4 mb-6">
            <button wire:click="setModalTable('Assignment')" class="custom-button">
                Asignaciones
            </button>
            <button wire:click="setModalTable('Patient')" class="custom-button">
                Pacientes
            </button>
            <button wire:click="setModalTable('Doctor')" class="custom-button">
                Doctores
            </button>
            <button wire:click="setModalTable('Medication')" class="custom-button">
                Medicamentos
            </button>
            <button wire:click="setModalTable('Diagnose')" class="custom-button">
                Diagnosticos
            </button>
        </div>

        <!-- Mostrar el CRUD correspondiente -->
        <div>
            @if ($modalTable === 'Assignment')
                @livewire('live-a')
            @elseif ($modalTable === 'Patient')
                @livewire('live-patient')
            @elseif ($modalTable === 'Doctor')
                @livewire('live-doctor')
            @elseif ($modalTable === 'Medication')
                @livewire('live-medication')
            @elseif ($modalTable === 'Diagnose')
                @livewire('live-diagnose')
            @else
                <p class="text-gray-500">Selecciona un CRUD para administrar.</p>
            @endif
        </div>
    </div>
</div>
