@extends('layout.user.app')

@section('main')
    {{-- Start Section: Hero --}}
    <section class="h-screen bg-hero-section bg-cover" style="background-position: top left 80%;">
        <div class="max-w-screen-lg mx-auto px-4 py-2 h-full flex items-center">
            <div class="bg-blue -mt-10">
                <h1 class="font-primary font-bold text-5xl text-primary lg:text-6xl">CLAUDIA<br> ANGELICA</h1>
                <span class="font-secondary font-semibold text-lg text-dark lg:text-[22px]">
                    CEO - FOUNDER - MENTOR - AUTHOR -
                    <br>
                    SOCIAL ENTREPRENEUR
                </span>
            </div>
        </div>
    </section>
    {{-- End Section: Hero --}}

    {{-- Start Section: Who Is Angle? --}}
    <section class="py-10">
        <div class="max-w-screen-lg mx-auto px-4 py-2">
            <div class="grid grid-cols-2 items-stretch gap-10 sm:flex-row">
                <div class="w-full col-span-2 sm:col-span-1">
                    <img src="{{ asset('assets/images/about.webp') }}" alt="Who Is Angel?"
                        class="w-full h-full object-contain">
                </div>
                <div class="w-full flex flex-col mt-8 sm:mt-0 sm:justify-center col-span-2 sm:col-span-1">
                    <h3 class="font-bold text-4xl text-dark">Hi, I'm</h3>
                    <h2 class="mt-2 font-primary font-bold text-6xl text-primary">Angel?</h2>
                    <p class="mt-2 text-lg leading-6 text-dark font-secondary font-medium text-justify">
                        I’m a young social entrepreneur and author who loves to learn, innovate, collaborate and educate. I
                        hope that my work brings positive and sustainable impact to communities around me and inspire others
                        to do likewise.
                        <br><br>
                        My journey officially began as the founder, CEO and CTO of Knocknock.co and Knocknock.Beauty,
                        e-commerce ventures that markets a variety of products sourced globally through various online
                        channels. Then, seeing my grandmother’s declining mental state during the pandemic and the lack of
                        accessibility to therapy moved me to start and become CEO of Muzartt, a mobile application that
                        provides virtual art and music therapy to older adults.
                        <br><br>
                        My entrepreneurship journey then inspired me to then start Aku Bisa, an initiative dedicated to
                        educating and mentoring underprivileged individuals in the field of digital entrepreneurship, aiming
                        to build a community of sustainable and modern entrepreneurs. Through Aku Bisa, I want to empower
                        and mentor many young entrepreneurs like myself, to become <b>changemakers in their
                            own communities.</b>
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- End Section: Who Is Angle? --}}

    {{-- Start Section: As Seen On --}}
    <section class="pb-12">
        <div class="py-8 bg-as-seen-as-section bg-cover bg-center">
            <div class="max-w-screen-lg mx-auto px-4 py-2">
                <h2 class="mt-4 font-primary font-bold text-3xl text-dark text-center uppercase py-6">As Seen On</h2>
                <ul class="mt-8 flex justify-between items-center gap-6">
                    <li>
                        <img src="{{ asset('assets/images/logo/liputan-6.png') }}" alt="UPH LOGO">
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/logo/suara-com.png') }}" alt="UI LOGO">
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/logo/times-indonesia.png') }}" alt="HILO LOGO">
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/logo/cnbc.png') }}" alt="HILO LOGO">
                    </li>
                </ul>

            </div>
        </div>
    </section>
    {{-- End Section: As Seen On --}}

    @if ($video)
        {{-- Start Section: Video --}}
        <section class="pb-12">
            <div class="py-8 bg-as-seen-as-section bg-cover bg-center">
                <div class="max-w-2xl mx-auto md:h-96 h-60 px-4 py-2">
                    {{-- Emmbed --}}
                    <div class="bg-primary-light h-full flex items-center justify-center relative">
                        <svg aria-hidden="true" class="z-10 absolute w-8 h-8 mr-2 text-light animate-spin fill-primary"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>

                        <iframe class="z-20" width="100%" height="100%"
                            src="https://www.youtube.com/embed/{{ $video->video_link }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{-- End Section: Video --}}

    {{-- Start Section: Projects --}}
    <section>
        <div class="py-12 bg-projects-section bg-cover bg-center">
            <div class="max-w-screen-lg mx-auto px-4 py-2">
                <h2 class="mt-4 font-primary font-bold text-3xl text-dark text-center uppercase">PROJECTS</h2>
            </div>
        </div>
        <div class="max-w-screen-lg mx-auto px-4 py-2">

            <div class="py-10">
                <ul class="flex flex-col gap-x-4 gap-y-10 mb-8">
                    @foreach ($projects as $item)
                        <li class="flex flex-col md:flex-row gap-x-16">
                            <div class="w-full">
                                <h4 class="mb-2 font-primary font-bold text-3xl text-primary lg:text-4xl lg:-mb-0">
                                    {{ $item->organization_name }}
                                </h4>
                                <div class="mt-2">
                                    <span class="font-secondary font-bold text-base text-grey lg:text-xl">
                                        {{ $item->roles }}
                                    </span>
                                </div>
                                @if ($item->start_date)
                                    <div class="mt-3">
                                        <span class="font-secondary text-grey text-base lg:text-xl">
                                            {{ date('F Y', strtotime($item->start_date)) }} -
                                            {{ date('F Y', strtotime($item->end_date)) }}
                                        </span>
                                    </div>
                                @endif
                                @if ($item->image)
                                    <div class="w-full mt-4">
                                        <img src="{{ asset('uploaded_files/projects/' . $item->created_at->format('Y') . '/' . $item->created_at->format('m') . '/' . $item->image) }}"
                                            alt="{{ $item->alt }}" class="w-full">
                                    </div>
                                @endif
                            </div>
                            <div class="w-full mt-4 md:mt-0">
                                <div class="mb-4 font-secondary font-medium text-sm text-dark lg:text-base">
                                    {!! $item->description !!}
                                </div>
                                @if ($item->button_title)
                                    <a href="{{ $item->button_link }}" target="_blank"
                                        class="p-2 bg-primary font-secondary font-bold text-sm text-light lg:text-base">
                                        {{ $item->button_title }}
                                    </a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>

                {{ $projects->links('layout.pagination.tailwind') }}
            </div>
        </div>
    </section>
    {{-- End Section: Projects --}}


    {{-- Start Section: Learn More About --}}
    <section class="py-10">
        <div class="max-w-screen-lg mx-auto px-4 py-2">
            <div class="flex flex-col justify-center">

                <h2 class="mb-2 font-primary font-bold text-3xl text-primary text-center lg:text-4xl">
                    LEARN MORE ABOUT ANGEL
                </h2>
                <a href="{{ route('achievements') }}"
                    class="mx-auto px-4 py-2 font-secondary font-semibold text-lg text-light bg-primary uppercase">
                    See Angel's Journey
                </a>
            </div>
        </div>
    </section>
    {{-- End Section: Learn More About --}}
@endsection
