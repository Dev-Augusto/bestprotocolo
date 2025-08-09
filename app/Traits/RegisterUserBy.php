<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RegisterUserBy
{
    public static function bootRegisterUserBy()
    {
        static::creating(function ($model) {
            $user = Auth::user();

            if ($user) {
                $id = $user->id;

                if (!$model->isDirty('createdby') && in_array('createdby', $model->getFillable())) {
                    $model->createdby = $id;
                }

                if (!$model->isDirty('updatedby') && in_array('updatedby', $model->getFillable())) {
                    $model->updatedby = $id;
                }

                if (!$model->isDirty('id_company') && in_array('id_company', $model->getFillable())) {
                    $model->id_company = $model->id_company ?? $user->getEmpresaId();
                }
            }
        });

        static::updating(function ($model) {
            $user = Auth::user();

            if ($user) {
                $id = $user->id;

                if (!$model->isDirty('updatedby') && in_array('updatedby', $model->getFillable())) {
                    $model->updatedby = $id;
                }

                if (!$model->isDirty('id_company') && in_array('id_company', $model->getFillable())) {
                    $model->id_company = $model->id_company ?? $user->getEmpresaId();
                }
            }
        });

        static::deleting(function ($model) {
            if (!property_exists($model, 'deletedby')) {
                return;
            }

            $user = Auth::user();

            if ($user) {
                $model->deletedby = $user->id;

                if (!$model->isDirty('id_company') && in_array('id_company', $model->getFillable())) {
                    $model->id_company = $model->id_company ?? $user->getEmpresaId();
                }

                // OBS: deletar não atualiza os atributos no banco, então se quiser registrar o `deletedby`,
                // você precisa usar SoftDeletes e `saving()` ou fazer isso manualmente antes do delete.
            }
        });
    }
}
