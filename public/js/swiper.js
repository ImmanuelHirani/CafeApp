var swiper = new Swiper(".customTopping", {
    grabCursor: true,
    loop: true,
    loopAddBlankSlides: false, // Default is false, included for clarity
    loopPreventsSliding: false, // Default is false, included for clarity

    preventClicksPropagation: true,
    // mousewheel: true,
    observer: true,
    speed: 800, // Slide transition speed
    updateOnWindowResize: true,
    // initialSlide: 20,

    // Navigation arrows
    navigation: {
        nextEl: "#next",
        prevEl: "#prev",
    },

    // autoplay: {
    //   delay: 5000, // Delay between autoplay slides
    // },
    autoHeight: true, // Adjusts height based on slide content

    breakpoints: {
        360: {
            slidesPerView: 1.19,

            centeredSlides: true,
        },
        430: {
            slidesPerView: 1.19,

            centeredSlides: true,
        },
        540: {
            slidesPerView: 1.5,
        },
        768: {
            slidesPerView: 2.2,
            spaceBetween: 10,
        },
        912: {
            slidesPerView: 1.8,
            spaceBetween: 16,
        },
        1024: {
            slidesPerView: 2.6,
            spaceBetween: 16,
        },
        1380: {
            slidesPerView: 2.5,
            spaceBetween: 0,
            centeredSlides: true,
        },
    },
});

var swiperFooterImgSlide = new Swiper(".img-showcase-food", {
    grabCursor: false,
    allowTouchMove: false,
    loop: true,
    loopAddBlankSlides: false, // Default is false, included for clarity
    loopPreventsSliding: false, // Default is false, included for clarity

    autoplay: {
        delay: 2000,
    },
    preventClicksPropagation: true,

    observer: true,
    speed: 1000, // Slide transition speed
    updateOnWindowResize: true,
    // initialSlide: 20,

    freeMode: false,

    // autoplay: {
    //   delay: 5000, // Delay between autoplay slides
    // },

    breakpoints: {
        360: {
            slidesPerView: 1.2,
            centeredSlides: true,
        },
        430: {
            slidesPerView: 1.2,
        },
        540: {
            slidesPerView: 1.5,
        },
        768: {
            slidesPerView: 2.2,
        },
        912: {
            slidesPerView: 1.8,
        },
        1024: {
            slidesPerView: 4,
        },
        1380: {
            slidesPerView: 6,
        },
    },
});

function initSwiper(selector) {
    return new Swiper(selector, {
        grabCursor: true,
        preventClicksPropagation: true,
        observer: true,

        // mousewheel: true,
        speed: 1000, // Slide transition speed
        updateOnWindowResize: true,
        // freeMode: false, // Disable free scrolling
        slideToClickedSlide: true, // Ensure it snaps to the closest slide

        breakpoints: {
            360: {
                slidesPerView: 1.06,
                spaceBetween: 6,
            },
            430: {
                slidesPerView: 1.2,
                spaceBetween: 8,
            },
            540: {
                slidesPerView: 1.5,
                spaceBetween: 12,
            },
            768: {
                slidesPerView: 2.2,
                spaceBetween: 12,
            },
            912: {
                slidesPerView: 1.8,
                spaceBetween: 16,
            },
            1024: {
                slidesPerView: 2.5,
                spaceBetween: 16,
            },
            1380: {
                slidesPerView: 2.9,
                spaceBetween: 16,
            },
            1800: {
                slidesPerView: 3.5,
                spaceBetween: 16,
            },
        },
    });
}

// Inisialisasi Swiper untuk masing-masing class
var swiperPizzaMenu = initSwiper(".pizza-swiper");
var swiperBubbleMenu = initSwiper(".bubble-swiper");
var swiperCoffeMenu = initSwiper(".coffee-swiper");

var swiper = new Swiper(".other-item-content", {
    direction: "vertical",
    mousewheel: true,
    speed: 800, // Slide transition speed
    updateOnWindowResize: true,
    slidesPerView: "auto", // Menyesuaikan tampilan item
    spaceBetween: 12, // Kurangi jarak antar slide
});

var swiper = new Swiper(".cart-added-content", {
    direction: "vertical",
    mousewheel: true,
    updateOnWindowResize: true,
    speed: 800, // Slide transition speed
    slidesPerView: "auto", // Menyesuaikan tampilan item
    spaceBetween: 12, // Kurangi jarak antar slide
});
