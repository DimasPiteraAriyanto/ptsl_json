<!DOCTYPE html>
<html>
<head>
	<title>Entri Ahli Waris</title>
	<meta name="_token" content="{{ csrf_token() }}"/>
	<!-- Bootstrap -->
    <link href="{{ asset('dashboard/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('dashboard/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('dashboard/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('dashboard/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('dashboard/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('dashboard/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('dashboard/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!-- Custom Theme Style -->
    <link href="{{ asset('dashboard/build/css/custom.min.css') }}" rel="stylesheet">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('dashboard/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- bootstrap-datetimepicker -->
    <link href="{{ asset('dashboard/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('dashboard/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
</head>
<body style="background-color: #FFF">
	<div class="container" onBlur="self.focus();">
		<input type="hidden" name="pid" id="pid" value="{{$pid}}">
        <input type="hidden" name="nob" id="nob" value="{{$nob}}">
        <input type="hidden" name="doc" id="doc" value="{{$doc}}">
        <input type="hidden" name="session" id="session" value="{{Request::segment(6)}}">
		<div class="col-sm-12">
	      <div class="card-box table-responsive">
	      	<button class="btn btn-success btn-sm m-add" data-toggle="modal" data-target=".bs-example-modal-lg" style="float: right; margin-bottom: 2px; margin-top: 2px;">Tambah Baru</button>
	        <table id="datatable_responsive" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th>ID</th>
	              <th>Nama Ahli Waris</th>
	              <th>NIK</th>
	              <th>No. Telp</th>
	              <th>Alamat</th>
	              <th>Proses</th>
	            </tr>
	          </thead>
	          <tbody>
            	
	          </tbody>
	        </table>
	      </div>
	    </div>
	</div>
	@include('auths.ahli-waris.form')
</body>
<!-- jQuery -->
    <script src="{{ asset('dashboard/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('dashboard/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('dashboard/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('dashboard/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('dashboard/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('dashboard/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <!-- Flot plugins -->
    <script src="{{ asset('dashboard/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('dashboard/vendors/DateJS/build/date.js') }}"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('dashboard/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Select2 -->
    <script src="{{asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{asset('dashboard/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
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
	            url: SITEURL + 'ahli-waris/' + id,
	            success: function(data){
	            	console.log(data)
	            	var table = $('#datatable_responsive').DataTable(); 
	        		table.ajax.reload(null, false);
	            }
	        });
		}
	}

	function inputRecord(id) {
  		var result = confirm("Apakah anda yakin?");
  		if(result == true){
  			$.ajaxSetup({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    }
			});

			$.ajax({
	            type: 'POST',
	            url: SITEURL + 'entri-ahli-waris',
	            data: {
                    'id' : id,
                    'session' : $('#session').val(),
                },
	            success: function(data){
	            	console.log(data)
	            	window.close();
	            }
	        });
  		}
	}

	function editRecord(id) {
  		$(document).on('click', '.btn-edit', function() {
  			$('.modal-title').text('Form Ubah Ahli Waris')
        	$('.f-add').modal('show');
        	$('.add').hide();
            $('.update').show();
    	});

    	$.ajax({
            type: 'GET',
            url: SITEURL + "json/ahli-waris/" + id,
            
            success: function(data) {
                $('.modal-title').text('Form Ubah Ahli Waris')
	        	$('.f-add').modal('show');
	        	$('#nik').val(data.nik)
	        	$('#no_telp').val(data.no_telp)
	        	$('#nama_ahli_waris').val(data.nama_ahli_waris)
	        	$('#tempat_lahir').val(data.tempat_lahir)
	        	$('#tanggal_lahir').val(data.tanggal_lahir)
	        	$('#pekerjaan').val(data.pekerjaan)
	        	$('#agama').val(data.agama)
	        	$('#jenis_kelamin').val(data.jenis_kelamin).trigger('change')
	        	$('#desa').val(data.desa)
	        	$('#kecamatan').val(data.kecamatan)
	        	$('#kabupaten').val(data.kabupaten)
	        	$('.add').hide();
            	$('.update').show();

            	var clickHandler = function(e){
			        $.ajax({
			            type: 'PUT',
			            url: SITEURL + "ahli-waris/" + id,
			            cache : false,
			            data: {
		                    'nik' : $('#nik').val(),
		                    'no_telp' : $('#no_telp').val(),
		                    'nama_ahli_waris' : $('#nama_ahli_waris').val(),
		                    'tempat_lahir' : $('#tempat_lahir').val(),
		                    'tanggal_lahir' : $('#tanggal_lahir').val(),
		                    'pekerjaan' : $('#pekerjaan').val(),
		                    'agama' : $('#agama').val(),
		                    'jenis_kelamin' : parseInt($('#jenis_kelamin').val()),
		                    'desa' : $('#desa').val(),
		                    'kecamatan' : $('#kecamatan').val(),
		                    'kabupaten' : $('#kabupaten').val(),
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
				url: SITEURL + "json/ahli-waris",
			},

			columns: [
			      { data: 'id', name: 'id', 'visible': true },
			      { data: 'nama_ahli_waris', name: 'nama_ahli_waris' },
			      { data: 'nik', name: 'nik' },
			      { data: 'no_telp', name: 'no_telp' },
			      { data: 'alamat', name: 'alamat' },
			      { 	data: 'id', 
	                    name: 'action',
	                    orderable: false,
	                    searchable: false,
	                    "render": function ( data, type, row, meta ) { 
							return '<button type="button" class="btn btn-warning btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="inputRecord(this.id);"><i class="fa fa-sign-in"></i></button><button type="button" id="'+data+'" class="btn btn-info btn-sm btn-edit" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="editRecord(this.id);"><i class="fa fa-pencil-square-o"></i><button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="deleteRecord(this.id);"><i class="fa fa-trash-o"></i></button>'
	                    }
                  },
			],

			order: [[0, 'asc']]
		});

		$(document).on('click', '.m-add', function() {
			$('.select2').val('').trigger("change");
            $('#form-add')[0].reset();
            $('.f-add').modal('hide');
  			$('.modal-title').text('Form Tambah Ahli Waris')
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
	        var nama_ahli_waris = $('#nama_ahli_waris').val();
	        var tempat_lahir = $('#tempat_lahir').val();
	        var tanggal_lahir = $('#tanggal_lahir').val();
	        var pekerjaan = $('#pekerjaan').val();
	        var agama = $('#agama').val();
	        var jenis_kelamin = $('#jenis_kelamin').val();
	        var desa = $('#desa').val();
	        var kecamatan = $('#kecamatan').val();
	        var kabupaten = $('#kabupaten').val();
	        var data = new FormData();
	        data.append('pid', pid);
	        data.append('nob', nob);
	        data.append('doc', doc);
	        data.append('nik', nik);
	        data.append('no_telp', no_telp);
	        data.append('nama_ahli_waris', nama_ahli_waris);
	        data.append('tempat_lahir', tempat_lahir);
	        data.append('tanggal_lahir', tanggal_lahir);
	        data.append('pekerjaan', pekerjaan);
	        data.append('agama', agama);
	        data.append('jenis_kelamin', jenis_kelamin);
	        data.append('desa', desa);
	        data.append('kecamatan', kecamatan);
	        data.append('kabupaten', kabupaten);

	        $.ajaxSetup({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    }
			});

	        $.ajax({
	            type: 'POST',
	            url: SITEURL + "ahli-waris",
	            cache       : false,
	            contentType : false,
	            processData : false,
	            data: data,
	            success: function(data) {
	            	console.log(data)
	                $('.select2').val('').trigger("change");
	                $('#form-add')[0].reset();
	                $('.f-add').modal('hide');
	                tableData.ajax.reload();
	            },
	        });
	    });
	});
</script>
</html>