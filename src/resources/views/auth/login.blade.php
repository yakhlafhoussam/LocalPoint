@extends('layout.main')

@section('title', 'Login | LocalMind')

<div class="min-h-screen flex items-center justify-center p-4 md:p-8">
    <div class="w-full max-w-6xl flex flex-col lg:flex-row rounded-2xl overflow-hidden shadow-custom-lg bg-white">
        <!-- Section gauche - Présentation -->
        <div class="lg:w-1/2 gradient-bg text-white p-8 md:p-12 flex flex-col justify-between">
            <div>
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3">
                        <i class="fas fa-comments text-primary text-xl"></i>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold">LocalMind</h1>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-6">Connectez-vous à votre communauté locale</h2>
                <p class="text-lg mb-8 opacity-90">
                    Rejoignez une plateforme communautaire où vous pouvez poser des questions et recevoir des réponses
                    de personnes proches de chez vous.
                </p>

                <div class="space-y-6 mb-10">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-4">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Questions localisées</h3>
                            <p class="opacity-90">Obtenez des réponses pertinentes de votre voisinage</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Communauté active</h3>
                            <p class="opacity-90">Entraide et partage d'informations locales</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-4">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Sécurité garantie</h3>
                            <p class="opacity-90">Vos données personnelles sont protégées</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section droite - Formulaire de connexion -->
        <div class="lg:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <div class="mb-8 text-center lg:text-left">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Connexion</h2>
                <p class="text-gray-600">Connectez-vous à votre compte LocalMind</p>
            </div>

            <!-- Messages d'erreur/succès -->
            @error('email')
                <div id="error-message" class=" bg-red-50 border-l-4 border-danger text-danger p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm" id="error-text">{{ $message }}</p>
                        </div>
                    </div>
                </div>
            @enderror

            <div id="success-message"
                class="hidden bg-green-50 border-l-4 border-success text-success p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm" id="success-text"></p>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <form id="login-form" class="space-y-6" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-200"
                            placeholder="votre@email.com">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <a href="#" class="text-sm font-medium text-primary hover:text-secondary transition">Mot
                            de passe oublié ?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-200"
                            placeholder="Votre mot de passe">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" id="toggle-password"
                                class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-eye" id="password-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Se souvenir de moi</label>
                </div>

                <button type="submit" id="submit-btn"
                    class="btn-primary w-full py-3 px-4 text-white font-bold rounded-xl shadow-md transition duration-300">
                    <span id="btn-text">Se connecter</span>
                    <i id="btn-spinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                </button>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Ou continuer avec</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button type="button"
                        class="py-3 px-4 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition duration-200 flex items-center justify-center">
                        <i class="fab fa-google text-red-500 mr-2"></i>
                        <span>Google</span>
                    </button>
                    <button type="button"
                        class="py-3 px-4 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition duration-200 flex items-center justify-center">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i>
                        <span>Facebook</span>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    Vous n'avez pas de compte ?
                    <a href="/signup" class="font-medium text-primary hover:text-secondary transition ml-1">S'inscrire
                        maintenant</a>
                </p>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-500">
                    En vous connectant, vous acceptez nos
                    <a href="#" class="text-primary hover:underline">Conditions d'utilisation</a>
                    et notre
                    <a href="#" class="text-primary hover:underline">Politique de confidentialité</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonctionnalité pour afficher/masquer le mot de passe
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('password-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });
</script>
