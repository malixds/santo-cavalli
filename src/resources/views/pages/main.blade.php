@extends('layouts.app')

@section('content')
    {{--    Тут фото и надпись--}}

    <section class="main flex items-center justify-center h-screen mb-10">
        <h1 id="main-brand" class="italic brand__name parisienne__regular text-4xl sm:text-2xl xs:text-xl">
            Santo Cavalli
        </h1>
    </section>

    <section class="products py-16 bg-white">
        <div class="mx-auto px-3">
            <!-- Заголовок -->
            <h1 class="products__title md:text-4xl font-light text-center mb-16 font-parisienne text-gray-800">
                Товары
            </h1>

            <!-- Сетка карточек -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4 sm:px-0">
                <!-- Карточка 1: Футболки -->
                <div
                    class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="aspect-square bg-gray-50 relative overflow-hidden"> <!-- добавлен overflow-hidden -->
                        <img
                            src="https://plantacv4hrdpi7j.storage.yandexcloud.net/iblock/422/422e464f5ff3abb4886e327eece69b15/e45020268eb0f121053df2bb3a24f234.jpg"
                            alt="Футболки"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        >
                        <!-- Заголовок и стрелка -->
                        <div class="absolute bottom-4 left-4 right-4 z-20 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-white libre-baskerville-regular">
                                Футболки
                            </h3>
                            <div
                                class="bg-white/90 backdrop-blur-sm w-10 h-10 rounded-full flex items-center justify-center transform translate-x-2 group-hover:translate-x-0 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 text-gray-800 group-hover:text-black group-hover:scale-110 transition-all duration-300"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <a href="/category/t-shirts" class="absolute inset-0 z-10" aria-label="Футболки"></a>
                </div>


                <!-- Карточка 2: Джемперы -->
                <div
                    class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="aspect-square bg-gray-50 relative overflow-hidden"> <!-- добавлен overflow-hidden -->
                        <img
                            src="https://plantacv4hrdpi7j.storage.yandexcloud.net/iblock/422/422e464f5ff3abb4886e327eece69b15/e45020268eb0f121053df2bb3a24f234.jpg"
                            alt="Футболки"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        >
                        <!-- Заголовок и стрелка -->
                        <div class="absolute bottom-4 left-4 right-4 z-20 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-white libre-baskerville-regular">
                                Футболки
                            </h3>
                            <div
                                class="bg-white/90 backdrop-blur-sm w-10 h-10 rounded-full flex items-center justify-center transform translate-x-2 group-hover:translate-x-0 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 text-gray-800 group-hover:text-black group-hover:scale-110 transition-all duration-300"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <a href="/category/t-shirts" class="absolute inset-0 z-10" aria-label="Футболки"></a>
                </div>

                <!-- Карточка 3: Сумки -->
                <div
                    class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="aspect-square bg-gray-50 relative overflow-hidden"> <!-- добавлен overflow-hidden -->
                        <img
                            src="https://plantacv4hrdpi7j.storage.yandexcloud.net/iblock/422/422e464f5ff3abb4886e327eece69b15/e45020268eb0f121053df2bb3a24f234.jpg"
                            alt="Футболки"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        >
                        <!-- Заголовок и стрелка -->
                        <div class="absolute bottom-4 left-4 right-4 z-20 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-white libre-baskerville-regular">
                                Футболки
                            </h3>
                            <div
                                class="bg-white/90 backdrop-blur-sm w-10 h-10 rounded-full flex items-center justify-center transform translate-x-2 group-hover:translate-x-0 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 text-gray-800 group-hover:text-black group-hover:scale-110 transition-all duration-300"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <a href="/category/t-shirts" class="absolute inset-0 z-10" aria-label="Футболки"></a>
                </div>

                <!-- Карточка 4: Аксессуары -->
                <div
                    class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="aspect-square bg-gray-50 relative overflow-hidden"> <!-- добавлен overflow-hidden -->
                        <img
                            src="https://plantacv4hrdpi7j.storage.yandexcloud.net/iblock/422/422e464f5ff3abb4886e327eece69b15/e45020268eb0f121053df2bb3a24f234.jpg"
                            alt="Футболки"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        >
                        <!-- Заголовок и стрелка -->
                        <div class="absolute bottom-4 left-4 right-4 z-20 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-white libre-baskerville-regular">
                                Футболки
                            </h3>
                            <div
                                class="bg-white/90 backdrop-blur-sm w-10 h-10 rounded-full flex items-center justify-center transform translate-x-2 group-hover:translate-x-0 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 text-gray-800 group-hover:text-black group-hover:scale-110 transition-all duration-300"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <a href="/category/t-shirts" class="absolute inset-0 z-10" aria-label="Футболки"></a>
                </div>

            </div>

            <!-- Кнопка "Смотреть все" -->
            <div class="text-center mt-12">
                <a href="{{route('category.get')}}"
                   class="inline-block border border-gray-800 px-8 py-3 text-sm tracking-wider text-gray-800 hover:bg-gray-800 hover:text-white transition duration-300 libre-baskerville-regular">
                    Смотреть все категории
                </a>
            </div>
        </div>
    </section>

    <section class="new__collection py-16 bg-white">

    </section>
@endsection
