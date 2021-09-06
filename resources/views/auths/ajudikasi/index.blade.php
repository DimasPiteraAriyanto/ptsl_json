@extends('auths.layouts.app')
@section('title', 'Ajudikasi - PTSL')
@section('content')
	    <div class="x_panel">
	      <div class="x_title">
	        <h2>Data<small><i>Panitia Ajudikasi</i></small></h2>
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
	              <th>Proyek</th>
	              <th>NIP</th>
	              <th>Nama Pegawai</th>
	              <th>Golongan</th>
	              <th>Jabatan</th>
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
	@include('auths.ajudikasi.modals.form')
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
	            url: SITEURL + 'ajudikasi/' + id,
	            success: function(data){
	            	var table = $('#datatable_responsive').DataTable();
	        		table.ajax.reload(null, false);
	            }
	        });
		}
	}

	function editRecord(id) {
  		$(document).on('click', '.btn-edit', function() {
  			$('.modal-title').text('Form Ubah Panitia Ajudikasi')
        	$('.f-add').modal('show');
        	$('#proyek_id').val($(".btn-info").data('proyek_id'))
        	$('#nip').val($(".btn-info").data('nip'))
        	$('#nama_pegawai').val($(".btn-info").data('nama_pegawai'))
        	$('#golongan').val($(".btn-info").data('golongan'))
        	$('#jabatan_ajudikasi').val($(".btn-info").data('jabatan_ajudikasi'))
        	$('.add').hide();
            $('.update').show();
    	});

    	$.ajax({
            type: 'GET',
            url: SITEURL + "json/ajudikasi/" + id,

            success: function(data) {
                $('.modal-title').text('Form Ubah Panitia Ajudikasi')
	        	$('.f-add').modal('show');
	        	$('#proyek_id').val(data.proyek_id).trigger('change')
	        	$('#nip').val(data.nip)
	        	$('#nama_pegawai').val(data.nama_pegawai)
	        	$('#golongan').val(data.golongan)
	        	$('#jabatan_ajudikasi').val(data.jabatan_ajudikasi).trigger('change')
	        	$('.add').hide();
            	$('.update').show();

            	var clickHandler = function(e){
			        $.ajax({
			            type: 'PUT',
			            url: SITEURL + "ajudikasi/" + id,
			            cache : false,
			            data: {
					        'proyek_id' : parseInt($('#proyek_id').val()),
		                    'nip' : $('#nip').val(),
					        'nama_pegawai' : $('#nama_pegawai').val(),
					        'golongan' : $('#golongan').val(),
					        'jabatan_ajudikasi' : parseInt($('#jabatan_ajudikasi').val()),
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
				url: SITEURL + "json/ajudikasi",
			},

			columns: [
			      { data: 'id', name: 'id', 'visible': true },
			      { data: 'proyek_id', name: 'proyek_id' },
			      { data: 'nip', name: 'nip' },
			      { data: 'nama_pegawai', name: 'nama_pegawai' },
			      { data: 'golongan', name: 'golongan' },
			      { data: 'jabatan_ajudikasi', name: 'jabatan_ajudikasi' },
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
  			$('.modal-title').text('Form Tambah Panitia Ajudikasi')
        	$('.f-add').modal('show');
        	$('.add').show();
            $('.update').hide();
    	});

	    $('.modal-footer').on('click', '.add', function() {
	        var proyek_id = $('#proyek_id').val();
	        var nip = $('#nip').val();
	        var nama_pegawai = $('#nama_pegawai').val();
	        var golongan = $('#golongan').val();
	        var jabatan_ajudikasi = $('#jabatan_ajudikasi').val();
	        var data = new FormData();
	        data.append('proyek_id', proyek_id);
	        data.append('nip', nip);
	        data.append('nama_pegawai', nama_pegawai);
	        data.append('golongan', golongan);
	        data.append('jabatan_ajudikasi', jabatan_ajudikasi);

	        $.ajaxSetup({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    }
			});

	        $.ajax({
	            type: 'POST',
	            url: SITEURL + "ajudikasi",
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
