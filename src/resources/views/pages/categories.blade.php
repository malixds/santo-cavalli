@extends('layouts.app')

@section('content')
    <!-- Hero секция -->
    <section class="relative h-96 flex items-center justify-center bg-gray-50 mb-16">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-5xl font-light text-white mb-6 parisienne-regular">Все категории</h1>
            <p class="text-lg text-gray-200 max-w-2xl mx-auto">Откройте для себя полную коллекцию Santo Cavalli</p>
        </div>
    </section>

    <!-- Сетка категорий -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Категория 1 -->
            <div
                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-500">
                <div class="aspect-[4/5] bg-gray-100 relative">
                    <img
                        src="https://plantacv4hrdpi7j.storage.yandexcloud.net/iblock/422/422e464f5ff3abb4886e327eece69b15/e45020268eb0f121053df2bb3a24f234.jpg"
                        alt="Футболки"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    >
                    <!-- Наложение -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-medium text-white mb-2 libre-baskerville-regular">Футболки</h3>
                        <p class="text-gray-300 text-sm">24 товара</p>
                    </div>
                    <!-- Анимированная стрелка -->
                    <div class="absolute bottom-6 right-6 z-20 transition-all duration-500 group-hover:rotate-45">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </div>
                <a href="/category/t-shirts" class="absolute inset-0 z-10" aria-label="Футболки"></a>
            </div>

            <!-- Категория 2 -->
            <div
                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-500">
                <div class="aspect-[4/5] bg-gray-100 relative">
                    <img
                        src="https://example.com/jumpers.jpg"
                        alt="Джемперы"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    >
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-medium text-white mb-2 libre-baskerville-regular">Джемперы</h3>
                        <p class="text-gray-300 text-sm">18 товаров</p>
                    </div>
                    <div class="absolute bottom-6 right-6 z-20 transition-all duration-500 group-hover:rotate-45">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </div>
                <a href="/category/jumpers" class="absolute inset-0 z-10" aria-label="Джемперы"></a>
            </div>

            <!-- Категория 3 -->
            <div
                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-500">
                <div class="aspect-[4/5] bg-gray-100 relative">
                    <img
                        src="https://example.com/bags.jpg"
                        alt="Сумки"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    >
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-medium text-white mb-2 libre-baskerville-regular">Сумки</h3>
                        <p class="text-gray-300 text-sm">12 товаров</p>
                    </div>
                    <div class="absolute bottom-6 right-6 z-20 transition-all duration-500 group-hover:rotate-45">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </div>
                <a href="/category/bags" class="absolute inset-0 z-10" aria-label="Сумки"></a>
            </div>

            <!-- Категория 4 -->
            <div
                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-500">
                <div class="aspect-[4/5] bg-gray-100 relative">
                    <img
                        src="https://example.com/accessories.jpg"
                        alt="Аксессуары"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    >
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-medium text-white mb-2 libre-baskerville-regular">Аксессуары</h3>
                        <p class="text-gray-300 text-sm">32 товара</p>
                    </div>
                    <div class="absolute bottom-6 right-6 z-20 transition-all duration-500 group-hover:rotate-45">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </div>
                <a href="/category/accessories" class="absolute inset-0 z-10" aria-label="Аксессуары"></a>
            </div>

            <!-- Добавьте остальные категории по аналогии -->
        </div>
    </section>

    <!-- CTA секция -->
    <section class="py-16 bg-gray-50 mt-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-light text-gray-900 mb-6 parisienne-regular">Не нашли нужную категорию?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Наши консультанты помогут вам найти именно то, что вы
                ищете</p>
            <a href="/contact"
               class="inline-block border border-gray-800 px-8 py-3 text-sm tracking-wider text-gray-800 hover:bg-gray-800 hover:text-white transition duration-300 libre-baskerville-regular">
                Связаться с нами
            </a>
        </div>
    </section>
@endsection
