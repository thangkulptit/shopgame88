<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryBought extends Model
{
    protected $table = 'history_boughts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid', 'username', 'password','password2','price','create','created_at'
        ];
}
