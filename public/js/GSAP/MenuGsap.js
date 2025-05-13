// Menu

gsap.from(".hero .wrap h1", {
    opacity: 0,
    y: -50,
    duration: 1,
    ease: "power2.out",
    delay: 0.5, // Optional: adds a delay before starting the animation
});

gsap.from(".hero .wrap h6", {
    opacity: 0,
    y: 50,
    duration: 1,
    ease: "power2.out",
    delay: 1, // Optional: adds a delay before starting the animation
});

// Menu End
