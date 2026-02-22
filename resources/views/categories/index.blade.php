@extends('layouts.app')
@section('title', 'Categories - PageTurner')
@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Categories</h1>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.categories.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    + Add Category
                </a>
            @endif
        @endauth
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $category->books_count }} books</p>
                        @if($category->description)
                            <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($category->description, 100) }}</p>
                        @endif
                    </div>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="flex space-x-2 ml-4">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="text-yellow-600 hover:text-yellow-800 text-sm">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                      onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
                <a href="{{ route('categories.show', $category) }}"
                   class="mt-4 block text-center bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">
                    Browse Books
                </a>
            </div>
        @empty
            <x-alert type="info">No categories found.</x-alert>
        @endforelse
    </div>
    <div class="mt-6">{{ $categories->links() }}</div>
@endsection