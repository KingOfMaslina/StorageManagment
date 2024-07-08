<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $manufacturer->name }}
            </h2>
            <a href="{{route('manufacturer.index')}}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm ">Назад</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  grid md:grid-cols-2 gap-4">
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg gap-4">
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Имя директора:</p>  {{$manufacturer->boss}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Фамилия директора:</p>  {{$manufacturer->boss_last_name}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Отчество директора:</p>  {{$manufacturer->boss_father_name}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">ИНН:</p>  {{$manufacturer->inn}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Номер телефона:</p>  {{$manufacturer->phone}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Эл.почта:</p>  {{$manufacturer->email}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
