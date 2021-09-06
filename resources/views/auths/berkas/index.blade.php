@extends('auths.layouts.app')
@section('title', 'Berkas - PTSL')
@section('content')
    <div class="x_panel">
    	<div class="x_title">
			<h2>Informasi Berkas</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<br />
			<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
				@csrf

				<!-- GET MAX PERSIL -->
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
						No. Berkas
					</label>
					<div class="col-md-6 col-sm-6 ">
						<select class="form-control select2" required="required" style="width: 100%" multiple="multiple" id="no_berkas" name="no_berkas">
							@for($i=1; $i<=$max_persil; $i++)
								<option value="{{$i}}">No. Berkas: {{$i}}</option>
							@endfor
						</select>
					</div>
				</div>

				<!-- COMBINE YEARS -->
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
						Tahun
					</label>
					<div class="col-md-6 col-sm-6 ">
						<select class="form-control select2" required="required" style="width: 100%" multiple="multiple" id="tahun" name="tahun">
							@foreach($tahun as $y)
								<option value="{{$y}}">Tahun: {{$y}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
						Nama Proyek
					</label>
					<div class="col-md-6 col-sm-6 ">
						<select class="form-control select2" required="required" style="width: 100%" multiple="multiple" id="proyek_id" name="proyek_id">
							@foreach($proyek as $p)
								<option value="{{$p->id}}">{{$p->nama_proyek}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
						Desa
					</label>
					<div class="col-md-6 col-sm-6 ">
						<select class="form-control select2" required="required" style="width: 100%" multiple="multiple" id="desa_id" name="desa_id">
							@foreach($desa as $d)
								<option value="{{$d->desa_id}}">{{$d->desa->nama_desa}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="ln_solid"></div>
				<div class="item form-group">
					<div class="col-md-6 col-sm-6 offset-md-3">
						<button type="button" class="btn btn-success btn-sm">Cari Berkas</button>
					</div>
				</div>

			</form>
		</div>

		<div class="x_title">
			<h2>Data<small><i>Pemberkasan</i></small></h2>
			<div class="clearfix"></div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card-box table-responsive">
					<table id="datatable_responsive" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
						<th>No</th>
						<th>No. Berkas</th>
						<th>NUB</th>
						<th>Nama Pemohon</th>
						<th>NIK</th>
						<th>No. Alas Hak</th>
						<th>Tanggal Alas Hak</th>
						<th>Luas Pengukuran</th>
						<th>Luas yang Dimohon</th>
						<th>Klaster</th>
						<th>No. Hp</th>
						<th>Status Surat</th>
						<th>Proses</th>
						</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
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
