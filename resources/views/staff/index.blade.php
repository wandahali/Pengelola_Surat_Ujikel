@extends('temp.template')

@section('nav')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('deleted'))
        <div class="alert alert-warning" role="alert">{{ Session::get('deleted') }}</div>
    @endif
    <h2 style="color:#756392">Data Staff</h2>

    <a href="{{ route('staff.create') }}" type="button" class="btn"
        style="float: right; margin-bottom: 10px; background-color: #d3d0d0; color:black;">
        Tambah Akun
    </a>

    <div class="container mt-4">
        <form action="" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search_query" class="form-control" placeholder="Search" aria-label="Search Query" aria-describedby="button-search">
                <button class="btn btn-primary" type="submit" id="button-search">Search</button>
            </div>
        </form>
    </div>
    

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($users as $user)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('staff.edit', $user->id) }}" class="btn btn-primary me-3">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $user->id }}">
                            Hapus
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal-{{ $user->id }}"  tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin akan menghapus?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('staff.delete', $user['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection
