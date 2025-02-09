@extends('template')

@section('section')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <b class="fs-5">INFORMASI UMUM</b>
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
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="form-label">Operator</label>
                            <select name="operator" class="form-control" id="">
                                <option value="">Pilih Operator</option>
                                @foreach ($operator as $item)
                                    <option value="{{ $item->id }}">{{ strtoupper($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Kategori</label>
                            <select name="category" class="form-control" id="" data-url="{{ route('sub-category') }}/category/">
                                <option value="">Pilih Kategori</option>
                                @foreach ($category as $item)
                                    <option value="{{ Crypt::encrypt($item->id) }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Sub Kategori</label>
                            <select name="sub_category" class="form-control" id="">
                                <option value="">Pilih Sub Kategori</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Batas Harga</label>
                            <input type="text" class="form-control js--money js--price-limit" readonly autocomplete="off" id="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-8">
                            <label for="" class="form-label">Asal Barang</label>
                            <input type="text" name="item_source" class="form-control" autocomplete="off" placeholder="Silakan input disini..." name="origin" id="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" placeholder="Silakan input disini..." name="reverence_number" max="100">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Lampiran <small style="color: brown">*.doc,.docx,.zip</small></label>
                            <input type="file" class="form-control" name="attachment" id="" accept=".doc,.docx,.zip">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <b class="fs-5">INFORMASI BARANG</b>
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
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" name="item_name[]" placeholder="Silakan input disini..." id="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control js--money js--price" placeholder="Silakan input disini..." name="price[]" id="">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control js--quantity" placeholder="Silakan input disini..." name="quantity[]" id="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Silakan input disini..." name="unit[]" id="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control js--total-price" readonly id="">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="expired_date" id="">
                                                </td>
                                                <td class="text-center js--incoming-items-action">
                                                    <button type="button" class="btn btn-outline-secondary js--add-item" style="padding-bottom: 0"><i class="lni lni-plus" style="font-size: 21px;"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="" class="btn btn-default btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary js--submit-form" disabled style="margin-left: 7px">Simpan</button>
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