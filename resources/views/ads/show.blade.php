<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ad->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Barre de navigation haute -->
        <nav class="mb-8">
            <a href="{{ route('ads.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Retour aux annonces
            </a>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <!-- Colonne Gauche : Image -->
            <div class="lg:col-span-7">
                <div class="overflow-hidden rounded-3xl bg-white shadow-xl shadow-gray-200/50 group">
                    <img src="{{ asset('storage/' . $ad->photo) }}"
                         alt="{{ $ad->title }}"
                         class="w-full h-[500px] object-cover hover:scale-105 transition-transform duration-500">
                </div>
            </div>

            <!-- Colonne Droite : Infos & Actions -->
            <div class="lg:col-span-5 flex flex-col justify-between">
                <div>
                    <!-- Badge Catégorie -->
                    <span class="inline-block px-3 py-1 text-xs font-bold tracking-wider uppercase bg-blue-100 text-blue-700 rounded-full mb-4">
                        {{ $ad->category->name }}
                    </span>

                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2 leading-tight">
                        {{ $ad->title }}
                    </h1>

                    <div class="flex items-center text-gray-500 mb-6">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm">{{ $ad->location }}</span>
                    </div>

                    <p class="text-4xl font-black text-blue-600 mb-8">
                        {{ number_format($ad->price, 0, ',', ' ') }} €
                    </p>

                    <div class="border-t border-gray-100 pt-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-3">Description</h2>
                        <p class="text-gray-600 leading-relaxed italic">
                            "{{ $ad->description }}"
                        </p>
                    </div>
                </div>

                <!-- Bouton Contact / Action -->
                <div class="mt-10 space-y-3">
                    <button class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98]">
                        Contacter le vendeur
                    </button>
                    <button class="w-full py-4 bg-white border-2 border-gray-100 hover:border-blue-600 hover:text-blue-600 text-gray-600 font-bold rounded-2xl transition-all">
                        Ajouter aux favoris
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
