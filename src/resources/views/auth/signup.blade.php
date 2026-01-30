@extends('layout.main')

@section('title', 'Signup | LocalMind')
<div class="w-full h-full flex flex-col justify-center">
<div class="w-full max-w-6xl h-[80vh] flex flex-col lg:flex-row rounded-2xl overflow-hidden shadow-2xl bg-white">
    <!-- Section gauche - Illustration -->
    <div class="lg:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 text-white p-8 flex flex-col justify-between">
        <div>
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center mr-3">
                    <i class="fas fa-comments text-white"></i>
                </div>
                <h1 class="text-xl font-bold">LocalMind</h1>
            </div>

            <h2 class="text-2xl font-bold mb-4">Rejoignez notre communauté</h2>
            <p class="text-sm mb-6 text-blue-100">
                Inscrivez-vous pour poser des questions et découvrir votre voisinage.
            </p>

            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mr-3 mt-0.5">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm">Questions localisées</h3>
                        <p class="text-blue-100 text-xs">Réponses de personnes près de chez vous</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mr-3 mt-0.5">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm">Communauté bienveillante</h3>
                        <p class="text-blue-100 text-xs">Entraide et échanges respectueux</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 p-3 bg-white/10 rounded-lg">
            <p class="italic text-xs text-center text-blue-100">
                "Grâce à LocalMind, j'ai découvert des commerces que je ne connaissais pas !"
            </p>
        </div>
    </div>

    <!-- Section droite - Formulaire -->
    <div class="lg:w-1/2 p-8 overflow-y-auto">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Créer un compte</h2>
            <p class="text-gray-600 text-sm mt-1">Rejoignez LocalMind en quelques secondes</p>
        </div>

        <!-- Messages -->
        <div id="error-message"
            class="hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded text-sm">
            <div class="flex">
                <i class="fas fa-exclamation-circle mt-0.5 mr-2"></i>
                <p id="error-text"></p>
            </div>
        </div>

        <!-- Formulaire -->
        <form id="register-form" class="space-y-4" method="POST">
            @csrf
            <!-- Nom et Prénom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Prénom</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" id="first_name"
                            class="pl-9 w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Votre prénom" name="first">
                    </div>
                    @error('first')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Nom</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" id="last_name"
                            class="pl-9 w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Votre nom" name="last">
                    </div>
                    @error('last')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Adresse email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400 text-sm"></i>
                    </div>
                    <input type="email" id="email"
                        class="pl-9 w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                        placeholder="votre@email.com" name="email">
                </div>
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Mot de passe</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400 text-sm"></i>
                    </div>
                    <input type="password" id="password"
                        class="pl-9 w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Créez un mot de passe" name="password">
                    <button type="button" id="toggle-password"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="fas fa-eye text-gray-400 text-sm hover:text-gray-600"></i>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400 text-sm"></i>
                    </div>
                    <input type="password" id="confirm_password"
                        class="pl-9 w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Confirmez votre mot de passe" name="password_confirmation">
                </div>
                @error('password_confirmation')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Ville -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Ville</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-map-marker-alt text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" id="city"
                        class="pl-9 w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Votre ville" name="city">
                </div>
                @error('city')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Conditions -->
            <div class="flex items-start">
                <input type="checkbox" id="terms"
                    class="h-3 w-3 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-0.5">
                <label for="terms" class="ml-2 block text-xs text-gray-700">
                    J'accepte les
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Conditions</a>
                    et la
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Politique de
                        confidentialité</a>
                </label>
            </div>

            <!-- Bouton d'inscription -->
            <button type="submit" id="submit-btn"
                class="w-full py-2.5 px-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-lg hover:from-blue-600 hover:to-indigo-700 transition duration-300 shadow hover:shadow-md text-sm mt-2">
                <span id="btn-text">Créer mon compte</span>
                <i id="btn-spinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
            </button>

            <!-- Connexion -->
            <div class="text-center pt-3">
                <p class="text-gray-600 text-xs">
                    Vous avez déjà un compte ?
                    <a href="/login" class="text-blue-600 hover:text-blue-800 font-medium ml-1">Se connecter</a>
                </p>
            </div>
        </form>
    </div>
</div>    
</div>

<script>
    // Toggle mot de passe
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
