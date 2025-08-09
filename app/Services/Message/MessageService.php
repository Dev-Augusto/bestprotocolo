<?php
namespace App\Services\Message;

use App\Repositories\Message\MessageRepository;
use App\Services\AbstractService;

class MessageService extends AbstractService
{
    public function __construct(MessageRepository $repository)
    {
        parent::__construct($repository);
    }
}