<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folios extends Model
{
    use HasFactory;

    protected $table = 'folios';

    protected $primaryKey = 'id_folio';

    protected $fillable = [
        'folio',
    ];
}
