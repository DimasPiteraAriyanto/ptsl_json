@extends('auths.layouts.app')
@section('title', 'Alas-Hak - PTSL')
@section('content')
<div class="x_panel">
	<div class="x_title">
		<h2>Data<small><i>Bukti Alas Hak</i></small></h2>
		<a href="{{url()->current().'/create'}}" class="btn btn-success btn-sm m-add" style="float: right;">Tambah Baru</a>
		<div class="clearfix"></div>
	</div>
	<div class="row">
		<div class="col-md-12" style="margin-bottom: 10px;">
			<h4>{{$penlok->proyek->nama_proyek}}</h4>
			<span class="badge badge-info" style="padding: 8px; margin:1px;">Tahun: {{$penlok->proyek->tahun}}</span>
			<span class="badge badge-secondary" style="padding: 8px; margin:1px;">No. SK Penlok: {{$penlok->no_sk_penlok}}</span>
			<span class="badge badge-warning" style="padding: 8px; margin:1px;">Tanggal SK Penlok: {{$penlok->tanggal_sk_penlok->format('d F Y')}}</span>
			<span class="badge badge-success" style="padding: 8px; margin:1px;">Desa: {{$penlok->desa->nama_desa}}</span>
			<span class="badge badge-danger" style="padding: 8px; margin:1px;">No. Berkas: {{$nob}}</span>
		</div>
		<div class="col-sm-12">
			<div class="card-box table-responsive">
				<table id="datatable_responsive" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama Pemohon</th>
							<th>Jenis Alas Hak</th>
							<th>Nama Alas Hak</th>
							<th>No. Alas Hak</th>
							<th>Tanggal Alas Hak</th>
							<th>Nama Pihak I</th>
							<th>Luas yang Dimohon</th>
							<th>Proses</th>
						</tr>
					</thead>
					<tbody>
						@foreach($alas_hak as $a)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$a->pemohon->nama_pemohon}}</td>
								<td>{{$a->jenis_alas_hak->nama_jenis_alas_hak}}</td>
								<td>{{$a->nama_alas_hak}}</td>
								<td>{{$a->no_alas_hak}}</td>
								<td>{{$a->tanggal_alas_hak}}</td>
								<td>
									{{\App\Models\PihakPertama::where('id', \App\Models\TempPihakPertama::where('session', $a->session)->pluck('pihak_pertama_id')->first())->pluck('nama_pihak_pertama')->first()}}
								</td>
								<td>{{$a->luas_yang_dimohon}}</td>
								<td>
									<a href="{{url()->current()}}/view/{{$a->jenis_alas_hak_id}}/session/{{$a->session}}" class="btn btn-success btn-sm btn-edit" style="padding-top:1px !important; padding-bottom:1px !important;"><i class="fa fa-eye"></i></a>
									<a href="{{url()->current()}}/print/{{$a->id}}" target="_blank" class="btn btn-primary btn-sm btn-print" style="padding-top:1px !important; padding-bottom:1px !important;"><i class="fa fa-print"></i></a>
									<a href="{{url()->current()}}/edit/{{$a->jenis_alas_hak_id}}/session/{{$a->session}}" class="btn btn-info btn-sm btn-edit" style="padding-top:1px !important; padding-bottom:1px !important;"><i class="fa fa-pencil-square-o"></i></a><button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="{{$a->id}}" onclick="deleteRecord(this.id);"><i class="fa fa-trash-o"></i></button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
	$(document).ready( function () {
		$('#datatable_responsive').DataTable();
	});

	var SITEURL = "{{route('alas-hak')}}";

  	function deleteRecord(id) {
  		var result = confirm("Apakah anda yakin?");
  		if(result == true){
	  		$.ajaxSetup({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    }
			});

			$.ajax({
	            type: 'DELETE',
	            url: SITEURL + '/' + id,
	            success: function(data){
	            	window.location.reload();
	            }
	        });
		}
	}
</script>
@endsection
