<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'fecha_inicio' => 'required|date',
			'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
			'precio' => 'required|numeric|min:0',
			'docente_id' => 'required|exists:teachers,id',
			'tema_id' => 'required|exists:subjects,id',
			'students' => 'array',
			'students.*' => 'exists:students,id'
        ];
    }
}
