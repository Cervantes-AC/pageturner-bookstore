@extends('layouts.app')
@section('title', 'PageTurner - Online Bookstore')

@section('content')
    {{-- Hero --}}
    <div class="bg-indigo-700 text-white rounded-lg p-8 mb-8">
        <h1 class="text-4xl font-bold mb-4">Welcome to PageTurner 📚</h1>
        <p class="text-xl text-indigo-200 mb-6">Discover your next favorite book from our extensive collection.</p>
        <a href="{{ route('books.index') }}"
           class="bg-white text-indigo-700 px-6 py-3 rounded-lg font-semibold hover:bg-indigo-100 transition">
            Browse Books
        </a>
    </div>

    {{-- Categories --}}
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-6">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}"
                   class="bg-white p-4 rounded-lg shadow hover:shadow-md transition text-center">
                    <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $category->books_count }} books</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Featured Books --}}
    <section>
        <h2 class="text-2xl font-bold mb-6">Featured Books</h2>
        @if($featuredBooks->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($featuredBooks as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
        @else
            <x-alert type="info">No books available yet. Check back soon!</x-alert>
        @endif
    </section>
@endsection