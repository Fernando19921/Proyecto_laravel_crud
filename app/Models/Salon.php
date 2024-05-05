<?php

// app/Models/Salon.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table='salones';
    protected $fillable = ['nombre'];

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'profesor_salon')->withPivot('hora', 'fecha')->withTimestamps();
    }
}

