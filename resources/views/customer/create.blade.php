<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Новый клиент') }}
            </h2>
            <a href="{{route('customer.index')}}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm ">Вернуться назад</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form action="{{route('customer.store')}}">
                        <x-splade-input name="name" label="ФИО или название" placeholder="ФИО" required/>
                        <x-splade-select name="business" label="Лицо" required>
                            <option value="Частное">Частное</option>
                            <option value="Юридическое">Юридическое</option>
                        </x-splade-select>
                        <x-splade-input name="boss" label="Имя директора" required/>
                        <x-splade-input name="boss_last_name" label="Фамилия" required/>
                        <x-splade-input name="boss_father_name" label="Отчество" required/>
                        <x-splade-select name="address_id" label="Адрес" :options="$address" required/>
                        <x-splade-input name="phone" label="Телефон"  required/>
                        <x-splade-input name="email" type="email" label="Эл.почта" required/>
                        <x-splade-input name="inn" label="ИНН" required/>

                        <x-splade-submit label="Сохранить" class="mt-4 bg-gray-800 text-white"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


