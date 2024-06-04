<?php

namespace App\Services;

use App\Repositorties\CategoryRepository;
use App\Utils\ImageUpload;

class CategoryService
{
    public $categoryRepository;
    public function __construct(CategoryRepository $repo)
    {
        $this->categoryRepository = $repo;
    }

    public function getMainCategories()
    {
        return $this->categoryRepository->getMainCategories();
    }


    public function store($params)
    {
        $params['parent_id'] = $params['parent_id'] ?? 0;
        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image'],path:'/category/');
        }
        return  $this->categoryRepository->store($params);
    }


    public function getById($id, $childrenCount = false)
    {
        return $this->categoryRepository->getbyId($id, $childrenCount);
    }

    public function update($id, $params)
    {
        $category = $this->categoryRepository->getById($id);
        $params['parent_id'] = $params['parent_id'] ?? 0;
        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image']);
        }
        return  $this->categoryRepository->update($category, $params);
    }


    public function delete($params)
    {
        $this->categoryRepository->delete($params);
    }

    public function getAll()
    {
        return $this->categoryRepository->baseQuery(['child'])->get();
    }
}
