<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\book_issue;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $availableBooks = Book::where('status', 'Available')->get();

        return view('report.Available_books', compact('availableBooks'));
    }
    public function date_wise()
    {
        return view('report.dateWise', ['books' => '']);
    }

    public function generate_date_wise_report(Request $request)
    {
        $request->validate(['date' => "required|date"]);
        return view('report.dateWise', [
            'books' => book_issue::where('issue_date', $request->date)->latest()->get()
        ]);
    }

    public function month_wise()
    {
        return view('report.monthWise', ['books' => '']);
    }

    public function generate_month_wise_report(Request $request)
    {
        $request->validate(['month' => "required|date"]);
        return view('report.monthWise', [
            'books' => book_issue::where('issue_date', 'LIKE', '%' . $request->month . '%')->latest()->get(),
        ]);
    }

    public function not_returned()
    {
        return view('report.notReturned',[
            'books' => book_issue::latest()->get()
        ]);
    }
    // public function availableBooks()
    // {
    //     return view('report.available_books', [
    //         'books' => Book::where('status', 'Available')->get()
    //     ]);
    // }

    // public function issuedBooks()
    // {
    //     return view('report.issueBooks');
    // }
}
