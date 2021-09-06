@extends('auths.layouts.app')
@section('title', 'Data Desa - PTSL')
@section('content')
	    <div class="x_panel">
	      <div class="x_title">
	        <h2>Data<small><i>Desa</i></small></h2>
	        <button class="btn btn-success btn-sm m-add" data-toggle="modal" data-target=".bs-example-modal-lg" style="float: right;">Tambah Baru</button>
	        <div class="clearfix"></div>
	      </div>
	          <div class="row">
	              <div class="col-sm-12">
	                <div class="card-box table-responsive">
	        <table id="datatable_responsive" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th>ID</th>
	              <th>Kecamatan</th>
	              <th>Kode Desa</th>
	              <th>Desa</th>
	              <th>Reje Kampung</th>
	              <th>Camat</th>
	              <th>NIP</th>
	              <th>Alamat</th>
	              <th>Kode Pos</th>
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
	<!-- modals -->
	@include('auths.desa.modals.form')
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
	            url: SITEURL + 'desa/' + id,
	            success: function(data){
	            	var table = $('#datatable_responsive').DataTable();
	        		table.ajax.reload(null, false);
	            }
	        });
		}
	}

	function editRecord(id) {
  		$(document).on('click', '.btn-edit', function() {
  			$('.modal-title').text('Form Ubah Desa')
        	$('.f-add').modal('show');
        	$('#kecamatan_id').val($(".btn-info").data('kecamatan_id'))
        	$('#kode_desa').val($(".btn-info").data('kode_desa'))
        	$('#nama_desa').val($(".btn-info").data('nama_desa'))
        	$('#reje_kampung').val($(".btn-info").data('reje_kampung'))
        	$('#nama_camat').val($(".btn-info").data('nama_camat'))
        	$('#nip').val($(".btn-info").data('nip'))
        	$('#alamat').val($(".btn-info").data('alamat'))
        	$('#kode_pos').val($(".btn-info").data('kode_pos'))
        	$('.add').hide();
            $('.update').show();
    	});

    	$.ajax({
            type: 'GET',
            url: SITEURL + "json/desa/" + id,

            success: function(data) {
                $('.modal-title').text('Form Ubah Desa')
	        	$('.f-add').modal('show');
	        	$('#kecamatan_id').val(data.kecamatan_id).trigger('change')
	        	$('#kode_desa').val(data.kode_desa)
	        	$('#nama_desa').val(data.nama_desa)
	        	$('#reje_kampung').val(data.reje_kampung)
	        	$('#nama_camat').val(data.nama_camat)
	        	$('#nip').val(data.nip)
	        	$('#alamat').val(data.alamat)
	        	$('#kode_pos').val(data.kode_pos)
	        	$('.add').hide();
            	$('.update').show();

            	var clickHandler = function(e){
			        $.ajax({
			            type: 'PUT',
			            url: SITEURL + "desa/" + id,
			            cache : false,
			            data: {
					        'kecamatan_id' : parseInt($('#kecamatan_id').val()),
		                    'kode_desa' : $('#kode_desa').val(),
					        'nama_desa' : $('#nama_desa').val(),
					        'reje_kampung' : $('#reje_kampung').val(),
					        'nama_camat' : $('#nama_camat').val(),
					        'nip' : $('#nip').val(),
					        'alamat' : $('#alamat').val(),
					        'kode_pos' : $('#kode_pos').val(),
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

		$.ajaxSetup({
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		    }
		});

		var tableData = $('#datatable_responsive').DataTable({
        	responsive: true,
			processing: false,
			serverSide: true,
			ajax: {
				type: 'POST',
				url: SITEURL + "json/desa",
			},

			columns: [
			      { data: 'id', name: 'id', 'visible': true },
			      { data: 'kecamatan_id', name: 'kecamatan_id' },
			      { data: 'kode_desa', name: 'kode_desa' },
			      { data: 'nama_desa', name: 'nama_desa' },
			      { data: 'reje_kampung', name: 'reje_kampung' },
			      { data: 'nama_camat', name: 'nama_camat' },
			      { data: 'nip', name: 'nip' },
			      { data: 'alamat', name: 'alamat' },
			      { data: 'kode_pos', name: 'kode_pos' },
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
  			$('.modal-title').text('Form Tambah Desa')
        	$('.f-add').modal('show');
        	$('.add').show();
            $('.update').hide();
    	});

	    $('.modal-footer').on('click', '.add', function() {
	        var kecamatan_id = $('#kecamatan_id').val();
	        var kode_desa = $('#kode_desa').val();
	        var nama_desa = $('#nama_desa').val();
	        var reje_kampung = $('#reje_kampung').val();
	        var nama_camat = $('#nama_camat').val();
	        var nip = $('#nip').val();
	        var alamat = $('#alamat').val();
	        var kode_pos = $('#kode_pos').val();
	        var data = new FormData();
	        data.append('kecamatan_id', kecamatan_id);
	        data.append('kode_desa', kode_desa);
	        data.append('nama_desa', nama_desa);
	        data.append('reje_kampung', reje_kampung);
	        data.append('nama_camat', nama_camat);
	        data.append('nip', nip);
	        data.append('alamat', alamat);
	        data.append('kode_pos', kode_pos);

	        $.ajaxSetup({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    }
			});

	        $.ajax({
	            type: 'POST',
	            url: SITEURL + "desa",
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
