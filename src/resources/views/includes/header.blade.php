<nav class="bg-transparent fixed top-0 left-0 w-full z-50 sm:px-15">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="cormorant-regular self-center font-semibold whitespace-nowrap dark:text-white">Call us</span>
        </a>


        <div id="brand-in-navbar"
             class="absolute left-1/2 transform -translate-x-1/2 opacity-0 transition-opacity duration-500">
            <a href="/" class="text-xl md:text-2xl font-semibold parisienne__regular text-white pointer">Santo
                Cavalli</a>
        </div>

        <!-- Burger button -->
        <button id="menu-toggle" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
    </div>

    <!-- Slide-in menu -->
    <div id="navbar-menu"
         class="fixed top-0 right-0 h-full w-64 bg-white text-red-600 shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-40">
        <div class="flex justify-end p-4">
            <button id="menu-close" class="text-2xl font-regular"></button>
        </div>
        <ul class="font-regular cormorant-regular text-lg flex flex-col gap-6 p-6">
            <li><a href="#" class="hover:text-red-400 transition">Home</a></li>
            <li><a href="#" class="hover:text-red-400 transition">About</a></li>
            <li><a href="#" class="hover:text-red-400 transition">Services</a></li>
            <li><a href="#" class="hover:text-red-400 transition">Pricing</a></li>
            <li><a href="#" class="hover:text-red-400 transition">Contact</a></li>
        </ul>
    </div>

    <div id="menu-overlay" class="fixed inset-0 bg-black bg-opacity-30 hidden z-30"></div>

    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const closeBtn = document.getElementById('menu-close');
        const menu = document.getElementById('navbar-menu');
        const overlay = document.getElementById('menu-overlay');

        toggleBtn.addEventListener('click', () => {
            menu.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
        });

        closeBtn.addEventListener('click', () => {
            menu.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            menu.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
</nav>
