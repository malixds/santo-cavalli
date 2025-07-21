@extends('layouts.app')

@section('content')
    <!-- Сетка категорий -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-10">
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
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
            @foreach($collection->products as $product)
                <!-- Product Card -->
                <a href="{{ route('product.get-one', $product->uuid) }}"
                   class="block p-2 md:p-2"
                   aria-label="{{ $product->name }}">
                    <div
                        class="product group relative hover:shadow-xl transition-all duration-300 overflow-hidden">

                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach($product->images->urls['images'] as $url)
                                    <div class="swiper-slide">
                                        <img src="{{ asset($url) }}" alt="{{ $product->name }}"
                                             class="w-full h-full object-cover"
                                             loading="lazy">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Navigation buttons -->
                            <div class="swiper-button-prev group-hover:block transition-opacity duration-200"></div>
                            <div class="swiper-button-next group-hover:block transition-opacity duration-200"></div>
                            <div class="swiper-scrollbar"></div>
                        </div>


                        <h3 class="text-center text-lg mb-2">{{ $product->name }}</h3>
                        <div class="mt-2 text-center">
                            <span
                                class="text-base md:text-lg font-semibold text-gray-900">{{ round($product->price) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="max-w-4xl mx-auto text-center px-4 mt-10">
            <a href="{{route('collection.get-all')}}"
               class="inline-block border border-gray-800 px-8 py-3 text-sm tracking-wider text-gray-800 hover:bg-gray-800 hover:text-white transition duration-300 libre-baskerville-regular">
                Смотреть все коллекции
            </a>
        </div>
    </section>
@endsection
