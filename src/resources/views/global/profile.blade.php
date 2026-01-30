@extends('layout.main')

@section('title', 'Profile | LocalMind')

@include('templates.header')

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column - Profile Card -->
        <div class="lg:w-1/3">
            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <div class="flex flex-col items-center">
                    <!-- Profile Image -->
                    <div
                        class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-900 to-blue-600 flex items-center justify-center text-white text-4xl font-bold mb-4">
                        {{ ucfirst(substr($user->name, 0, 1)) }}
                    </div>

                    <!-- User Info -->
                    <h1 class="text-2xl font-bold text-gray-800 mb-1">{{ $user->name }}</h1>
                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $user->city }}</span>
                    </div>

                    <!-- Role Badge -->
                    <div class="mb-6">
                        @if ($user->role == 'admin')
                            <span class="px-4 py-2 bg-red-100 text-red-800 font-medium rounded-full">
                                <i class="fas fa-crown mr-2"></i>Admin
                            </span>
                        @else
                            <span class="px-4 py-2 bg-blue-100 text-blue-800 font-medium rounded-full">
                                <i class="fas fa-user mr-2"></i>User
                            </span>
                        @endif
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 w-full mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ count($user->questions) }}</div>
                            <div class="text-sm text-gray-600">Questions</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ count($user->answers) }}</div>
                            <div class="text-sm text-gray-600">Answers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">{{ count($user->favorites) }}</div>
                            <div class="text-sm text-gray-600">Favorites</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="w-full space-y-3">
                        <button
                            class="w-full py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-indigo-700 transition">
                            <i class="fas fa-edit mr-2"></i>Edit Profile
                        </button>
                        <button
                            class="w-full py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition">
                            <i class="fas fa-cog mr-2"></i>Settings
                        </button>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Contact Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Email</div>
                            <div class="font-medium text-gray-800">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Member Since</div>
                            <div class="font-medium text-gray-800">{{ $user->created_at }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3">
                            <i class="fas fa-check-circle text-purple-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Account Status</div>
                            <div class="font-medium text-gray-800">Verified</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center mr-3">
                            <i class="fas fa-globe text-orange-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Location</div>
                            <div class="font-medium text-gray-800">{{ $user->city }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Profile Content -->
        <div class="lg:w-2/3">
            <!-- Tabs -->
            <div class="bg-white rounded-2xl shadow-lg mb-6 overflow-hidden">
                <div class="border-b border-gray-200">
                    <nav class="flex">
                        <h1 class="px-6 py-4 font-medium text-gray-600">
                            <i class="fas fa-star mr-2"></i>Favorites
                        </h1>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Recent Questions -->
                    <div class="space-y-4">
                        <div class="space-y-6">
                            @foreach ($questions as $question)
                                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition duration-300">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span
                                                    class="text-blue-600 font-medium">{{ ucfirst(substr($question->user->name, 0, 1)) }}</span>
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800">{{ $question->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $question->created_at }}</div>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $question->city }}
                                        </div>
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $question->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $question->content }}</p>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-6">
                                            <a href="/showanswers?id={{ $question->id }}" class="text-gray-500">
                                                <i class="fas fa-comment mr-1"></i> {{ $question->answers_count }}
                                            </a>
                                            @if ($question->is_liked)
                                                <form class="m-0" method="POST" action="/unlike">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $question->id }}">
                                                    <button type="submit" class="text-red-500">
                                                        <i class="fas fa-heart mr-1"></i> {{ $question->likes_count }}
                                                    </button>
                                                </form>
                                            @else
                                                <form class="m-0" method="POST" action="/like">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $question->id }}">
                                                    <button type="submit" class="text-gray-500">
                                                        <i class="fas fa-heart mr-1"></i> {{ $question->likes_count }}
                                                    </button>
                                                </form>
                                            @endif
                                            <form class="m-0" method="POST" action="/unsave">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $question->id }}">
                                                <button class="text-yellow-500">
                                                    <i class="fas fa-bookmark"></i>
                                                </button>
                                            </form>
                                        </div>
                                        @if ($question->user->id == $user->id)
                                            <form class="m-0" method="POST" action="/delete">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $question->id }}">
                                                <button class="text-red-500">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
