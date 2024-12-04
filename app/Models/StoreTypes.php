<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreTypes extends Model
{
    use HasFactory;

    protected $table = 'store_types';

    protected $primaryKey = 'id_store_type';

    protected $fillable = [
        'name',
    ];
}
