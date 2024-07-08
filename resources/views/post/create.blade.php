<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Новая должность') }}
            </h2>
            <a href="{{route('post.index')}}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm ">Вернуться назад</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form action="{{route('post.store')}}">
                        <x-splade-input name="post" label="Должность" required/>

                        <x-splade-submit label="Сохранить" class="mt-4 bg-gray-800 text-white"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

