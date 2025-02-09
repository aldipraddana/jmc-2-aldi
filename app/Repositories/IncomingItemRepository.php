<?php
namespace App\Repositories;

use App\Models\ItemHeader;
use Illuminate\Support\Facades\Crypt;

class IncomingItemRepository
{
    public function all()
    {
        return ItemHeader::with('itemBody')->get();
    }

    public function create(array $data)
    {
        dd($data);
    }

    public function update(array $data, $id)
    {
        $id = Crypt::decrypt($id);
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
    }
}