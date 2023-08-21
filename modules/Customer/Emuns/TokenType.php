<?php

namespace Modules\Customer\Emuns;

enum TokenType: string
{
    case Access = 'access';
    case Refresh = 'refresh';
}
