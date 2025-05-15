@extends('layout.main')
@section('meta')
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
@endsection
@section('content')
    <section class="mt-16 md:mt-20 contact-us">
        <div class="container flex flex-col items-center justify-center gap-8 md:gap-24">
            <div class="flex flex-col items-center justify-center md:w-[40%] w-[80%] gap-3 text-center title-wrap">
                <h3>Contact Us</h3>
                <h6>
                    Welcome! We appreciate your interest. For questions, feedback, or
                    assistance, please contact us.
                </h6>
            </div>
            <div class="flex flex-col items-center grid-cols-7 gap-8 md:gap-24 md:grid content-wrapper">
                <img src="../asset/Contact-us.png" class="w-full col-span-4" alt="" />
                <form action="{{ route('insertCS') }}" method="POST"
                    class="flex flex-col w-full col-span-3 gap-6 font-aesthetnova">
                    @csrf
                    <label for="name" class="flex flex-col gap-12">
                        <h6>Name</h6>
                        <input required type="text" name="name" id="name"
                            class="w-full h-12 outline-none text-white border-b-[1px] border-white/30"
                            placeholder="Your Name" />
                    </label>


                    <label for="email" class="flex flex-col gap-12">
                        <h6>Email</h6>
                        <input required type="email" name="email" id="email"
                            class="w-full h-12  outline-none text-white border-b-[1px] border-white/30"
                            placeholder="Your Email" />
                    </label>

                    <label for="messages" class="flex flex-col gap-12">
                        <h6>Message</h6>
                        <textarea required name="messages" id="messages" class="outline-none text-white border-b-[1px] border-white/30"
                            rows="5" placeholder="Tell Us What Is In Your Thought"></textarea>
                    </label>

                    <button type="submit" class="w-full py-3 rounded-lg bg-secondary-color">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </section>
            @include('layout.popovers.aside.sidebar-frontend')
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/GSAP/NavbarGsap.js') }}"></script>
    <script src="{{ asset('js/GSAP/ContactGsap.js') }}"></script>
@endsection
