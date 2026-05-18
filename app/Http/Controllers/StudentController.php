<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'grade' => 'required|string|max:50',
            'enrollment_date' => 'required|date',
        ]);

        student::create($request->only(['name', 'email', 'phone', 'address', 'grade', 'enrollment_date']));

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'grade' => 'required|string|max:50',
            'enrollment_date' => 'required|date',
        ]);

        $student->update($request->only(['name', 'email', 'phone', 'address', 'grade', 'enrollment_date']));

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
