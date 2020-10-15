<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'id',
        'name',
        'email',
    ];

    public function historys() {
        return $this->hasMany(History::class);
    }

    public function city() {
        return $this->hasMany(City::class);
    }
}
