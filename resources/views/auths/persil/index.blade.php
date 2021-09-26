@extends('auths.layouts.app')
@section('title', 'Data Persil - PTSL')
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
	@include('auths.persil.modals.form')
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
              url: SITEURL + 'persil/' + id,
              success: function(data){
                  var table = $('#datatable_responsive').DataTable();
                  table.ajax.reload(null, false);
              }
          });
      }
  }

  function editRecord(id) {
        $(document).on('click', '.btn-edit', function() {
            $('.modal-title').text('Form Ubah Persil')
          $('.f-add').modal('show');
          $('.add').hide();
          $('.update').show();
      });

      $.ajax({
          type: 'GET',
          url: SITEURL + "json/persil/" + id,

          success: function(data) {
              $('.modal-title').text('Form Ubah Persil')
              $('.f-add').modal('show');
              $('#pemohon_id').val(data.pemohon_id).trigger('change');
              $('#alas_hak_id').val(data.alas_hak_id).trigger('change');
              $('#nub').val(data.nub)
              $('#luas_pengukuran').val(data.luas_pengukuran)
              $('#penggunaan_tanah').val(data.penggunaan_tanah)
              $('#batas_tanah').val(data.batas_tanah)
              $('#no_pbt').val(data.no_pbt)
              $('#no_gu').val(data.no_gu)
              $('#no_berkas_fisik').val(data.no_berkas_fisik)
              $('#nib').val(data.nib)
              $('#ajudikasi_id').val(data.ajudikasi_id).trigger('change')
              $('.add').hide();
              $('.update').show();

              var clickHandler = function(e){
                  $.ajax({
                      type: 'PUT',
                      url: SITEURL + "persil/" + id,
                      cache : false,
                      data: {
                          'pemohon_id' : parseInt($('#pemohon_id').val()),
                          'alas_hak_id' : parseInt($('#alas_hak_id').val()),
                          'nub' : $('#nub').val(),
                          'luas_pengukuran' : $('#luas_pengukuran').val(),
                          'penggunaan_tanah' : $('#penggunaan_tanah').val(),
                          'batas_tanah' : $('#batas_tanah').val(),
                          'no_pbt' : $('#no_pbt').val(),
                          'no_gu' : parseInt($('#no_gu').val()),
                          'no_berkas_fisik' : $('#no_berkas_fisik').val(),
                          'nib' : $('#nib').val(),
                          'ajudikasi_id' : parseInt($('#ajudikasi_id').val()),
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
              url: SITEURL + "json/persil/" + pid + '/' + nob + '/' + doc,
          },

          columns: [
                { data: 'id', name: 'id', 'visible': true },
                { data: 'alas_hak_id', name: 'alas_hak_id' },
                { data: 'nub', name: 'nub' },
                { data: 'pemohon_id', name: 'pemohon_id' },
                { data: 'nik', name: 'nik' },
                { data: 'pemohon_id', name: 'pemohon_id' },
                { data: 'no_berkas_fisik', name: 'no_berkas_fisik'},
                { data: 'no_pbt', name: 'no_pbt' },
                { data: 'nib', name: 'nib' },
                { data: 'no_gu', name: 'no_gu'},
                { data: 'luas_pengukuran', name: 'luas_pengukuran' },
                { data: 'penggunaan_tanah', name: 'penggunaan_tanah'},
                { data: 'tanda_batas', name: 'tanda_batas'},
                { data: 'ajudikasi_id', name: 'ajudikasi_id'}
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
            $('.modal-title').text('Form Tambah Persil')
          $('.f-add').modal('show');
          $('.add').show();
          $('.update').hide();
      });

      $('.modal-footer').on('click', '.add', function() {
          var pid = $('#pid').val();
          var nob = $('#nob').val();
          var doc = $('#doc').val();
          var pemohon_id = $('#pemohon_id').val();
          var alas_hak_id = $('#alas_hak_id').val();
          var nub = $('#nub').val();
          var luas_pengukuran = $('#luas_pengukuran').val();
          var penggunaan_tanah = $('#penggunaan_tanah').val();
          var tanda_batas = $('#tanda_batas').val();
          var no_pbt = $('#no_pbt').val();
          var no_gu = $('#no_gu').val();
          var no_berkas_fisik = $('#no_berkas_fisik').val();
          var nib = $('#nib').val();
          var ajudikasi_id = $('#ajudikasi_id').val();
          var data = new FormData();
          data.append('pid', pid);
          data.append('nob', nob);
          data.append('doc', doc);
          data.append('pemohon_id', pemohon_id);
          data.append('alas_hak_id', alas_hak_id);
          data.append('nub', nub);
          data.append('luas_pengukuran', luas_pengukuran);
          data.append('penggunaan_tanah', penggunaan_tanah);
          data.append('tanda_batas', tanda_batas);
          data.append('no_pbt', no_pbt);
          data.append('no_gu', no_gu);
          data.append('no_berkas_fisik', no_berkas_fisik);
          data.append('nib', nib);
          data.append('ajudikasi_id', ajudikasi_id);

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });

          $.ajax({
              type: 'POST',
              url: SITEURL + "persil",
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
