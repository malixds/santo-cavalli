@extends('layouts.app')

@section('content')
    <!-- Сетка категорий -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-20">
        <h2 class="text-2xl font-light text-center mb-12 libre-baskerville-regular">ENVELOPE PRODUCTS</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <!-- Product Card -->
                <div
                        class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300 overflow-hidden">
                    <!-- Slider Container -->
                    <div class="relative h-48 overflow-hidden">
                        <!-- Slides -->
                        <div class="flex h-full transition-transform duration-300 ease-in-out"
                             id="slider-{{ $product->id }}">
                            @foreach($product->images->urls['images'] as $url)
                                <div class="w-full flex-shrink-0">
                                    <img src="{{ asset($url) }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Dots -->
                        @if(count($product->images->urls['images']) > 1)
                            <div class="absolute bottom-2 left-0 right-0 flex justify-center space-x-1">
                                @foreach($product->images->urls['images'] as $index => $image)
                                    <button
                                            class="w-2 h-2 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity slider-dot"
                                            data-slider="{{ $product->id }}"
                                            data-slide="{{ $index }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <h3 class="text-center text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">{{ $product->name }}</h3>
                        <div class="mt-2 text-center">
                            <span class="text-lg font-semibold text-gray-900">{{ $product->price }} ₽</span>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('product.get-one', $product->uuid) }}" class="absolute inset-0 z-10"
                       aria-label="{{ $product->name }}"></a>
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
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize sliders for each product
                @foreach($products as $product)
                @if(count($product->images->urls['images']) > 1)
                initSlider({{ $product->id }}, {{ count($product->images->urls['images']) }});
                @endif
                @endforeach

                // Handle dot navigation
                document.querySelectorAll('.slider-dot').forEach(dot => {
                    dot.addEventListener('click', function () {
                        const sliderId = this.dataset.slider;
                        const slideIndex = parseInt(this.dataset.slide);
                        goToSlide(sliderId, slideIndex);
                    });
                });
            });

            function initSlider(sliderId, slideCount) {
                let currentIndex = 0;
                const slider = document.getElementById(`slider-${sliderId}`);
                const dots = document.querySelectorAll(`.slider-dot[data-slider="${sliderId}"]`);

                // Auto-rotate slides every 3 seconds
                const interval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % slideCount;
                    updateSlider(sliderId, currentIndex, slider, dots);
                }, 3000);

                // Pause on hover
                slider.parentElement.addEventListener('mouseenter', () => clearInterval(interval));
                slider.parentElement.addEventListener('mouseleave', () => {
                    interval = setInterval(() => {
                        currentIndex = (currentIndex + 1) % slideCount;
                        updateSlider(sliderId, currentIndex, slider, dots);
                    }, 3000);
                });
            }

            function goToSlide(sliderId, slideIndex) {
                const slider = document.getElementById(`slider-${sliderId}`);
                const dots = document.querySelectorAll(`.slider-dot[data-slider="${sliderId}"]`);
                updateSlider(sliderId, slideIndex, slider, dots);
            }

            function updateSlider(sliderId, index, slider, dots) {
                slider.style.transform = `translateX(-${index * 100}%)`;

                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('opacity-50', i !== index);
                    dot.classList.toggle('opacity-100', i === index);
                });
            }
        </script>
    @endpush

    <style>
        .slider-dot {
            transition: opacity 0.3s ease;
        }

        .slider-dot.opacity-100 {
            opacity: 1;
        }

        .slider-dot.opacity-50 {
            opacity: 0.5;
        }
    </style>
@endsection
