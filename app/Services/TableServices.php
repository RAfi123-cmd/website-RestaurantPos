<?php

namespace App\Services;

use App\Repositories\TableRepository;

class TableServices {
    private $tableRepository;

    public function __construct(TableRepository $tableRepository) {
        $this->tableRepository = $tableRepository;
    }

    public function getAll(array $fields){
        return $this->tableRepository->getAll($fields);
    }

    public function getById(int $id, array $fields){
        return $this->tableRepository->getById($id, $fields);
    }

    public function create(array $data){
        return $this->tableRepository->create($data);
    }

    public function update(int $id, array $data){
        return $this->tableRepository->update($id, $data);
    }

    public function delete(int $id){
        $this->tableRepository->delete($id);
    }
}