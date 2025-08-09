<?php
namespace App\Repositories\Site;

use App\Models\Site\Client;
use App\Repositories\AbstractRepository;

class ClientRepository extends AbstractRepository
{
    public function __construct(Client $model)
    {
        parent::__construct($model);
    }
}