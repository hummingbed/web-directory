<?php

namespace App\Services;

use App\Exceptions\UnprocessableEntityException;
use App\Helpers\ResponseMessages;
use App\Models\Website;
use App\Repositories\WebsiteRepository;

class WebsiteService extends BaseService
{
    public function __construct(WebsiteRepository $repository)
    {
        $this->repo = $repository;
    }

    public function addWebsite($request)
    {
        $website = $this->repo->insert([
            'user_id' => $request->user()->id,
            'url' => $request->url,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return $website->categories()->attach($request->category_id);
    }

    private function getWebsiteByUrl($request)
    {
        return $this->repo->findFirst(['url' => $request->url]);
    }

    public function deleteWebsiteByAdmin($request)
    {
        if ($request->user()->role == 'admin'){
            $website = $this->getWebsiteByUrl($request);
            if ($website){
                return $website->delete();
            }else{
                throw new UnprocessableEntityException(ResponseMessages::getEntityNotExistMessage('website'));
            }
        }else{
            throw new UnprocessableEntityException(ResponseMessages::ADMIN_ERROR);
        }
    }

    public function searchWithPaginate($request)
    {
        $term = $request->input('term');

        return Website::where('title', 'LIKE', "%{$term}%")
            ->orWhere('description', 'LIKE', "%{$term}%")
            ->with('categories')
            ->paginate(10);
    }
}
