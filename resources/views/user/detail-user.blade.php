@extends('layouts.user_type.auth')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if ($sekertaris->foto != null)
                        <img src="{{ asset('assets/img/foto_user/'. $sekertaris->foto) }}" alt="..." class="w-100 border-radius-lg shadow-sm">
                        @else
                        <img src="../assets/img/blank-logo.png" alt="..." class="w-100 border-radius-lg shadow-sm">
                        @endif
                        {{-- <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $sekertaris->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $sekertaris->role }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        @if ($sekertaris->vidio_diri != null)
                        <iframe src="{{ $sekertaris->vidio_diri }}" frameborder="0"></iframe>
                        @else
                        <span>Sekertaris tersebut Tidak memiliki Vidio diri!</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">

        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/user-profile" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Foto Profile') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">

                                    <input name="foto" type="file" class="dropify" data-height="200" readonly disabled data-max-file-size="500K" data-allowed-file-extensions="jpg png jpeg"    
                                    data-default-file="{{ asset('assets/img/foto_user/'.$sekertaris->foto) }}" value="{{$sekertaris->foto}}" />
                                        @error('foto')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ $sekertaris->name }}" type="text" placeholder="Name" id="user-name" name="name" readonly>
                                        @error('name') 
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ $sekertaris->email }}" type="email" placeholder="@example.com" id="user-email" name="email" readonly>
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($sekertaris->role == 'Agensi' || $sekertaris->role == 'Sekertaris' || $sekertaris->role == 'Customer')
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Bisnis Tipe') }}</label>
                                @php
                                    $tipe_bisnis = App\Models\Bisnis::get();
                                @endphp  
                                <div class="@error('bisnis_tipe')border border-danger rounded-3 @enderror">
                                        <select id="tipe_bisnis" class="form-control" name="bisnis_tipe" required>
                                            <option value="">Pilih Bisnis Tipe</option>
                                            @foreach ($tipe_bisnis as $tb)
                                                <option value="{{ $tb->id }}" {{ $tb->id == $sekertaris->bisnis_tipe ? 'selected' : '' }}>{{ $tb->tipe_bisnis }}</option>
                                            @endforeach
                                        </select>
                                        @error('bisnis_tipe')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Jenis Kelamin') }}</label>
                                <div class="@error('Jenis_Kelamin')border border-danger rounded-3 @enderror">
                                        <select name="jenis_kelamin" class="form-control" id="" required readonly>
                                            <option value="Laki-Laki" {{ $sekertaris->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ $sekertaris->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>

                        @if ($sekertaris->role == 'Sekertaris' || $sekertaris->role == 'Customer')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.phone" class="form-control-label">Vidio Diri (Link Youtube)</label>
                                    <div class="@error('vidio_diri')border border-danger rounded-3 @enderror" >
                                        <input class="form-control" value="{{ $sekertaris->vidio_diri }}" readonly type="text" placeholder="Link Embed Youtube" id="user-email" name="vidio_diri">
                                        @error('vidio_diri')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.phone" class="form-control-label">Linkedin (Link)</label>
                                    <div class="@error('linkedin')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $sekertaris->linkedin }}" readonly type="text" placeholder="Link Linkedin" id="user-email" name="linkedin">
                                        @error('linkedin')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.phone" class="form-control-label">No WhatsApp</label>
                                    <div class="@error('no_wa')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ auth()->user()->no_wa }}" readonly type="number" placeholder="No WhatsApp" id="user-email" name="no_wa">
                                        @error('no_wa')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.phone" class="form-control-label">Tanggal Lahir</label>
                                    <div class="@error('no_wa')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ auth()->user()->no_wa }}" readonly type="date" placeholder="No WhatsApp" id="user-email" name="no_wa">
                                        @error('no_wa')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Tentang Diri') }}</label>
                                <div class="@error('tentang_diri')border border-danger rounded-3 @enderror">
                                        <textarea class="form-control" readonly name="tentang_diri">{{ $sekertaris->tentang_diri }}</textarea>
                                        @error('tentang_diri')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        @endif

                        
                    </div>
                </form>
            </div>
        </div>
        @if (Auth::user()->role == 'Agensi' || Auth::user()->role == 'Sekertaris' )
        <div class="card mt-3">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Referal Base') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ url('referal-update/'.Auth::user()->id) }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Referal Code') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    @php
                                        if (Auth::user()->role == 'Agensi') {
                                            $val = Auth::user()->referal_base;
                                        }else{
                                            $val = Auth::user()->referal_code;
                                        }
                                    @endphp
                                    <input class="form-control"  type="text" placeholder="Referal Code" {{ Auth::user()->referal_base != null || Auth::user()->referal_code != null ? 'readonly' : '' }} id="referal" value="{{ $val }}" name="code_referal">
                                        @error('foto')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror

                                        @if (Auth::user()->referal_base == null || Auth::user()->referal_code == null)
                                            <small id="result-msg"></small>
                                        @endif
                                        <br>
                                        @if ($val == null)
                                            <small style="color: red">*Generate code referal anda untuk pertama kali,code referal tidak bisa di ganti apabila sudah di simpan!</small>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($val == null)
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                    @endif
                  
                </form>

            </div>
        </div>
        @endif
     
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

<script>
$('.dropify').dropify();

// Mendapatkan elemen input
var input = document.getElementById('referal');

// Menambahkan event listener untuk event input
input.addEventListener('input', function(event) {
    // Mendapatkan nilai input
    var value = event.target.value;

    var formData = {
        'referal_base' : value
    }

    $.ajax({
        type: 'GET',
        url: '{{ route("cek-referal") }}',
        data: formData,
        dataType: 'json',
        success: function(data) {
            // Handle respon dari server jika berhasil
            console.log(data);

            var role =  "{{Auth::user()->role}}";

            if (role == 'Agensi' ) {
                if (data.result == 'Tidak Ada') {
                    $('#result-msg').addClass('text-success');
                    $('#result-msg').html('Code Referal Bisa Dipakai');
                }else{
                    $('#result-msg').addClass('text-danger');
                    $('#result-msg').html('Code Referal Sudah Ada');
                }
            }else{
                if (data.result == 'Ada') {
                    $('#result-msg').addClass('text-success');
                    $('#result-msg').html('Code Referal Tersedia : '+data.data.referal_base+ ' ('+data.data.name+')');
                }else{
                    $('#result-msg').addClass('text-danger');
                    $('#result-msg').html('Code Referal Tidak Ada');
                }
            }
        },
        error: function(xhr, status, error) {
            // Handle respon dari server jika terjadi kesalahan
            console.error(xhr.responseText);
        }
    });

    // Menampilkan nilai input di log
    console.log(value);
});
</script>
@endsection 