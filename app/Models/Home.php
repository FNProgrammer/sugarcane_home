<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Home extends Model
{
    use HasFactory;
    protected $fillable=[
        'district',
        'unit',
        'rent',
        'home_kind_id'

        ];

    public function getHomeName()
    {
        return  " بلوک {$this->district} واحد{$this->unit}";
    }

    public function home_kind()
    {
        return $this->belongsTo(HomeKind::class);
   }
    public function contract()
    {
        return $this->hasMany(Contract::class);
    }
}
