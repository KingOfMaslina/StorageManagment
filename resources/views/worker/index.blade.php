<x-app-layout>
    <x-slot name="header">

        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Сотрудники') }}
            </h2>
            <a href="{{ route('worker.create') }}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm">{{ __('Добавить') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-table :for="$workers">
                        @cell('action', $worker)
                        <Link method="DELETE" href="{{ route('worker.destroy', $worker->id) }}" class="text-red-500" confirm="Внимание! Информация будет удалена" confirm-text="Вы действительно хотите продолжить?" confirm-button="Удалить" cancel-button="Отмена" >Удалить</Link>
                        <Link href="{{route('worker.edit',$worker->id )}}" class="text-blue-400 ml-4">Редактировать</Link>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


