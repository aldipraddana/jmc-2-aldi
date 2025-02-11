@extends('template')

@section('styles')
    <link rel="stylesheet" href="{{ asset('library/dataTables.css') }}">
@endsection

@section('section')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <b class="fs-5">BARANG MASUK</b>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @csrf
                <div class="table-responsive">
                    <div style="position: absolute;z-index:99;margin-top:11px;display: flex;">
                        <a href="{{ route('incoming.items.create') }}" class="btn btn-primary">Tambah Data</a>
                        <select name="" class="form-control js--filter-category" id="" style="width: 250px;margin-left:10px">
                            <option value="">Semua Kategori</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table class="js--table-incoming-item table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Action</th>
                                <th>Tanggal</th>
                                <th>Asal Barang</th>
                                <th>Penerima</th>
                                <th>Unit</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style="display: none">Kategori</th>
                                <th style="display: none">Sub Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $previousItemId = null;
                            @endphp
                            @foreach ($incomingItems as $item)
                               <tr>
                                    <td class="text-center">
                                        @if ($loop->iteration == 1 || $item->item_header_id != $previousItemId)
                                            {{ $no++ }}
                                        @else
                                           <span style="color: transparent"> {{ $no }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($loop->iteration == 1 || $item->item_header_id != $previousItemId)
                                            <div style="display: flex;justify-content: center;">
                                                @if ($item->itemHeader->created_by == Auth::user()->id)
                                                <div>
                                                    <a href="{{ route('incoming.items.edit', Crypt::encrypt($item->item_header_id)) }}" class="btn btn-primary">Edit</a>
                                                </div>
                                                <div style="margin-left: 5px;">
                                                    <form action="{{ route('incoming.items.destroy', Crypt::encrypt($item->item_header_id)) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                                @endif
                                                <div style="margin-left: 5px;">
                                                    <a href="{{ route('incoming.items.pdf', Crypt::encrypt($item->item_header_id)) }}" target="_blank" class="btn btn-success">Print</a>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($loop->iteration == 1 || $item->item_header_id != $previousItemId)
                                            {{ $item->itemHeader->created_at }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($loop->iteration == 1 || $item->item_header_id != $previousItemId)
                                            {{ $item->itemHeader->item_source }}
                                        @else
                                            <span style="color: transparent">{{ $item->itemHeader->item_source }}</span>
                                         @endif
                                    </td>
                                    <td>
                                        @if ($loop->iteration == 1 || $item->item_header_id != $previousItemId)
                                            {{ strtoupper($item->itemHeader->createdBy->name) }}
                                        @endif
                                    </td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->itemHeader->category->category_code.str_pad($item->id, 5, '0', STR_PAD_LEFT); }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ number_format($item->price) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price*$item->quantity) }}</td>
                                    <td>
                                        @if (Auth::user()->role == 'admin' && $item->status == 'pending')
                                            <form action="{{ route('incoming.items.update.status', Crypt::encrypt($item->id)) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memverifikasi data ini?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                        @else
                                            <b>{{ strtoupper($item->status) }}</b>
                                        @endif
                                    </td>
                                    <td style="display: none">{{ $item->itemHeader->category->category_name }}</td>
                                    <td style="display: none">{{ $item->itemHeader->sub_category_id }}</td>
                               </tr>
                               @php
                                   $previousItemId = $item->item_header_id;
                               @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('library/dataTables.js') }}"></script>
    <script src="{{ asset('js/incoming-item.js?time='.time()) }}"></script>
@endsection 