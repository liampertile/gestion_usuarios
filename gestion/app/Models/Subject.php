<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Course[] $courses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Subject extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'tema_id', 'id');
    }
    
}
