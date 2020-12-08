<header class="flex justify-between items-center py-5 text-gray-700">
    <div>
        <a href="{{ route('jobs.index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-48">
        </a>        
    </div>

    <nav>
        <livewire:search />

        <a href="{{ route('jobs.index') }}" class="mr-5 {{ request()->routeIs('jobs.*') ? 'text-green-500 font-semibold' : '' }} hover:text-green-500">
            Nos missions
        </a>

        @guest
            <a href="{{ route('login') }}" class="mr-5 {{ request()->routeIs('login') ? 'text-green-500 font-semibold' : '' }} hover:text-green-500">
                Se connecter
            </a>

            <a href="{{ route('register') }}" class="mr-5 {{ request()->routeIs('register') ? 'text-green-500 font-semibold' : '' }} hover:text-green-500">
                S'enregistrer
            </a>
        @else
            <a href="{{ route('conversation.index') }}" class="mr-5 {{ request()->routeIs('conversation.*') ? 'text-green-500 font-semibold' : '' }} hover:text-green-500">
                Mes conversations
            </a>

            {{-- DROPDOWN MENU --}}
            <div class="inline-block relative" x-data="{ open:false }">
                <button :class="{'text-green-500': open}" class="hover:text-green-500 {{ request()->routeIs('home') ? 'text-green-500 font-semibold' : '' }}"
                    @click="{open = !open}"
                    @click.away="{open = false}">
                
                    <span class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
        
                        <span class="absolute top-0 right-0 mr-2 inline-flex items-center justify-center w-4 h-4  text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 rounded-full {{ (auth()->user()->unreadNotifications()->count() > 0) ? 'bg-red-600' : 'bg-gray-600'}} ">
                            {{ auth()->user()->unreadNotifications()->count() }} 
                        </span>
                    </span> 
                    <span class="ml-1">{{ auth()->user()->name }}</span>
                    <span class="text-xs" x-html="open ? '<i class=&quot;fas fa-chevron-up pl-1&quot;></i>' : '<i class=&quot;fas fa-chevron-down pl-1&quot;></i>'"></span>
                </button>

                {{-- Box menu --}}
                <div class="absolute z-50 bg-gray-100 rounded w-56 mt-1 px-3 py-3 shadow-xl" x-show="open" x-cloak>
                    <ul>
                        <li>                            
                            <a href="{{ route('home') }}" class="hover:text-green-500 flex items-center transition ease-in-out duration-150">
                                Tableau de bord  
                                @if (auth()->user()->unreadNotifications()->count() > 0)
                                    <span class="ml-2 inline-block w-2 h-2 bg-red-600 rounded-full"></span>                                    
                                @endif
                            </a>
                        </li>

                        <li>
                            <a href="#" class="hover:text-green-500 flex items-center transition ease-in-out duration-150">
                                Mon profil
                            </a>
                        </li>
    
                        <li>
                            <a href="{{ route('logout') }}" class="hover:text-green-500 flex items-center transition ease-in-out duration-150" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Se déconnecter
                            </a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                                @csrf
                            </form>
                        </li>
                    </ul>                    
                </div>
            </div>
        @endguest
    </nav>
</header>