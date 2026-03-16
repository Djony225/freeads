<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces — Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900">

    <!-- Navbar Fixée & Floue -->
    <nav class="fixed w-full z-50 top-0 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <span class="font-bold text-xl tracking-tight">FlashAds</span>
            </a>

            
            <!-- <div class="hidden md:block flex-1 max-w-md mx-8">
                <div class="relative">
                    <input type="text" placeholder="Rechercher un objet..." class="w-full bg-slate-100 border-none rounded-full py-2 px-10 focus:ring-2 focus:ring-indigo-500 transition-all text-sm">
                    <svg class="w-4 h-4 text-slate-400 absolute left-4 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2"/></svg>
                </div>
            </div> -->

            <div class="flex items-center gap-4">
                <a href="{{ route('ads.create') }}" class="hidden sm:flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-md shadow-indigo-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round"/></svg>
                    Publier
                </a>

                <a href="{{ route('home') }}" class="hidden sm:flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-md shadow-indigo-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round"/></svg>
                    La page public
                </a>

                {{-- Icône profil --}}
                <a href="{{ route('profile.edit') }}" class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-purple-600 rounded-full flex items-center justify-center shadow-lg hover:opacity-80 transition" title="Mon profil">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>

            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 pt-28 pb-12">

        <!-- Header de section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Toutes les annonces</h1>
                <p class="text-slate-500 mt-1">Découvrez les pépites de la communauté</p>
            </div>

            
            <!-- <div class="flex gap-2 overflow-x-auto pb-2">
                <button class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium whitespace-nowrap">Tout voir</button>
                <button class="px-4 py-2 hover:bg-white text-slate-600 rounded-full text-sm font-medium whitespace-nowrap transition-colors border border-transparent hover:border-slate-200">Électronique</button>
                <button class="px-4 py-2 hover:bg-white text-slate-600 rounded-full text-sm font-medium whitespace-nowrap transition-colors border border-transparent hover:border-slate-200">Véhicules</button>
            </div> -->
        </div>

        <!-- Grille d'annonces -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($ads as $ad)
                <article class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 overflow-hidden">
                    <!-- Image -->
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('storage/' . $ad->photo) }}"
                             alt="{{ $ad->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-3 right-3">
                            <button class="p-2 bg-white/80 backdrop-blur rounded-full text-slate-400 hover:text-red-500 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-width="2" stroke-linecap="round"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-2">
                            <h2 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors truncate pr-2">
                                {{ $ad->title }}
                            </h2>
                            <span class="text-lg font-black text-slate-900">{{ number_format($ad->price, 0, ',', ' ') }}€</span>
                        </div>

                        <div class="flex items-center text-sm text-slate-500 gap-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-width="2"/></svg>
                                {{ $ad->location }}
                            </span>
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            <span>{{ $ad->category->name }}</span>
                        </div>

                        <div class="mt-5 flex gap-2">
                            <a href="{{ route('ads.show', $ad->id) }}" class="flex-1 text-center py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-indigo-600 transition-colors">
                                Voir détails
                            </a>
                            <a href="{{ route('ads.edit', $ad->id) }}" class="p-2.5 border border-slate-200 text-slate-400 hover:text-slate-600 hover:border-slate-400 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2" stroke-linecap="round"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </main>

</body>
</html>
