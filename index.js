$(document).ready(function(){
    // Inisialisasi untuk slider Wisata
    var swiperTour = new Swiper('.tour-slider', {
        slidesPerView: 6,            // Menampilkan 6 card per slide
        spaceBetween: 10,            // Jarak antar card
        slidesPerGroup: 6,           // Geser 6 card sekaligus
        loop: true,                  // Infinite loop
        autoplay: {
            delay: 3000,             // Interval 3 detik
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,    // Menampilkan 4 card pada tablet
                slidesPerGroup: 4,
            },
            600: {
                slidesPerView: 2,    // Menampilkan 2 card pada mobile
                slidesPerGroup: 2,
            }
        }
    });

    // Inisialisasi untuk slider Events
    var swiperEvent = new Swiper('.event-slider', {
        slidesPerView: 6,
        spaceBetween: 10,
        slidesPerGroup: 6,
        loop: true,
        autoplay: {
            delay: 3000,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,
                slidesPerGroup: 4,
            },
            600: {
                slidesPerView: 2,
                slidesPerGroup: 2,
            }
        }
    });

    // Inisialisasi untuk slider Penginapan
    var swiperRoom = new Swiper('.room-slider', {
        slidesPerView: 6,
        spaceBetween: 10,
        slidesPerGroup: 6,
        loop: true,
        autoplay: {
            delay: 3000,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,
                slidesPerGroup: 4,
            },
            600: {
                slidesPerView: 2,
                slidesPerGroup: 2,
            }
        }
    });
});
