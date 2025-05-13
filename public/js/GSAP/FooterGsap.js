gsap.timeline({
    scrollTrigger: {
        trigger: "footer",
        start: "top 80%",
        end: "top center",
        scrub: 1,
    },
})
    .from(".wrapper-address .Wrap", {
        opacity: 0,
        y: 200,
        duration: 1.5,

        ease: "none",
    })
    .from(
        ".sosial-media",
        {
            opacity: 0,
            scale: 0,
            y: 200,
            duration: 1.5,
            ease: "none",
        },
        "-=1.5"
    ); // Adjust this overlap as needed