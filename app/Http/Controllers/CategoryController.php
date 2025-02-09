<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{   
    protected $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function index()
    {
        if (Auth::user()->role == 'operator') {
            return redirect()->route('incoming.items');
        }

        return view('category/index', [
            'menu' => 'Kategori',
            'categories' => $this->categoryRepository->all(),
        ]);
    }
    
    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryRepository->create($request->validated());
            return response()->json(['message' => 'Kategori berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $this->categoryRepository->update($request->validated(), $id);
            return response()->json(['message' => 'Kategori berhasil diubah']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryRepository->delete($id);
            return redirect()->route('category')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('category')->with('error', $e->getMessage());
        }
    }
}
