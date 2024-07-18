<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseMessages;
use App\Http\Requests\DeleteWebsiteRequest;
use App\Services\WebsiteService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use HttpResponses;
    protected WebsiteService $websiteService;

    public function __construct(WebsiteService $websiteService)
    {
        $this->websiteService = $websiteService;
    }
    public function deleteWebsite(DeleteWebsiteRequest $request)
    {
        $delete = $this->websiteService->deleteWebsiteByAdmin($request);
        return $this->successHttpMessage(
            $delete,
            ResponseMessages::getSuccessMessage('website', 'deleted'),
        );
    }
}
