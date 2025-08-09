<?php
namespace App\Services\Site;

use App\Repositories\Site\AboutRepository;
use App\Services\AbstractService;

class AboutService extends AbstractService
{
    public function __construct(AboutRepository $repository)
    {
        parent::__construct($repository);
    }
}