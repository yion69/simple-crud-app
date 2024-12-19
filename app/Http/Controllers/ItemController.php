<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
     public function store(Request $request)
    {
        
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_category' => 'required|string|max:255',
            'item_price' => 'required|numeric',
            'item_description' => 'required|string',
            'item_condition' => 'required|string',
            'item_type' => 'required|string',
            'owner_name' => 'required|string|max:255',
            'owner_contact_number' => 'required|string|max:20',
            'owner_address' => 'required|string',
            'owner_lat' => 'required|numeric',
            'owner_lng' => 'required|numeric',
        ]);

        $item = Item::create([
            'item_name' => $validated['item_name'],
            'item_category' => $validated['item_category'],
            'item_price' => $validated['item_price'],
            'item_description' => $validated['item_description'],
            'item_condition' => $validated['item_condition'],
            'item_type' => $validated['item_type'],
            'owner_name' => $validated['owner_name'],
            'owner_contact_number' => $validated['owner_contact_number'],
            'owner_address' => $validated['owner_address'],
            'owner_lat' => $validated['owner_lat'],
            'owner_lng' => $validated['owner_lng'],
        ]);
        
        return response()->json([
            'message' => 'Item added successfully',
            'item' => $item,
        ], 201);
    }   
    public function get () {
        $items = Item::all();
        return response()->json([
            'items' => $items,
        ]);
    }
}
