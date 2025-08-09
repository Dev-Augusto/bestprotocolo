<?php

namespace App\Models\Site;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceAbout extends BaseModel
{
    use HasFactory;
    protected $table = 'about_services';
    protected $primaryKey = 'id';
    protected $fillable = ['id_service','title','description', 'list'];
    protected $casts = [
        'list'      => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class,'id','id_service');
    }
}