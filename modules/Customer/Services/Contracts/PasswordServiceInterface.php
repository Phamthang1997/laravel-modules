<?php

namespace Modules\Customer\Services\Contracts;

use Illuminate\Http\Request;

interface PasswordServiceInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request): mixed;

    /**
     * @param Request $request
     * @return mixed
     */
    public function reset(Request $request): mixed;
}
