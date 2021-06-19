<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Storage;
use App\Category;
use App\Subcategory;
use File;

class ItemController extends Controller
{
  public function index($id = 0)
  {
    if ($id === 0) {
      $items = \App\Item::notDeleted()->latest()->paginate(30);
    } else {
      $items = \App\Item::where('id', $id)->paginate(30);
    }
    return view('items.add', compact('items'));
  }
  public function store(Request $request, $id = 0)
  {

    if ($id !== 0) {
      $item = Item::find($id);
      $text = "گۆڕانکاریەکە بەسەرکەوتوویی تۆمارکرا کرا";
      $this->validate(
        request(),
        [
          "sale_price" => "required",
          "purchase_price" => "required",
          "name" => "required",
        ]
      );
    } else {
      $item = new Item();
      $text = "مەوادەکە بەسەرکەوتوویی زیاد کرا";
      $this->validate(
        request(),
        [
          "sale_price" => "required",
          "purchase_price" => "required",
          "name" => "required",
          "id" => 'unique:items',

        ]
      );
    }

    if ($request->has('id')) {
      $item->id = request('id');
    }

    $item->code = request('code');
    $item->name = request('name');
    $item->sale_price = request('sale_price');
    $item->purchase_price = request('purchase_price');
    $subcategory = Subcategory::find(request('subcategory_id'));
    $item->subcategory_id = $subcategory->id;
    $item->category_id = $subcategory->category_id;
    $item->supplier_id = request('supplier_id');
    $item->description = request('description');
    $item->color = request('color');
    $item->shewa = request('shewa');
    $item->qomash = request('qomash');
    $item->charm = request('charm');
    $item->gozha = request('gozha');
    $item->status = request('status');
    $item->save();
    \Session::flash('message', $text);
    return redirect('/items/add');
  }

  public function search()
  {
    $id = request('id');
    $searchItems = Item::notDeleted()->where('id', $id)->paginate(15);
    return view('items.add', compact('searchItems'));
  }

  public function searchName()
  {
    $name = request('name');
    $items = Item::notDeleted()->where('name', 'like', '%' . $name . '%')->get();
    return view('items.add', compact('items'));
  }

  public function addCategory()
  {
    $text = request('name');
    DB::table('categories')->insert(['name' => $text]);
    $text = "جۆری مەواد (" . $text . ")زیاد کرا";
    \Session::flash('message', $text);
    return redirect('/items/add');
  }

  public function edit($id)
  {
    $item = Item::find($id);
    $subcategories = Subcategory::with('category')->get();
    $suppliers = \App\Supplier::all();
    return view('items.edit', compact('item', 'subcategories', 'suppliers'));
  }

  public function delete($id)
  {
    $item = Item::find($id);
    $item->update('status', '0');
  }

  public function getItemPrice()
  {
    $item = Item::notDeleted()->find(request('barcode'));

    return json_encode(array("price" => $item->sale_price, "name" => $item->name, "sprice" => $item->sale_price, "stock" => $item->stock()));
  }
  public function getItemPurchasePrice()
  {
    $item = Item::notDeleted()->find(request('barcode'));

    return json_encode(array("price" => $item->purchase_price, "sprice" => $item->sale_price, "name" => $item->name));
  }

  public function mandwbReports(Request $request)
  {
    if ($request->exists('boxes')) {
      $user = \App\User::find($request['user_id']);

      $to = $request['to'];
      $from = $request['from'];

      $items = Item::all();

      return view('reports.mandwbBoxes', compact(['from', 'to', 'items', 'user']));
    }
  }
}
