<?php

namespace Rahweb\CmsAssistant\Modules\V1;
use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Blog
{
    public static function getBlogList(): Collection
    {
        return API::get('v1/blogs');
    }
    public static function getBlogCategoryList($url): Collection
    {
        return API::get('v1/blogs/' . $url);
    }

    public static function getBlogDetail($url): Collection
    {
        return API::get('v1/blog/' . $url);
    }
}
