<div>
    @if ($modalC)
        <h3 class="p-7 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Nuevo Diagnóstico</h3>
        <div class="mb-6">
            <form wire:submit.prevent='save'>
                <x-label class="ml-6" for="name" value="Nombre del diagnostico"/>
                <x-input class="ml-6" wire:model='name'/><br>
                <x-label class="ml-6" for="description" value="Descripción del Diagnóstico"/>
                <x-input class="ml-6" type="text" wire:model='description'/>
                <x-button class="ml-6 mt-2">Guardar</x-button>
                <x-danger-button wire:click="$set('modalC', false)">Cerrar</x-danger-button>
            </form>
        </div>
    @endif

    <div class="relative overflow-x-auto">
        <div class="flex justify-between items-center p-7">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Diagnósticos</h2>
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
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3">Nombre del diagnostico</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($diagnoses as $diagnose)
                <tr wire:key="{{ $diagnose->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $diagnose->id }}</th>
                    <td class="px-6 py-4">{{ $diagnose->description }}</td>
                    <td class="px-6 py-4">{{ $diagnose->name }}</td>
                    <td class="px-6 py-4">
                        <x-danger-button wire:click='delete({{$diagnose->id}})'>Eliminar</x-danger-button>
                        <x-button class="text-orange-600 active:bg-orange-400 bg-white hover:bg-orange-300 border-orange-600 border-2" wire:click='edit({{$diagnose->id}})'>Editar</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $diagnoses->links() }}
        </div>
    </div>

    @if ($modalE)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
        <div class="py-12">
            <div class="bg-white shadow rounded-lg p-6">
                <form class="max-w-lg mx-auto" wire:submit.prevent='update'>
                    <div class="mb-4"><span>Editar Diagnóstico:</span></div>
                    <x-label class="w-full" for="name" value="Nombre del diagnostico"/>
                    <x-input class="w-full" name="name" wire:model='Edit.name'/><br>
                    <x-label class="w-full" for="description" value="Descripción"/>
                    <x-input class="w-full" name="description" wire:model='Edit.description'/>
                    <x-danger-button class="mt-2" wire:click="$set('modalE', false)">Cancelar</x-danger-button>
                    <x-button class="mt-2 ">Actualizar</x-button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
