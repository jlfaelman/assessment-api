<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $items = Customers::all();
            return response()->json($items);
        } catch (QueryException   $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }

    }

    public function view($id)
    {
        try {
            $item = Customers::find($id);
            return response()->json($item);
        } catch (QueryException   $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }

    }

    public function create(Request $request)
    {
        try {
            $item = Customers::create($request->all());
            return response()->json($item, 201);
        } catch (QueryException   $e) {
            error_log($e);
            if ($e->errorInfo[1] == 19) {
                \Log::error("Duplicate entry for email: " . $request->email);
                return response()->json(['error' => 'Email address already exists.'], 400);
            }
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $item = Customers::find($id);
            $item->update($request->all());
            return response()->json($item, 200);
        } catch (QueryException   $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }

    }

    public function delete($id)
    {
        try {
            Customer::destroy($id);
            return response()->json(null, 204);
        } catch (QueryException   $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
}
