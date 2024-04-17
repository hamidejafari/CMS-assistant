<?php

namespace Rahweb\CmsAssistant\Modules\V1;

use Illuminate\Support\Collection;
use Rahweb\CmsAssistant\Core\API;

class Comment
{
    public static function create($request): Collection
    {
        return API::post('v1/post-comment',$request);
    }


}