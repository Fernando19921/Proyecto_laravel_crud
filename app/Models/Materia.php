<?php

// app/Models/Materia.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'profesor_materia');
    }
}
