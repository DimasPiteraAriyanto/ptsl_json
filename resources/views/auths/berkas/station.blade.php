@extends('auths.layouts.app')
@section('title', 'Pemberkasan - PTSL')
@section('content')
    <div class="x_panel">
		<div class="x_content">
			<div class="x_title">
				<h2>Dokumen<small><i>Pemberkasan</i></small></h2>
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
							<th>No</th>
							<th>Tipe</th>
							<th>Nomor</th>
							<th>Proses</th>
							</tr>
							</thead>
							<tbody>
								@foreach($dokumen as $dk => $d)
									<tr>
										<td>{{$dk}}</td>
										<td>{{$d}}</td>
										<td>-</td>
										<td>
											<a href="{{url()->current().'/'.$dk}}" class="btn btn-info btn-sm btn-view" style="padding-top:1px !important; padding-bottom:1px !important;"><i class="fa fa-search"></i></a>
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
@endsection
@section('scripts')
<script>
  	var SITEURL = "{{URL::to('').'/'.config('app.root').'/'}}";

	$(document).ready( function () {
		$('.select2').select2({
		      theme: "classic",
		      maximumSelectionLength: 1,
		});

		$('#tanggal').datetimepicker({
	        format: 'YYYY-MM-DD'
	    });

	    $('.form-group').on('click', '.btn-success', function() {
	    	if($("#proyek_id").val() == null) {
	    		alert("Nama Proyek tidak boleh kosong");
	    		$("#proyek_id").focus();
	    	} else if($("#desa_id").val() == null) {
	    		alert("Desa tidak boleh kosong");
	    		$("#desa_id").focus();
	    	} else if($("#tahun").val() == null) {
	    		alert("Tahun tidak boleh kosong");
	    		$("#tahun").focus();
	    	}else{
	    		$("#datatable_responsive").dataTable().fnDestroy();
		    	$.ajaxSetup({
					headers: {
				        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				    }
				});

				$('#datatable_responsive').DataTable({
		        	responsive: true,
					processing: false,
					serverSide: true,
					ajax: {
						type: 'POST',
						url: SITEURL + "berkas",
						data : {
				            "proyek_id" : $("#proyek_id").val(),
				            "desa_id" : $("#desa_id").val(),
				            "tahun" : $("#tahun").val(),
				            "no_berkas" : $("#no_berkas").val(),
				        },
					},

					columns: [
					      { data: 'id', name: 'id', 'visible': false },
					      { data: 'no_berkas', name: 'no_berkas' },
					      { data: 'nub', name: 'nub' },
					      { data: 'nama_pemohon', name: 'nama_pemohon' },
					      { data: 'nik', name: 'nik' },
					      { data: 'no_alas_hak', name: 'no_alas_hak' },
					      { data: 'tanggal_alas_hak', name: 'tanggal_alas_hak' },
					      { data: 'luas_pengukuran', name: 'luas_pengukuran' },
					      { data: 'luas_yang_dimohon', name: 'luas_yang_dimohon' },
					      { data: 'klaster', name: 'klaster' },
					      { data: 'no_hp', name: 'no_hp' },
					      { data: 'status_surat', name: 'status_surat' },
					      { 	data: 'id',
			                    name: 'action',
			                    orderable: false,
			                    searchable: false,
			                    "render": function ( data, type, row, meta ) {
									return '<a href="{{route("berkas")."/"}}' + data + '/' + row.no_berkas + '" class="btn btn-info btn-sm btn-search" style="padding-top:1px !important; padding-bottom:1px !important;" onclick="editRecord(this.id);"><i class="fa fa-search"></i></a>'
			                    }
		                  },
					],

					order: [[1, 'asc']]
				});

	    	}
	    });
	});
</script>
@endsection
