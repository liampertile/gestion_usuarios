<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Course::with(['teacher', 'subject', 'courseStudents.student']);

        // filtro de activos e inactivos
        if ($request->has('estado')) {
            switch ($request->estado) {
                case 'activos':
                    $query->where('fecha_fin', '>', Carbon::now());
                    break;
                case 'inactivos':
                    $query->where('fecha_fin', '<=', Carbon::now());
                    break;
            }
        }

        // Aplicar filtro por docente si se especifica
        if ($request->has('docente_id')) {
            $query->where('docente_id', $request->docente_id);
        }

        $courses = $query->paginate();
        $teachers = Teacher::all();

        return view('course.index', compact('courses', 'teachers'))
            ->with('i', ($request->input('page', 1) - 1) * $courses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $course = new Course();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $students = Student::all();

        return view('course.create', compact('course', 'teachers', 'subjects', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request): RedirectResponse
    {
        $course = Course::create($request->validated());

        // Guardar los estudiantes seleccionados
        if ($request->has('students')) {
            foreach ($request->students as $studentId) {
                $course->courseStudents()->create([
                    'student_id' => $studentId
                ]);
            }
        }

        return Redirect::route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $course = Course::with(['courseStudents.student'])->find($id);
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $course = Course::with(['courseStudents'])->find($id);
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $students = Student::all();

        return view('course.edit', compact('course', 'teachers', 'subjects', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());

        // Actualizar los estudiantes del curso
        $course->courseStudents()->delete();
        if ($request->has('students')) {
            foreach ($request->students as $studentId) {
                $course->courseStudents()->create([
                    'student_id' => $studentId
                ]);
            }
        }

        return Redirect::route('courses.index')
            ->with('success', 'Course updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Course::find($id)->delete();

        return Redirect::route('courses.index')
            ->with('success', 'Course deleted successfully');
    }
}
