<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Новая поставка') }}
            </h2>
            <a href="{{route('shipment.index')}}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm ">Вернуться назад</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form action="{{route('shipment.store')}}">
                        <x-splade-select name="provider_id" label="Поставщик" :options="$provider" required/>
                        <x-splade-input name="ship_date" label="Дата поставки" required date/>
                        <x-splade-select name="status_id" label="Статус" :options="$status" required/>
                        <x-splade-submit label="Сохранить" class="mt-4 bg-gray-800 text-white"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

