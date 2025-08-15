<nav class="bg-transparent fixed top-0 left-0 w-full z-50 sm:px-15 @if(!request()->is('/')) bg-black @endif"
     xmlns="http://www.w3.org/1999/html">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
        <div class="tools flex">
            <!-- Кнопка в шапке сайта -->
            <button id="authModalTrigger"
                    class="personal__account items-center text-gray-700 hover:text-gray-900 transition mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </button>

            <!-- Модальное окно авторизации -->
            <div id="authModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Фон -->
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <!-- Контент модального окна -->
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                        <div class="bg-white px-6 py-8 sm:p-8">
                            <div class="flex justify-between items-start">
                                <h3 class="mt-5 text-xl font-medium text font-semiboldr">Войдите или
                                    зарегистрируйтесь</h3>
                                <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>

                            <form id="auth-form" class="mt-6 space-y-6" action="{{ route('authorization.send-code') }}"
                                  method="POST">
                                @csrf
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                                    <input id="phone" name="phone" required
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input id="remember" name="remember" type="checkbox"
                                               class="h-4 w-4 text-gray-900 focus:ring-gray-900 border-gray-300 rounded">
                                        <label for="remember" class="ml-2 block text-sm text-gray-900">Запомнить
                                            меня</label>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit"
                                       class="w-full flex justify-center py-2 px-4 border border-black">
                                        Получить смс
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const modal = document.getElementById('authModal');
                    const trigger = document.getElementById('authModalTrigger');
                    const closeBtn = document.getElementById('closeModal');

                    // Открытие модального окна
                    trigger.addEventListener('click', function () {
                        modal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    });

                    // Закрытие модального окна
                    closeBtn.addEventListener('click', function () {
                        modal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    });

                    // Закрытие при клике на фон
                    modal.addEventListener('click', function (e) {
                        if (e.target === modal) {
                            modal.classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }
                    });

                    // Закрытие при нажатии ESC
                    document.addEventListener('keydown', function (e) {
                        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                            modal.classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {

                    console.log('auth');
                    const form = document.getElementById('auth-form');

                    form.addEventListener('submit', async function (e) {
                        e.preventDefault(); // отмена стандартной отправки

                        const formData = new FormData(form);
                        const csrfToken = document.querySelector('input[name="_token"]').value;

                        try {
                            const response = await fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: formData
                            });

                            if (response.ok) {
                                const data = await response.json();
                                console.log('Успешно отправлено:', data);
                                // Здесь можно, например, показать сообщение об успехе
                            } else {
                                const error = await response.json();
                                console.error('Ошибка:', error);
                                // Можно отобразить ошибки на форме
                            }
                        } catch (err) {
                            console.error('Ошибка при запросе:', err);
                        }
                    });
                });
            </script>

            <style>
                .personal__account {
                    transition: all 0.3s ease;
                }

                .personal__account:hover {
                    transform: translateY(-1px);
                }
            </style>
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span
                    class="cormorant-regular self-center font-semibold whitespace-nowrap dark:text-white">CALL US</span>
            </a>
        </div>

        <div id="brand-in-navbar"
             class="absolute left-1/2 transform -translate-x-1/2 @if(request()->is('/')) opacity-0 @else opacity-100 @endif transition-opacity duration-500">
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
