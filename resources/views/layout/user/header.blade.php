 {{-- Navigation Bar --}}
 <header>
     <nav class="bg-primary">
         <div class="max-w-screen-lg mx-auto px-4 py-2 flex justify-between items-center">
             <a href="{{ route('home') }}">
                 <svg width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M8.33334 43.75V18.75L25 6.25L41.6667 18.75V43.75H29.1667V29.1667H20.8333V43.75H8.33334Z"
                         fill="white" />
                 </svg>
             </a>
             <a href="{{ route('achievements') }}" class="mt-1">
                 <span class="font-primary font-bold text-xl text-light leading-tight">Achievements</span>
             </a>
         </div>
     </nav>
 </header>
 {{-- Navigation Bar End  --}}
