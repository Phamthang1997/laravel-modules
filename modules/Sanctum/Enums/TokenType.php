<?php

namespace Modules\Sanctum\Enums;

enum TokenType: string
{
    case Access = 'access'; // access token user login
    case Refresh = 'refresh'; // refresh token user login
}
