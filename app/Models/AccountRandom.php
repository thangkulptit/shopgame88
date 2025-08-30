<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountRandom extends Model
{
    protected $table = 'account_random';
    protected $primaryKey = 'acc_id';
    protected $fillable = [
        'type_account', 'username', 'password','url_image','price','content','status'
    ];
}
