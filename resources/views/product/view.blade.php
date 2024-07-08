<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <a href="{{route('product.index')}}" class="px-2 py-2 bg-blue-500 text-white font-medium rounded-sm ">Назад</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  grid md:grid-cols-2 gap-4">
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg gap-4">
                    <div>
                        <p class="pt-4 font-semibold">Характеристики:</p>
                        @forelse($characteristics as $characteristic)
                            <div class="p-6 mb-4 bg-white border-b border-gray-300 shadow-md ">

                                <p class="font-semibold">
                                    {{$characteristic->name}}

                                    {{$characteristic->value}}
                                </p>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg ">
                    <div>
                        @forelse(json_decode($product->image,true) as $image)
                            <img src="{{Storage::url($image)}}" alt="">
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
