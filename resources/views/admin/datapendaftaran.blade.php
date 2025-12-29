@extends('template_admin.master')
@section('contents')


<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama Pelamar</th>
                            <th>Posisi Lowongan</th>
                            <th>Email</th>
                            <th>No. WhatsApp</th>
                            <th>Tgl Melamar</th>
                            <th>Status</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['data_pendaftaran'] as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->nama_lengkap}}</td>
                                <td><strong>{{ $item->nama_lowongan ?? 'Magang Reguler' }}</strong></td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->no_telp}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-warning">{{ $item->status_pendaftaran }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('detail-pendaftaran/' . $item->id_pendaftaran) }}" class="btn btn-info btn-sm" title="Lihat Detail & Review"><i class="fas fa-eye"></i> Detail</a>
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
