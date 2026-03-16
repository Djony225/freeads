<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <p class="text-lg mb-6">{{ __("You're logged in!") }} 🎉</p>

                    <div class="flex justify-center gap-4">
                        <a href="{{ route('home') }}"
                           class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            🏠 Voir les annonces
                        </a>
                        <a href="{{ route('ads.index') }}"
                           class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                            📋 Mes annonces
                        </a>
                        <a href="{{ route('ads.create') }}"
                           class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                            ➕ Publier une annonce
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
