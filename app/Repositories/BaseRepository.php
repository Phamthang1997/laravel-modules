<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use \Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;

class BaseRepository extends PrettusBaseRepository implements BaseRepositoryInterface
{
    public function model()
    {
        return '';
    }
}
