@extends('layouts.layout')



@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 d-flex flex-column align-items-center">



    <h1 class="text-center">Recycle Bin</h1>
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
                <th>ID</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Restore</th>
                    <th>Delete</th>
            </thead>
            <tbody>




                @foreach($Books as $Book)


                <!-- Display Records -->
                <tr class="row-record">
                    <td>{{$Book->id}}</td>
                    <td>{{$Book->book_title}} </td>
                    <td>{{$Book->book_author}}</td>

                    <td><form action="{{route('restore' , $Book->id)}}" method="GET"> @csrf  <button class="btn btn-warning btn-s" type="submit" onClick="return confirm('Do you really want to restore the record?');">Restore</button></form></td>

                    <td><form action="{{route('Forcedelete' , $Book->id)}}" method="POST"> @csrf @method('DELETE') <button class="btn btn-danger btn-s" type="submit" onClick="return confirm('Do you really want to delete the record Permanently');"><span class="glyphicon glyphicon-trash"></span></button></form></td>

                </tr>

                @endforeach




            </tbody>
        </table>
    </div>
</div>

</div>
@endsection