<?php

namespace App\Repositories;

use App\Models\Vote;

class VoteRepository extends BaseRepository
{
    public function getModel(): Vote
    {
        return new Vote();
    }
}






