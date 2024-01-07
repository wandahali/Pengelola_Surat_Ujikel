    @extends('temp.template')

    @section('nav')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Data Surat</h1>
    <p class="mb-4">.</p>
        <form action="{{ route('letter.store') }}" method="POST" class="card p-5">
            @csrf
            @if(Session::get('success'))
                <div class="alert alert-success"> {{ Session::get('success') }} </div>
            @endif
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="row">
                <div class="col">
                    <label for="form-label" for="perihal">Perihal</label>
                <input type="text" class="form-control"  name="letter_perihal">
                </div>
                <div class="col-md-5">
                    <label for="inputState" class="form-label">Klasifikasi Surat</label>
                    <select name="letter_type_id" class="form-select">
                        <option selected disabled hidden>Pilih</option>
                    
                            @foreach ($types as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name_type'] }}</option>
                            @endforeach
                        </select>
                        
                    
                </div>
            </div>
            <div class="mb-3">
                <label for="agenda" class="form-label">Isi Surat</label>
                <textarea id="myeditorinstance" name="content"></textarea>
            </div>
            
        
                <div class="mb-3">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Peserta</th>
                        </tr>
                        <tr>
                            @foreach ($gurus as $item)
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="recipients[]" id="" value="{{ $item->name }}">
                                </div>
                            </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            
                
                <div class="mb-3">
                    <label for="lampiran" class="form-label">Lampiran</label>
                    <input class="form-control" type="file" id="attachment" name="attachment">
                </div>
                <div class="mb-3">
                    <label for="notulis" class="form-label">Notulis</label>
                    <select name="notulis" id="notulis" class="form-select">
                        <option selected disabled hidden>Pilih</option>
                        @foreach ($gurus as $item)
                        <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            
        </form>
    @endsection