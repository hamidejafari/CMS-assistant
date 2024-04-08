<?php

namespace Rahweb\CmsAssistant\Modules\V1;
use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Service
{
    public static function getServiceList(): Collection
    {
        return API::get('v1/services');
    }

    public static function getServiceDetail($url): Collection
    {
        return API::get('v1/service/' . $url);
    }
}
