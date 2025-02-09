@extends('template')

@section('styles')
    <link rel="stylesheet" href="{{ asset('library/dataTables.css') }}">
@endsection

@section('section')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <b class="fs-5">SUB KATEGORI</b>
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
                    <button type="button" style="position: absolute;z-index:99;margin-top:11px" data-bs-toggle="modal" data-bs-target="#modal--add-category" class="btn btn-primary js--add-data-category">Tambah Data</button>
                    <table class="js--table-category table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Action</th>
                                <th>Kategori</th>
                                <th>Sub Kategori Barang</th>
                                <th>Batas Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subCategories as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td style="display: flex;justify-content: center;">
                                        <div>
                                            <button type="button" class="btn btn-primary js--edit-data-sub-category" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modal--edit-category" 
                                            data-id="{{ Crypt::encrypt($item->id) }}" 
                                            data-action="{{ route('sub-category.update', Crypt::encrypt($item->id)) }}"
                                            data-category="{{ $item->category_id }}"
                                            data-sub_category_name="{{ $item->sub_category_name }}"
                                            data-price_limit="{{ (int)$item->price_limit }}">Edit</button>
                                        </div>
                                        <div style="margin-left: 5px;">
                                            <form action="{{ route('sub-category.destroy', Crypt::encrypt($item->id)) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $item->category->category_name }}</td>
                                    <td>{{ $item->sub_category_name }}</td>
                                    <td>{{ number_format($item->price_limit) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal--add-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sub-category.store') }}" method="POST" class="js--form-category">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Sub Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="alert alert-success" style="display: none" role="alert"></div>
                    <div class="alert alert-danger" style="display: none" role="alert"></div>
                    <div class="mb-3">
                        <label for="category_code" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Sub Kategori</label>
                        <input type="text" class="form-control" autocomplete="off" id="" name="sub_category_name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Batas Harga</label>
                        <input type="text" class="form-control js--money" autocomplete="off" name="price_limit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal--edit-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" class="js--form-category">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Edit Sub Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="">
                    <div class="alert alert-success" style="display: none" role="alert"></div>
                    <div class="alert alert-danger" style="display: none" role="alert"></div>
                    <div class="mb-3">
                        <label for="category_code" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Sub Kategori</label>
                        <input type="text" class="form-control" autocomplete="off" id="" name="sub_category_name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Batas Harga</label>
                        <input type="text" class="form-control js--money" autocomplete="off" name="price_limit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('library/dataTables.js') }}"></script>
    <script src="{{ asset('js/category.js?time='.time()) }}"></script>
@endsection 