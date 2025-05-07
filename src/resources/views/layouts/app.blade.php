<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Santo Cavalli')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Parisienne&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Parisienne&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('includes.header')

@yield('content') <!-- Основной контент страниц -->

@include('includes.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>


<script>
    gsap.registerPlugin(ScrollTrigger);

    // Проверяем, находимся ли мы на главной странице
    const isHomePage = window.location.pathname === '/';

    const mainBrand = document.getElementById('main-brand');
    const navBrand = document.getElementById('brand-in-navbar');
    const navbar = document.querySelector('nav');

    // Для не-главных страниц сразу устанавливаем финальное состояние
    if (!isHomePage) {
        navBrand?.classList.add('opacity-100');
        navbar.style.backgroundColor = "#000000";
    } else {
        // Анимации только для главной страницы
        if (mainBrand && navBrand && navbar) {
            gsap.to(mainBrand, {
                scrollTrigger: {
                    trigger: mainBrand,
                    start: "top-=10 top",
                    end: "top+=100 top",
                    scrub: true,
                    onEnter: () => navBrand.classList.add('opacity-100'),
                    onLeaveBack: () => navBrand.classList.remove('opacity-100'),
                },
                y: -100,
                scale: 0.5,
                opacity: 0,
                ease: "power2.out",
                duration: 1,
            });

            gsap.to(navbar, {
                scrollTrigger: {
                    trigger: mainBrand,
                    start: "top-=10 top",
                    end: "top+=100 top",
                    scrub: true,
                },
                backgroundColor: "#000000",
                ease: "none",
                duration: 1,
            });
        }
    }

    window.addEventListener('load', () => {
        ScrollTrigger.refresh();
    });
</script>


</body>
</html>
