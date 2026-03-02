<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Http\Resources\MenuResource;
use App\Services\MenuServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private MenuServices $menuServices;

    public function __construct(MenuServices $menuServices){
        $this->menuServices = $menuServices;
    }

    public function index(){
        $fields = ['id', 'name', 'price', 'photo', 'category_id'];

        $menus = $this->menuServices->getAll($fields);

        return response()->json(MenuResource::collection($menus));
    }

    public function show(int $id){
        try{
            $fields = ['id', 'name', 'price', 'photo', 'category_id', 'description'];
            $menu  = $this->menuServices->getById($id, $fields);
            return response()->json(new MenuResource($menu));
        } catch (ModelNotFoundException $e){
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    public function store(MenuRequest $request){
        $menu = $this->menuServices->create($request->validated());
        return response()->json(new MenuResource($menu), 201);
    }

    public function update(MenuRequest $request, int $id){
        try{
            $menu = $this->menuServices->update($id, $request->validated());
            return response()->json(new MenuResource($menu));
        } catch (ModelNotFoundException $e){
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }
    
    public function destroy(int $id){
        try{
            $this->menuServices->delete($id);
            return response()->json(['message' => 'Menu deleted successfully']);
        } catch (ModelNotFoundException $e){
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }
}
