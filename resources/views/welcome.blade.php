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
                        <div class="container2 d-flex justify-content-between">
                        <a href="{{ route('addBook') }}"><button class="btn btn-primary btn-s">Add new Book</button></a>
                            <input class="form-control w-25" id="searchElement" type="search" placeholder="Search" aria-label="Search">
                        </div>

                        <form action="{{ route('sortbooks') }}" method="POST" class="d-flex flex-column align-items-end">
                            @csrf
                            <select class="form-select w-25 mt-5" name="sortSelect" aria-label="Default select example">
                                <option
                                class="dropdown-header" value="Sort..." disabled selected hidden>Sort...</option>
                                <option value="newest">newest</option>
                                <option value="oldest">oldest</option>
                              </select>
                              <button class="w-25 mt-4">Sort</button>

                        </form>

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
                                    <tr class="row-record">
                                        <td>{{$Book->id}}</td>
                                        <td>{{$Book->book_title}} </td>
                                        <td>{{$Book->book_author}}</td>

                                        <td><a href="{{route('Book.Details' , $Book->id)}}"><button class="btn btn-warning btn-s">View Details</button></a></td>
                                        <td><a href="{{route('Book.edit'  , $Book->id)}}"><button class="btn btn-info btn-s"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                                        <td><form action="{{route('Book.destroy' , $Book->id)}}" method="POST"> @csrf @method('DELETE') <button class="btn btn-danger btn-s" type="submit" onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash"></span></button></form></td>

                                    </tr>

                                    @endforeach




                                </tbody>
                            </table>
                            <a href="{{route('trash')}}">Books Archive</a>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
  

    const searchElement = document.querySelector('#searchElement');
    searchElement.addEventListener('input', function(event) {

        const searched = event.target.value.toLowerCase();

        const rowRecords = [] = document.getElementsByClassName("row-record");

        for (let i = 0; i < rowRecords.length; i++){
            console.log((rowRecords[i].cells[2].firstChild.data));
            const visible =
            rowRecords[i].cells[2].firstChild.data.toLowerCase().includes(searched) ||
            rowRecords[i].cells[1].firstChild.data.toLowerCase().includes(searched);

            if (visible != true) {
                rowRecords[i].style.display = "none";
         } else {
            rowRecords[i].style.display = "table-row";
      }

        }

    

    });


</script>
@endsection