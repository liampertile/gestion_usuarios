<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestión Académica</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            <style>
            body {
                background-color: #FDFDFC;
                color: #1b1b18;
                font-family: 'Instrument Sans', sans-serif;
                margin: 0;
                padding: 1.5rem;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                max-width: 335px;
                width: 100%;
                margin: 0 auto;
            }
            .card {
                background: white;
                padding: 2rem;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                text-align: center;
            }
            h1 {
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 1rem;
            }
            p {
                color: #706f6c;
                font-size: 1.125rem;
                margin-bottom: 2rem;
            }
            .buttons-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }
            .button {
                display: block;
                width: 90%;
                padding: 0.75rem 1.5rem;
                background-color:rgb(2, 228, 134);
                color: white;
                text-align: center;
                text-decoration: none;
                border-radius: 0.5rem;
                font-weight: 500;
                margin-bottom: 1rem;
                transition: background-color 0.2s;
            }
            .button:last-child {
                margin-bottom: 0;
            }
            .button:hover {
                background-color:rgb(2, 228, 134);
            }
            </style>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <h1>Bienvenido a Gestión Académica</h1>
                <p>Sistema de gestión para cursos, docentes y estudiantes.</p>
                
                <div class="buttons-container">
                    <a href="{{ route('courses.index') }}" class="button">
                        Gestionar Cursos
                    </a>
                    <a href="{{ route('teachers.index') }}" class="button">
                        Gestionar Docentes
                    </a>
                    <a href="{{ route('students.index') }}" class="button">
                        Gestionar Estudiantes
                    </a>
                </div>
                </div>
        </div>
    </body>
</html>