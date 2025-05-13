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