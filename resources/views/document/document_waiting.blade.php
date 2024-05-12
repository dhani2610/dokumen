@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div>
 
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
    @if(session('failed'))
        <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-danger" role="alert">
            <span class="alert-text text-white">
            {{ session('failed') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0 mb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Manage Document</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-3 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myDataTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Created By
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fakultas
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Program Studi
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Document
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Document
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tautan Document
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Keterangan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokumen as $item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $pembuat = App\Models\User::where('id',$item->id_user)->first();
                                        @endphp
                                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->name ?? '-' }}</p>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $fakultas = App\Models\Fakultas::where('id',$pembuat->fakultas)->first();
                                        @endphp
                                        <p class="text-xs font-weight-bold mb-0">{{ $fakultas->fakultas ?? '-' }}</p>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $program = App\Models\ProgramStudi::where('id',$pembuat->program_studi)->first();
                                        @endphp
                                        <p class="text-xs font-weight-bold mb-0">{{ $program->program ?? '-' }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->nama_dokumen }}</p>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $jenis = \App\Models\JenisDokumen::where('id',$item->id_jenis)->first();
                                        @endphp
                                        <p class="text-xs font-weight-bold mb-0">{{ $jenis->jenis ?? '-' }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            <a href="{{ $item->tautan_dokumen }}" target="_blank">
                                                {{ $item->tautan_dokumen }}
                                            </a>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->keterangan }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                            <span class="badge bg-warning" data-bs-toggle="tooltip">Dalam Proses Validasi</span>
                                        @elseif ($item->status == 2)
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-success">Ditolak</span>
                                            <a href="#" type="button" title="Klik untuk lihat reason!" data-bs-toggle="modal" data-bs-target="#reason{{ $item->id }}">
                                                <i class="fas fa-edit	text-secondary"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" type="button" onclick="editStatus('{{$item->status}}')" data-bs-toggle="modal" data-bs-target="#modaledit{{ $item->id }}">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($dokumen as $item2)
<div class="modal fade" id="modaledit{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status {{ $item2->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form text-left" method="POST" action="{{ route('updateStatus',$item2->id) }}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="" required>
                        <option value="2">Diterima</option>
                        <option value="3">Ditolak</option>
                    </select>
                    @error('status')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3 keterangan-div" >
                    <label for="">Keterangan</label> 
                    <textarea name="ket_ditolak" class="form-control" id="" cols="30" rows="10"></textarea>
                @error('reason_non_aktif')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                </div>
        </div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
        </div>
    </div>
    </div>
</div>
@endforeach



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$('.select2').select2();
$('.dropify').dropify();

    $(document).ready(function () {
        $('#myDataTable').DataTable();
    });

    function editStatus(id){
    console.log('====================================');
    console.log(id);
    console.log('====================================');
    // Sembunyikan div saat halaman dimuat
    if (id == 3) {
        $('.keterangan-div').show();
    }else{
        $('.keterangan-div').hide();
    }

    // Tambahkan event listener untuk memantau perubahan pada dropdown
    if ($(this).val() === '3') {
        $('.keterangan-div').show();
    } else {
        $('.keterangan-div').hide();
    }
}

    $(document).ready(function () {
        $('.keterangan-div-create').hide();
        // Tambahkan event listener untuk memantau perubahan pada dropdown
        $('select[name="status"]').change(function() {
            if ($(this).val() === '3') {
                $('.keterangan-div').show();
            } else {
                $('.keterangan-div').hide();
            }
        });

    });
</script>

@endsection