@extends('auths.layouts.app')
@section('title', 'Penlok - PTSL')
@section('content')
	    <div class="x_panel">
	      <div class="x_title">
	        <h2>Data<small><i>Penlok</i></small></h2>
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
	              <th>Desa</th>
	              <th>Jumlah Persil</th>
	              <th>No. SK Penlok</th>
	              <th>Tanggal SK Penlok</th>
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
	@include('auths.penlok.modals.form')
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
	            url: SITEURL + 'penlok/' + id,
	            success: function(data){
	            	var table = $('#datatable_responsive').DataTable();
	        		table.ajax.reload(null, false);
	            }
	        });
		}
	}

	function editRecord(id) {
  		$(document).on('click', '.btn-edit', function() {
  			$('.modal-title').text('Form Ubah Penlok')
        	$('.f-add').modal('show');
        	$('.add').hide();
            $('.update').show();
    	});

    	$.ajax({
            type: 'GET',
            url: SITEURL + "json/penlok/" + id,

            success: function(data) {
                $('.modal-title').text('Form Ubah Penlok')
	        	$('.f-add').modal('show');
	        	$('#proyek_id').val(data.proyek_id).trigger('change')
	        	$('#desa_id').val(data.desa_id).trigger('change')
	        	$('#jumlah_persil').val(data.jumlah_persil)
	        	$('#no_sk_penlok').val(data.no_sk_penlok)
	        	$('#tanggal_sk_penlok').val(data.tanggal_sk_penlok)
	        	$('.add').hide();
            	$('.update').show();

            	var clickHandler = function(e){
			        $.ajax({
			            type: 'PUT',
			            url: SITEURL + "penlok/" + id,
			            cache : false,
			            data: {
					        'proyek_id' : parseInt($('#proyek_id').val()),
					        'desa_id' : parseInt($('#desa_id').val()),
		                    'jumlah_persil' : $('#jumlah_persil').val(),
					        'no_sk_penlok' : $('#no_sk_penlok').val(),
					        'tanggal_sk_penlok' : $('#tanggal_sk_penlok').val(),
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

		$('#tanggal_sk_penlok').datetimepicker({
	        format: 'YYYY-MM-DD'
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
				url: SITEURL + "json/penlok",
			},

			columns: [
			      { data: 'id', name: 'id', 'visible': true },
			      { data: 'proyek_id', name: 'proyek_id' },
			      { data: 'desa_id', name: 'desa_id' },
			      { data: 'jumlah_persil', name: 'jumlah_persil' },
			      { data: 'no_sk_penlok', name: 'no_sk_penlok' },
			      { data: 'tanggal_sk_penlok', name: 'tanggal_sk_penlok' },
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
  			$('.modal-title').text('Form Tambah Penlok')
        	$('.f-add').modal('show');
        	$('.add').show();
            $('.update').hide();
    	});

	    $('.modal-footer').on('click', '.add', function() {
	        var proyek_id = $('#proyek_id').val();
	        var desa_id = $('#desa_id').val();
	        var jumlah_persil = $('#jumlah_persil').val();
	        var no_sk_penlok = $('#no_sk_penlok').val();
	        var tanggal_sk_penlok = $('#tanggal_sk_penlok').val();
	        var data = new FormData();
	        data.append('proyek_id', proyek_id);
	        data.append('desa_id', desa_id);
	        data.append('jumlah_persil', jumlah_persil);
	        data.append('no_sk_penlok', no_sk_penlok);
	        data.append('tanggal_sk_penlok', tanggal_sk_penlok);

	        $.ajaxSetup({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    }
			});

	        $.ajax({
	            type: 'POST',
	            url: SITEURL + "penlok",
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
