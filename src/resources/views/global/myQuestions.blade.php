@extends('layout.main')

@section('title', 'My Questions | LocalMind')

@include('templates.header')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">My Questions</h1>
            <p class="text-gray-600">Manage all the questions you've asked</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ count($questions) }}</div>
                <div class="text-gray-600">Total Questions</div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $answerCount }}</div>
                <div class="text-gray-600">Total Answers Received</div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ $likeCount }}</div>
                <div class="text-gray-600">Likes</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-2xl shadow p-6 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex-1 min-w-[250px]">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" placeholder="Search your questions..."
                            class="pl-10 w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <select
                    class="px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>All Questions</option>
                    <option>Answered</option>
                    <option>Unanswered</option>
                    <option>Most Popular</option>
                    <option>Recently Asked</option>
                </select>

                <button class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                    <i class="fas fa-filter mr-2"></i>More Filters
                </button>
            </div>
        </div>

        <!-- Questions List -->
        <div id="questions-container" class="space-y-6">
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

        <!-- Bulk Actions -->
        <div class="mt-6 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <select
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Bulk Actions</option>
                    <option>Delete Selected</option>
                    <option>Mark as Answered</option>
                    <option>Export Selected</option>
                </select>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Apply
                </button>
            </div>
        </div>
    </div>
</div>
