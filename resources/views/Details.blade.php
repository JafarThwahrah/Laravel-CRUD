@extends('layouts.layout')



@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">



    <h1>Book ID-{{$id}}</h1>
    @foreach($Book as $bookinfo)
    <img src="{{ url('public/Image/'.$bookinfo->book_image) }}" alt="book image" style="height:200 px; width: 150px;">  
      <h3>Book Title: {{$bookinfo->book_title}}</h3>
    <p>{{$bookinfo->book_description}}</p>
    @endforeach


    </div>
</div>
@endsection