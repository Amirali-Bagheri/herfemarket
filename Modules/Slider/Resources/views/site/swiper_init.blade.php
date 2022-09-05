@push ('head')
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
    />

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    {{--        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">--}}

    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
            integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <!-- Swiper JS -->
    {{--    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>--}}
    {{--    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>--}}

    @php
        if (!isset($type) or empty($type)) {
            $type = 'mobile';
        }
    @endphp

    @if ($type == 'desktop')
        <style>

            .swiper-container #categories-slider {
                width: 100%;
                height: 100%;
            }

            .swiper-slide #categories-slider-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                display: -webkit-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
            }

        </style>

        <!-- Initialize Swiper -->
        <script type="module">
            import Swiper from 'https://unpkg.com/swiper@8/swiper-bundle.esm.browser.min.js'

            var categories_slider = new Swiper('#categories-slider', {
                freeMode: true,
                slidesPerView: 4,
                slidesPerColumn: 1,
                spaceBetween: 1,
                slideShadows: false,
                autoplay: {
                    delay: 5000,
                },
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            var products_slider = new Swiper('#products-slider', {
                freeMode: true,
                slidesPerView: 7,
                slidesPerColumn: 1,
                autoplay: {
                    delay: 5000,
                },
                slideShadows: false,
                shadow: false,
                loop: true,
                spaceBetween: 1,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            var banner_slider = new Swiper('#banner-slider', {
                effect: 'cube',
                grabCursor: true,
                slideShadows: false,
                shadow: false,
                autoplay: {
                    delay: 5000,
                },
                loop: true,
                cubeEffect: {
                    shadow: false,
                    slideShadows: false,
                    shadowOffset: 20,
                    shadowScale: 0.94,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
            });
        </script>


    @elseif($type == 'mobile')
        <style>

            .swiper-container #categories-slider {
                width: 100%;
                height: 100%;
            }

            .swiper-slide #categories-slider-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                display: -webkit-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
            }

        </style>

        <!-- Initialize Swiper -->
        <script type="module">
            import Swiper from 'https://unpkg.com/swiper@8/swiper-bundle.esm.browser.min.js'

            var categories_slider = new Swiper('#categories-slider', {
                freeMode: true,
                slidesPerView: 4,
                slidesPerColumn: 1,
                spaceBetween: 1,
                slideShadows: false,
                autoplay: {
                    delay: 5000,
                },
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            var products_slider = new Swiper('#products-slider', {
                freeMode: true,
                slidesPerView: 3,
                slidesPerColumn: 1,
                autoplay: {
                    delay: 5000,
                },
                slideShadows: false,
                shadow: false,
                loop: true,
                spaceBetween: 1,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            var banner_slider = new Swiper('#banner-slider', {
                effect: 'cube',
                grabCursor: true,
                slideShadows: false,
                shadow: false,
                autoplay: {
                    delay: 5000,
                },
                loop: true,
                cubeEffect: {
                    shadow: false,
                    slideShadows: false,
                    shadowOffset: 20,
                    shadowScale: 0.94,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
            });
        </script>

    @endif


@endpush
