<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MenuServices {
    private MenuRepository $menuRepository;

    public function __construct(MenuRepository $menuRepository){
        $this->menuRepository = $menuRepository;
    }

    public function getAll(array $fields){
        return $this->menuRepository->getAll($fields);
    }

    public function getById(int $id, array $fields = ['*']){
        return $this->menuRepository->getById($id, $fields);
    }

    public function create(array $data){
        if(isset($data['photo']) && $data['photo'] instanceof UploadedFile){
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->menuRepository->create($data);
    }

    public function update(int $id, array $data){
        $menu = $this->menuRepository->getById($id, ['*']);

        if(isset($data['photo']) && $data['photo'] instanceof UploadedFile){
            if(!empty($menu->photo)){
                $this->deletePhoto($menu->photo);
            }

            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
    
        return $this->menuRepository->update($id, $data);
    }

    public function delete(int $id){
        $menu = $this->menuRepository->getById($id, ['*']);

        if($menu->photo){
            $this->deletePhoto($menu->photo);
        }

        $this->menuRepository->delete($id);
    }

    public function deletePhoto(string $photoPath){
        $relativePath = 'menus/' . basename($photoPath);

        if(Storage::disk('public')->exists($relativePath)){
            Storage::disk('public')->delete($relativePath);
        }
    }

    public function uploadPhoto(UploadedFile $photo){
        return $photo->store('menus', 'public');
    }


}