<?php

namespace Rahweb\CmsAssistant\Modules\V1;
use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Seo
{

    public static function getStatic($url): Collection
    {
        return API::get('v1/seo/' . trim($url,'/'));
    }
    public static function getRedirct(): Collection
    {
        return API::get('v1/redirect/');
    }
}
