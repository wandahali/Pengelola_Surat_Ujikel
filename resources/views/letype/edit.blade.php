@extends('temp.template')

@section('nav')
<div class="mb-2">
    <h4>Data Klasifikasi Surat</h4>
    <a href="/" class="list-group-item-action disabled" tabindex="-1" aria-disabled="true">Home</a>
    /
    <a href="{{ route('letype.index') }}" class="list-group-item-action disabled" tabindex="-1" aria-disabled="true">Data Klasifikasi Surat</a>
    /
    <a href="#" class="list-group-item-action disabled" tabindex="-1" aria-disabled="true">Edit Data Klasifikasi Surat</a>
</div>
<form action="{{ route('letype.update', $types['id']) }}" method="POST" class="card p-5">
    @csrf
    @method('PATCH')

    @if ($errors->any())
        <ul class ="alert alert-danger p-3">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    <div class="mb-3 row">
        <div class="col-sm-10">
            <label for="letter_code" class="col-sm-2 col-form-label">Kode Surat </label>
            <input type="text" class="form-control" id="letter_code" name="letter_code" value="{{ substr($types['letter_code'], 0, -2) }}">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-10">
            <label for="name_type" class="col-sm-2 col-form-label">Klasifikasi Surat </label>
            <input type="text" class="form-control" id="name_type" name="name_type" value="{{ $types['name_type'] }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
</form>
@endsection