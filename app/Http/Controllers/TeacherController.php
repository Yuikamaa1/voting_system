<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teachers.index', [
            'teachers' => Teacher::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_name' => 'required|string|max:255',
            'tsc_no' => 'required|string|max:100|unique:teachers,tsc_no',
            'gender' => 'required|string|max:100',
            'position' => 'required|string|max:100'
        ]);
                // Create the student record if validation passes
                Teacher::create([
                    'teacher_name' => $request['teacher_name'],
                    'tsc_no' => $request['tsc_no'],
                    'gender' => $request['gender'],
                    'position' => $request['position']

                ]);

                // Flash a success message to the session
                session()->flash('success', 'Teacher added successfully!');

                // Redirect to the students list page
                return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the student by ID and delete the record
        $student = Teacher::findOrFail($id);
        $student->delete();

        // Flash a success message to the session
        session()->flash('success', 'Teacher deleted successfully!');

        // Redirect to the students list page
        return redirect()->route('teachers.index');
    }
}
