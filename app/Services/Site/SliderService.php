<?php
namespace App\Services\Site;

use App\Repositories\Site\SliderRepository;
use App\Services\AbstractService;

class SliderService extends AbstractService
{
    public function __construct(SliderRepository $repository)
    {
        parent::__construct($repository);
    }
}