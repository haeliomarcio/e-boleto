<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{

    use SoftDeletes;
    
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
