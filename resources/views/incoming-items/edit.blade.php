@extends('template')

{{-- array:14 [▼ // app\Http\Controllers\IncomingItemController.php:44
  "id" => 9
  "user_id" => 3
  "category_id" => 1
  "sub_category_id" => 1
  "item_source" => "ASD"
  "reference_number" => "AS121231"
  "attachment" => "public/attachments/STRUKTUR.docx"
  "created_by" => array:9 [▼
    "id" => 1
    "name" => "aldi"
    "email" => "aldi@aldi.com"
    "email_verified_at" => "2025-02-10T00:29:43.000000Z"
    "role" => "admin"
    "created_at" => "2025-02-10T00:29:44.000000Z"
    "updated_at" => "2025-02-10T00:29:44.000000Z"
    "username" => "admin"
    "lock" => 0
  ]
  "updated_by" => 1
  "created_at" => "2025-02-11T10:19:02.000000Z"
  "updated_at" => "2025-02-11T10:19:02.000000Z"
  "item_body" => array:2 [▼
    0 => array:10 [▼
      "id" => 13
      "item_header_id" => 9
      "item_name" => "12"
      "price" => "231.00"
      "quantity" => 1
      "unit" => "212"
      "expired_date" => null
      "created_at" => "2025-02-11T10:19:02.000000Z"
      "updated_at" => "2025-02-11T10:19:02.000000Z"
      "status" => "pending"
    ]
    1 => array:10 [▼
      "id" => 14
      "item_header_id" => 9
      "item_name" => "S231"
      "price" => "1231.00"
      "quantity" => 1
      "unit" => "1212"
      "expired_date" => null
      "created_at" => "2025-02-11T10:19:02.000000Z"
      "updated_at" => "2025-02-11T10:19:02.000000Z"
      "status" => "pending"
    ]
  ]
  "category" => array:7 [▼
    "id" => 1
    "category_code" => "COMP"
    "category_name" => "COMPUTER"
    "created_by" => 1
    "updated_by" => 1
    "created_at" => "2025-02-11T06:32:11.000000Z"
    "updated_at" => "2025-02-11T06:32:11.000000Z"
  ]
  "sub_category" => array:8 [▼
    "id" => 1
    "category_id" => 1
    "sub_category_name" => "LAPTOP"
    "price_limit" => "5000000.00"
    "created_by" => 1
    "updated_by" => 1
    "created_at" => "2025-02-11T06:32:30.000000Z"
    "updated_at" => "2025-02-11T06:32:30.000000Z"
  ]
] --}}

@section('section')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <b class="fs-5">EDIT INFORMASI UMUM</b>
            </div>
            <div class="card-body">
                <div class="alert alert-success" style="display: none" role="alert"></div>
                <div class="alert alert-danger" style="display: none" role="alert"></div>
                <form action="{{ route('incoming.items.update') }}" class="js--form-submit" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="header_id" value="{{ Crypt::encrypt($data['id']) }}">
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="form-label">Operator</label>
                            @if (Auth::user()->role == 'admin')
                            <select name="operator" class="form-control" id="">
                                <option value="">Pilih Operator</option>
                                @foreach ($operator as $item)
                                    <option value="{{ Crypt::encrypt($item->id) }}" {{ $data['user_id'] == $item->id ? 'selected' : '' }}>{{ strtoupper($item->name) }}</option>
                                @endforeach
                            </select>
                            @else
                                <select name="operator" class="form-control" @readonly(true) id="">
                                    @if ($data['user_id'] == Auth::user()->id)
                                        <option value="{{ Crypt::encrypt(Auth::user()->id) }}" selected>{{ strtoupper(Auth::user()->name) }}</option>
                                    @else
                                        <option value="{{ Crypt::encrypt($data['user_id']) }}" selected>{{ strtoupper($data['created_by']['name']) }}</option>                    
                                    @endif
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Kategori</label>
                            <select name="category" class="form-control" id="" data-url="{{ route('sub-category') }}/category/">
                                <option value="">Pilih Kategori</option>
                                @foreach ($category as $item)
                                    <option value="{{ Crypt::encrypt($item->id) }}" {{ $data['category_id'] == $item->id ? 'selected' : ''}}>{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Sub Kategori</label>
                            <select name="sub_category" class="form-control" id="">
                                <option value="">Pilih Sub Kategori</option>
                                <option value="{{ Crypt::encrypt($data['sub_category']['id']) }}" data-price_limit="{{ $data['sub_category']['price_limit'] }}" selected>{{ $data['sub_category']['sub_category_name'] }}</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Batas Harga</label>
                            <input type="text" class="form-control js--money js--price-limit" readonly autocomplete="off" value="{{ number_format($data['sub_category']['price_limit'], 0, ',', '.') }}" id="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-8">
                            <label for="" class="form-label">Asal Barang</label>
                            <input type="text" name="item_source" class="form-control" autocomplete="off" placeholder="Silakan input disini..." name="origin" id="" value="{{  $data['item_source'] }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" placeholder="Silakan input disini..." name="reverence_number" max="100" value="{{ $data['reference_number'] }}">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Lampiran <small style="color: brown">*.doc,.docx,.zip, .png, .jpg</small></label>
                            <input type="file" class="form-control" name="attachment" id="" accept=".doc,.docx,.zip, .png, .jpg">
                        </div>
                        <div class="col-4">
                            <label for="">Uploaded File</label><br>
                            @if (!empty($data['attachment']))
                                <a href="{{ route('incoming-items.file', $data['attachment']) }}" target="_blank">{{ $data['attachment'] }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <b class="fs-5">EDIT INFORMASI BARANG</b>
                                </div>
                                <div class="card-body">
                                    <table style="width: 100%">
                                        <thead>
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td style="width: 15%">Harga (Rp.)</td>
                                                <td style="width: 10%">Jumlah</td>
                                                <td>Satuan</td>
                                                <td style="width: 15%">Total</td>
                                                <td>Tgl. Expired</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody class="js--incoming-items">
                                            @foreach ($data['item_body'] as $item)
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" name="item_name[]" value="{{ $item['item_name'] }}" placeholder="Silakan input disini..." id="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control js--money js--price" value="{{ number_format($item['price'], 0, ',', '.') }}" placeholder="Silakan input disini..." name="price[]" id="">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control js--quantity" placeholder="Silakan input disini..." value="{{ $item['quantity'] }}" name="quantity[]" id="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Silakan input disini..." value="{{ $item['unit'] }}" name="unit[]" id="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control js--total-price" value="{{ number_format($item['price']*$item['quantity'], 0, ',', '.') }}" readonly id="">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="expired_date[]" value="{{ $item['expired_date'] }}" id="">
                                                </td>
                                                <td class="text-center js--incoming-items-action">
                                                    @if ($loop->iteration == 1)
                                                    <button type="button" class="btn btn-outline-secondary js--add-item" style="padding-bottom: 0"><i class="lni lni-plus" style="font-size: 21px;"></i></button>
                                                    @else
                                                    <button type="button" class="btn btn-danger js--destroy-item" style="padding-bottom: 0">
                                                        <i class="lni lni-xmark" style="font-size: 21px;"></i>
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="{{ route('incoming.items') }}" class="btn btn-default btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary js--submit-form" style="margin-left: 7px">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/incoming-item.js?time='.time()) }}"></script>
@endsection