<?php

namespace Rahweb\CmsAssistant\Modules\V1;
use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Tag
{
    public static function getList(): Collection
    {
        return API::get('v1/tags');
    }

    public static function getDetail($url): Collection
    {
        return API::get('v1/tag/' . $url);
    }
}
