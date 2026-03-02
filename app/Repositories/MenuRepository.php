<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository {
    public function getAll(array $fields){
        return Menu::select($fields)->with(['category'])->latest()->paginate(10);
    }

    public function getById(int $id, array $fields){
        return Menu::select($fields)->with(['category'])->findOrFail($id);
    }

    public function create(array $data){
        return Menu::create($data);
    }

    public function update(int $id,array $data){
        $menu = Menu::findOrFail($id);
        $menu->update($data);
        return $menu;
    }

    public function delete(int $id){
        $menu = Menu::findOrFail($id);
        $menu->delete();
    }
}