<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;


class ItemController extends Controller
{
    //MODEL INSTANCE
    protected $item;

    //USED FOR FORM VALIDATION
    private $validation = [
        'name' => 'string|max:255|required',
        'price' => 'numeric|required',
        'sale' => 'boolean|required',
    ];

    /*
    *   instantiating model
    */
    public function __construct()
    {
        $this->item = new Item;
    }

    /*
    *   return index page with items
    */
    public function index()
    {
        $items = $this->item->repository->findAll();
        return view('items.index', ['items' => $items]);
    }

    /*
    *   returns create form
    */
    public function create()
    {
        return view('items.create');
    }

    /*
    *   stores a new item
    */
    public function store(Request $request)
    {
        $request->validate($this->validation);
        $item = $this->item->repository->create($request->all());
        $item = $this->item->repository->save($item);

        return redirect()->route('items.index')
                ->with('flash_message', 'added successfully');
    }

    /*
    *   return edit form
    */
    public function edit($id)
    {
        try {
            $item = $this->item->repository->find($id);
        } catch (\Exception $e) {
            return back()
                ->withErrors('something went wrong');
        }

        return view('items.edit', compact('item'));
    }

    /*
    *   updates an existing item
    */
    public function update(Request $request, $id)
    {
        $request->validate($this->validation);

        try {
            $item = $this->item->repository->update($request->all(), $id);
        } catch (\Exception $e) {
            return back()
                ->withErrors('something went wrong');
        }

        $item = $this->item->repository->save($item);

        return redirect()->route('items.index')
                ->with('flash_message', 'updated successfully');

    }

    /*
    *   removes an existing item
    */
    public function destroy($id)
    {
        try {
            $item = $this->item->repository->find($id);
        } catch (\Exception $e) {
            return back()
                ->withErrors('something went wrong');
        }

        $this->item->repository->delete($item);
        return back()->with('flash_message', 'successfully deleted');
    }
}
