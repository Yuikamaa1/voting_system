<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;
// use App\Http\Requests\UpdatebookRequest;
use App\Models\auther;
use App\Models\category;
use App\Models\publisher;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('book.index', [
            'books' => book::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_name' => 'required|string|max:255',
            'book_number' => 'required|string|max:100',
            'subject' => 'required',
            'edition' => 'required|string'
        ]);

        // Create the studen0t record if validation passes
        $book=book::create($validated);
        // dd($book);
        // Flash a success message to the session
        session()->flash('success', 'Book Inserted successfully!');

        // Redirect to the students list page
        return redirect()->route('books.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(book $book)
    {
        return view('book.edit',[
            'authors' => auther::latest()->get(),
            'publishers' => publisher::latest()->get(),
            'categories' => category::latest()->get(),
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebookRequest  $request
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebookRequest $request, $id)
    {
        $book = book::find($id);
        $book->name = $request->name;
        $book->auther_id = $request->author_id;
        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->save();
        return redirect()->route('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $book=book::all();
    //     if($book->status == 'Available'){
    //         book::find($id)->delete();
    //         session()->flash('success', 'Book deleted successfully!');
    //     }
    //     else{
    //         session()->flash('error', 'Book issued can not be deleted');
    //     }


    //     return redirect()->route('books');
    // }
    public function destroy($id)
    {
        // Find the book by ID
        $book = Book::findOrFail($id);

        // Check if the book's status is 'Issued'
        if ($book->status === 'Issued') {
            // Flash an error message to the session
            session()->flash('error', 'Cannot delete a borrowed book!');

            // Redirect back to the books list page
            return redirect()->route('books.index');
        }

        // Delete the book
        $book->delete();

        // Flash a success message to the session
        session()->flash('success', 'Book deleted successfully!');

        // Redirect to the books list page
        return redirect()->route('books.index');
    }

}
