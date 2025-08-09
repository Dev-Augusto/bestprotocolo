<?php

namespace App\Models\Site;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends BaseModel
{
    use HasFactory;
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $fillable = ['name','image','description','slug', 'icon'];

    public function clients()
    {
        return $this->hasMany(Client::class,'id_service','id');
    }

    public function about()
    {
        return $this->belongsTo(ServiceAbout::class,'id','id_service');
    }

    public function images()
    {
        return $this->hasMany(ImagesService::class,'id_service','id');
    }

}