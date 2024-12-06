<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
    <main>
        <section class="mt-16 md:mt-20 contact-us">
            <div class="container flex flex-col items-center justify-center gap-8 md:gap-24">
                <div class="flex flex-col items-center justify-center md:w-[40%] w-[80%] gap-3 text-center title-wrap">
                    <h2>Contact Us</h2>
                    <h6>
                        Welcome! We appreciate your interest. For questions, feedback, or
                        assistance, please contact us.
                    </h6>
                </div>
                <div class="flex flex-col items-center grid-cols-7 gap-8 md:gap-24 md:grid content-wrapper">
                    <img src="../asset/Contact-us.png" class="w-full col-span-4" alt="" />
                    <form action="" class="flex flex-col w-full col-span-3 gap-4">
                        <label for="">
                            <h6>Name</h6>
                        </label>
                        <input required type="text" class="w-full h-12 px-4 rounded-lg outline-none"
                            placeholder="Your Name" />
                        <label for="">
                            <h6>Email</h6>
                        </label>
                        <input required type="text" class="w-full h-12 px-4 rounded-lg outline-none"
                            placeholder="Your Email" />
                        <label for="">
                            <h6>Message</h6>
                        </label>
                        <textarea required name="" class="p-4 rounded-l outline-none" id="" rows="3"
                            placeholder="Tell Us What Is In Your Tought"></textarea>
                        <button type="submit" class="w-full py-3 rounded-lg bg-secondary-color">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </section>
        @include('layout.Sidebar')
        @include('layout.AuthCustomer')
    </main>
    @include('layout.Footer')
</body>
<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init();
  </script> -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>

</html>
