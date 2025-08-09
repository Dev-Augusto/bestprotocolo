<?php

namespace App\Models\Site;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends BaseModel
{
    use HasFactory;
    protected $table = 'partners';
    protected $primaryKey = 'id';
    protected $fillable = ['name','profission','image','url'];
}