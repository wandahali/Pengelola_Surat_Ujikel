@extends('temp.template')

@section('nav')
<div class="mb-2">
    <h4>Data Klasifikasi Surat</h4>
    <a href="/" class="list-group-item-action disabled" tabindex="-1" aria-disabled="true">Home</a>
    /
    <a href="{{ route('letype.index') }}" class="list-group-item-action disabled" tabindex="-1" aria-disabled="true">Data Klasifikasi Surat</a>
    /
    <a href="{{ route('letype.create') }}" class="list-group-item-action disabled" tabindex="-1" aria-disabled="true">Tambah Data Klasifikasi Surat</a>
</div>
<form action="{{ route('letype.store') }}" method="POST" class="card p-5">
    @csrf

    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
        
    <div class="mb-3 row">
        <div class="col-sm-10">
            <label for="letter_code" class="col-sm-2 col-form-label">Kode Surat </label>
            <input type="number" class="form-control" id="letter_code" name="letter_code">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-10">
            <label for="name_type" class="col-sm-2 col-form-label">Klasifikasi Surat </label>
            <input type="text" class="form-control" id="name_type" name="name_type" autocomplete="off">
        </div>
    </div>
    <button type="submit" class="btn btn-primary ms-auto mt-3">Tambah</button>
   
</form>
@endsection