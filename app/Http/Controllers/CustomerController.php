<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    public function view($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    public function create(Request $request)
    {
        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->update($request->all());
        return response()->json($item, 200);
    }

    public function delete($id)
    {
        Item::destroy($id);
        return response()->json(null, 204);
    }
}
