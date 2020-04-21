<?php

namespace App\Http\Controllers;

use App\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class RealEstateController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $items = RealEstate::orderBy('price')->get();

        return view('realestate.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {

        $json = $request->get('json', '[]');

        $items = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back();
        }

        if (empty($items)) {
            return redirect()->back();
        }

        foreach ($items as $item) {

            $realEstate = RealEstate::where('external_id', Arr::get($item, 'id'))->first();

            $price = Str::replaceFirst('.', '', Arr::get($item, 'price'));

            if (is_null($realEstate)) {
                RealEstate::create([
                    'external_id' => Arr::get($item, 'id'),
                    'title' => Arr::get($item, 'title'),
                    'link' => Arr::get($item, 'link'),
                    'prices' => [$price => date('d.m.Y')],
                    'price' => $price,
                    'image' => Arr::get($item, 'image'),
                    'data' => $json,
                ]);
            } else {
                if ($realEstate->price != $price) {
                    $realEstate->price = $price;
                    $realEstate->prices = Arr::add($realEstate->prices, $price, date('d.m.Y'));
                    $realEstate->save();
                }
            }

        }

        return redirect()->back();
    }
}
