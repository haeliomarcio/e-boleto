<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    protected $table = 'boletos';
    protected $fillable = [
        'id',
        'name',
        'competence',
    ];

    public function stores() {
        return $this->hasMany(Store::class);
    }
}
