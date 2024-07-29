<?php

namespace Rahweb\CmsAssistant\Modules\V1;

use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Shop
{
    public static function getCategoryList(): Collection
    {
        return API::get('v1/categories');
    }

    public static function getProductList($url): Collection
    {
        return API::get('v1/category/' . $url);
    }

    public static function getBrandList($title = null): Collection
    {
        return API::get('v1/brands', ['title' => $title]);
    }

    public static function getBrandDetail($url): Collection
    {
        return API::get('v1/brand/' . $url);
    }

    public static function getProductDetail($url): Collection
    {
        return API::get('v1/product/' . $url);
    }
    public static function getDiscountedProduct(): Collection
    {
        return API::get('v1/discounted-products');
    }

}
