<?php
namespace App\Services\Site;

use App\Repositories\Site\ImagesServiceRepository;
use App\Services\AbstractService;

class ImagesServiceService extends AbstractService
{
    public function __construct(ImagesServiceRepository $repository)
    {
        parent::__construct($repository);
    }
}