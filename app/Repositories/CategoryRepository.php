<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Crypt;

class CategoryRepository
{
    public function create(array $data)
    {
        Category::create($data);
    }

    public function all()
    {
        return Category::all();
    }

    public function update(array $data, $id)
    {
        $id = Crypt::decrypt($id);
        Category::find($id)->update($data);
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        Category::find($id)->delete();
    }
}