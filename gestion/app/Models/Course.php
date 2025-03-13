<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 *
 * @property $id
 * @property $fecha_inicio
 * @property $fecha_fin
 * @property $precio
 * @property $docente_id
 * @property $tema_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Teacher $teacher
 * @property Subject $subject
 * @property CourseStudent[] $courseStudents
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Course extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fecha_inicio', 'fecha_fin', 'precio', 'docente_id', 'tema_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(\App\Models\Teacher::class, 'docente_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class, 'tema_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseStudents()
    {
        return $this->hasMany('App\Models\CourseStudent', 'course_id', 'id');
    }
    
}
