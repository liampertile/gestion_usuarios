@extends('layouts.app')

@section('template_title')
    Courses
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Courses') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <!-- Filtros -->
                        <div class="row mb-4">
                            <!-- Filtro de Estado -->
                            <div class="col-md-6">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('courses.index', ['estado' => 'todos', 'docente_id' => request('docente_id')]) }}" 
                                       class="btn btn-outline-secondary {{ !request('estado') || request('estado') == 'todos' ? 'active' : '' }}">
                                        Todos
                                    </a>
                                    <a href="{{ route('courses.index', ['estado' => 'activos', 'docente_id' => request('docente_id')]) }}" 
                                       class="btn btn-outline-success {{ request('estado') == 'activos' ? 'active' : '' }}">
                                        Activos
                                    </a>
                                    <a href="{{ route('courses.index', ['estado' => 'inactivos', 'docente_id' => request('docente_id')]) }}" 
                                       class="btn btn-outline-danger {{ request('estado') == 'inactivos' ? 'active' : '' }}">
                                        Inactivos
                                    </a>
                                </div>
                            </div>
                            <!-- Filtro de Docente -->
                            <div class="col-md-6">
                                <form action="{{ route('courses.index') }}" method="GET" class="d-flex align-items-center">
                                    <select name="docente_id" class="form-select me-2" onchange="this.form.submit()">
                                        <option value="">Seleccionar Docente</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ request('docente_id') == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->nombre }} {{ $teacher->apellido }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if(request('estado'))
                                        <input type="hidden" name="estado" value="{{ request('estado') }}">
                                    @endif
                                </form>
                            </div>
                        </div>

                        <!-- Tabla de Cursos -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Precio</th>
                                        <th>Docente</th>
                                        <th>Tema</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ \Carbon\Carbon::parse($course->fecha_inicio)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($course->fecha_fin)->format('d/m/Y') }}</td>
                                            <td>${{ number_format($course->precio, 2) }}</td>
                                            <td>{{ $course->teacher->nombre }} {{ $course->teacher->apellido }}</td>
                                            <td>{{ $course->subject->nombre }}</td>
                                            <td>
                                                @if(\Carbon\Carbon::now()->lte(\Carbon\Carbon::parse($course->fecha_fin)))
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('courses.show', $course->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('courses.edit', $course->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $courses->withQueryString()->links() !!}
            </div>
        </div>

        <!-- Tabla de Estudiantes por Docente -->
        @if(request('docente_id'))
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <span id="card_title">
                            Estudiantes del Docente: {{ $teachers->find(request('docente_id'))->nombre }} {{ $teachers->find(request('docente_id'))->apellido }}
                        </span>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Estudiante</th>
                                        <th>Asignatura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $studentCount = 1;
                                        $students = collect();
                                        foreach($courses as $course) {
                                            foreach($course->courseStudents as $courseStudent) {
                                                $students->push([
                                                    'nombre' => $courseStudent->student->name,
                                                    'asignatura' => $course->subject->nombre
                                                ]);
                                            }
                                        }
                                        $students = $students->unique(function ($item) {
                                            return $item['nombre'];
                                        });
                                    @endphp
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $studentCount++ }}</td>
                                            <td>{{ $student['nombre'] }}</td>
                                            <td>{{ $student['asignatura'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
