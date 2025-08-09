<?php

namespace App\Models\Site;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'sliders';
    protected $primaryKey = 'id';
    protected $fillable = ['title','description','name_btn','url_btn','img'];
}