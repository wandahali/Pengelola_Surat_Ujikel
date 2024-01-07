    @extends('temp.template')

    @section('nav')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
            <main class="content px-3 py-2">
            @if (Session::get('cantAccess'))
            <div class="alert alert-danger">{{ Session::get('cantAccess') }}</div>
        @endif
            <div class="container-fluid">
                                    <div class="mb-2">
                        <h4>Dashboard</h4>
                        <h3>Welcome {{ Auth::user()->name }}!</h3>
                        <a href="/" class="list-group-item-action disabled" tabindex="-1" aria-disabled="true"></a>
                        </div>
                        <div class="row">
                            <div class="container px-4 ">
                                <div class="row g-3 my-2 mb-4">
                                    <div class="col-md-7">
                                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                            <div>
                                                <h3 class="fs-2">6</h3>
                                                <p class="fs-5">Surat Keluar</p>
                                            </div>
                                            <i class="ri-bookmark-fill fs-1"></i>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                            <div>
                                                <h3 class="fs-2">{{ count(App\Models\Letter_type::all()) }}</h3>
                                                <p class="fs-5">Klasifikasi Surat</p>
                                            </div>
                                            <i class="ri-bookmark-fill fs-1"></i>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                            <div>
                                                <h3 class="fs-2">{{ count(App\Models\User::where('role', 'guru')->get()) }}</h3>
                                                <p class="fs-5">Guru</p>
                                            </div>
                                            <i class="ri-user-fill fs-1"></i>
                                            </div>
                                    </div>
                                    <div class="col-md-7">
                                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                            <div>
                                                <h3 class="fs-2">{{ count(App\Models\User::where('role', 'staff')->get()) }}</h3>
                                                <p class="fs-5">Staff Tata Usaha</p>
                                            </div>
                                            <i class="ri-user-fill fs-1"></i>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </main>
            
        <script src="/js/srcipt.js"></script>

    @endsection