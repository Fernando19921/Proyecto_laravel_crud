<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores'; 

    protected $fillable = [
        'nombre',
        'email',
        'telefono'
    ];

    use HasFactory;

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'profesor_materia')
                    ->withPivot('activo') // Obtener el campo 'activo' de la tabla pivot
                    ->withTimestamps()
                    ->wherePivot('activo', true); // Filtrar solo las relaciones activas
    }

    public function salones()
    {
        return $this->belongsToMany(Salon::class, 'profesor_salon')->withPivot('hora', 'fecha')->withTimestamps();
    }
}
