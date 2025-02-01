<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $items = Customers::all();
            return response()->json($items);
        } catch (Exception  $e) {
            \Log::error("Error on: " . $e->getMessage());
        }

    }

    public function view($id)
    {
        try {
            $item = Customers::find($id);
        return response()->json($item);
        } catch (Exception  $e) {
            \Log::error("Error on:" . $e->getMessage());
        }

        
    }

    public function create(Request $request)
    {
        try {
            error_log($request);
            $item = Customers::create($request->all());
            return response()->json($item, 201);
        } catch (Exception  $e) {
            \Log::error("Error on:" . $e->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        try {
            $item = Customers::find($id);
            $item->update($request->all());
            return response()->json($item, 200);
        } catch (Exception  $e) {
            \Log::error("Error on:" . $e->getMessage());
        }
        
    }

    public function delete($id)
    {
        try {
            Customer::destroy($id);
            return response()->json(null, 204);
        } catch (Exception  $e) {
            \Log::error("Error on:" . $e->getMessage());
        }
    }
}
