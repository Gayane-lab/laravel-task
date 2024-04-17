<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['url'];
    //protected $guarded = [];

    public function reports()
    {
        return $this->hasMany(Report::class, 'website_id', 'id');
    }
}
