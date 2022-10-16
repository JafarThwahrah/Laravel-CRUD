@extends('layouts.layout')



@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">



    <h3 class="text-center">Add new Book</h3>


    <form class="container-lg" name="createForm" action="/books/addBook" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="form-floating m-3">
            <input type="text" name="Title" class="form-control h-25" id="title" placeholder="title" required>
            <label for="title">Book Title</label>
        </div>
        <div class="form-floating m-3">
            <input type="text" name="author" class="form-control h-25" id="author" placeholder="author" required>
            <label for="author">Author Name</label>
        </div>
        <div class="form-floating m-3">
            <input type="text" class="form-control h-25" name="Description" id="Description" placeholder="Description" required>
            <label for="Description">Book Description</label>
        </div>

        <div class="form-floating m-3">
            <input type="file" class="form-control h-25" name="image" id="image" placeholder="image" required>
            <label for="image">Book image</label>
            <input class="btn btn-primary mt-4" name="insert" type="submit" value="Submit">
        </div>

    </form>


    </div>
</div>
@endsection