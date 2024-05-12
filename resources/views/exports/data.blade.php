<table style="border: 1px solid black;text-align:center;">
    <thead>
        <tr style="border: 1px solid black;text-align:center;background:orange">
            <td colspan="12" style="text-align:center;"> <b>LAPORAN INPUT DATA DOCUMENT USER</b></td>
        </tr>
        <tr>
            <th style="border: 1px solid black;text-align:center;">NO</th>
            <th style="border: 1px solid black;text-align:center;">User</th>
            <th style="border: 1px solid black;text-align:center;">Stambuk / NIDN</th>
            <th style="border: 1px solid black;text-align:center;">Program Studi</th>
            <th style="border: 1px solid black;text-align:center;">Fakultas</th>
            <th style="border: 1px solid black;text-align:center;">No Handpone</th>
            <th style="border: 1px solid black;text-align:center;">Email</th>
            <th style="border: 1px solid black;text-align:center;">Password</th>
            <th style="border: 1px solid black;text-align:center;">Status Kelengkapan</th>
            <th style="border: 1px solid black;text-align:center;">Nama Document</th>
            <th style="border: 1px solid black;text-align:center;">Jenis Document</th>
            <th style="border: 1px solid black;text-align:center;">Tautan Document</th>
            <th style="border: 1px solid black;text-align:center;">Keterangan</th>
            <th style="border: 1px solid black;text-align:center;">Status</th>
            <th style="border: 1px solid black;text-align:center;">Keterangan Ditolak</th>
        </tr>
    </thead>
    <tbody>
        
        {{-- @php $prev_user = null; $row_span = 0; $noUrut = 1 @endphp --}}

        @php
            $prev_user = null;
            $row_span = 0;
            $noUrut = 1;
            $total_doc = count($data);
            $doc_complete = 0;
            $doc_approved = 0;
        @endphp
        @foreach ($data as $key => $item)
            @php
            
                // Variabel tambahan
                $jumlah_jenis_doc = App\Models\JenisDokumen::get()->count();
                $jumlah_doc_apprv = App\Models\Document::where('id_user',$item->id_user)->where('status',2)->get()->count();
                $pembuat = App\Models\User::where('id', $item->id_user)->first();

                // Mengatur warna latar belakang berdasarkan status dokumen
                $statusKelengkapan = '';
                if ($jumlah_jenis_doc == $jumlah_doc_apprv) {
                    $statusKelengkapan = 'Sudah Lengkap';
                }elseif ($jumlah_doc_apprv < $jumlah_jenis_doc) {
                    $statusKelengkapan = 'Belum Lengkap';
                }else {
                    $statusKelengkapan = 'Tidak Ada Data';
                }
            @endphp
            <tr>
            @if ($prev_user != $pembuat->id)
                @php $row_span = $data->where('id_user', $pembuat->id)->count(); @endphp
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $noUrut++ }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->name ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->stambuk ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        @php
                            $program = App\Models\ProgramStudi::where('id',$pembuat->program_studi)->first();
                        @endphp
                        <p class="text-xs font-weight-bold mb-0">{{ $program->program ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        @php
                            $fakultas = App\Models\Fakultas::where('id',$pembuat->fakultas)->first();
                        @endphp
                        <p class="text-xs font-weight-bold mb-0">{{ $fakultas->fakultas ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->phone ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->email ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->pw_text ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $statusKelengkapan }}</p>
                    </td>
            @endif
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $item->nama_dokumen }}</p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        @php
                            $jenis = \App\Models\JenisDokumen::where('id', $item->id_jenis)->first();
                        @endphp
                        <p class="text-xs font-weight-bold mb-0">{{ $jenis->jenis ?? '-' }}</p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">
                            <a href="{{ $item->tautan_dokumen }}" target="_blank">
                                {{ $item->tautan_dokumen }}
                            </a>
                        </p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $item->keterangan }}</p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        @if ($item->status == 1)
                            <span class="badge bg-warning" data-bs-toggle="tooltip">Dalam Proses Validasi</span>
                        @elseif ($item->status == 2)
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                            <a href="#" type="button" title="Klik untuk lihat reason!" data-bs-toggle="modal" data-bs-target="#reason{{ $item->id }}">
                                <i class="fas fa-edit	text-secondary"></i>
                            </a>
                        @endif
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $item->ket_ditolak }}</p>
                    </td>
            @if ($prev_user != $pembuat->id)
                </tr>
            @endif
            @php $prev_user = $pembuat->id; @endphp
        @endforeach
        @foreach ($dataUserNoData as $userData)
        <tr>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{ $noUrut++ }} </p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{ $userData->name ?? '-' }}</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{ $userData->stambuk ?? '-' }}</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                @php
                    $program = App\Models\ProgramStudi::where('id',$userData->program_studi)->first();
                @endphp
                <p class="text-xs font-weight-bold mb-0">{{ $program->program ?? '-' }}</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                @php
                    $fakultas = App\Models\Fakultas::where('id',$userData->fakultas)->first();
                @endphp
                <p class="text-xs font-weight-bold mb-0">{{ $fakultas->fakultas ?? '-' }}</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{ $userData->phone ?? '-' }}</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{ $userData->email ?? '-' }}</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{ $userData->pw_text ?? '-' }}</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">Tidak Ada Data</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">Tidak Ada Data</p> 
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">Tidak Ada Data</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">Tidak Ada Data</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">Tidak Ada Data</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">Tidak Ada Data</p>
            </td>
            <td style="border: 1px solid black;text-align:center;" class="text-center">
                <p class="text-xs font-weight-bold mb-0">Tidak Ada Data</p>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
