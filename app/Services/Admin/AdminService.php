<?php
namespace App\Services\Admin;

use App\Repositories\Admin\AdminRepository;
use App\Services\AbstractService;

class AdminService extends AbstractService
{
    public function __construct(AdminRepository $repository)
    {
        parent::__construct($repository);
    }
}