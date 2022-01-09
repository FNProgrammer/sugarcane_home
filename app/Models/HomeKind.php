<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeKind extends Model
{
    use HasFactory;
    protected $fillable=[
        'title'
    ];
    public function home()
    {
        return $this->hasMany(Home::class);
    }
    public function home_price()
    {
        return $this->hasMany(HomePrice::class);
    }

}
