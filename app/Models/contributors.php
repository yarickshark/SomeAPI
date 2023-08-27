<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contributors extends Model
{
    public function collection()
    {
        return $this->belongsTo(collections::class, 'collection_id', 'id');
    }
    //use HasFactory;
}
