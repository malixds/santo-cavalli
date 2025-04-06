@extends('layouts.app')

@section('content')
    {{--    Тут фото и надпись--}}

    <section class="main flex items-center justify-center h-screen mb-10">
        <h1 id="main-brand" class="italic brand__name parisienne__regular text-4xl sm:text-2xl xs:text-xl">
            Santo Cavalli
        </h1>
    </section>

    <section class="products py-16 bg-white">
        <div class="container mx-auto px-4">
            <!-- Заголовок -->
            <h1 class="products__title md:text-4xl font-light text-center mb-16 font-parisienne text-gray-800">
                Что мы предлагаем
            </h1>

            <!-- Сетка карточек -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Карточка 1: Футболки -->
                <div class="group relative overflow-hidden">
                    <div class="aspect-square bg-gray-50 flex items-center justify-center">
                        <img src="/images/t-shirts.jpg" alt="Футболки" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-xl font-light text-gray-800 mb-1 libre-baskerville-regular">Футболки</h3>
                        <p class="text-gray-500 text-sm">Эксклюзивные модели из органического хлопка</p>
                    </div>
                    <a href="/category/t-shirts" class="absolute inset-0 z-10" aria-label="Футболки"></a>
                </div>

                <!-- Карточка 2: Джемперы -->
                <div class="group relative overflow-hidden">
                    <div class="aspect-square bg-gray-50 flex items-center justify-center">
                        <img src="/images/jumpers.jpg" alt="Джемперы" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-xl font-light text-gray-800 mb-1 libre-baskerville-regular">Джемперы</h3>
                        <p class="text-gray-500 text-sm">Роскошные кашемировые модели ручной работы</p>
                    </div>
                    <a href="/category/jumpers" class="absolute inset-0 z-10" aria-label="Джемперы"></a>
                </div>

                <!-- Карточка 3: Сумки -->
                <div class="group relative overflow-hidden">
                    <div class="aspect-square bg-gray-50 flex items-center justify-center">
                        <img src="/images/bags.jpg" alt="Сумки" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-xl font-light text-gray-800 mb-1 libre-baskerville-regular">Сумки</h3>
                        <p class="text-gray-500 text-sm">Эксклюзивная кожаная галантерея</p>
                    </div>
                    <a href="/category/bags" class="absolute inset-0 z-10" aria-label="Сумки"></a>
                </div>
            </div>

            <!-- Кнопка "Смотреть все" -->
            <div class="text-center mt-12">
                <a href="/products" class="inline-block border border-gray-800 px-8 py-3 text-sm tracking-wider text-gray-800 hover:bg-gray-800 hover:text-white transition duration-300 libre-baskerville-regular">
                    Смотреть все категории
                </a>
            </div>
        </div>
    </section>
@endsection
