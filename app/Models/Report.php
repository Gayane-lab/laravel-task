<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }
}
