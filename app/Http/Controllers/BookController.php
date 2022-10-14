<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationExceptionuse;
use Illuminate\Http\Request;
use App\Models\Books;

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

        $Book = new Books();

        $Book->book_title = request('Title');
        $Book->book_author = request('author');
        $Book->book_description = request('Description');

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


        $request->validate([
            'book_title' => 'unique:books|max:255',
            'book_author' => '',
            'book_description' => ''
        ]);

        // dd($id);
        Books::where('id', $id)->update(['book_title' => request('Title'), 'book_author' => request('author'), 'book_description' => request('description')]);

        return redirect('/')->with('mssg', 'Book record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Book = Books::find($id);
        $Book->delete();
        return redirect()->route('homePage')->withSuccess(__('Post delete successfully.'));
    }
}
