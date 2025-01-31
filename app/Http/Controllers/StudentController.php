<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return the students index view with paginated students
        return view('student.index', [
            'students' => Student::all(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:100',
            'admission_no' => 'required|string|max:100|unique:students,admission_no',
            'admission_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'parent_phone' => 'required|string|max:15',
        ]);

        // Create the student record if validation passes
        student::create([
            'name' => $request['name'],
            'class' => $request['class'],
            'admission_no' => $request['admission_no'],
            'admission_date' => $request['admission_date'],
            'gender' => $request['gender'],
            'parent_phone' => $request['parent_phone']
        ]);

        // Flash a success message to the session
        session()->flash('success', 'Student added successfully!');

        // Redirect to the students list page
        return redirect()->route('students.index');
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
        $student = Student::findOrFail($id);
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // Return the edit view with the student data
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        // Find the student by ID and update the record
        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'class' => $request->class,
            'admission_no' => $request->admission_no,
            'admission_date' => $request->admission_date,
            'gender' => $request->gender,
            'parent_phone' => $request->parent_phone,
        ]);

        // Flash a success message to the session
        session()->flash('success', 'Student updated successfully!');

        // Redirect to the students list page
        return redirect()->route('students.index');
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
        $student = Student::findOrFail($id);
        $student->delete();

        // Flash a success message to the session
        session()->flash('success', 'Student deleted successfully!');

        // Redirect to the students list page
        return redirect()->route('students.index');
    }
}
