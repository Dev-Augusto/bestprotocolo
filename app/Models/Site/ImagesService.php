<?php

namespace App\Models\Site;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagesService extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'images_service';
    protected $primaryKey = 'id';
    protected $fillable = ['id_service','img'];
}