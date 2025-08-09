<?php
namespace App\Services\Site;

use App\Repositories\Site\ClientRepository;
use App\Services\AbstractService;

class ClientService extends AbstractService
{
    public function __construct(ClientRepository $repository)
    {
        parent::__construct($repository);
    }
}