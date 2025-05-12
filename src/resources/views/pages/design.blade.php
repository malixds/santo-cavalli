@extends('layouts.app')

@section('content')
    <section class="bg-white text-gray-900">
        <div class="max-w-6xl mx-auto px-6 py-24">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-extrabold tracking-tight leading-tight">Create Your Unique Design</h1>
                <p class="mt-4 text-lg text-gray-600">Upload your ideas — earn from every sale.</p>
            </div>

            <!-- Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
                <!-- Slider -->
                <div class="relative aspect-square w-full rounded-2xl overflow-hidden shadow-lg">
                    <div id="slider" class="absolute w-full h-full transition-opacity duration-1000 ease-in-out">
                        <img src="{{ asset('images/123.jpg') }}" alt="Design 1"
                             class="w-full h-full object-cover absolute rounded-2xl opacity-100 transition-opacity duration-1000">
                        <img src="{{ asset('images/123.jpg') }}" alt="Design 2"
                             class="w-full h-full object-cover absolute rounded-2xl opacity-0 transition-opacity duration-1000">
                        <img src="{{ asset('images/123.jpg') }}" alt="Design 3"
                             class="w-full h-full object-cover absolute rounded-2xl opacity-0 transition-opacity duration-1000">
                    </div>
                </div>

                <!-- Text -->
                <div class="space-y-6 animate-fade-in">
                    <h2 class="text-3xl font-semibold">Your Idea. <br> Our Time.</h2>
                    <p class="text font-semibold">
                        Мы хотим помочь тебе раскрыть свой творческий потенциал — воплотив твою идею в полноценный продукт.
                        Просто отправь нам свою лучшую работу в любом удобном формате, и если она будет одобрена, мы реализуем её за свой счёт и запустим в продажу.
                        Ты будешь получать ощутимый процент с каждой продажи.
                    </p>
                </div>
            </div>

            <!-- Upload Form -->
            <div class="bg-gray-50 p-10 rounded-3xl shadow-xl mb-20">
                <h2 class="text-2xl font-semibold text-center mb-8">Загрузи Свою Работу</h2>
                <form action="{{ route('designs.store') }}" method="POST" enctype="multipart/form-data"
                      class="space-y-8">
                    @csrf

                    <div>
                        <label for="design_name" class="block text-sm font-medium text-gray-700">Design Name</label>
                        <input type="text" id="design_name" name="design_name" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black"
                               placeholder="Give your design a name">
                    </div>

                    <div>
                        <label for="product_type" class="block text-sm font-medium text-gray-700">Product Type</label>
                        <select id="product_type" name="product_type" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black">
                            <option value="" disabled selected>Select a product</option>
                            <option value="t-shirt">T-Shirt</option>
                            <option value="hoodie">Hoodie</option>
                            <option value="tote-bag">Tote Bag</option>
                            <option value="phone-case">Phone Case</option>
                        </select>
                    </div>

                    <div>
                        <label for="design_file" class="block text-sm font-medium text-gray-700">Upload File</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                            <input type="file" name="design_file" id="design_file"
                                   accept=".png,.jpg,.jpeg,.svg,.ai,.eps"
                                   required class="sr-only">
                            <label for="design_file" class="cursor-pointer text-black font-medium hover:text-gray-600">
                                Click or drag file here
                            </label>
                            <p class="mt-2 text-sm text-gray-500">PNG, JPG, SVG (max 10MB)</p>
                        </div>
                    </div>

                    <div>
                        <label for="design_notes" class="block text-sm font-medium text-gray-700">Additional
                            Notes</label>
                        <textarea id="design_notes" name="design_notes" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black"
                                  placeholder="Any instructions or preferences..."></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                                class="inline-block bg-black text-white px-8 py-3 rounded-lg hover:bg-gray-900 transition">
                            Submit Design
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- FAQ Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-serif font-light text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Find answers to common questions about our design
                    platform</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-200 rounded-xl overflow-hidden transition-all duration-300">
                    <button
                        class="faq-toggle w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 transition"
                        aria-expanded="false"
                        aria-controls="faq-1">
                        <h3 class="text-lg font-medium text-gray-900">How do I earn money with my designs?</h3>
                        <svg class="w-5 h-5 text-indigo-600 transform transition-transform duration-300" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="faq-1" class="hidden px-6 pb-6 pt-0">
                        <div class="text-gray-600 space-y-2">
                            <p>You earn 10% royalties from every product sold featuring your design. We handle all
                                production, shipping, and customer service, while you focus on creating.</p>
                            <p>Payments are made monthly via PayPal or bank transfer once you reach the $50 minimum
                                threshold.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-200 rounded-xl overflow-hidden transition-all duration-300">
                    <button
                        class="faq-toggle w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 transition"
                        aria-expanded="false"
                        aria-controls="faq-2">
                        <h3 class="text-lg font-medium text-gray-900">What file formats do you accept?</h3>
                        <svg class="w-5 h-5 text-indigo-600 transform transition-transform duration-300" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="faq-2" class="hidden px-6 pb-6 pt-0">
                        <div class="text-gray-600 space-y-2">
                            <p>We accept the following file formats:</p>
                            <ul class="list-disc pl-5 space-y-1">
                                <li>High-resolution PNG (min 3000x3000px, 300DPI)</li>
                                <li>JPEG (high quality only)</li>
                                <li>SVG (vector files preferred)</li>
                                <li>AI (Adobe Illustrator)</li>
                                <li>EPS (Encapsulated PostScript)</li>
                            </ul>
                            <p>Maximum file size is 10MB.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-200 rounded-xl overflow-hidden transition-all duration-300">
                    <button
                        class="faq-toggle w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 transition"
                        aria-expanded="false"
                        aria-controls="faq-3">
                        <h3 class="text-lg font-medium text-gray-900">How long does approval take?</h3>
                        <svg class="w-5 h-5 text-indigo-600 transform transition-transform duration-300" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="faq-3" class="hidden px-6 pb-6 pt-0">
                        <div class="text-gray-600">
                            <p>Our team typically reviews new submissions within 2-3 business days. You'll receive an
                                email notification once your design is approved and live in our store.</p>
                            <p class="mt-2">During peak times, approval may take up to 5 business days.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border border-gray-200 rounded-xl overflow-hidden transition-all duration-300">
                    <button
                        class="faq-toggle w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 transition"
                        aria-expanded="false"
                        aria-controls="faq-4">
                        <h3 class="text-lg font-medium text-gray-900">Can I edit or remove my design later?</h3>
                        <svg class="w-5 h-5 text-indigo-600 transform transition-transform duration-300" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="faq-4" class="hidden px-6 pb-6 pt-0">
                        <div class="text-gray-600">
                            <p>Yes, you can edit your design details (title, description, tags) at any time from your
                                dashboard. To replace the actual design file, you'll need to submit a new version for
                                approval.</p>
                            <p class="mt-2">You can remove your design from sale anytime, but any products already
                                ordered will still be fulfilled.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('.faq-toggle').forEach(button => {
                button.addEventListener('click', () => {
                    const faqContent = document.getElementById(button.getAttribute('aria-controls'));
                    const isExpanded = button.getAttribute('aria-expanded') === 'true';

                    // Toggle aria-expanded
                    button.setAttribute('aria-expanded', !isExpanded);

                    // Toggle icon rotation
                    const icon = button.querySelector('svg');
                    icon.classList.toggle('rotate-180');

                    // Toggle content visibility
                    faqContent.classList.toggle('hidden');

                    // Close other open FAQs
                    if (!isExpanded) {
                        document.querySelectorAll('.faq-toggle').forEach(otherButton => {
                            if (otherButton !== button && otherButton.getAttribute('aria-expanded') === 'true') {
                                otherButton.setAttribute('aria-expanded', 'false');
                                otherButton.querySelector('svg').classList.remove('rotate-180');
                                document.getElementById(otherButton.getAttribute('aria-controls')).classList.add('hidden');
                            }
                        });
                    }
                });
            });
        </script>
    </section>


    <style>
        .slider-img {
            @apply w-full h-full object-cover absolute transition-opacity duration-1000 ease-in-out rounded-3xl;
        }

        .inspiration-box {
            @apply bg-gray-100 p-8 text-gray-700 rounded-xl text-lg font-medium hover:bg-gray-200 transition;
        }
    </style>

    <script>
        const images = document.querySelectorAll('#slider img');
        let current = 0;
        setInterval(() => {
            images[current].classList.remove('opacity-100');
            images[current].classList.add('opacity-0');
            current = (current + 1) % images.length;
            images[current].classList.remove('opacity-0');
            images[current].classList.add('opacity-100');
        }, 4000);
    </script>
@endsection
