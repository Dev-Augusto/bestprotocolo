<?php

namespace App\Models\Message;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $fillable = ['name','email','phone','description'];
}