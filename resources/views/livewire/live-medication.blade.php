<div>
    @if ($modalC)
        <h3 class="p-7 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Nueva Medicación</h3>
        <div class="mb-6">
            <form wire:submit.prevent='save'>
                <x-label class="ml-6" for="name" value="Nombre de la Medicación"/>
                <x-input class="ml-6" type="text" wire:model='name'/>
                <x-label class="ml-6" for="description" value="Descripción"/>
                <textarea class="ml-6" wire:model='description' rows="3" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm"></textarea>
                <x-label class="ml-6" for="dosage" value="Dosificación"/>
                <x-input class="ml-6" type="text" wire:model='dosage'/><br>
                <x-button class="ml-6 mt-2">Guardar</x-button>
                <x-danger-button wire:click="$set('modalC', false)">Cerrar</x-danger-button>
            </form>
        </div>
    @endif

    <div class="relative overflow-x-auto">
        <div class="flex justify-between items-center p-7">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Medicaciones</h2>
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
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3">Dosificación</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medications as $medication)
                <tr wire:key="{{ $medication->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $medication->id }}</th>
                    <td class="px-6 py-4">{{ $medication->name }}</td>
                    <td class="px-6 py-4">{{ $medication->description }}</td>
                    <td class="px-6 py-4">{{ $medication->dosage }}</td>
                    <td class="px-6 py-4">
                        <x-danger-button wire:click='delete({{ $medication->id }})'>Eliminar</x-danger-button>
                        <x-button class="text-white bg-gray-600 hover:bg-orange-400 active:bg-orange-500 border-orange-600 border-2" wire:click='edit({{$medication->id}})'>Editar</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $medications->links() }}
        </div>
    </div>

    @if ($modalE)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
        <div class="py-12">
            <div class="bg-white shadow rounded-lg p-6">
                <form class="max-w-lg mx-auto" wire:submit.prevent='update'>
                    <div class="mb-4"><span>Editar Medicación:</span></div>
                    <x-label class="w-full" for="name" value="Nombre"/>
                    <x-input class="w-full" name="name" wire:model='Edit.name'/>
                    <x-label class="w-full" for="description" value="Descripción"/>
                    <textarea class="w-full mt-1 border-gray-300 rounded-md shadow-sm" name="description" wire:model='Edit.description' rows="3"></textarea>
                    <x-label class="w-full" for="dosage" value="Dosificación"/>
                    <x-input class="w-full" name="dosage" wire:model='Edit.dosage'/><br>
                    <x-danger-button class="mt-2" wire:click="$set('modalE', false)">Cancelar</x-danger-button>
                    <x-button class="mt-2">Actualizar</x-button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
