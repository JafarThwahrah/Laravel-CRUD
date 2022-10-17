@extends('layouts.layout')



@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 d-flex flex-column align-items-center">

    <h1 class="text-center">Author Name:{{$books[0]->name}}</h1>

    <h3>Author Nationality:{{$books[0]->nationality}}</h3>
    <h3>Author Email:{{$books[0]->email}}</h3>
    

    <h4>Author Books:</h4>
    <div class="d-flex">
        @foreach($books as $book)

    <div>
    <img src="{{ url('public/Image/'.$book->book_image) }}" alt="book image" style="height:200 px; width: 150px;">  
      <h3>Book Title: {{$book->book_title}}</h3>
    <p>{{$book->book_description}}</p>
</div>
    @endforeach
</div>
</div>

</div>
@endsection