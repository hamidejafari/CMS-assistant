<?php

namespace Rahweb\CmsAssistant\Modules\V1;

use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class User
{
    public static function users(): Collection
    {
        return API::get('v1/users');
    }

    public static function get(int $id): Collection
    {
        return API::get('v1/users/' . $id);
    }
}
