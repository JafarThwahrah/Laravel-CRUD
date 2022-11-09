<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationExceptionuse;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Books = Books::all();
        return view('welcome',  ['Books' => $Books]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addBook');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'book_title' => 'unique:books|max:255',
            'book_author' => '',
            'book_description' => ''
        ]);
        $author = new authors();
        $author->name = request('author');
        $author->save();

        $Book = new Books();

        $Book->book_title = request('Title');
        $Book->book_author = request('author');
        $Book->book_description = request('Description');
        $Book->authors_id = $author->id;



        $file = $request->file('image');
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('public/Image'), $filename);


        $Book->book_image = $filename;




        $Book->save();

        return redirect('/')->with('mssg', 'Book added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Book = Books::where('id', $id)->get();

        return view('Details',  ['id' => $id, 'Book' => $Book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Book = Books::find($id);

        return view('edit', ['id' => $id, 'Book' => $Book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(Gate::allows('Editor') || Gate::allows('admin')){

        $request->validate([
            'book_title' => 'unique:books|max:255',
            'book_author' => '',
            'book_description' => ''
        ]);


        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);

            Books::where('id', $id)->update(['book_title' => request('Title'), 'book_author' => request('author'), 'book_description' => request('description'), 'book_image' => $filename]);

            return redirect('/')->with('mssg', 'Book record updated successfully');
        } else {

            Books::where('id', $id)->update(['book_title' => request('Title'), 'book_author' => request('author'), 'book_description' => request('description')]);

            return redirect('/')->with('mssg', 'Book record updated successfully');
        }
    }else {
        abort(403);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
      if((Gate::allows('admin'))){
        Books::where('id', $id)->delete();

        return redirect('/')->with('mssg', 'Book Moved to Trash successfully');
    }else {
        abort(403);
    }
    }

    public function sort()
    {

        $sortCondition = request('sortSelect');
        if ($sortCondition == "newest") {

            $Books = Books::orderBy('created_at', 'DESC')
                ->get();
            return view('welcome',  ['Books' => $Books]);
        } elseif ($sortCondition == 'oldest') {

            $Books = Books::orderBy('created_at', 'ASC')
                ->get();
            return view('welcome',  ['Books' => $Books]);
        } else {
            $Books = Books::all();
            return view('welcome',  ['Books' => $Books]);
        }
    }


    public function trash()
    {

        $onlySoftDeleted = Books::onlyTrashed()->get();

        return view('trash', ['Books' => $onlySoftDeleted]);
    }

    public function Forcedelete($id)
    {

        //$Books= Books::withTrashed()->where('id',$id)->get();
        // what you are trying to return is a multiple row data, hence it will return a single data but in multi-dimensional array format. You can check that using dd() helper function. In second case, you are using first() method, it always returns single row of data related to that particular $id, so forceDelete() method exists for that case(In other sense you can say that forceDelete exists only the single row data model, but not multiple data row model which you are tying to retrieve using get(). Remember get() always tries to return multiple data, and multiple data can only be held on array, so it gives array as a result although the result is only one.)


        $Book = Books::withTrashed()->find($id);
        $Book->forceDelete();
        return redirect('/')->with('mssg', 'Book Removed from the database successfully');
    }

    public function restore($id)
    {

        Books::withTrashed()->find($id)->restore();

        return redirect('/')->with('mssg', 'Book Restored successfully');
    }

    public function author_details($name)
    {
        // $Books = Books::where('book_author', $name)->with('author_books')->get();
        // $author = authors::where('name', $name)->get();
        $Books = authors::with('author_books')->where('name', $name)->get();
        // dd($Books);
        return view('authorinfo', ['books' => $Books]);
    }
}
