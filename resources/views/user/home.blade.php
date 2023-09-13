@extends('layout.user.app')

@section('main')
    {{-- Start Section: Hero --}}
    <section class="h-screen bg-hero-section bg-cover bg-center">
        <div class="max-w-screen-lg mx-auto px-4 py-2 h-full flex items-center">
            <div class="bg-blue -mt-10">
                <h1 class="font-primary font-bold text-5xl text-primary lg:text-6xl">DANYA <br> TJOKROARDI</h1>
                <span class="font-secondary font-semibold text-lg text-light lg:text-[22px]">
                    Part-Time Student, Full-Time Advocate
                </span>
            </div>
        </div>
    </section>
    {{-- End Section: Hero --}}

    {{-- Start Section: Who Is Danya? --}}
    <section class="py-10">
        <div class="max-w-screen-lg mx-auto px-4 py-2">
            <div class="flex flex-col items-center sm:flex-row">
                <div class="w-full">
                    <img src="{{ asset('assets/images/image_who_is_danya.png') }}" alt="Who Is Danya?"
                        class="w-full object-cover">
                </div>
                <div class="w-full flex flex-col mt-8 sm:ml-6 sm:mt-0 sm:justify-center">
                    <h3 class="font-bold text-4xl text-dark">Who is</h3>
                    <h2 class="mt-2 font-primary font-bold text-6xl text-primary">Danya?</h2>
                    <p class="mt-2 text-lg leading-6 text-dark font-secondary font-medium">
                        As a student activist, Danya is committed to driving positive political and environmental change,
                        serving as the Founder of We The Genesis, an organization that empowers Indonesian youth through
                        social media and journalism. In addition to advocacy, Danya possesses a strong passion for
                        academics, believing that learning should be accompanied by empathy in order to utilize knowledge
                        for the greater good. Danya aspires to leverage education for making a positive impact.
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- End Section: Who Is Danya? --}}

    {{-- Start Section: Create Change Makin Projects --}}
    <section>
        <div class="py-12 bg-change-making-projects-section bg-cover bg-center">
            <div class="max-w-screen-lg mx-auto px-4 py-2">
                <h2 class="mt-4 font-primary font-bold text-3xl text-light text-center">CHANGE-MAKING PROJECTS</h2>
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
    {{-- End Section: Create Change Makin Projects --}}

    {{-- Start Section: Create Honors & Accomplishments --}}
    <section>
        <div class="py-8 bg-honors-accomplishments-section bg-cover bg-center">
            <div class="max-w-screen-lg mx-auto px-4 py-2">
                <h2 class="mt-4 font-primary font-bold text-3xl text-light text-center">HONORS & ACCOMPLISHMENTS</h2>
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
    {{-- End Section: Create Honors & Accomplishments --}}

    {{-- Start Section: Speaking Opportunities --}}
    <section class="py-10">
        <div class="py-12 bg-speaking-opportunities bg-cover bg-center">
            <div class="max-w-screen-lg mx-auto px-4 py-2">
                <h2 class="mt-4 font-primary font-bold text-3xl text-light text-center">SPEAKING OPPORTUNITIES</h2>
            </div>
        </div>

        <div class="max-w-screen-lg mx-auto px-4 py-2">
            <div class="py-10">
                <ul class="flex flex-col gap-x-4 gap-y-12">

                    @foreach ($speaking_opportunities as $item)
                        <li class="flex flex-col">
                            <div class="w-full">
                                <h4 class="-mb-2 font-primary font-bold text-3xl text-primary lg:text-4xl lg:-mb-0">
                                    {{ $item->title }}
                                </h4>
                            </div>
                            <div class="mt-4 w-full grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="max-w-md w-full h-72 mx-auto sm:mx-0">
                                    @if ($item->video_link)
                                        <div class="bg-primary-light h-full flex items-center justify-center relative">
                                            <svg aria-hidden="true"
                                                class="z-10 absolute w-8 h-8 mr-2 text-light animate-spin fill-primary"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>

                                            <iframe class="z-20" width="100%" height="100%"
                                                src="https://www.youtube.com/embed/{{ $item->video_link_id }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>

                                        </div>
                                    @elseif($item->image)
                                        <div class="bg-primary-light h-full flex items-center justify-center relative">
                                            <svg aria-hidden="true"
                                                class="z-10 absolute w-8 h-8 mr-2 text-light animate-spin fill-primary"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>

                                            <img src="{{ asset('uploaded_files/speaking_opportunities/' . $item->created_at->format('Y') . '/' . $item->created_at->format('m') . '/' . $item->image) }}"
                                                alt="{{ $item->alt }}" class="object-cover w-full h-full z-20">

                                        </div>
                                    @else
                                        <div class="bg-primary-light h-full flex items-center justify-center relative">
                                            <svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;"
                                                class="z-10 absolute w-8 h-8 mr-2 text-light  fill-primary" version="1.1"
                                                viewBox="0 0 512 512" width="512px" xml:space="preserve"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g>
                                                    <path
                                                        d="M368,224c26.5,0,48-21.5,48-48c0-26.5-21.5-48-48-48c-26.5,0-48,21.5-48,48C320,202.5,341.5,224,368,224z" />
                                                    <path
                                                        d="M452,64H60c-15.6,0-28,12.7-28,28.3v327.4c0,15.6,12.4,28.3,28,28.3h392c15.6,0,28-12.7,28-28.3V92.3   C480,76.7,467.6,64,452,64z M348.9,261.7c-3-3.5-7.6-6.2-12.8-6.2c-5.1,0-8.7,2.4-12.8,5.7l-18.7,15.8c-3.9,2.8-7,4.7-11.5,4.7   c-4.3,0-8.2-1.6-11-4.1c-1-0.9-2.8-2.6-4.3-4.1L224,215.3c-4-4.6-10-7.5-16.7-7.5c-6.7,0-12.9,3.3-16.8,7.8L64,368.2V107.7   c1-6.8,6.3-11.7,13.1-11.7h357.7c6.9,0,12.5,5.1,12.9,12l0.3,260.4L348.9,261.7z" />
                                                </g>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="w-full flex flex-col justify-between">
                                    @if ($item->event_date)
                                        <div>
                                            <span class="font-secondary text-grey text-base lg:text-xl">
                                                {{ date("F Y", strtotime($item->event_date)) }}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="mb-4 font-secondary font-medium text-sm text-dark lg:text-base md:mb-0">
                                        {!! $item->description !!}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    {{-- End Section: Speaking Opportunities --}}

    {{-- Start Section: Learn More About --}}
    <section class="py-10">
        <div class="max-w-screen-lg mx-auto px-4 py-2">
            <div class="flex flex-col justify-center">

                <h2 class="mb-2 font-primary font-bold text-3xl text-primary text-center lg:text-4xl">
                    LEARN MORE ABOUT DANYA
                </h2>
                <a href="{{ route('achievements') }}" class="mx-auto px-4 py-2 font-secondary font-semibold text-lg text-light bg-primary">
                    See Danya's Journey
                </a>
            </div>
        </div>
    </section>
    {{-- End Section: Learn More About --}}
@endsection
