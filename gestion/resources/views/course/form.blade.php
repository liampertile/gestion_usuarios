<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha_inicio" class="form-label">{{ __('Fecha Inicio') }}</label>
            <input type="text" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio', $course?->fecha_inicio) }}" id="fecha_inicio" placeholder="Fecha Inicio">
            {!! $errors->first('fecha_inicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_fin" class="form-label">{{ __('Fecha Fin') }}</label>
            <input type="text" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ old('fecha_fin', $course?->fecha_fin) }}" id="fecha_fin" placeholder="Fecha Fin">
            {!! $errors->first('fecha_fin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="precio" class="form-label">{{ __('Precio') }}</label>
            <input type="text" name="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio', $course?->precio) }}" id="precio" placeholder="Precio">
            {!! $errors->first('precio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="docente_id" class="form-label">{{ __('Docente') }}</label>
            <select name="docente_id" class="form-control @error('docente_id') is-invalid @enderror" id="docente_id">
                <option value="">Seleccione un docente</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('docente_id', $course?->docente_id) == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->nombre }} {{ $teacher->apellido }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('docente_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tema_id" class="form-label">{{ __('Tema') }}</label>
            <select name="tema_id" class="form-control @error('tema_id') is-invalid @enderror" id="tema_id">
                <option value="">Seleccione un tema</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('tema_id', $course?->tema_id) == $subject->id ? 'selected' : '' }}>
                        {{ $subject->nombre }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('tema_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label class="form-label">{{ __('Estudiantes') }}</label>
            <div class="border p-3 rounded" style="max-height: 200px; overflow-y: auto;">
                @foreach($students as $student)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="students[]" 
                               value="{{ $student->id }}" 
                               id="student_{{ $student->id }}"
                               {{ (isset($course->courseStudents) && $course->courseStudents->contains('student_id', $student->id)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="student_{{ $student->id }}">
                            {{ $student->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            {!! $errors->first('students', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>