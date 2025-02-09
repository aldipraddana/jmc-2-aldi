<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\IncomingItemRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\UserRepository;

class IncomingItemController extends Controller
{
    protected $userRepository, $categoryRepository, $subCategoryRepository, $incomingItemRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->categoryRepository = new CategoryRepository(); 
        $this->subCategoryRepository = new SubCategoryRepository();
        $this->incomingItemRepository = new IncomingItemRepository();
    }

    public function index()
    {
        return view('incoming-items/index', [
            'menu' => 'Barang Masuk',
            'operator' => $this->userRepository->operator(),
            'category' => $this->categoryRepository->all(),
        ]);
    }
}
