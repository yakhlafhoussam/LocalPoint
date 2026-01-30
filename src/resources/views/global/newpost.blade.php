@extends('layout.main')

@section('title', 'New Post | LocalMind')

@include('templates.header')

<!-- Main Content -->
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center text-gray-600 mb-8">
            <a href="/" class="hover:text-blue-600">
                <i class="fas fa-home"></i>
            </a>
            <i class="fas fa-chevron-right mx-2 text-sm"></i>
            <span class="text-blue-600 font-medium">Ask Question</span>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-3">Ask a Question to Your Community</h1>
            <p class="text-gray-600">Get answers from people in your area who know best.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
            <!-- Success Message -->
            @if (session('success'))
                <div id="success-message"
                    class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    <div class="flex">
                        <i class="fas fa-check-circle mt-1 mr-3"></i>
                        <p class="text-sm" id="success-text">{{ session('success') }}</p>
                    </div>
                </div>
            @endif


            <!-- Error Message -->
            @if ($errors->any())
                <div id="error-message"
                    class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
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


            <!-- Question Form -->
            <form id="question-form" method="POST" class="space-y-6">
                @csrf
                <!-- Question Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Question Title <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-question text-gray-400"></i>
                        </div>
                        <input type="text" id="title" maxlength="150"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="What do you need to know?" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="flex justify-between mt-1">
                        <p class="text-xs text-gray-500">Be specific and clear about what you're asking</p>
                        <span id="title-counter" class="text-xs text-gray-500">0/150</span>
                    </div>
                </div>

                <!-- Question Details -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Question Details <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <i class="fas fa-align-left text-gray-400"></i>
                        </div>
                        <textarea id="details" rows="8"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Provide more details about your question..." name="content">{{ old('content') }}</textarea>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Add any relevant information to help others understand your
                        question better</p>
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Location <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input type="text" id="city"
                                class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="City" value="{{ old('city') }}" name="city">
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2"></i>
                        Your location helps people nearby answer your question
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" id="submit-btn"
                        class="flex-1 py-3.5 px-6 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-600 hover:to-indigo-700 transition duration-300 shadow-md hover:shadow-lg">
                        <span id="btn-text">Publish Question</span>
                        <i id="btn-spinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                    </button>
                    <div id="draft-btn"
                        class="px-6 py-3.5 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition">
                        Save as Draft
                    </div>
                    <a href="/"
                        class="px-6 py-3.5 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Tips Card -->
        <div class="mt-8 bg-blue-50 rounded-2xl border border-blue-200 p-6">
            <div class="flex items-start mb-4">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                    <i class="fas fa-lightbulb text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Tips for Getting Better Answers</h3>
                    <p class="text-sm text-gray-600 mt-1">Follow these guidelines to get helpful responses faster</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <div
                        class="w-6 h-6 rounded-full bg-white border border-blue-300 flex items-center justify-center mr-2 mt-0.5">
                        <span class="text-blue-600 text-xs font-bold">1</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Be specific</p>
                        <p class="text-sm text-gray-600">Clearly state what you're looking for</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div
                        class="w-6 h-6 rounded-full bg-white border border-blue-300 flex items-center justify-center mr-2 mt-0.5">
                        <span class="text-blue-600 text-xs font-bold">2</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Include location</p>
                        <p class="text-sm text-gray-600">Help locals provide relevant answers</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div
                        class="w-6 h-6 rounded-full bg-white border border-blue-300 flex items-center justify-center mr-2 mt-0.5">
                        <span class="text-blue-600 text-xs font-bold">3</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Add details</p>
                        <p class="text-sm text-gray-600">Provide context for better understanding</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div
                        class="w-6 h-6 rounded-full bg-white border border-blue-300 flex items-center justify-center mr-2 mt-0.5">
                        <span class="text-blue-600 text-xs font-bold">4</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Use tags</p>
                        <p class="text-sm text-gray-600">Help others find your question</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Character counter for title
    const titleInput = document.getElementById('title');
    const titleCounter = document.getElementById('title-counter');

    titleInput.addEventListener('input', function() {
        titleCounter.textContent = `${this.value.length}/150`;
    });
</script>
