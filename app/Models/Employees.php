<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $primaryKey = 'id_employee';

    protected $fillable = [
        'name',
        'employee_number',
        'email',
    ];
}
