<?php

namespace YCodeWebsite\Http\Controllers;

use Illuminate\Http\Request;
use YCodeWebsite\Websites;

class WebsitesController extends Controller
{
    public function getAll() {
        $websites = Websites::all();
        return $websites;
    }

    public function addWebsite(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|unique:websites',
        ]);
        $website = Websites::create($request->all());
        return $website;
    }
}
