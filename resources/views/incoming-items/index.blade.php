@extends('template')

@section('section')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <b class="fs-5">INFORMASI UMUM</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="form-label">Operator</label>
                            <select name="operator" class="form-control" id="">
                                <option value="">Pilih Operator</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Kategori</label>
                            <select name="category" class="form-control" id="">
                                <option value="">Pilih Kategori</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Sub Kategori</label>
                            <select name="category" class="form-control" id="">
                                <option value="">Pilih Sub Kategori</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Batas Harga</label>
                            <input type="text" class="form-control js--money" autocomplete="off" placeholder="Silakan input disini" name="price_limit" id="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-8">
                            <label for="" class="form-label">Asal Barang</label>
                            <input type="text" name="item_source" class="form-control" autocomplete="off" placeholder="Silakan input disini" name="origin" id="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" name="reverence_number" max="100">
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
                                                    <input type="text" class="form-control" name="item_name" id="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control js--money" name="price" id="">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="quantity" id="">
                                                </td>
                                                <td>
                                                    <select name="unit" class="form-control" name="unit" id="">
                                                        <option value="">Pilih Satuan</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control js--money" readonly name="total" id="">
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
                            <button type="submit" class="btn btn-primary" style="margin-left: 7px">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/incoming-item.js') }}"></script>
@endsection