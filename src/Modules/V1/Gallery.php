<?php

namespace Rahweb\CmsAssistant\Modules\V1;
use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Gallery
{
    public static function getCategory(): Collection
    {
        return API::get('v1/galleries');
    }
    public static function getList($url): Collection
    {
        return API::get('v1/gallery/' . $url);
    }
}
