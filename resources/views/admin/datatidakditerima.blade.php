@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
        <h1>{{$data['title']}}</h1>
    </div>
    <div class="section-body">
        <div class="card shadow-sm">
            <div class="card-body">
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama Pelamar</th>
                            <th>Posisi Lowongan</th>
                            <th>Email</th>
                            <th>Alasan Penolakan</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data_pendaftaran'] as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td><strong>{{ $item->nama_lowongan ?? 'Magang Reguler' }}</strong></td>
                                <td>{{ $item->email }}</td>
                                <td><span class="text-muted small">{{ Str::limit($item->keterangan, 50) }}</span></td>
                                <td class="text-center">
                                    <a href="{{ url('detail-pendaftaran/'.$item->id_pendaftaran) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
