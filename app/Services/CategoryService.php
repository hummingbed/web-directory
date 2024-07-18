<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService extends BaseService
{

    public function __construct(CategoryRepository $repository)
    {
        $this->repo = $repository;
    }


    public function getCategories()
    {
        return $this->repo->findAll();
    }

}
