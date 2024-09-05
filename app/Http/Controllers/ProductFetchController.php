<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnCallback;

class ProductFetchController extends Controller
{
    public function index()
    {
        return view('product.list');
    }

    public function create()
    {
        return view('product.add');
    }
}