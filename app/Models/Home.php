<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends BaseModel
{
    use HasFactory;
    protected $table = 'home';
    protected $primaryKey = 'id';
    protected $fillable = [''];
}