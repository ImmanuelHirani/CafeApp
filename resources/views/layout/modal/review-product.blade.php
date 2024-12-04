<div id="reviewBox"
    class="fixed inset-0 z-50 flex items-center justify-center invisible bg-black opacity-30 bg-opacity-70 box-review-wrapper font-aesthetnova">
    <!-- Review Box Container -->
    <div
        class="review-box relative w-[90%] md:w-[50%] h-fit md:h-fit bg-secondary-accent-color outline outline-1 outline-highlight-content p-4 md:p-8 rounded-lg flex flex-col gap-3 items-center">
        <!-- Review Box Title -->
        <p class="text-lg text-center md:text-start md:text-xl">
            <span class="hidden md:inline-block">WHAT WOULD YOU</span>RATE THIS
            ITEM?
        </p>
        <!-- Product Image -->
        <img src="{{ asset('storage/' . $menusDetails->image) }}" alt="{{ $menusDetails->name }}"
            class="md:w-[50%] w-full h-[18rem]  object-cover rounded-lg" />
        <!-- Star Rating SVG Icons -->
        <div class="flex items-center gap-1.5 star">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20" fill="none">
                <path
                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                    class="fill-highlight-content" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20" fill="none">
                <path
                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                    class="fill-highlight-content" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20" fill="none">
                <path
                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                    class="fill-highlight-content" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20" fill="none">
                <path
                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                    fill="white" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20" fill="none">
                <path
                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                    fill="white" />
            </svg>
        </div>
        <!-- Feedback Form -->
        <div class="flex flex-col w-full gap-3">
            <p class="text-lg text-center md:text-start md:text-xl">
                Tell us your feedback about this product
            </p>
            <form class="grid grid-cols-4 gap-3.5 items-end">
                <!-- Feedback Textarea -->
                <textarea required name="feedback" class="w-full col-span-4 px-4 py-2 rounded-lg outline-none" rows="2"
                    placeholder="Max Character Limit - (100 Words)"></textarea>
                <!-- Name Input -->
                <input required type="text" name="name"
                    class="w-full h-10 col-span-4 px-4 rounded-lg outline-none md:col-span-2 md:h-14"
                    placeholder="Your Name" />
                <!-- Email Input -->
                <input required type="email" name="email"
                    class="w-full h-10 col-span-4 px-4 rounded-lg outline-none md:col-span-2 md:h-14"
                    placeholder="Your Email" />
                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-end col-span-4 gap-3.5">
                    <button type="submit"
                        class="w-full px-6 py-1.5 rounded-lg md:py-3 md:w-fit md:px-16 bg-secondary-color">
                        Submit
                    </button>
                    <button type="button"
                        class="w-full px-6 py-1.5 border border-white rounded-lg md:py-3 md:w-fit md:px-16">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
        <!-- Close Button (X Icon) -->
        <svg id="closeReviwe" xmlns="http://www.w3.org/2000/svg" class="absolute cursor-pointer top-6 right-6"
            width="20" height="20" viewBox="0 0 12 12" fill="none">
            <path
                d="M0.29289 0.29289C0.68342 -0.09763 1.31658 -0.09763 1.70711 0.29289L6 4.58579L10.2929 0.29289C10.6834 -0.09763 11.3166 -0.09763 11.7071 0.29289C12.0976 0.68342 12.0976 1.31658 11.7071 1.70711L7.4142 6L11.7071 10.2929C12.0976 10.6834 12.0976 11.3166 11.7071 11.7071C11.3166 12.0976 10.6834 12.0976 10.2929 11.7071L6 7.4142L1.70711 11.7071C1.31658 12.0976 0.68342 12.0976 0.29289 11.7071C-0.09763 11.3166 -0.09763 10.6834 0.29289 10.2929L4.58579 6L0.29289 1.70711C-0.09763 1.31658 -0.09763 0.68342 0.29289 0.29289Z"
                fill="#F8C055" />
        </svg>
    </div>
</div>
