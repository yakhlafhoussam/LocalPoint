@extends('layout.main')

@section('title', 'Answers | LocalMind')

@include('templates.header')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center text-gray-600 mb-6">
            <a href="/" class="hover:text-blue-600">
                <i class="fas fa-home"></i>
            </a>
            <i class="fas fa-chevron-right mx-2 text-sm"></i>
            <span class="text-blue-600 font-medium">Question Details</span>
        </div>

        <!-- Question Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <!-- Question Header -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-900 to-blue-500 flex items-center justify-center text-white font-bold text-lg">
                        {{ ucfirst(substr($question->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-bold text-gray-800">{{ $question->user->name }}</div>
                        <div class="text-sm text-gray-500">
                            <span>Asked in {{ $question->created_at }}</span>
                            <span class="mx-2">•</span>
                            <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $question->city }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
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
                    <button
                        class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>

            <!-- Question Content -->
            <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $question->title }}</h1>

            <div class="mb-6">
                <p class="text-gray-700 leading-relaxed">{{ $question->content }}</p>
            </div>

            <!-- Question Stats and Actions -->
            <div class="flex items-center justify-between border-t border-b border-gray-200 py-4">
                <div class="flex items-center space-x-6">
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
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-4 py-2 text-blue-600 font-medium hover:bg-blue-50 rounded-lg">
                        <i class="fas fa-share mr-2"></i>Share
                    </button>
                    <button class="px-4 py-2 text-blue-600 font-medium hover:bg-blue-50 rounded-lg">
                        <i class="fas fa-flag mr-2"></i>Report
                    </button>
                </div>
            </div>
        </div>

        <!-- Answers Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Answers ({{ $question->answers_count }})</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">Sort by:</span>
                    <select
                        class="px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Most Helpful</option>
                        <option>Newest</option>
                        <option>Oldest</option>
                        <option>Highest Rated</option>
                    </select>
                </div>
            </div>

            @foreach ($question->answers as $answer)
                <div class="bg-white rounded-2xl shadow p-6 mb-4">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-teal-500 flex items-center justify-center text-white font-medium">
                                {{ ucfirst(substr($answer->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-bold text-gray-800">{{ $answer->user->name }}</div>
                                <div class="text-sm text-gray-500">
                                    <span>Answered in {{ $answer->created_at }}</span>
                                    <span class="mx-2">•</span>
                                    <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $answer->user->city }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 leading-relaxed">{{ $answer->content }}</p>
                    </div>
                    @if ($answer->user->id == $user->id)
                        <form class="m-0" method="POST" action="/answerdelete">
                            @csrf
                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                            <button class="text-red-500">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Post Answer Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Post Your Answer</h3>

            @if ($errors->any())
                <div id="error-message" class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <div class="flex">
                        <i class="fas fa-exclamation-circle mt-1 mr-3"></i>
                        <ul class="text-sm flex flex-col" id="error-text">
                            @foreach ($errors->all() as $error)
                                <li>❌ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form id="answer-form" method="POST" action="pushanswer">
                @csrf
                <input type="hidden" value="{{ $question->id }}" name="post_id">
                <div class="mb-4">
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <i class="fas fa-comment-alt text-gray-400"></i>
                        </div>
                        <textarea id="answer-content" rows="6"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Share your knowledge or experience with this question..." name="answer"></textarea>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Be helpful and specific in your answer</p>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            You're answering as <span class="font-medium">{{ $question->user->name }}</span>
                        </div>
                    </div>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-indigo-700 transition">
                        Post Answer
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
