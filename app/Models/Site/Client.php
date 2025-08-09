<?php

namespace App\Models\Site;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['id_service','name','description','stars','type'];

    public function service()
    {
        return $this->belongsTo(Service::class,'id','id_service');
    }
}