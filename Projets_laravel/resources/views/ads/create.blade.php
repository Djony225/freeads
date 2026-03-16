<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle annonce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl">
        <!-- Retour -->
        <a href="{{ route('ads.index') }}" class="inline-flex items-center text-slate-500 hover:text-indigo-600 mb-6 transition-colors font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Retour au tableau de bord
        </a>

        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <header class="mb-10 text-center">
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Faire une annonce</h1>
                    <p class="text-slate-500 mt-2">Remplissez les détails pour informer les utilisateurs</p>
                </header>

                <!-- Gestion des Erreurs (Style Alert) -->
                @if($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            <ul class="text-sm text-red-700 font-medium">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Titre -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Titre de l'annonce</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder:text-slate-400"
                            placeholder="Ex: Vélo de course carbone">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Catégorie -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Catégorie</label>
                            <select name="category_id" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                                <option value="">-- Choisir --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Prix -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Prix (€)</label>
                            <input type="number" name="price" value="{{ old('price') }}"
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none"
                                placeholder="0.00">
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none resize-none"
                            placeholder="Décrivez votre objet en quelques lignes...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Lieu -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Localisation</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none"
                            placeholder="Ville ou Code Postal">
                    </div>

                    <!-- Upload Photo -->
                    <div class="p-6 border-2 border-dashed border-slate-200 rounded-3xl hover:bg-slate-50 transition-colors">
                        <label class="block text-center cursor-pointer">
                            <svg class="mx-auto h-10 w-10 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">Ajouter une photo</span>
                            <p class="text-xs text-slate-400 mt-1">Cliquez ou glissez une image ici</p>
                            <input type="file" name="photo" class="hidden">
                        </label>
                    </div>

                    <!-- Bouton Publier -->
                    <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold rounded-2xl shadow-lg shadow-indigo-200 transition-all transform active:scale-[0.98]">
                        Mettre en ligne mon annonce
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
