<?php

namespace App\Services;

class CategoryServices {
    private $categoryRepository;

    public function __construct($categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll(array $fields){
        return $this->categoryRepository->getAll($fields);
    }

    public function getById(int $id, array $fields = ['*']){
        return $this->categoryRepository->getById($id, $fields);
    }

    public function create(array $data){
        return $this->categoryRepository->create($data);
    }

    public function update(int $id, array $data){
        return $this->categoryRepository->update($id, $data);
    }

    public function delete(int $id){
        return $this->categoryRepository->delete($id);
    }

}