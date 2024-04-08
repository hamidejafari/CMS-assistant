<?php

namespace Rahweb\CmsAssistant\Modules\V1;
use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Service
{
    public static function services(): Collection
    {
        return API::get('v1/services');
    }

    public static function get($slug): Collection
    {
        return API::get('v1/service/' . $slug);
    }
}
