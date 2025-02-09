@extends('template')

@section('styles')
    <link rel="stylesheet" href="{{ asset('library/dataTables.css') }}">
@endsection

@section('section')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <b class="fs-5">USER MANAJEMEN</b>
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
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal--add-user" class="btn btn-primary js--add-data-category">Tambah Data</button>
                        <select name="" class="form-control js--filter-role" id="" style="width: 200px;margin-left:10px">
                            <option value="">Tampilkan Semua Role</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                        </select>
                    </div>
                    <table class="js--table-category table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Action</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td style="display: flex;justify-content: center;">
                                        <div>
                                            <button type="button" class="btn btn-primary js--edit-data-user-management" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modal--edit-user" 
                                            data-id="{{ Crypt::encrypt($item->id) }}" 
                                            data-action="{{ route('user-management.update', Crypt::encrypt($item->id)) }}"
                                            data-role="{{ $item->role }}"
                                            data-username="{{ $item->username }}"
                                            data-name="{{ $item->name }}"
                                            data-email="{{ $item->email }}"
                                            >Edit</button>
                                        </div>
                                        @if ($item->role != 'admin')
                                            <div style="margin-left: 5px;">
                                                <form action="{{ route('user-management.lock', Crypt::encrypt($item->id)) }}" onsubmit="return confirm('Apakah Anda yakin?');" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning">{{ $item->lock == 1 ? 'Unlock' : 'Lock' }}</button>
                                                </form>
                                            </div>
                                            <div style="margin-left: 5px;">
                                                <form action="{{ route('user-management.destroy', Crypt::encrypt($item->id)) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal--add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user-management.store') }}" method="POST" class="js--form-user-management">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="alert alert-success" style="display: none" role="alert"></div>
                    <div class="alert alert-danger" style="display: none" role="alert"></div>
                    <div class="mb-3">
                        <label for="" class="form-label">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" autocomplete="off" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" autocomplete="off" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" class="form-control" autocomplete="off" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" autocomplete="off" name="email">
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

<div class="modal fade" id="modal--edit-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" class="js--form-user-management-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="">
                    <div class="alert alert-success" style="display: none" role="alert"></div>
                    <div class="alert alert-danger" style="display: none" role="alert"></div>
                    <div class="mb-3">
                        <label for="" class="form-label">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" autocomplete="off" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" autocomplete="off" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" class="form-control" autocomplete="off" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" autocomplete="off" name="email">
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
    <script src="{{ asset('js/user-management.js?time='.time()) }}"></script>
@endsection 