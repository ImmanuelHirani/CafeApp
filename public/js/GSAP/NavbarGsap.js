const nav = document.querySelector(".box");
const header = document.querySelector("header");
const navTrigger = document.getElementById("navTrigger");
const mobilenavExpand = document.getElementById("mobilenavExpand");

let previousScroll = window.pageYOffset;
let originalHeight = mobilenavExpand ? mobilenavExpand.scrollHeight : 0; // Get the scrollHeight initially

// Update height when the page is resized (to handle dynamic content changes)
if (mobilenavExpand) {
    window.addEventListener("resize", () => {
        originalHeight = mobilenavExpand.scrollHeight;
    });

    // Initialize the height to 0 if h-0 class is present
    if (mobilenavExpand.classList.contains("h-0")) {
        mobilenavExpand.style.height = "0";
    }
}

window.addEventListener("scroll", function () {
    let currentScroll = window.pageYOffset;

    if (currentScroll < previousScroll) {
        // Scroll ke atas
        gsap.to(header, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out",
        });
    } else if (currentScroll > previousScroll && currentScroll > 500) {
        // Scroll ke bawah setelah offset 500px
        gsap.to(header, {
            opacity: 0,
            y: -20,
            duration: 0.8,
            ease: "power2.out",
        });
    }

    previousScroll = currentScroll;

    // Collapse the mobile navigation when scrolling down
    if (currentScroll > 50) {
        nav.classList.add("expanded");

        if (mobilenavExpand && !mobilenavExpand.classList.contains("h-0")) {
            gsap.to(mobilenavExpand, {
                height: 0,
                duration: 0.5,
                ease: "power2.inOut",
                onComplete: () => {
                    mobilenavExpand.classList.add("h-0");
                    mobilenavExpand.parentNode.classList.remove(
                        "bg-secondary-color"
                    );
                },
            });
        }
    } else {
        nav.classList.remove("expanded");
    }
});

if (navTrigger && mobilenavExpand) {
    navTrigger.addEventListener("click", () => {
        if (mobilenavExpand.classList.contains("h-0")) {
            // Expand
            mobilenavExpand.classList.remove("h-0");
            mobilenavExpand.parentNode.classList.add("bg-secondary-color");
            gsap.to(mobilenavExpand, {
                height: originalHeight,
                duration: 0.5,
                ease: "power2.inOut",
            });
        } else {
            // Collapse
            gsap.to(mobilenavExpand, {
                height: 0,
                duration: 0.5,
                ease: "power2.inOut",
                onComplete: () => {
                    mobilenavExpand.classList.add("h-0");
                    mobilenavExpand.parentNode.classList.remove(
                        "bg-secondary-color"
                    );
                },
            });
        }
    });
}
