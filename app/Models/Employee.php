<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'name',
        'family',
        'national_id',
        'certificate_id',
        'child',
        'company_id',
        'position_id',
        'status',

    ];

    public function getFullName()
    {
        return  "{$this->name} {$this->family}";
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function contract()
    {
        return $this->hasMany(Contract::class);
    }
}
