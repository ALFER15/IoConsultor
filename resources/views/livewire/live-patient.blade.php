<div>
    @if ($modalC)
        <h3 class="p-7 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Nuevo Paciente</h3>
        <div class="mb-6">
            <form wire:submit.prevent='save'>
                <x-label class="ml-6" for="name" value="Nombre del Paciente"/>
                <x-input class="ml-6" type="text" wire:model='name'/>
                <x-label class="ml-6" for="email" value="Correo Electrónico"/>
                <x-input class="ml-6" type="email" wire:model='email'/><br>
                <x-label class="ml-6" for="phone" value="Teléfono"/>
                <x-input class="ml-6" type="text" wire:model='phone'/><br>
                <x-label class="ml-6" for="age" value="Edad"/>
                <x-input class="ml-6" type="number" wire:model='age'/><br>
                <x-button class="ml-6 mt-2">Guardar</x-button>
                <x-danger-button wire:click="$set('modalC', false)">Cerrar</x-danger-button>
            </form>
        </div>
    @endif

    <div class="relative overflow-x-auto">
        <div class="flex justify-between items-center p-7">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Pacientes</h2>
            <div class="flex items-center space-x-4">
                <button wire:click="$set('modalC', true)" class="px-3 py-2 text-sm bg-gray-200 hover:bg-gray-300 rounded">Crear</button>
                <div class="relative">
                    <input type="search"
                           wire:model.debounce.300ms="search"
                           class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Buscar pacientes..."/>
                </div>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Correo</th>
                    <th scope="col" class="px-6 py-3">Teléfono</th>
                    <th scope="col" class="px-6 py-3">Edad</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                <tr wire:key="{{ $patient->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $patient->id }}</th>
                    <td class="px-6 py-4">{{ $patient->name }}</td>
                    <td class="px-6 py-4">{{ $patient->email }}</td>
                    <td class="px-6 py-4">{{ $patient->phone }}</td>
                    <td class="px-6 py-4">{{ $patient->age }}</td>
                    <td class="px-6 py-4">
                        <x-danger-button wire:click='delete({{$patient->id}})'>Eliminar</x-danger-button>
                        <x-button class="text-orange-600 active:bg-orange-400 bg-white hover:bg-orange-300 border-orange-600 border-2" wire:click='edit({{$patient->id}})'>Editar</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $patients->links() }}
        </div>
    </div>

    @if ($modalE)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
        <div class="py-12">
            <div class="bg-white shadow rounded-lg p-6">
                <form class="max-w-lg mx-auto" wire:submit.prevent='update'>
                    <div class="mb-4"><span>Editar Paciente:</span></div>
                    <x-label class="w-full" for="name" value="Nombre"/>
                    <x-input class="w-full" name="name" wire:model='Edit.name'/>
                    <x-label class="w-full" for="email" value="Correo Electrónico"/>
                    <x-input class="w-full" name="email" wire:model='Edit.email'/><br>
                    <x-label class="w-full" for="age" value="Edad"/>
                    <x-input class="w-full" type="number" name="age" wire:model='Edit.age'/><br>
                    <x-label class="w-full" for="phone" value="phone"/>
                    <x-input class="w-full" name="phone" wire:model='Edit.phone'/><br>
                    <x-danger-button class="mt-2" wire:click="$set('modalE', false)">Cancelar</x-danger-button>
                    <x-button class="mt-2">Actualizar</x-button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

