@extends('layouts.app')

@section('content')
    {{--    Тут фото и надпись--}}

    <section class="main flex items-center justify-center h-screen">
        <h1 id="main-brand" class="italic brand__name parisienne__regular text-4xl sm:text-2xl xs:text-xl">
            Santo Cavalli
        </h1>
    </section>

    <section class="relative h-screen min-h-[600px] flex items-center mb-16 overflow-hidden">
        <!-- Фоновое изображение -->
        <img
            src="https://plantacv4hrdpi7j.storage.yandexcloud.net/iblock/b39/b3926f2a688854cf275cdd52018b0e0c/4fa4fb5314622ee254485c47d90158aa.jpg"
            alt="Фон"
            class="absolute inset-0 w-full h-full object-cover z-0"
        >

        <!-- Затемнение фона -->
        <div class="absolute inset-0 bg-black/30 z-1"></div>

        <!-- Текст поверх изображения -->
        <div class="relative z-10 px-8 md:px-12 lg:px-24 xl:px-32 w-full max-w-4xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-light text-white mb-6 parisienne-regular leading-tight">
                Откройте для себя<br>наши последние поступления
            </h1>
            <div class="border-t border-white/30 w-24 my-6"></div>
            <p class="text-xl md:text-2xl text-gray-100 libre-baskerville-regular max-w-2xl">
                Santo Cavalli в России
            </p>
            <a href="{{route('collection.get')}}" class="mt-8 inline-block border border-white px-8 py-3 text-sm tracking-wider text-white hover:bg-white hover:text-gray-900 transition duration-300 libre-baskerville-regular">
                Смотреть новую коллекцию
            </a>
        </div>
    </section>

    <section class="products py-16 bg-white">
        <div class="mx-auto px-3">
            <!-- Заголовок -->
            <h1 class="products__title md:text-4xl font-light text-center mb-16 font-parisienne text-gray-800">
                Больше всего нравится
            </h1>

            <!-- Сетка карточек -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4 sm:px-0">
                <!-- Карточка 1: Футболки -->
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

                <!-- Карточка 2: Джемперы -->
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
                <!-- Карточка 3: Сумки -->
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

                <!-- Карточка 4: Аксессуары -->
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
