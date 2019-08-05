<?php

namespace App\Observers;

use App\Models\Link;
use Cache;

class linkObserver
{
    //
    public function saved(Link $link){
        Cache::forget($link->cache_key);
    }
}
