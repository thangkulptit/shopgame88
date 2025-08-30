<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeAccount extends Model
{
    protected $table = 'type_accounts';
    protected $primaryKey = 'ta_id';
    protected $fillable = [
        'name'
    ];


}
