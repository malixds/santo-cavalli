@extends('layouts.app')

@section('content')
    <!-- Сетка категорий -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-20">
        <h2 class="text-2xl font-light text-center mb-12 libre-baskerville-regular">ENVELOPE PRODUCTS</h2>

        <!-- Фильтр-панель -->
        <div class="bg-white shadow-md rounded-lg px-6 py-4 mb-12">
            <form method="GET" action="{{ route('products.search') }}"
                  class="flex flex-col md:flex-row md:items-end gap-4 md:gap-8 flex-wrap">

                <!-- Сортировка по цене -->
                <div>
                    <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort by Price</label>
                    <select name="sort" id="sort"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-gray-800 focus:border-gray-800 text-sm">
                        <option value="">Default</option>
                        <option value="price_asc" @if(request('sort') == 'price_asc') selected @endif>Low to High
                        </option>
                        <option value="price_desc" @if(request('sort') == 'price_desc') selected @endif>High to Low
                        </option>
                    </select>
                </div>

                <!-- Фильтр по цвету -->
                <div>
                    <span class="block text-sm font-medium text-gray-700 mb-1">Colors</span>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['white', 'kraft', 'black'] as $color)
                            <label class="inline-flex items-center text-sm text-gray-700">
                                <input type="checkbox" name="colors[]"
                                       value="{{ $color }}"
                                       @if(is_array(request('colors')) && in_array($color, request('colors'))) checked
                                       @endif
                                       class="text-gray-800 border-gray-300 rounded focus:ring-gray-800">
                                <span class="ml-2 capitalize">{{ $color }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Размер -->
                <div>
                    <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                    <select name="size" id="size"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-gray-800 focus:border-gray-800 text-sm">
                        <option value="">All Sizes</option>
                        @foreach(['A4', 'A5', 'C6', 'DL'] as $size)
                            <option value="{{ $size }}"
                                    @if(request('size') == $size) selected @endif>{{ $size }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Кнопки -->
                <div class="flex gap-4 mt-2 md:mt-0">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-gray-800 text-sm text-gray-800 hover:bg-gray-800 hover:text-white rounded transition">
                        Apply Filters
                    </button>
                    <a href="{{ route('products.search') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm text-gray-600 hover:text-gray-900 rounded transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
            @foreach($products as $product)
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
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.swiper').forEach((el, index) => {
                // Генерируем уникальные классы для кнопок и скроллбара
                const prevBtn = el.querySelector('.swiper-button-prev');
                const nextBtn = el.querySelector('.swiper-button-next');
                const scrollbar = el.querySelector('.swiper-scrollbar');

                // Добавляем уникальные классы
                const uniqueId = 'swiper-' + index;
                el.classList.add(uniqueId);

                if (prevBtn) prevBtn.classList.add(`swiper-button-prev-${index}`);
                if (nextBtn) nextBtn.classList.add(`swiper-button-next-${index}`);
                if (scrollbar) scrollbar.classList.add(`swiper-scrollbar-${index}`);

                // Инициализация слайдера
                new Swiper('.' + uniqueId, {
                    loop: true,
                    navigation: {
                        nextEl: `.swiper-button-next-${index}`,
                        prevEl: `.swiper-button-prev-${index}`,
                    },
                    scrollbar: {
                        el: `.swiper-scrollbar-${index}`,
                        draggable: true,
                    },
                });
            });
        });


        document.querySelectorAll('.swiper-button-prev, .swiper-button-next').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                e.preventDefault();
            });
        });
    </script>


    <!-- CTA секция -->
    <section class="py-16 bg-gray-50 mt-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-light text-gray-900 mb-6 parisienne-regular">Need custom envelopes?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">We can create bespoke envelopes tailored to your specific
                requirements</p>
            <a href="/contact"
               class="inline-block border border-gray-800 px-8 py-3 text-sm tracking-wider text-gray-800 hover:bg-gray-800 hover:text-white transition duration-300 libre-baskerville-regular">
                Request Custom Order
            </a>
        </div>
    </section>
@endsection
