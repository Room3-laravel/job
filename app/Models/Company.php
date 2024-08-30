<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',

    ];
    public function jobs()
    {
        return $this->hasMany(JobData::class, 'company_id', 'id');
    }

}
