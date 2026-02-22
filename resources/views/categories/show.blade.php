@extends('layouts.app')
@section('title', $category->name . ' - PageTurner')
@section('header')
    <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
@endsection

@section('content')
    @if($category->description)
        <p class="text-gray-600 mb-6">{{ $category->description }}</p>
    @endif

    @if($books->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
        <div class="mt-8">{{ $books->links() }}</div>
    @else
        <x-alert type="info">No books in this category yet.</x-alert>
    @endif
@endsection