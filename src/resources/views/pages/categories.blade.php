@extends('layouts.app')

@section('content')
    <!-- Сетка категорий -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto mt-20">
        <h2 class="text-2xl font-light text-center mb-12 libre-baskerville-regular">ALL CATEGORIES</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Категория 1 -->

            @foreach($categories as $category)
                <div
                    class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">{{$category->name}}</h3>
                        <p class="text-gray-500 text-sm">{{$category->products_count}} products</p>
                        <div class="mt-4">
                            <a href="/category/t-shirts"
                               class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">
                                View all
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <a href="{{route('products.search', ['category_id' => $category->id])}}"
                       class="absolute inset-0 z-10"
                       aria-label="T-Shirts"></a>
                </div>
        @endforeach


        {{--            <!-- Категория 2 -->--}}
        {{--            <div class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300">--}}
        {{--                <div class="p-6">--}}
        {{--                    <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">Jumpers</h3>--}}
        {{--                    <p class="text-gray-500 text-sm">18 products</p>--}}
        {{--                    <div class="mt-4">--}}
        {{--                        <a href="/category/jumpers" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">--}}
        {{--                            View all--}}
        {{--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />--}}
        {{--                            </svg>--}}
        {{--                        </a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <a href="/category/jumpers" class="absolute inset-0 z-10" aria-label="Jumpers"></a>--}}
        {{--            </div>--}}

        {{--            <!-- Категория 3 -->--}}
        {{--            <div class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300">--}}
        {{--                <div class="p-6">--}}
        {{--                    <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">Bags</h3>--}}
        {{--                    <p class="text-gray-500 text-sm">12 products</p>--}}
        {{--                    <div class="mt-4">--}}
        {{--                        <a href="/category/bags" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">--}}
        {{--                            View all--}}
        {{--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />--}}
        {{--                            </svg>--}}
        {{--                        </a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <a href="/category/bags" class="absolute inset-0 z-10" aria-label="Bags"></a>--}}
        {{--            </div>--}}

        {{--            <!-- Категория 4 -->--}}
        {{--            <div class="group relative border border-gray-200 rounded-lg hover:shadow-md transition-all duration-300">--}}
        {{--                <div class="p-6">--}}
        {{--                    <h3 class="text-xl font-medium text-gray-900 mb-2 libre-baskerville-regular">Accessories</h3>--}}
        {{--                    <p class="text-gray-500 text-sm">32 products</p>--}}
        {{--                    <div class="mt-4">--}}
        {{--                        <a href="/category/accessories" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">--}}
        {{--                            View all--}}
        {{--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />--}}
        {{--                            </svg>--}}
        {{--                        </a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <a href="/category/accessories" class="absolute inset-0 z-10" aria-label="Accessories"></a>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </section>

    <!-- CTA секция -->
    <section class="py-16 bg-gray-50 mt-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-light text-gray-900 mb-6 parisienne-regular">Can't find what you need?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Our consultants will help you find exactly what you're
                looking for</p>
            <a href="/contact"
               class="inline-block border border-gray-800 px-8 py-3 text-sm tracking-wider text-gray-800 hover:bg-gray-800 hover:text-white transition duration-300 libre-baskerville-regular">
                Contact Us
            </a>
        </div>
    </section>
@endsection
