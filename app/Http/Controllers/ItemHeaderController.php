<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemHeaderController extends Controller
{
    public function index()
    {
        return view('incoming-items/index', [
            'menu' => 'Barang Masuk',
        ]);
    }
}
