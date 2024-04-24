<?php

namespace Rahweb\CmsAssistant\Modules\V1;
use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Portfolio
{
    public static function getList(): Collection
    {
        return API::get('v1/portfolios');
    }
    public static function getServiceForFilter(): Collection
    {
        return API::get('v1/portfolio-filters');
    }
    public static function getListForVue(): Collection
    {
        return API::get('v1/portfolio-vue');
    }

    public static function getDetail($url): Collection
    {
        return API::get('v1/portfolio/' . $url);
    }
}
