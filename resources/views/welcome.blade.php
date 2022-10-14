@extends('layouts.layout')



@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">







            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Books record</h1>
                        <hr />
                        <a href="{{ route('addBook') }}"><button class="btn btn-primary btn-s">Add new Book</button></a>
                        <hr />

                     @if(session('mssg'))
                        <p class="alert alert-success">{{session ('mssg')}}</p>
                     @endif

                        <div class="table-responsive">
                            <table id="mytable" class="table table-bordred table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Book Title</th>
                                    <th>Author</th>

                                    <th>view</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>




                                    @foreach($Books as $Book)


                                    <!-- Display Records -->
                                    <tr>
                                        <td>{{$Book->id}}</td>
                                        <td>{{$Book->book_title}} </td>
                                        <td>{{$Book->book_author}}</td>

                                        <td><a href="{{route('Book.Details' , $Book->id)}}"><button class="btn btn-warning btn-s">View Details</button></a></td>
                                        <td><a href="{{route('Book.edit'  , $Book->id)}}"><button class="btn btn-info btn-s"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                                        <td><a href="{{route('Book.destroy' , $Book->id)}}"><button class="btn btn-danger btn-s" onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash"></span></button></a></td>
                                    </tr>


                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>












        </div>
    </div>
</div>
@endsection