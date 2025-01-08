<div id="reviewBox"
    class="fixed inset-0 z-50 items-center justify-center hidden bg-black opacity-30 bg-opacity-70 box-review-wrapper font-aesthetnova">
    <!-- Review Box Container -->
    <div
        class="review-box relative w-[90%] md:w-[50%] h-fit md:h-fit bg-secondary-accent-color p-4 md:p-8 rounded-lg flex flex-col gap-3 items-center">
        <!-- Review Box Title -->
        <p class="text-lg text-center md:text-start md:text-xl">
            <span class="hidden md:inline-block">WHAT WOULD YOU</span>RATE THIS
            ITEM?
        </p>
        <!-- Product Image -->
        <img src="{{ asset('storage/' . $menuDetails->image) }}" alt="{{ $menuDetails->name }}"
            class="md:w-[50%] w-full md:h-[18rem] h-[10rem]  object-cover rounded-lg" />
        <form action="{{ route('menu.reviews.store') }}" method="POST" class="flex flex-col items-center w-full gap-3">
            @csrf
            <!-- Star Rating SVG Icons -->
            <div class="flex items-center gap-1.5 star">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="text-3xl text-white transition-all duration-500 ease-in-out cursor-pointer ti ti-carambola-filled hover:text-highlight-content"
                        data-value="{{ $i }}"></i>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating" value="0">
            <input type="hidden" name="menu_ID" value="{{ $menuDetails->menu_ID }}">
            @auth
                <input type="hidden" name="user_ID" value="{{ Auth::user()->user_ID }}">
            @endauth
            <!-- Feedback Form -->
            <div class="flex flex-col w-full gap-3">
                <p class="text-base text-center md:text-start md:text-xl">
                    Tell us your feedback about this product
                </p>
                <div class="grid grid-cols-4 gap-3.5 items-end">
                    <!-- Feedback Textarea -->
                    <textarea required name="review_desc" class="w-full col-span-4 px-4 py-2 rounded-lg outline-none" rows="4"
                        placeholder="Max Character Limit - (100 Words)"></textarea>
                    <!-- Submit and Cancel Buttons -->
                    <div class="flex justify-end col-span-4 gap-3.5">
                        <button type="submit"
                            class="w-full px-6 py-1.5 rounded-lg md:py-3 md:w-fit md:px-16 bg-secondary-color">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Close Button (X Icon) -->
        <svg id="closeReviwe" xmlns="http://www.w3.org/2000/svg" class="absolute cursor-pointer top-6 right-6"
            width="20" height="20" viewBox="0 0 12 12" fill="none">
            <path
                d="M0.29289 0.29289C0.68342 -0.09763 1.31658 -0.09763 1.70711 0.29289L6 4.58579L10.2929 0.29289C10.6834 -0.09763 11.3166 -0.09763 11.7071 0.29289C12.0976 0.68342 12.0976 1.31658 11.7071 1.70711L7.4142 6L11.7071 10.2929C12.0976 10.6834 12.0976 11.3166 11.7071 11.7071C11.3166 12.0976 10.6834 12.0976 10.2929 11.7071L6 7.4142L1.70711 11.7071C1.31658 12.0976 0.68342 12.0976 0.29289 11.7071C-0.09763 11.3166 -0.09763 10.6834 0.29289 10.2929L4.58579 6L0.29289 1.70711C-0.09763 1.31658 -0.09763 0.68342 0.29289 0.29289Z"
                fill="#F8C055" />
        </svg>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const reviewTrigger = document.getElementById("reviewTrigger"),
            reviewBox = document.getElementById("reviewBox"),
            closeReviwe = document.getElementById("closeReviwe");

        // Handling the review box visibility
        reviewTrigger.addEventListener("click", () => {
            reviewTrigger.classList.add("trigger-active-review");
            reviewBox.classList.add("box-active-review");
        });

        closeReviwe.addEventListener("click", () => {
            reviewTrigger.classList.remove("trigger-active-review");
            reviewBox.classList.remove("box-active-review");
        });

        // Handling the star rating
        const stars = document.querySelectorAll(".star i");
        const ratingInput = document.querySelector("input[name='rating']");

        stars.forEach((star) => {
            star.addEventListener("click", () => {
                const selectedRating = star.getAttribute("data-value");

                // Update the hidden rating input
                ratingInput.value = selectedRating;

                // Update the visual state of the stars
                stars.forEach((s, i) => {
                    if (i < selectedRating) {
                        s.classList.add("text-highlight-content");
                        s.classList.remove("text-white");
                    } else {
                        s.classList.add("text-white");
                        s.classList.remove("text-highlight-content");
                    }
                });
            });
        });
    });
</script>
