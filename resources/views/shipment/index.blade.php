<x-app-layout>
    <x-slot name="header">

        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Поставки') }}
            </h2>
            <a href="{{ route('shipment.create') }}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm">{{ __('Добавить') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-table :for="$shipments">
                        @cell('action', $shipment)
                        <Link method="DELETE" href="{{ route('shipment.destroy', $shipment->id) }}" class="text-red-500" confirm="Внимание! Информация будет удалена" confirm-text="Вы действительно хотите продолжить?" confirm-button="Удалить" cancel-button="Отмена" >Удалить</Link>
                        <Link href="{{route('shipment.edit',$shipment->id )}}" class="text-blue-400 ml-4">Редактировать</Link>
                        @endcell
                        @cell('shipmentfull',$shipment)
                        <Link href="{{route('shipmentfull.index', $shipment->id)}}" class="text-blue-500">Перейти</Link>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
