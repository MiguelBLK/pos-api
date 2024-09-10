<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;

    protected $table = 'stores';

    protected $primaryKey = 'id_store';

    protected $fillable = [
        'name',
        'street',
        'neighbourhood',
        'zip_code',
        'municipality',
        'external_number',
        'latitude',
        'length',
        'email',
        'phone',
        'seller_name',
        'id_status',
        'id_store_type',
        'id_employee'
    ];
}
