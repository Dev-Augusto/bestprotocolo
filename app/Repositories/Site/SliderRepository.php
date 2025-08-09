<?php
namespace App\Repositories\Site;

use App\Models\Site\Slider;
use App\Repositories\AbstractRepository;

class SliderRepository extends AbstractRepository
{
    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }
}