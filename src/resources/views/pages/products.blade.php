@extends('layouts.app')

@section('content')
    <!-- Сетка категорий -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-20">
        <h2 class="text-2xl font-light text-center mb-12 libre-baskerville-regular">ENVELOPE PRODUCTS</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($products as $product)
                <!-- Категория 1 -->
                <div
                    class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300 overflow-hidden">
                    <!-- Слайдер изображений -->
                    <div class="relative h-48 overflow-hidden">
                        <div class="absolute inset-0 flex transition-transform duration-500 ease-in-out">
                            <img src="{{ asset('images/123.jpg') }}" alt="Standard Envelope"
                                 class="w-full h-full object-cover">
                            <img src="{{ asset('images/123.jpg') }}" alt="Standard Envelope"
                                 class="w-full h-full object-cover">
                            <img src="{{ asset('images/123.jpg') }}" alt="Standard Envelope"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">{{$product->name}}</h3>
                        <div class="mt-2 text-center">
                            <span class="text-lg font-semibold text-gray-900">{{$product->price}} ₽</span>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <a href="/category/standard-envelopes" class="text-sm font-medium text-gray-700 hover:text-black transition-colors">
                                View all
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <a href="/category/standard-envelopes" class="absolute inset-0 z-10"
                       aria-label="Standard Envelopes"></a>
                </div>
            @endforeach
        </div>
    </section>

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

    @push('scripts')
        <script>
            // Простой автоматический слайдер для изображений
            document.addEventListener('DOMContentLoaded', function () {
                const sliders = document.querySelectorAll('.relative.h-48.overflow-hidden > div');

                sliders.forEach(slider => {
                    const images = slider.children;
                    let currentIndex = 0;

                    setInterval(() => {
                        currentIndex = (currentIndex + 1) % images.length;
                        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
                    }, 3000); // Меняем изображение каждые 3 секунды
                });
            });
        </script>
    @endpush
@endsection
