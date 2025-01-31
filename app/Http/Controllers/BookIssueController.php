<?php

namespace App\Http\Controllers;

use App\Models\book_issue;
use App\Http\Requests\Storebook_issueRequest;
use App\Http\Requests\Updatebook_issueRequest;
use App\Models\auther;
use App\Models\book;
use App\Models\settings;
use App\Models\student;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // ✅ Add this line


class BookIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report.issueBooks', [
            'issueBooks' => book_issue::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.issueBook_add', [
            'students' => student::latest()->get(),
            'books' => book::where('status', 'Y')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storebook_issueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info('Request Data:', $request->all());

        $validator = Validator::make($request->all(), [
            'student_adm_no' => 'required|string|exists:students,admission_no',
            'book_name' => 'required|string',
            'book_number' => 'required|string',
            'issue_date' => 'required|date',
            'return_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            \Log::error($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the book issue record
        $data = book_issue::create($request->only([
            'student_adm_no', 'book_name', 'book_number', 'issue_date', 'return_date'
        ]));

        // Find the book and update its status
        $book = book::where('book_number', $request->input('book_number'))->first();

        if ($book) {
            $book->status = 'Issued';
            $book->save();
        } else {
            session()->flash('error', 'Book not found.');
            return redirect()->route('book_issue.index');
        }

        session()->flash('success', 'Book issued successfully!');
        return redirect()->route('book_issue.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the student by ID and return the student data
        // $student = Student::findOrFail($id);
        // return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebook_issueRequest  $request
     * @param  \App\Models\book_issue  $book_issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book_issue  $book_issue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Find the book issue record
    $bookIssue = book_issue::find($id);

    if (!$bookIssue) {
        session()->flash('error', 'Book issue record not found.');
        return redirect()->route('book_issue.index');
    }

    // Retrieve the book based on the book number in the book issue record
    $book = book::where('book_number', $bookIssue->book_number)->first();

    if ($book) {
        // Update the book's status to 'Available'
        $book->status = 'Available';
        $book->save();
    } else {
        // Handle the case when the book is not found (optional)
        session()->flash('error', 'Associated book not found.');
        return redirect()->route('book_issue.index');
    }

    // Delete the book issue record
    $bookIssue->delete();

    session()->flash('success', 'Book returned successfully!');
    return redirect()->route('book_issue.index');
}

}
