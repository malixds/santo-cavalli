@extends('layouts.app')

@section('content')
    <!-- Детали товара -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Слайдер изображений -->
            <div class="relative">
                <!-- Основное изображение -->
                <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-[4/3]">
                    <div class="swiper-container h-full">
                        <div class="swiper-wrapper">
                            @foreach($product->images->urls['images'] as $url)
                                <div class="swiper-slide">
                                    <img src="{{ asset($url)}}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-contain">
                                </div>
                            @endforeach
                        </div>

                        <!-- Навигационные точки -->
                        @if(count($product->images->urls['images']) > 1)
                            <div class="swiper-pagination"></div>
                        @endif
                    </div>
                </div>

                <!-- Миниатюры (если изображений больше 1) -->
                @if(count($product->images->urls['images']) > 1)
                    <div class="mt-4 swiper-thumbs">
                        <div class="swiper-wrapper">
                            @foreach($product->images->urls['images'] as $url)
                                <div
                                    class="swiper-slide w-24 h-24 cursor-pointer border-2 border-transparent hover:border-gray-300 transition">
                                    <img src="{{ asset($url) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Информация о товаре -->
            <div>
                <h1 class="text-3xl font-light text-gray-900 mb-4 libre-baskerville-regular">{{ $product->name }}</h1>

                <!-- Цена -->
                <div class="flex items-center mb-6">
                    <span class="text-2xl font-semibold text-gray-900">{{ number_format($product->price, 0, ',', ' ') }} ₽</span>
                    @if($product->old_price)
                        <span class="ml-3 text-lg text-gray-500 line-through">{{ number_format($product->old_price, 0, ',', ' ') }} ₽</span>
                    @endif
                </div>

                <!-- Описание -->
                <div class="prose max-w-none mb-8">
                    {!! $product->description !!}
                </div>

                <!-- Характеристики -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Характеристики</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        {{--                        <div class="flex">--}}
                        {{--                            <span class="text-gray-500 w-32">Размер</span>--}}
                        {{--                            <span class="text-gray-900">{{ $product->size }}</span>--}}
                        {{--                        </div>--}}
                        <div class="flex">
                            <span class="text-gray-500 w-32">Материал</span>
                            @foreach($product->information['structure'] as $key => $value)
                                <span class="text-gray-900">{{ $key }} : {{$value}}</span>
                            @endforeach
                        </div>
                        {{--                        <div class="flex">--}}
                        {{--                            <span class="text-gray-500 w-32">Цвет</span>--}}
                        {{--                            <span class="text-gray-900">{{ $product->color }}</span>--}}
                        {{--                        </div>--}}
                        <div class="flex">
                            <span class="text-gray-500 w-32">Описание</span>
                            <span class="text-gray-900">{{ $product->information['description'] }} </span>
                        </div>
                    </div>
                </div>

                <!-- Кнопка добавления в корзину -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <button class="px-3 py-2 text-gray-600 hover:text-gray-900">-</button>
                        <span class="px-4 py-2">1</span>
                        <button class="px-3 py-2 text-gray-600 hover:text-gray-900">+</button>
                    </div>
                    <button class="flex-1 bg-gray-900 text-white px-6 py-3 rounded-md hover:bg-gray-800 transition">
                        Добавить в корзину
                    </button>
                </div>

                <!-- Дополнительная информация -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Бесплатная доставка от 5 000 ₽</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Возврат в течение 14 дней</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Похожие товары -->
{{--    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">--}}
{{--        <h2 class="text-2xl font-light text-center mb-8 libre-baskerville-regular">Похожие товары</h2>--}}
{{--        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">--}}
{{--            @foreach($relatedProducts as $product)--}}
{{--                <div--}}
{{--                    class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300 overflow-hidden">--}}
{{--                    <div class="relative h-48 overflow-hidden">--}}
{{--                        <img src="{{ asset('storage/' . $product->main_image) }}"--}}
{{--                             alt="{{ $product->name }}"--}}
{{--                             class="w-full h-full object-cover transition duration-300 group-hover:scale-105">--}}
{{--                    </div>--}}
{{--                    <div class="p-4">--}}
{{--                        <h3 class="text-lg font-medium text-gray-900 mb-1 libre-baskerville-regular">{{ $product->name }}</h3>--}}
{{--                        <div class="text-center mt-2">--}}
{{--                            <span class="text-lg font-semibold text-gray-900">{{ number_format($product->price, 0, ',', ' ') }} ₽</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 z-10"></a>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </section>--}}

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <style>
            .swiper-container {
                width: 100%;
                height: 100%;
            }

            .swiper-slide {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .swiper-pagination-bullet {
                background: white;
                opacity: 0.5;
            }

            .swiper-pagination-bullet-active {
                opacity: 1;
            }

            .swiper-thumbs .swiper-slide {
                opacity: 0.6;
                transition: opacity 0.3s;
            }

            .swiper-thumbs .swiper-slide-thumb-active {
                opacity: 1;
                border-color: #000 !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Основной слайдер
                const mainSwiper = new Swiper('.swiper-container', {
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });

                // Слайдер миниатюр
                const thumbsSwiper = new Swiper('.swiper-thumbs', {
                    slidesPerView: 'auto',
                    spaceBetween: 10,
                    freeMode: true,
                    watchSlidesVisibility: true,
                    watchSlidesProgress: true,
                    breakpoints: {
                        640: {
                            slidesPerView: 4,
                        }
                    }
                });

                // Связывание основного слайдера с миниатюрами
                if (thumbsSwiper) {
                    mainSwiper.controller.control = thumbsSwiper;
                    thumbsSwiper.controller.control = mainSwiper;
                }

                // Обработка клика на миниатюру
                document.querySelectorAll('.swiper-thumbs .swiper-slide').forEach(slide => {
                    slide.addEventListener('click', function () {
                        const index = this.getAttribute('data-swiper-slide-index');
                        mainSwiper.slideTo(index);
                    });
                });
            });
        </script>
    @endpush
@endsection
