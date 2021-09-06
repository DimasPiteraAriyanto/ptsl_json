@extends('auths.layouts.app')
@section('title', 'Data Proyek - PTSL')
@section('content')
	    <div class="x_panel">
	      <div class="x_title">
	        <h2>Data<small><i>Proyek</i></small></h2>
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
	              <th>Tahun</th>
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
	@include('auths.proyek.modals.form')
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
	            url: SITEURL + 'proyek/' + id,
	            success: function(data){
	            	var table = $('#datatable_responsive').DataTable();
	        		table.ajax.reload(null, false);
	            }
	        });
		}
	}

	function editRecord(id) {
  		$(document).on('click', '.btn-edit', function() {
  			$('.modal-title').text('Form Ubah Proyek')
        	$('.f-add').modal('show');
        	$('#nama_proyek').val($(".btn-info").data('proyek_id'))
        	$('#tahun').val($(".btn-info").data('tahun'))
        	$('.add').hide();
            $('.update').show();
    	});

    	$.ajax({
            type: 'GET',
            url: SITEURL + "json/proyek/" + id,

            success: function(data) {
                $('.modal-title').text('Form Ubah Proyek')
	        	$('.f-add').modal('show');
	        	$('#nama_proyek').val(data.nama_proyek)
	        	$('#tahun').val(data.tahun)
	        	$('.add').hide();
            	$('.update').show();

            	var clickHandler = function(e){
			        $.ajax({
			            type: 'PUT',
			            url: SITEURL + "proyek/" + id,
			            cache : false,
			            data: {
					        'nama_proyek' : $('#nama_proyek').val(),
					        'tahun' : $('#tahun').val(),
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
				url: SITEURL + "json/proyek",
			},

			columns: [
			      { data: 'id', name: 'id', 'visible': true },
			      { data: 'nama_proyek', name: 'nama_proyek' },
			      { data: 'tahun', name: 'tahun' },
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
  			$('.modal-title').text('Form Tambah Proyek')
        	$('.f-add').modal('show');
        	$('.add').show();
            $('.update').hide();
    	});

	    $('.modal-footer').on('click', '.add', function() {
	        var nama_proyek = $('#nama_proyek').val();
	        var tahun = $('#tahun').val();
	        var data = new FormData();
	        data.append('nama_proyek', nama_proyek);
	        data.append('tahun', tahun);

	        $.ajaxSetup({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    }
			});

	        $.ajax({
	            type: 'POST',
	            url: SITEURL + "proyek",
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
