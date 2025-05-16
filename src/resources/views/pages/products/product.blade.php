@extends('layouts.app')

@section('content')
    <!-- Детали товара -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Слайдер изображений -->
            <div class="grid grid-cols-10 gap-4">
                <!-- Миниатюры (30%) -->
                @if(count($product->images->urls['images']) > 1)
                    <div class="col-span-3 order-1 lg:order-none">
                        <div class="swiper-thumbs h-full">
                            <div class="swiper-wrapper">
                                @foreach($product->images->urls['images'] as $index => $url)
                                    <div class="swiper-slide {{ $index === 0 ? 'swiper-slide-thumb-active' : '' }} cursor-pointer">
                                        <img src="{{ asset($url) }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover rounded-lg border-2 border-transparent hover:border-gray-300 transition">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Основное изображение (70%) -->
                <div class="col-span-7 relative overflow-hidden rounded-lg bg-gray-100 aspect-[4/3] order-first lg:order-none">
                    <div class="swiper-main h-full">
                        <div class="swiper-wrapper">
                            @foreach($product->images->urls['images'] as $url)
                                <div class="swiper-slide">
                                    <img src="{{ asset($url) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-contain">
                                </div>
                            @endforeach
                        </div>

                        <!-- Навигационные точки -->
                        @if(count($product->images->urls['images']) > 1)
                            <div class="swiper-pagination !bottom-2"></div>
                        @endif
                    </div>
                </div>
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
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Описание</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="flex">
                            <span class="text-gray-500 w-32">Материал</span>
                            @foreach($product->information['structure'] as $key => $value)
                                <span class="text-gray-900">{{ $key }}: {{$value}}</span>
                            @endforeach
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Описание</span>
                            <span class="text-gray-900">{{ $product->information['description'] }}</span>
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
                            <svg class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Бесплатная доставка от 5 000 ₽</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Возврат в течение 14 дней</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <style>
            /* Основной слайдер */
            .swiper-main {
                width: 100%;
                height: 100%;
            }

            /* Слайдер миниатюр */
            .swiper-thumbs {
                height: 400px;
                width: 100%;
            }

            /* Стили для слайдов миниатюр */
            .swiper-thumbs .swiper-slide {
                height: 80px;
                width: 100%;
                opacity: 0.6;
                transition: all 0.3s ease;
                margin-bottom: 10px;
            }

            .swiper-thumbs .swiper-slide:last-child {
                margin-bottom: 0;
            }

            .swiper-thumbs .swiper-slide-thumb-active {
                opacity: 1;
                border-color: #000 !important;
            }

            /* Точки пагинации */
            .swiper-pagination-bullet {
                background: white;
                opacity: 0.5;
                width: 8px;
                height: 8px;
            }

            .swiper-pagination-bullet-active {
                opacity: 1;
            }

            /* Адаптив для мобильных */
            @media (max-width: 1023px) {
                .swiper-thumbs {
                    height: auto;
                    margin-top: 10px;
                }

                .swiper-thumbs .swiper-wrapper {
                    flex-direction: row !important;
                }

                .swiper-thumbs .swiper-slide {
                    height: 60px !important;
                    width: 60px !important;
                    margin-right: 10px;
                    margin-bottom: 0 !important;
                }

                .swiper-thumbs .swiper-slide:last-child {
                    margin-right: 0;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Инициализация основного слайдера
                const mainSwiper = new Swiper('.swiper-main', {
                    loop: false,
                    spaceBetween: 10,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });

                // Инициализация слайдера миниатюр
                const thumbsSwiper = new Swiper('.swiper-thumbs', {
                    direction: 'vertical',
                    slidesPerView: 'auto',
                    spaceBetween: 10,
                    freeMode: true,
                    watchSlidesVisibility: true,
                    watchSlidesProgress: true,
                    breakpoints: {
                        1024: {
                            direction: 'vertical',
                        },
                        320: {
                            direction: 'horizontal',
                        }
                    }
                });

                // Связывание слайдеров
                mainSwiper.controller.control = thumbsSwiper;
                thumbsSwiper.controller.control = mainSwiper;

                // Обновление активного класса при переключении слайдов
                mainSwiper.on('slideChange', function() {
                    document.querySelectorAll('.swiper-thumbs .swiper-slide').forEach((slide, index) => {
                        if (index === mainSwiper.activeIndex) {
                            slide.classList.add('swiper-slide-thumb-active');
                        } else {
                            slide.classList.remove('swiper-slide-thumb-active');
                        }
                    });
                });

                // Обработка клика на миниатюру
                document.querySelectorAll('.swiper-thumbs .swiper-slide').forEach((slide, index) => {
                    slide.addEventListener('click', function(e) {
                        e.preventDefault();
                        mainSwiper.slideTo(index);
                    });
                });
            });
        </script>
    @endpush
@endsection
