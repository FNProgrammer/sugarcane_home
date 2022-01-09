<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePrice extends Model
{
    use HasFactory;
    protected $fillable=[
        'home_kind_id',
        'price',
        'Compensatory',
        'from_date',
        'to_date',
        'status',

    ];

    public function home_kind()
    {
        return $this->belongsTo(HomeKind::class);
    }
}
