<?php

namespace Rahweb\CmsAssistant\Modules\V1;
use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Package
{
    public static function getPackageList(): Collection
    {
        return API::get('v1/packages');
    }

    public static function getPackageDetail($url): Collection
    {
        return API::get('v1/package/' . $url);
    }
}
