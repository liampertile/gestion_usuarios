<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $subjects = Subject::paginate();

        return view('subject.index', compact('subjects'))
            ->with('i', ($request->input('page', 1) - 1) * $subjects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $subject = new Subject();

        return view('subject.create', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request): RedirectResponse
    {
        Subject::create($request->validated());

        return Redirect::route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $subject = Subject::find($id);

        return view('subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $subject = Subject::find($id);

        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject): RedirectResponse
    {
        $subject->update($request->validated());

        return Redirect::route('subjects.index')
            ->with('success', 'Subject updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Subject::find($id)->delete();

        return Redirect::route('subjects.index')
            ->with('success', 'Subject deleted successfully');
    }
}
