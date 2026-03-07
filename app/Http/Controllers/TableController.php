<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use App\Http\Resources\TableResource;
use App\Services\TableServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $tableServices;

    public function __construct(TableServices $tableServices) {
        $this->tableServices = $tableServices;
    }

    public function index(){
        $fields = ['id', 'number', 'status'];
        return response()->json($this->tableServices->getAll($fields));
    }

    public function show(int $id){
        try {
            $fields = ['id', 'number', 'status'];
            return response()->json($this->tableServices->getById($id, $fields));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Table not found'], 404);
        }
    }

    public function store(TableRequest $request){
        $tables = $this->tableServices->create($request->validated());
        return response()->json(new TableResource($tables), 201);
    }

    public function update(TableRequest $request, int $id){
        try{
            $tables = $this->tableServices->update($id, $request->validated());
            return response()->json(new TableResource($tables));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Table not found'], 404);
        }
    }

    public function destroy(int $id){
        try {
            $this->tableServices->delete($id);
            return response()->json(['message' => 'Table Deleted successfully']);
        }catch (ModelNotFoundException $e){
            return response()->json(['message' => 'Table not found'], 404);
        }
    }
}
