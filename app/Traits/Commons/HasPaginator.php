<?php

namespace App\Traits\Commons;

use App\Enums\Paginator;
use Throwable;

trait HasPaginator
{
    /**
     * Retrieve per page
     *
     * @return integer
     */
    public function getPerPage(): int
    {
        try {
            $perPage = (int) request()->get('limit');
            $perPage = Paginator::tryFrom($perPage);
            if (empty($perPage)) {
                return Paginator::PER_PAGE_10->value;
            }

            return $perPage->value;
        } catch (Throwable) {
            return Paginator::PER_PAGE_10->value;
        }
    }
}
