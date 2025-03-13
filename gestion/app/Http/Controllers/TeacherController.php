<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $teachers = Teacher::paginate();

        return view('teacher.index', compact('teachers'))
            ->with('i', ($request->input('page', 1) - 1) * $teachers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $teacher = new Teacher();

        return view('teacher.create', compact('teacher'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request): RedirectResponse
    {
        Teacher::create($request->validated());

        return Redirect::route('teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $teacher = Teacher::find($id);

        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $teacher = Teacher::find($id);

        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher): RedirectResponse
    {
        $teacher->update($request->validated());

        return Redirect::route('teachers.index')
            ->with('success', 'Teacher updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Teacher::find($id)->delete();

        return Redirect::route('teachers.index')
            ->with('success', 'Teacher deleted successfully');
    }
}
