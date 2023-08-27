<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class collections extends Model
{
    protected $fillable = ['name', '_token'];
    public function contributors()
    {
        return $this->hasMany(contributors::class, 'collection_id', 'id');
    }
    //use HasFactory;
}
