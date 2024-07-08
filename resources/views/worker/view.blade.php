<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $worker->name }} {{ $worker->last_name }} {{ $worker->father_name }}
            </h2>
            <a href="{{route('worker.index')}}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm ">Назад</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  grid md:grid-cols-2 gap-4">
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg gap-4">
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Номер телефона:</p>  {{$worker->phone}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Эл.почта:</p>  {{$worker->email}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Паспортные данные:</p>  {{$worker->passport}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Адрес прописки:</p>  {{$worker->regaddress}}
                    </div>
                    <div class="font-semibold text-xl">
                        <p class="pt-4 font-semibold">Фактический адрес:</p>  {{$worker->address_id}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


