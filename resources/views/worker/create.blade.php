<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Новый сотрудник') }}
            </h2>
            <a href="{{route('worker.index')}}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm ">Вернуться назад</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form action="{{route('worker.store')}}">
                        <x-splade-input name="name" label="Имя"  required/>
                        <x-splade-input name="last_name" label="Фамилия"  required/>
                        <x-splade-input name="father_name" label="Отчество"  required/>
                        <x-splade-select name="post_id" label="Должность"  :options="$post" required/>
                        <x-splade-input name="phone" label="Телефон"  required/>
                        <x-splade-input name="email" type="email" label="Email" required/>
                        <x-splade-input name="passport" label="Паспортные данные" required/>
                        <x-splade-select name="regaddress" label="Адрес прописки" :options="$address" required/>
                        <x-splade-checkbox name="matching" label="Адрес проживания совпадает с адресом прописки" />
                        <x-splade-select name="address_id" label="Фактический адрес" :options="$address" />
                        <x-splade-submit label="Сохранить" class="mt-4 bg-gray-800 text-white"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

