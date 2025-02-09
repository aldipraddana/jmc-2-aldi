<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryRepository, $categoryRepository;
    public function __construct()
    {
        $this->subCategoryRepository = new SubCategoryRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function index()
    {
        return view('sub-category/index', [
            'menu' => 'Sub Kategori',
            'subCategories' => $this->subCategoryRepository->all(),
            'categories' => $this->categoryRepository->all()
        ]);
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $this->subCategoryRepository->create($request->validated());
            return response()->json(['message' => 'Sub Kategori berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(SubCategoryRequest $request, $id)
    {
        try {
            $this->subCategoryRepository->update($request->validated(), $id);
            return response()->json(['message' => 'Sub Kategori berhasil diubah']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function subCategoryByCategoryId($categoryId) {
        try {
            $subCategories = $this->subCategoryRepository->subCategoryByCategoryId($categoryId);
            return response()->json($subCategories);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->subCategoryRepository->delete($id);
            return redirect()->route('sub-category')->with('success', 'Sub Kategori berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->route('sub-category')->with('error', $e->getMessage());
        }
    }

    
}
