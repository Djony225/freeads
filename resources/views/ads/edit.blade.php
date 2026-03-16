<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'annonce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-xl animate-in fade-in zoom-in duration-500">
        <!-- Card Container -->
        <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">

            <!-- Header avec dégradé subtil -->
            <div class="relative px-8 py-10 bg-gradient-to-br from-white to-slate-50 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 tracking-tight">
                            Modifier l'annonce
                        </h3>
                        <p class="text-slate-500 text-sm mt-1">Mettez à jour les détails de votre article</p>
                    </div>

                    <a href="{{ route('ads.index') }}" class="group flex items-center justify-center w-10 h-10 rounded-full bg-slate-100 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all duration-300" title="Retour">
                        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Formulaire -->
            <form method="POST" action="{{ route('ads.update', $ad->id) }}" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Titre (Full width) -->
                    <div class="md:col-span-2 group">
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">Titre de l'objet</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $ad->title) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all outline-none placeholder:text-slate-400"
                            placeholder="Ex: iPhone 15 Pro Max..." required>
                    </div>

                    <!-- Prix -->
                    <div>
                        <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">Prix souhaité</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">€</span>
                            <input type="number" name="price" id="price" value="{{ old('price', $ad->price) }}"
                                class="w-full pl-8 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all outline-none"
                                placeholder="0.00" required>
                        </div>
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">Catégorie</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all outline-none appearance-none">
                            <option value="">Sélectionner...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $ad->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description (Full width) -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description détaillée</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all outline-none resize-none"
                            placeholder="Décrivez l'état, les options...">{{ old('description', $ad->description) }}</textarea>
                    </div>

                    <!-- Localisation -->
                    <div class="md:col-span-2">
                        <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">Ville ou Code Postal</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <input type="text" name="location" id="location" value="{{ old('location', $ad->location) }}"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all outline-none"
                                placeholder="Paris, 75001..." required>
                        </div>
                    </div>

                    <!-- Photo Upload Style "Dropzone" -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Photo de l'annonce</label>
                        <div class="relative group cursor-pointer border-2 border-dashed border-slate-200 hover:border-blue-400 hover:bg-blue-50/30 rounded-2xl p-6 transition-all">
                            <input type="file" name="photo" id="photo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-300 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                <p class="mt-2 text-sm text-slate-600">Cliquez pour remplacer l'image ou glissez-déposez</p>
                                <p class="text-xs text-slate-400 mt-1">PNG, JPG jusqu'à 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-col sm:flex-row-reverse gap-3 pt-6 border-t border-slate-100">
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:shadow-blue-300 active:scale-95 transition-all">
                        Enregistrer les modifications
                    </button>

                    <a href="{{ route('ads.index') }}" class="w-full sm:w-auto px-8 py-3.5 bg-white border border-slate-200 text-slate-600 font-semibold rounded-xl hover:bg-slate-50 transition-all text-center">
                        Annuler
                    </a>

                    <!-- Bouton Supprimer (Optionnel mais recommandé pour une édition) -->
                    <button type="button" class="sm:mr-auto p-3 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all" title="Supprimer l'annonce">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
