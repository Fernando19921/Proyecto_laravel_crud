<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorMateriaTable extends Migration
{
    public function up()
    {
        Schema::create('profesor_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profesor_id')->constrained('profesores')->onDelete('cascade');
            $table->foreignId('materia_id')->constrained()->onDelete('cascade');
            $table->boolean('activo')->default(true); // Nuevo campo para representar el estado de la relación
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('profesor_materia');
    }
}
