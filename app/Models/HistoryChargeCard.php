<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryChargeCard extends Model
{
    protected $table = 'history_charge_cards';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid'
    ];
}
