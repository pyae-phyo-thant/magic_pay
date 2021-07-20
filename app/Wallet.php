<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Wallet extends Model
{
    protected $fillable = ['account_number','amount','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
