<?php

namespace App\Repositories;

use App\Models\Website;

class WebsiteRepository extends BaseRepository
{
    public function getModel(): Website
    {
        return new Website();
    }
}
