

@extends('layouts.app')

@section('content')
    <h1>Add New Book</h1>
    <form action="{{ route('books.store') }}" method="post">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title">
        </div>
        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author">
        </div>
        <button type="submit">Add Book</button>
    </form>
@endsection
