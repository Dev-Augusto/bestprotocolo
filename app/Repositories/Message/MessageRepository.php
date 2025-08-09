<?php
namespace App\Repositories\Message;

use App\Models\Message\Message;
use App\Repositories\AbstractRepository;

class MessageRepository extends AbstractRepository
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }
}