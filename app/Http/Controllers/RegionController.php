<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function index(Region $region)
    {
        return view('regions/index')->with(['facilities' => $region->getByRegion()]);
    }
}
