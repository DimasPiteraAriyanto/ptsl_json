@extends('auths.layouts.app')
@section('title', 'Dashboard - PTSL')
@section('content')
	    <div class="x_panel">
	    	<div class="x_content">
		      <div class="x_title">
		        <h2>Data<small><i>Persil</i></small></h2>
		        	<button class="btn btn-success btn-sm m-add" data-toggle="modal" data-target=".bs-example-modal-lg" style="float: right;">Tambah Baru</button>
		        	<div class="clearfix"></div>
		      	</div>
		      	<input type="hidden" name="pid" id="pid" value="{{$pid}}">
		      	<input type="hidden" name="nob" id="nob" value="{{$nob}}">
		      	<input type="hidden" name="doc" id="doc" value="{{$doc}}">
		      	<div class="col-md-12" style="margin-bottom: 10px;">
					<h4>{{$penlok->proyek->nama_proyek}}</h4>
					<span class="badge badge-info" style="padding: 8px; margin:1px;">Tahun: {{$penlok->proyek->tahun}}</span>
					<span class="badge badge-secondary" style="padding: 8px; margin:1px;">No. SK Penlok: {{$penlok->no_sk_penlok}}</span>
					<span class="badge badge-warning" style="padding: 8px; margin:1px;">Tanggal SK Penlok: {{$penlok->tanggal_sk_penlok->format('d F Y')}}</span>
					<span class="badge badge-success" style="padding: 8px; margin:1px;">Desa: {{$penlok->desa->nama_desa}}</span>
					<span class="badge badge-danger" style="padding: 8px; margin:1px;">No. Berkas: {{$nob}}</span>
	            </div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card-box table-responsive">
							<table id="datatable_responsive" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Klaster</th>
										<th>NUB</th>
										<th>Nama Pemohon</th>
										<th>NIK</th>
										<th>Alamat Pemohon</th>
										<th>No. Berkas Fisik</th>
										<th>PBT</th>
                                        <th>NIB</th>
                                        <th>Luas Pengukuran</th>
                                        <th>Penggunaan Tanah</th>
                                        <th>Batas Tanah</th>
                                        <th>Nama Petugas Pengukuran</th>
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
		</div>
	<!-- modals -->
	@include('auths.pemohon.modals.form')
	<!-- end Modals -->
