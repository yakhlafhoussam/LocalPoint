@extends('layout.main')

@section('title', 'Manege | LocalMind')

@include('templates.header')

<div class="container mx-auto px-4 py-8">
    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Dashboard</h1>
        <p class="text-gray-600">Manage your LocalMind community</p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-blue-600">{{ count($questions) }}</div>
                    <div class="text-gray-600">Total Questions</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-question text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-green-600">{{ $answerCount }}</div>
                    <div class="text-gray-600">Total Answers</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                    <i class="fas fa-comment text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-purple-600">{{ count($users) }}</div>
                    <div class="text-gray-600">Active Users</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Users -->
        <div class="bg-white rounded-2xl shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Recent Users</h2>
                </div>
            </div>

            <div class="overflow-y-auto max-h-[500px]">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $userss)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center text-white font-medium mr-3">
                                            {{ ucfirst(substr($userss->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-800">{{ $userss->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $userss->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($userss->role == 'admin')
                                        <span
                                            class="px-2 py-1 text-xs bg-red-100 text-red-800 font-medium rounded-full">
                                            <i class="fas fa-crown mr-2"></i>Admin
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs bg-blue-100 text-blue-800 font-medium rounded-full">
                                            <i class="fas fa-user mr-2"></i>User
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="/deleteuser">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $userss->id }}">
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Questions -->
        <div class="bg-white rounded-2xl shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Recent Questions</h2>
                </div>
            </div>

            <div class="overflow-y-auto max-h-[500px]">
                <div class="divide-y divide-gray-200">
                    @foreach ($questions as $question)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span
                                            class="text-blue-600 font-medium">{{ ucfirst(substr($question->user->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-800">{{ $question->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $question->created_at }}</div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-2">{{ $question->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">{{ $question->content }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-comment mr-1"></i> {{ $question->answers_count }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-heart mr-1"></i> {{ $question->likes_count }}
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    <form method="POST" action="/deletequestion">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $question->id }}">
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
