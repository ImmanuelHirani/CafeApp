// Media queries menggunakan gsap.matchMedia
// Main GSAP timeline for the entrance animations
gsap.timeline()
    .from(".left-content h1", {
        opacity: 0,
        y: -100,
        duration: 1.5,
        ease: "power2.out",
    })
    .from(
        ".left-content h5",
        {
            opacity: 0,
            x: -50,
            duration: 1,
            ease: "power2.out",
        },
        "-=1.2"
    )
    .fromTo(
        ".left-content #ExploreBtn",
        {
            opacity: 0,
            y: 50,
        },
        {
            opacity: 100,
            y: 0,
            duration: 1,
            ease: "power2.out",
        },
        "-=1"
    )
    .from(
        ".right-content-hero img",
        {
            scale: 0.5,
            rotation: 360, // Initial rotation animation
            opacity: 0,
            duration: 2,
            ease: "back.out(1.7)",
            onComplete: () => {
                // Start the infinite rotation after the initial animation completes
                gsap.to(".right-content-hero img", {
                    rotation: 360,
                    duration: 10,
                    ease: "none",
                    repeat: -1,
                });
            },
        },
        "-=1.5"
    );




const mm = gsap.matchMedia();

mm.add(
    {
        isTablet: "(min-width: 501px) and (max-width: 1023px)",
        isLaptop: "(min-width: 1440px) and (max-width: 1580px)",
        isDesktop: "(min-width: 1440px) and (max-width: 1920px)",
    },
    (context) => {
        const { isDesktop, isLaptop, isTablet } = context.conditions;

        // Properly select the element based on the context
        const selector =
            isLaptop || isDesktop
                ? ".toppings-content"
                : ".toppings-content .right-content";

        // Timeline untuk animasi utama
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: "#toppings",
                start: "top top",
                end: "bottom top",
                scrub: 1,
                pin: true,
            },
        });

        // Animasi untuk selector utama
        tl.to(selector, {
            xPercent: isLaptop
                ? -72.5
                : isDesktop
                ? -74.5
                : isTablet
                ? -190
                : -175,
            duration: 1,
            ease: "none",
        });

        // Animasi untuk elemen gambar di right content
        tl.to(
            ".toppings-content .right-content .img-wrap",
            {
                skewY: 3,
                borderRadius: 40,
                scale: 0.9,
                duration: 1.5,
                ease: "none",
            },
            0
        );

        // Timeline untuk animasi teks di left content
        const tlText = gsap.timeline({
            scrollTrigger: {
                trigger: "#toppings",
                start: "top 80%",
                end: "bottom 20%",
                scrub: true,
            },
        });

        tlText
            .from("#toppings .left-content h2", {
                opacity: 0,
                y: -50,
                duration: 1,
                ease: "power2.out",
            })
            .from(
                "#toppings .left-content p",
                {
                    opacity: 0,
                    y: 50,
                    duration: 1.2,
                    ease: "power2.out",
                },
                "-=0.8"
            )
            .from(
                "#toppings .left-content h6",
                {
                    opacity: 0.9,
                    x: 50,
                    duration: 1.4,
                    ease: "power2.out",
                },
                "-=0.6"
            );

        // Timeline untuk animasi topping-name
        const tlToppingName = gsap.timeline({
            scrollTrigger: {
                trigger: "#toppings",
                start: "80% 80%", // Mulai animasi ketika bagian atas dari #toppings mencapai 80% viewport
                end: "bottom 20%", // Animasi berakhir saat bagian bawah dari #toppings mencapai 20% viewport
                scrub: true, // Animasi mengikuti scroll
            },
        });

        tlToppingName.fromTo(
            ".topping-name",
            {
                opacity: 0,
                y: 50,
            },
            {
                opacity: 1,
                y: 0,
                stagger: 3, // Jarak antara setiap animasi elemen
                duration: 4,
                ease: "power2.out",
            }
        );
    }
);


gsap.timeline({
    scrollTrigger: {
        trigger: "#more-menu",
        start: "top bottom",
        end: "bottom 80%",
        scrub: 1,
        // toggleActions: "play none none reverse",
        // markers: true,
    },
})
    .from(".headline-content h2", {
        opacity: 0,
        y: 50,
        duration: 1,
        ease: "power2.out",
    })
    .from(
        ".headline-content hr",
        {
            width: 0,
            duration: 1,
            ease: "power2.out",
        },
        "-=0.5"
    )
    .from(
        ".headline-content h6",
        {
            opacity: 0,
            y: 50,
            duration: 1,
            ease: "power2.out",
        },
        "-=0.5"
    )
    .from(
        ".coffee img",
        {
            opacity: 0,
            scale: 0.8,
            duration: 1,
            ease: "back.out(1.7)",
        },
        "-=0.5"
    )
    .from(
        ".coffee .desc-content",
        {
            opacity: 0,
            x: 100,
            duration: 1,
            ease: "power2.out",
        },
        "-=0.5"
    )
    .from(
        ".bubble .desc-content",
        {
            opacity: 0,
            x: -100,
            duration: 1,
            ease: "power2.out",
        },
        "-=0.5"
    )
    .from(
        ".bubble img",
        {
            opacity: 0,
            scale: 0.8,
            duration: 1,
            ease: "back.out(1.7)",
        },
        "-=0.5"
    );


    // Custom Order

gsap.timeline({
    scrollTrigger: {
        trigger: "#custom-order",
        start: "-15% 80%",
        end: "bottom 30%",
        scrub: 1,
    },
}).from(".title h5", {
    opacity: 0,
    y: 50,
    duration: 1.5,
    ease: "power2.out",
});

// GSAP untuk tombol #prev
gsap.from("#custom-order #prev", {
    x: -50,
    duration: 0.3,
    scale: 0.6,
    ease: "expoScale(0.5,7,none)",
    scrollTrigger: {
        trigger: "#custom-order #prev",
        toggleActions: "play reverse play reverse", // Mainkan animasi saat masuk, balikkan saat keluar
    },
});

// GSAP untuk tombol #next
gsap.from("#custom-order #next", {
    x: 50,
    duration: 0.3,
    scale: 0.6,
    ease: "expoScale(0.5,7,none)",
    scrollTrigger: {
        trigger: "#custom-order #next",
        toggleActions: "play reverse play reverse", // Mainkan animasi saat masuk, balikkan saat keluar
    },
});

// GSAP untuk tombol #btn-custom

mm.add(
    {
        isMobile: "(max-width: 500px)",
        isTablet: "(min-width: 501px) and (max-width: 1023px)",
        isLaptop: "(min-width: 1440px) and (max-width: 1580px)",
        isDesktop: "(min-width: 1440px) and (max-width: 1920px)",
    },
    (context) => {
        const { isDesktop, isLaptop, isTablet } = context.conditions;

        return gsap.to("#custom-order .container #btn-custom", {
            width: !isDesktop && !isLaptop && !isTablet ? "8.8em" : "",
            duration: 0.4,
            ease: "expoScale(0.5,7,none)",
            scrollTrigger: {
                trigger: "#custom-order .container #btn-custom",
                toggleActions: "play reverse play reverse",
            },
        });
    }
);

// Custom Order end