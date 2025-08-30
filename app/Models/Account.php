<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    protected $primaryKey = 'acc_id';
    protected $fillable = [
        'type_account', 'username', 'password','url_image','price','content','status'
    ];
}
