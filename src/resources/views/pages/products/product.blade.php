@extends('layouts.app')

@section('content')
    <!-- Детали товара -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <div class="">
                <!-- Main Swiper -->
                <div class="swiper swiper-main mb-4 relative rounded-lg overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach($product->images->urls['images'] as $url)
                            <div class="swiper-slide">
                                <img src="{{ asset($url) }}" alt="{{ $product->name }}"
                                     class="w-full h-full object-cover" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                    <!-- Навигация -->
                    <div
                        class="swiper-button-prev !hidden md:!flex items-center justify-center !w-10 !h-10 !rounded-full !text-gray-800 after:!text-sm"></div>
                    <div
                        class="swiper-button-next !hidden md:!flex items-center justify-center !w-10 !h-10 !rounded-full !text-gray-800 after:!text-sm"></div>
                    <div class="swiper-scrollbar !bg-gray-200 !h-1 !rounded-full"></div>
                    <div id="swipe-left" class="absolute left-0 top-0 w-1/2 h-full z-10"></div>
                    <div id="swipe-right" class="absolute right-0 top-0 w-1/2 h-full z-10"></div>
                </div>

                <!-- Thumbnails -->
                <div class="swiper swiper-thumbs mt-4">
                    <div class="swiper-wrapper">
                        @foreach($product->images->urls['images'] as $index => $url)
                            <div
                                class="swiper-slide !w-24 cursor-pointer opacity-60 hover:opacity-100 transition duration-200 {{ $index === 0 ? '!opacity-100 border-2 border-gray-500' : '' }}">
                                <img src="{{ asset($url) }}" alt="Thumbnail"
                                     class="w-full h-full object-cover rounded-md">
                            </div>
                        @endforeach
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

                <!-- Кнопка добавления в корзину -->
                <div class="action__buttons">
                    <button type="button"
                            class="w-full bg-white text-black px-6 py-3 transition inline-block border border-black mb-4">
                        Выбрать размер
                    </button>
                    <button type="button"
                            class="w-full bg-gray-900 text-white px-6 py-3 transition inline-block">
                        Добавить в корзину
                    </button>
                </div>

                <!-- Tabs -->
                <div x-data="{ tab: 'description' }" class="mt-10">
                    <!-- Tab buttons -->
                    <div class="flex border-b border-gray-300 mb-6 space-x-6">
                        <button @click="tab = 'description'"
                                :class="tab === 'description' ? 'border-b-2 border-gray-900 text-gray-900' : 'text-gray-500'"
                                class="pb-2 text-sm font-medium transition libre-baskerville-regular">
                            ОПИСАНИЕ
                        </button>
                        <button @click="tab = 'care'"
                                :class="tab === 'care' ? 'border-b-2 border-gray-900 text-gray-900' : 'text-gray-500'"
                                class="pb-2 text-sm font-medium transition libre-baskerville-regular">
                            СОСТАВ И УХОД
                        </button>
                        <button @click="tab = 'story'"
                                :class="tab === 'story' ? 'border-b-2 border-gray-900 text-gray-900' : 'text-gray-500'"
                                class="pb-2 text-sm font-medium transition libre-baskerville-regular">
                            ИСТОРИЯ СОЗДАНИЯ
                        </button>
                    </div>

                    <!-- Tab content -->
                    <div>
                        <div x-show="tab === 'description'" class="prose max-w-none">
                            {!! $product->description !!}
                        </div>

                        <div x-show="tab === 'care'" class="prose max-w-none" x-cloak>
                            @if(isset($product->information['structure']))
                                <h4>Состав:</h4>
                                <ul>
                                    @foreach($product->information['structure'] as $key => $value)
                                        <li><strong>{{ $key }}</strong>: {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if(isset($product->information['care']))
                                <h4>Уход:</h4>
                                <p>{{ $product->information['care'] }}</p>
                            @endif
                        </div>

                        <div x-show="tab === 'story'" class="prose max-w-none" x-cloak>
                            @if(isset($product->information['story']))
                                {!! $product->information['story'] !!}
                            @else
                                <p>История создания этого продукта пока недоступна.</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Инициализация слайдера миниатюр
                const thumbsSwiper = new Swiper('.swiper-thumbs', {
                    spaceBetween: 8,
                    breakpoints: {
                        640: {
                            slidesPerView: 5,
                        },
                        1024: {
                            slidesPerView: 6,
                        }
                    }
                });

                const mainSwiper = new Swiper('.swiper-main', {
                    spaceBetween: 10,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    scrollbar: {
                        el: '.swiper-scrollbar',
                        draggable: true,
                    },
                    thumbs: {
                        swiper: thumbsSwiper,
                    },
                });

                // Подсветка активной миниатюры при переключении
                mainSwiper.on('slideChange', function () {
                    document.querySelectorAll('.swiper-thumbs .swiper-slide').forEach((slide, index) => {
                        if (index === mainSwiper.activeIndex) {
                            slide.classList.add('!opacity-100', 'border-2', 'border-gray-500');
                            slide.classList.remove('opacity-60');
                        } else {
                            slide.classList.remove('!opacity-100', 'border-2', 'border-gray-500');
                            slide.classList.add('opacity-60');
                        }
                    });
                });

                // Клик по миниатюре
                document.querySelectorAll('.swiper-thumbs .swiper-slide').forEach((slide, index) => {
                    slide.addEventListener('click', () => {
                        mainSwiper.slideTo(index);
                    });
                });

                document.getElementById('swipe-left').addEventListener('click', () => {
                    mainSwiper.slidePrev();
                });
                document.getElementById('swipe-right').addEventListener('click', () => {
                    mainSwiper.slideNext();
                });

            });
        </script>
    @endpush

    @push('styles')
        <style>
            .swiper-main {
                height: 500px;
            }

            .swiper-thumbs {
                height: auto;
                padding-bottom: 4px;
            }

            .swiper-thumbs .swiper-slide {
                width: 80px;
                height: 80px;
                transition: all 0.3s ease;
            }

            .swiper-thumbs .swiper-slide:hover {
                opacity: 1 !important;
            }

            .swiper-button-prev,
            .swiper-button-next {
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .swiper-main:hover .swiper-button-prev,
            .swiper-main:hover .swiper-button-next {
                opacity: 1;
            }
        </style>
    @endpush
@endsection
