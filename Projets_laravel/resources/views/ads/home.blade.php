<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Freeads — Trouvez la perle rare</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen text-slate-900 font-sans">

<nav class="bg-white/70 backdrop-blur-xl sticky top-0 z-50 border-b border-white/20 shadow-sm">
  <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
        <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <span class="text-2xl font-black tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">Freeads</span>
    </a>
    
    <div class="flex items-center gap-6">
       @auth
            <a href="{{ route('ads.index') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Mes annonces</a>
            <a href="{{ route('ads.create') }}" class="px-6 py-2.5 bg-slate-900 text-white rounded-full text-sm font-bold hover:bg-blue-600 shadow-lg transition-all">
                + Publier
            </a>

            {{-- Icône profil --}}
            <a href="{{ route('profile.edit') }}" class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-purple-600 rounded-full flex items-center justify-center shadow-lg hover:opacity-80 transition" title="Mon profil">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-bold text-slate-400 hover:text-red-500 transition">
                    Déconnexion
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600">Connexion</a>
            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-white text-slate-900 border border-slate-200 rounded-full text-sm font-bold hover:bg-slate-50 transition">S'inscrire</a>
        @endauth
    </div>
  </div>
</nav>

<main class="max-w-7xl mx-auto px-6 py-12">
    
    <div class="max-w-3xl mx-auto mb-16 text-center">
        <h1 class="text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Trouvez tout ce dont vous avez besoin.</h1>
        <form action="{{ route('home') }}" method="GET" class="relative group">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Un vélo, une voiture, un canapé..." 
                class="w-full pl-14 pr-32 py-5 bg-white/80 backdrop-blur-2xl border border-white rounded-3xl shadow-2xl shadow-blue-100/50 focus:ring-4 focus:ring-blue-100 focus:outline-none text-lg transition-all"
            >
            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <button type="submit" class="absolute right-3 top-3 bottom-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 rounded-2xl font-bold hover:opacity-90 transition shadow-lg">
                Chercher
            </button>
        </form>
    </div>

    <div class="flex flex-col lg:flex-row gap-12">
        
        <aside class="w-full lg:w-72 shrink-0">
            <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[2rem] border border-white shadow-xl shadow-blue-50/50 sticky top-32">
                <h2 class="text-xl font-bold mb-8 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    Filtres
                </h2>
                
                <form action="{{ route('home') }}" method="GET" class="space-y-8">
                    <input type="hidden" name="search" value="{{ request('search') }}">

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3">Catégorie</label>
                        <select name="category" class="w-full bg-white border border-slate-100 rounded-2xl px-4 py-3.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                            <option value="">Toutes</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3">Où ?</label>
                        <input type="text" name="location" value="{{ request('location') }}" placeholder="Ville..." 
                               class="w-full bg-white border border-slate-100 rounded-2xl px-4 py-3.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3">Prix Max</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Ex: 500€" 
                               class="w-full bg-white border border-slate-100 rounded-2xl px-4 py-3.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                    </div>

                    <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-blue-600 transition-all shadow-xl shadow-slate-200">
                        Appliquer
                    </button>
                    
                    <a href="{{ route('home') }}" class="block text-center text-xs font-bold text-slate-400 hover:text-blue-600 transition">
                        Réinitialiser tout
                    </a>
                </form>
            </div>
        </aside>

        <div class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($ads as $ad)
                    <div class="group bg-white rounded-[2rem] border border-white shadow-lg shadow-slate-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-100/50 transition-all duration-500">
                        <a href="{{ route('ads.voir', $ad->id) }}" class="block relative aspect-square overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                 src="{{ asset('storage/' . $ad->photo) }}"
                                 alt="{{ $ad->title }}">
                            <div class="absolute top-4 left-4 bg-white/80 backdrop-blur px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider text-blue-600 shadow-sm">
                                {{ $ad->category->name }}
                            </div>
                        </a>

                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h2 class="text-xl font-bold text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">{{ $ad->title }}</h2>
                            </div>
                            
                            <p class="text-slate-400 text-sm flex items-center mb-6">
                                <svg class="w-4 h-4 mr-1.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                {{ $ad->location }}
                            </p>

                            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                <span class="text-2xl font-black text-slate-900">{{ number_format($ad->price, 0) }}€</span>
                                <a href="{{ route('ads.voir', $ad->id) }}" class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-900 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-32 text-center bg-white/40 backdrop-blur-md rounded-[3rem] border-2 border-dashed border-white">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Aucun résultat</h3>
                        <p class="text-slate-500 mt-2">Essayez de modifier vos filtres ou votre recherche.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16">
                {{ $ads->links() }}
            </div>
        </div>
    </div>
</main>

<footer class="mt-32 pb-12 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
    &copy; 2026 Freeads — Créé par ton groupe de choc
</footer>

</body>
</html>