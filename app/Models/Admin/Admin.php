<?php

namespace App\Models\Admin;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends BaseModel
{
    use HasFactory;
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $fillable = [''];
}