@extends('layout.user.app')

@section('main')
    {{-- Start Section: Achievements--}}
    <section>
        <div class="py-12 bg-achievements-section bg-cover bg-center">
            <div class="max-w-screen-lg mx-auto px-4 py-2">
                <h2 class="mt-4 font-primary font-bold text-3xl text-dark text-center uppercase">AWARDS AND ACHIEVEMENTS</h2>
            </div>
        </div>
        <div class="max-w-screen-lg mx-auto px-4 py-2">
            <div class="py-10">
                <ul class="flex flex-col gap-x-4 gap-y-14 mb-6">
                    @foreach ($award_achievements as $item)
                        <li class="flex flex-col md:gap-8 md:flex-row">
                            <div class="w-full">
                                <h4 class="font-primary font-bold text-3xl text-primary lg:text-4xl lg:-mb-0">
                                    {{ $item->competition_name }}
                                </h4>
                                <div class="mt-2">
                                    <span class="font-secondary font-bold text-base lg:text-xl">
                                        {{ $item->award_name }}
                                    </span>
                                </div>
                                @if ($item->competition_date)
                                    <div class="mt-4">
                                        <span class="font-secondary text-grey text-base lg:text-xl">
                                            {{ date("d F Y", strtotime($item->competition_date)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full mt-4 md:mt-0">
                                <img src="{{ asset('uploaded_files/award_achievement/' . $item->created_at->format('Y') . '/' . $item->created_at->format('m') . '/' . $item->image) }}"
                                    alt="{{ $item->alt }}" class="w-full">
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{ $award_achievements->links('layout.pagination.tailwind') }}
            </div>
        </div>
    </section>
    {{-- End Section: Achievements--}}

    {{-- Start Section: Other Activities --}}
    <section>
        <div class="py-12 bg-achievements-section bg-cover bg-center">
            <div class="max-w-screen-lg mx-auto px-4 py-2">
                <h2 class="mt-4 font-primary font-bold text-3xl text-dark text-center uppercase">Other Activities</h2>
            </div>
        </div>
        <div class="max-w-screen-lg mx-auto px-4 py-2">
            <div class="py-10">
                <ul class="flex flex-col gap-x-4 gap-y-14 mb-6">
                    @foreach ($award_achievements as $item)
                        <li class="flex flex-col md:gap-8 md:flex-row">
                            <div class="w-full">
                                <h4 class="font-primary font-bold text-3xl text-primary lg:text-4xl lg:-mb-0">
                                    {{ $item->competition_name }}
                                </h4>
                                <div class="mt-2">
                                    <span class="font-secondary font-bold text-base lg:text-xl">
                                        {{ $item->award_name }}
                                    </span>
                                </div>
                                @if ($item->competition_date)
                                    <div class="mt-4">
                                        <span class="font-secondary text-grey text-base lg:text-xl">
                                            {{ date("d F Y", strtotime($item->competition_date)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full mt-4 md:mt-0">
                                <img src="{{ asset('uploaded_files/award_achievement/' . $item->created_at->format('Y') . '/' . $item->created_at->format('m') . '/' . $item->image) }}"
                                    alt="{{ $item->alt }}" class="w-full">
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{ $award_achievements->links('layout.pagination.tailwind') }}
            </div>
        </div>
    </section>
    {{-- End Section: Other Activities --}}
@endsection
