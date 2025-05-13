// contact us
const contactUsTimeline = gsap.timeline();

contactUsTimeline
    .from(".title-wrap h2", {
        opacity: 0,
        y: 50,
        duration: 0.8, // Perpendek durasi animasi
        ease: "power2.out",
    })
    .from(
        ".title-wrap h6",
        {
            opacity: 0,
            y: 50,
            duration: 0.8,
            ease: "power2.out",
        },
        "-=0.3" // Perkecil delay antar animasi
    );

// Animasi untuk gambar dan form
contactUsTimeline
    .from(".content-wrapper img", {
        opacity: 0,
        y: 50,
        duration: 0.8, // Perpendek durasi animasi
        ease: "power2.out",
    })
    .from(
        ".content-wrapper form",
        {
            opacity: 0,
            y: 50,
            duration: 0.8,
            ease: "power2.out",
        },
        "-=0.3" // Perkecil delay antar animasi
    );

// contact us End
