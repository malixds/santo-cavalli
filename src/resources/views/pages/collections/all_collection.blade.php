@extends('layouts.app')

@section('content')
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-20">
        <h2 class="text-2xl font-light text-center mb-12 libre-baskerville-regular">Наши Коллекции</h2>

        @foreach($collections as $collection)
            <div class="relative w-full h-96 md:h-[32rem] lg:h-[40rem] mb-16 rounded-lg overflow-hidden shadow-lg">
                <!-- Фоновое изображение -->
                <img
                    src="https://plantacv4hrdpi7j.storage.yandexcloud.net/iblock/318/318c65d787d842f77027f532f7f7ddf7/66a9e0fefc18172cf1ca71d0909cfbae.jpg"
                    alt="{{ $collection->name }}"
                    class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 hover:scale-105"
                >

                <!-- Затемнение для лучшей читаемости текста -->
                <div class="absolute inset-0 bg-black bg-opacity-30 z-10"></div>

                <!-- Контент коллекции -->
                <div
                    class="relative z-20 h-full flex flex-col justify-center items-start p-8 md:p-12 lg:p-16 text-white">
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-medium mb-4">{{ $collection->name }}</h3>
                    <p class="text-lg md:text-xl lg:text-2xl max-w-2xl mb-6">{{ $collection->description }}</p>
                    <a href="{{ route('collection.get', $collection->id) }}"
                       class="px-6 py-3 bg-white text-gray-900 rounded-md hover:bg-gray-100 transition-colors duration-300">
                        Смотреть коллекцию
                    </a>
                </div>
            </div>
        @endforeach

    </section>
@endsection
