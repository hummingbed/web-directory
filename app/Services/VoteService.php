<?php

namespace App\Services;

use App\Exceptions\UnprocessableEntityException;
use App\Helpers\ResponseMessages;
use App\Models\Website;
use App\Repositories\VoteRepository;

class VoteService extends BaseService
{

    const VOTE = 'vote';
    const UNVOTE = 'unvote';
    public function __construct(VoteRepository $repository)
    {
        $this->repo = $repository;
    }

    public function storeVote($userId, $websiteId)
    {
        $this->repo->insert([
            'website_id' => $websiteId,
            'user_id' => $userId,
        ]);
    }

    private function findVotes($userId, $websiteId)
    {
        return $this->repo->findFirst([
            'user_id' => $userId,
            'website_id' => $websiteId,
        ]);
    }

    private function deleteVote($userId, $websiteId)
    {
        $vote = $this->findVotes($userId, $websiteId);
        return $vote->delete();
    }

    public function voteWebsite($request)
    {
        $website = Website::where('url', $request->url)->first();

        $websiteId = $website->id;

        if($request->action == self::VOTE){
            throw_if($this->findVotes($request->user()->id, $websiteId),
                new UnprocessableEntityException(ResponseMessages::VOTE_ERROR)
            );
            $this->storeVote($request->user()->id, $websiteId);
        }elseif ($request->action == self::UNVOTE){
            throw_unless($this->findVotes($request->user()->id, $websiteId),
                new UnprocessableEntityException(ResponseMessages::DELETE_VOTE)
            );
            $this->deleteVote($request->user()->id, $websiteId);
        }
        return true;
    }

}
