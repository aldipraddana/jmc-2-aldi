<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Crypt;

class SubCategoryRepository
{
    public function create(array $data)
    {
        SubCategory::create($data);
    }

    public function all()
    {
        return SubCategory::with('category')
        ->orderBy('category_id', 'asc')
        ->get();
    }

    public function update(array $data, $id)
    {
        $id = Crypt::decrypt($id);
        SubCategory::find($id)->update($data);
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        SubCategory::find($id)->delete();
    }
}