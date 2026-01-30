@extends('layout.main')

@section('title', 'Home | LocalMind')

@include('templates.header')

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column - Questions List -->
        <div class="lg:w-2/3">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Questions from your area</h1>
                    <p class="text-gray-600">Find answers from people near you</p>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" placeholder="Search questions..."
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <select
                        class="px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Sort by: Newest</option>
                        <option>Sort by: Most Answers</option>
                        <option>Sort by: Distance</option>
                        <option>Sort by: Popular</option>
                    </select>

                    <select
                        class="px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Filter by: All</option>
                        <option>Filter by: Unanswered</option>
                        <option>Filter by: My Questions</option>
                    </select>

                    <button class="px-4 py-2.5 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                </div>
            </div>

            <!-- Questions List -->
            <div class="space-y-6">
                @foreach ($questions as $question)
                    <div class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
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

                                @if ($question->is_favorited)
                                    <form class="m-0" method="POST" action="/unsave">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $question->id }}">
                                        <button class="text-yellow-500">
                                            <i class="fas fa-bookmark"></i>
                                        </button>
                                    </form>
                                @else
                                    <form class="m-0" method="POST" action="/save">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $question->id }}">
                                        <button class="text-yellow-500">
                                            <i class="fa-regular fa-bookmark"></i>
                                        </button>
                                    </form>
                                @endif
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

        <!-- Right Column - Sidebar -->
        <div class="lg:w-1/3">
            <!-- Ask Question Card -->
            <div
                class="bg-gradient-to-r flex flex-col items-center from-blue-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white mb-6">
                <div class="w-16 h-16 rounded-xl bg-white/20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-question text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-center">Need Help?</h3>
                <p class="text-blue-100 text-center mb-6">
                    Ask your question to the local community and get quick answers from people who know the area best.
                </p>
                <a href="/newpost"
                    class="py-3 px-5 bg-white text-blue-600 font-bold rounded-xl hover:bg-gray-100 transition">
                    Ask a Question
                </a>
            </div>
        </div>
    </div>
</div>
