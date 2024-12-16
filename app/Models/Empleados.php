<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table = 'empleados';

    protected $fillable = ["nombre", "identificacion", "direccion", "telefono", "ciudad"];
}
