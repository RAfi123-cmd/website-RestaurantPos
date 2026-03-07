<?php

namespace App\Repositories;

use App\Models\Table;

class TableRepository {
    public function getAll(array $fields){
        return Table::select($fields)->latest()->paginate(10);
    }

    public function getById(int $id, array $fields){
        return Table::select($fields)->findOrFail($id);
    }

    public function create(array $data){
        return Table::create($data);
    }

    public function update(int $id,array $data){
        $table = Table::findOrFail($id);
        $table->update($data);
        return $table;
    }

    public function delete(int $id){
        $table = Table::findOrFail($id);
        $table->delete();
        return $table;
    }
}