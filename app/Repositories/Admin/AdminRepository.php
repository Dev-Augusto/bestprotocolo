<?php
namespace App\Repositories\Admin;

use App\Models\Admin\Admin;
use App\Repositories\AbstractRepository;

class AdminRepository extends AbstractRepository
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
}