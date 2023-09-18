@extends('layout.user.app')

@section('main')
    {{-- Start Section: Hero --}}
    <section class="h-screen bg-hero-section bg-red-100 bg-cover bg-center">
        <div class="max-w-screen-lg mx-auto px-4 py-2 h-full flex items-center">
            <div class="bg-blue -mt-10">
                <h1 class="font-primary font-bold text-5xl text-primary lg:text-6xl">CLAUDIA<br> ANGELICA</h1>
                <span class="font-secondary font-semibold text-lg text-dark lg:text-[22px]">
                    CEO - FOUNDER - MENTOR - SOCIAL
                    <br>
                    ENTREPRENEUR
                </span>
            </div>
        </div>
    </section>
    {{-- End Section: Hero --}}

    {{-- Start Section: Who Is Angle? --}}
    <section class="py-10">
        <div class="max-w-screen-lg mx-auto px-4 py-2">
            <div class="grid grid-cols-2 items-stretch gap-4 sm:flex-row">
                <div class="w-full col-span-2 sm:col-span-1">
                    <img src="{{ asset('assets/images/image_who_is_angel.png') }}" alt="Who Is Angel?"
                        class="w-full h-full object-contain">
                </div>
                <div class="w-full flex flex-col mt-8 sm:mt-0 sm:justify-center col-span-2 sm:col-span-1">
                    <h3 class="font-bold text-4xl text-dark">Who is</h3>
                    <h2 class="mt-2 font-primary font-bold text-6xl text-primary">Angle?</h2>
                    <p class="mt-2 text-lg leading-6 text-dark font-secondary font-medium text-justify">
                        A young social entrepreneur and author who loves to learn, innovate, collaborate and educate. I hope that my work brings positive and sustainable impact to communities around me and inspire others to do likewise. My journey officially began as the founder, CEO and CTO of Knocknock.co and Knocknock.Beauty, e-commerce ventures that markets a variety of products sourced from Europe and Singapore through various online and social media channels. Then, seeing my grandmother’s declining mental state during the pandemic and the lack of accessibility to therapy moved me to start and become CEO of Muzartt, a mobile application that provides virtual art and music therapy to older adults who suffer from dementia and other mental issues. My entrepreneurship journey inspired me to then start Aku Bisa, a service initiative dedicated to educating and mentoring underprivileged individuals in the field of digital entrepreneurship with an aim to build a community of sustainable and modern entrepreneurs. Through Aku Bisa, I want to empower and mentor many young entrepreneurs like myself, to become changemakers in their own communities.
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
                <ul class="mt-8 flex justify-between gap-6">
                    <li>
                        <img src="{{ asset('assets/images/logo/UPH_logo.svg') }}" alt="UPH LOGO">
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/logo/UI_logo.svg') }}" alt="UI LOGO">
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/logo/HILO_logo.svg') }}" alt="HILO LOGO">
                    </li>
                </ul>

            </div>
        </div>
    </section>
    {{-- End Section: As Seen On --}}

    {{-- Start Section: Projects --}}
    <section>
        <div class="py-12 bg-projects-section bg-cover bg-center">
            <div class="max-w-screen-lg mx-auto px-4 py-2">
                <h2 class="mt-4 font-primary font-bold text-3xl text-dark text-center uppercase">PROJECTS</h2>
            </div>
        </div>
        <div class="max-w-screen-lg mx-auto px-4 py-2">

            <div class="py-10">
                <ul class="flex flex-col gap-x-4 gap-y-10">
                    @foreach ($change_making_projects as $item)
                        <li class="flex flex-col md:flex-row gap-x-4">
                            <div class="w-full">
                                <h4 class="mb-2 font-primary font-bold text-3xl text-primary lg:text-4xl lg:-mb-0">
                                    {{ $item->organization_name }}
                                </h4>
                                <div class="mt-2">
                                    <span class="font-secondary font-bold text-base text-grey lg:text-xl">
                                        {{ $item->roles }}
                                    </span>
                                </div>
                                @if ($item->end_date)
                                    <div class="mt-3">
                                        <span class="font-secondary text-grey text-base lg:text-xl">
                                            {{ date("F Y", strtotime($item->end_date)) }}
                                        </span>
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
                <a href="{{ route('achievements') }}" class="mx-auto px-4 py-2 font-secondary font-semibold text-lg text-light bg-primary uppercase">
                    See Angel's Journey
                </a>
            </div>
        </div>
    </section>
    {{-- End Section: Learn More About --}}
@endsection
