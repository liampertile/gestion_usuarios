@extends('layouts.app')

@section('template_title')
    {{ $course->name ?? __('Show') . " " . __('Course') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Course</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('courses.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Inicio:</strong>
                                    {{ $course->fecha_inicio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Fin:</strong>
                                    {{ $course->fecha_fin }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Precio:</strong>
                                    {{ $course->precio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Docente Id:</strong>
                                    {{ $course->docente_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tema Id:</strong>
                                    {{ $course->tema_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
