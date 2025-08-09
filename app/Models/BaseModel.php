<?php

namespace App\Models;

use App\Http\Resources\GenericResource;
use App\Models\Scopes\EmpresaScope;
use App\Traits\RegisterUserBy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{

    protected static function booted()
    {
        //static::addGlobalScope(new EmpresaScope);
    }

    public function formatStringClean($string)
    {
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $stringFormatada = preg_replace('/\s+/', '-', $string);
        $stringFormatada = strtolower($stringFormatada);
        $stringFormatada = preg_replace('/[^a-z0-9\-áéíóúãõâêîôûàèìòùäëïöüçñ]/', '', $stringFormatada);
        return $stringFormatada;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (auth()->check()) {
                if (in_array('id_company', $model->getFillable())) {
                    $model->id_company = $model->id_company ?? Auth::user()->getEmpresaId();
                }
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                if (in_array('id_company', $model->getFillable())) {
                    $model->id_company = $model->id_company ?? Auth::user()->getEmpresaId();
                }
            }
        });

        static::deleting(function ($model) {
            if (auth()->check()) {
                if (in_array('id_company', $model->getFillable())) {
                    $model->id_company = $model->id_company ?? Auth::user()->getEmpresaId();
                }
            }
        });

        static::retrieved(function ($model) {
            if (auth()->check()) {
                if (in_array('id_company', $model->getFillable())) {
                    $model->id_company = $model->id_company ?? Auth::user()->getEmpresaId();
                }
            }
        });
    }
}
