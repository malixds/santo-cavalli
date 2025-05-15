@extends('layouts.app')

@section('content')
    <!-- Сетка категорий -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-20">
        <h2 class="text-2xl font-light text-center mb-12 libre-baskerville-regular">ENVELOPE PRODUCTS</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Категория 1 -->
            <div class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300">
                <div class="p-6">
                    <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">Standard Envelopes</h3>
                    <p class="text-gray-500 text-sm">24 varieties</p>
                    <div class="mt-4">
                        <a href="/category/standard-envelopes" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">
                            View all
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <a href="/category/standard-envelopes" class="absolute inset-0 z-10" aria-label="Standard Envelopes"></a>
            </div>

            <!-- Категория 2 -->
            <div class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300">
                <div class="p-6">
                    <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">Window Envelopes</h3>
                    <p class="text-gray-500 text-sm">18 designs</p>
                    <div class="mt-4">
                        <a href="/category/window-envelopes" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">
                            View all
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <a href="/category/window-envelopes" class="absolute inset-0 z-10" aria-label="Window Envelopes"></a>
            </div>

            <!-- Категория 3 -->
            <div class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300">
                <div class="p-6">
                    <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">Padded Envelopes</h3>
                    <p class="text-gray-500 text-sm">12 sizes</p>
                    <div class="mt-4">
                        <a href="/category/padded-envelopes" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">
                            View all
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <a href="/category/padded-envelopes" class="absolute inset-0 z-10" aria-label="Padded Envelopes"></a>
            </div>

            <!-- Категория 4 -->
            <div class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300">
                <div class="p-6">
                    <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">Invitation Envelopes</h3>
                    <p class="text-gray-500 text-sm">32 colors</p>
                    <div class="mt-4">
                        <a href="/category/invitation-envelopes" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">
                            View all
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <a href="/category/invitation-envelopes" class="absolute inset-0 z-10" aria-label="Invitation Envelopes"></a>
            </div>
        </div>
    </section>

    <!-- CTA секция -->
    <section class="py-16 bg-gray-50 mt-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-light text-gray-900 mb-6 parisienne-regular">Need custom envelopes?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">We can create bespoke envelopes tailored to your specific requirements</p>
            <a href="/contact"
               class="inline-block border border-gray-800 px-8 py-3 text-sm tracking-wider text-gray-800 hover:bg-gray-800 hover:text-white transition duration-300 libre-baskerville-regular">
                Request Custom Order
            </a>
        </div>
    </section>
@endsection
