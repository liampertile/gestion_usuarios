<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 3 estudiantes
        Student::create(['name' => 'Juan Pérez', 'birth_date' => '2000-05-15']);
        Student::create(['name' => 'María García', 'birth_date' => '2001-08-22']);
        Student::create(['name' => 'Carlos López', 'birth_date' => '2000-03-10']);

        // Crear 3 profesores
        Teacher::create(['nombre' => 'Dr. Roberto Martínez', 'legajo' => '001']);
        Teacher::create(['nombre' => 'Lic. Ana Sánchez', 'legajo' => '002']);
        Teacher::create(['nombre' => 'Prof. Luis González', 'legajo' => '003']);

        // Crear 3 materias
        Subject::create([
            'nombre' => 'Matemáticas',
            'descripcion' => 'Curso de matemáticas avanzadas incluyendo álgebra y cálculo'
        ]);
        Subject::create([
            'nombre' => 'Física',
            'descripcion' => 'Estudio de la física clásica y moderna con experimentos prácticos'
        ]);
        Subject::create([
            'nombre' => 'Química',
            'descripcion' => 'Fundamentos de química orgánica e inorgánica con prácticas de laboratorio'
        ]);
    }
}
