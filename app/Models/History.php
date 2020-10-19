<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = [
        'id',
        'client_id',
        'competence',
        'status',
    ];

    public function client() {
        return $this->belongsTo(Client::class, 'client_id')->withTrashed();
    }

}
