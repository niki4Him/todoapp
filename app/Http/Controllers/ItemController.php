<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @param ItemRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ItemRequest $request)
    {
        Item::create($request->all());
        return response()->json(['status' => 'success'], 201);
    }


    /**
     * @param ItemRequest $request
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ItemRequest $request, Item $item)
    {
        $this->authorize('update', $item->todo);
        $item->update($request->all());
        return response()->json(['status' => 'success'], 201);
    }

    /**
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item->todo);
        $item->delete();
        return response()->json(['status' => 'success'], 201);
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function complete(Request $request, Item $item)
    {
        $item->update(['complete' => $request->complete]);
        return response()->json(['status' => 'success'], 201);
    }

}
