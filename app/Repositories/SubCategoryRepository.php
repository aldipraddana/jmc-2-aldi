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

    public function subCategoryByCategoryId($id)
    {
        $id = Crypt::decrypt($id);
        $data = SubCategory::select('id', 'sub_category_name', 'price_limit')
        ->where('category_id', $id)->get();

        $data = array_map(function($item) {
            return [
                'id' => Crypt::encrypt($item['id']),
                'sub_category_name' => $item['sub_category_name'],
                'price_limit' => $item['price_limit']
            ];
        }, $data->toArray());
        return $data;
    }
}