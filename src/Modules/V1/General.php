<?php

namespace Rahweb\CmsAssistant\Modules\V1;

use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class General
{
    public static function firstPage(): Collection
    {
        return API::get('v1/first-page');
    }

    public static function layoutData(): Collection
    {
        return API::get('v1/setting');
    }
}