@endsection
@section('scripts')
<script>
  	var SITEURL = "{{URL::to('').'/'.config('app.root').'/'}}";

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
	            url: SITEURL + 'pemohon/' + id,
	            success: function(data){
	            	var table = $('#datatable_responsive').DataTable();
	        		table.ajax.reload(null, false);
	            }
	        });
		}
	}

	function editRecord(id) {
  		$(document).on('click', '.btn-edit', function() {
  			$('.modal-title').text('Form Ubah Pemohon')
        	$('.f-add').modal('show');
        	$('.add').hide();
            $('.update').show();
    	});

    	$.ajax({
            type: 'GET',
            url: SITEURL + "json/pemohon/" + id,

            success: function(data) {
                $('.modal-title').text('Form Ubah Pemohon')
	        	$('.f-add').modal('show');
	        	$('#nik').val(data.nik)
	        	$('#no_telp').val(data.no_telp)
	        	$('#nama_pemohon').val(data.nama_pemohon)
	        	$('#tempat_lahir').val(data.tempat_lahir)
	        	$('#tanggal_lahir').val(data.tanggal_lahir)
	        	$('#pekerjaan').val(data.pekerjaan)
	        	$('#agama').val(data.agama)
	        	$('#jenis_kelamin').val(data.jenis_kelamin).trigger('change')
	        	$('#desa').val(data.desa)
	        	$('#kecamatan').val(data.kecamatan)
	        	$('#kabupaten').val(data.kabupaten)
	        	$('#jenis_pemohon').val(data.jenis_pemohon).trigger('change')
	        	$('.add').hide();
            	$('.update').show();

            	var clickHandler = function(e){
			        $.ajax({
			            type: 'PUT',
			            url: SITEURL + "pemohon/" + id,
			            cache : false,
			            data: {
		                    'nik' : $('#nik').val(),
		                    'no_telp' : $('#no_telp').val(),
		                    'nama_pemohon' : $('#nama_pemohon').val(),
		                    'tempat_lahir' : $('#tempat_lahir').val(),
		                    'tanggal_lahir' : $('#tanggal_lahir').val(),
		                    'pekerjaan' : $('#pekerjaan').val(),
		                    'agama' : $('#agama').val(),
		                    'jenis_kelamin' : parseInt($('#jenis_kelamin').val()),
		                    'desa' : $('#desa').val(),
		                    'kecamatan' : $('#kecamatan').val(),
		                    'kabupaten' : $('#kabupaten').val(),
		                    'jenis_pemohon' : parseInt($('#jenis_pemohon').val()),
		                },
			            success: function(data) {
			                console.log(data)
			                tableData = $('#datatable_responsive').DataTable();
			                $('.select2').val('').trigger("change");
			                $('#form-add')[0].reset();
			                $('.f-add').modal('hide');
			                tableData.ajax.reload();
			            },
			        });
			        // Handler Twice Request
			        e.stopImmediatePropagation();
			     	return false;
				}

			    $('.update').one('click', clickHandler);
            },
        });
	}

	$(document).ready( function () {
		$('.select2').select2({
		      theme: "classic",
		      maximumSelectionLength: 1,
		});

		$('#tanggal_lahir').datetimepicker({
	        format: 'YYYY-MM-DD'
	    });

		$.ajaxSetup({
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		    }
		});

		var pid = $("#pid").val();
		var nob = $("#nob").val();
		var doc = $("#doc").val();

		var tableData = $('#datatable_responsive').DataTable({
        	responsive: true,
			processing: false,
			serverSide: true,
			ajax: {
				type: 'POST',
				url: SITEURL + "json/pemohon/" + pid + '/' + nob + '/' + doc,
			},

			columns: [
			      { data: 'id', name: 'id', 'visible': true },
			      { data: 'nama_pemohon', name: 'nama_pemohon' },
			      { data: 'nik', name: 'nik' },
			      { data: 'jenis_pemohon', name: 'jenis_pemohon' },
			      { data: 'no_telp', name: 'no_telp' },
			      { data: 'alamat', name: 'alamat' },
			      { 	data: 'id',
	                    name: 'action',
	                    orderable: false,
	                    searchable: false,
	                    "render": function ( data, type, row, meta ) {
							return '<button type="button" id="'+data+'" class="btn btn-info btn-sm btn-edit" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="editRecord(this.id);"><i class="fa fa-pencil-square-o"></i><button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="deleteRecord(this.id);"><i class="fa fa-trash-o"></i></button>'
	                    }
                  },
			],

			order: [[0, 'asc']]
		});

		$(document).on('click', '.m-add', function() {
			$('.select2').val('').trigger("change");
            $('#form-add')[0].reset();
            $('.f-add').modal('hide');
  			$('.modal-title').text('Form Tambah Pemohon')
        	$('.f-add').modal('show');
        	$('.add').show();
            $('.update').hide();
    	});

	    $('.modal-footer').on('click', '.add', function() {
	        var pid = $('#pid').val();
	        var nob = $('#nob').val();
	        var doc = $('#doc').val();
	        var nik = $('#nik').val();
	        var no_telp = $('#no_telp').val();
	        var nama_pemohon = $('#nama_pemohon').val();
	        var tempat_lahir = $('#tempat_lahir').val();
	        var tanggal_lahir = $('#tanggal_lahir').val();
	        var pekerjaan = $('#pekerjaan').val();
	        var agama = $('#agama').val();
	        var jenis_kelamin = $('#jenis_kelamin').val();
	        var desa = $('#desa').val();
	        var kecamatan = $('#kecamatan').val();
	        var kabupaten = $('#kabupaten').val();
	        var jenis_pemohon = $('#jenis_pemohon').val();
	        var data = new FormData();
	        data.append('pid', pid);
	        data.append('nob', nob);
	        data.append('doc', doc);
	        data.append('nik', nik);
	        data.append('no_telp', no_telp);
	        data.append('nama_pemohon', nama_pemohon);
	        data.append('tempat_lahir', tempat_lahir);
	        data.append('tanggal_lahir', tanggal_lahir);
	        data.append('pekerjaan', pekerjaan);
	        data.append('agama', agama);
	        data.append('jenis_kelamin', jenis_kelamin);
	        data.append('desa', desa);
	        data.append('kecamatan', kecamatan);
	        data.append('kabupaten', kabupaten);
	        data.append('jenis_pemohon', jenis_pemohon);

	        $.ajaxSetup({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    }
			});

	        $.ajax({
	            type: 'POST',
	            url: SITEURL + "pemohon",
	            cache       : false,
	            contentType : false,
	            processData : false,
	            data: data,
	            success: function(data) {
	                $('.select2').val('').trigger("change");
	                $('#form-add')[0].reset();
	                $('.f-add').modal('hide');
	                tableData.ajax.reload();
	            },
	        });
	    });
	});
</script>
@endsection
