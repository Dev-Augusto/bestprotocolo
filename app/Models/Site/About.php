<?php

namespace App\Models\Site;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'about';
    protected $primaryKey = 'id';
    protected $fillable = ['home_title','home_list','home_description','description','list','img'];
    protected $casts = [
        'home_list' => 'array',
        'list'      => 'array',
    ];
}