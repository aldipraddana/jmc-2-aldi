<?php
namespace App\Repositories;

use App\Models\ItemBody;
use App\Models\ItemHeader;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class IncomingItemRepository
{
    public function all()
    {
        return ItemBody::with(['itemHeader', 'itemHeader.createdBy'])
        ->orderBy('id', 'desc')
        ->get();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            /**
             * save header data
             */
            $header = ItemHeader::create([
                'user_id' => Crypt::decrypt($data['operator']),
                'category_id' => Crypt::decrypt($data['category']),
                'sub_category_id' => Crypt::decrypt($data['sub_category']),
                'item_source' => $data['item_source'],
                'reference_number' => $data['reverence_number'],
            ]);

            /**
             * save body data
             */
            foreach ($data['item_name'] as $key => $value) {
                $data['price'][$key] = str_replace('.', '', $data['price'][$key]);
                $header->itemBody()->create([
                    'item_name' => $value,
                    'price' => $data['price'][$key],
                    'quantity' => $data['quantity'][$key],
                    'unit' => $data['unit'][$key],
                    'expired_date' => $data['expired_date'][$key],
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function updateStatusItem($id)
    {
        $id = Crypt::decrypt($id);
        $data = [
            'status' => 'verified',
        ];
        ItemBody::find($id)->update($data);
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        ItemHeader::find($id)->delete();
    }

    public function find($id)
    {
        $id = Crypt::decrypt($id);
        return ItemHeader::with(['itemBody', 'createdBy', 'category', 'subCategory'])
        ->where('id', $id)
        ->first();
    }
}