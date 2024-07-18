<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseMessages;
use App\Http\Requests\StoreWebsiteRequest;
use App\Http\Requests\VoteWebsiteRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SearchWebsiteResource;
use App\Services\CategoryService;
use App\Services\VoteService;
use App\Services\WebsiteService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;


class WebsiteController extends Controller
{
    use HttpResponses;

    protected WebsiteService $websiteService;
    protected VoteService $voteService;

    protected CategoryService  $categoryService;

    public function __construct(WebsiteService  $websiteService, VoteService $voteService, CategoryService $categoryService)
    {
        $this->websiteService = $websiteService;
        $this->voteService = $voteService;
        $this->categoryService = $categoryService;
    }

    public function storeWebsite(StoreWebsiteRequest $request)
    {
        $website = $this->websiteService->addWebsite($request);
        return $this->successHttpMessage(
            $website,
            ResponseMessages::getSuccessMessage('website', 'added'),
        );
    }

    public function vote(VoteWebsiteRequest $request)
    {
        $website = $this->voteService->voteWebsite($request);
        return $this->successHttpMessage(
            $website,
            ResponseMessages::getSuccessMessage('action', 'implemented'),
        );
    }

    public function searchWebsite(Request $request)
    {
        $websites = $this->websiteService->searchWithPaginate($request);

        $transformer = SearchWebsiteResource::collection($websites);

        return $this->paginateSuccessHttpMessage(
            $transformer,
            ResponseMessages::getSuccessMessage('action', 'implemented'),
            $websites
        );
    }

    public function getAllCategories()
    {
        $category = $this->categoryService->getCategories();
        $transformer = CategoryResource::collection($category);
        return $this->successHttpMessage(
            $transformer,
            ResponseMessages::getSuccessMessage('category', 'retrieved'),
        );
    }
}
