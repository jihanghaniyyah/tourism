<?php

namespace App\Services;

use App\Models\Item;
use App\Http\Requests\ItemRequest;

class ItemService
{
    public function create(ItemRequest $request)
    {
        Item::create([
            'item_category_id' => $request->category,
            'name' => $request->name,
            'loc' => $request->loc,
        ]);
    }

    public function update(ItemRequest $request, string $id)
    {
        $item = Item::find($id);
        $item->item_category_id = $request->category;
        $item->name = $request->name;
        $item->loc = $request->loc;
        $item->save();
    }

    public function delete(string $id)
    {
        $item = Item::find($id);
        $item->delete();
    }
}
