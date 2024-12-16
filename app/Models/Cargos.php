<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    protected $table = 'cargo_empleados';

    protected $fillable = ["id_empleados", "cargo", "jefe"];
}
