<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $students = Student::paginate();

        return view('student.index', compact('students'))
            ->with('i', ($request->input('page', 1) - 1) * $students->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $student = new Student();

        return view('student.create', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        Student::create($request->validated());

        return Redirect::route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $student = Student::find($id);

        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $student = Student::find($id);

        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());

        return Redirect::route('students.index')
            ->with('success', 'Student updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Student::find($id)->delete();

        return Redirect::route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}
