<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">UBAH DATA BARANG</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">DASHBOARD</a></li>
                           <li class="breadcrumb-item"><a href="<?php echo base_url('barang'); ?>">BARANG</a></li>
                           <li class="breadcrumb-item active">UBAH DATA BARANG</li>
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card" id="card-barang">
                           <div class="card-header">
                              <h3 class="card-title">UBAH DATA BARANG</h3>
                           </div>
                           <div class="card-body">
                              <!-- form start -->
                              <?php foreach ($barang as $value) : ?>
                              <form class="form-horizontal" id="form_barang" action="<?php echo base_url('barang/update/'. $value->id ); ?>" method="POST">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label for="kode_brg" class="col-sm-2 col-form-label">KODE BARANG</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" name="kode_brg" id="kode_brg" value="<?php echo $value->kode_brg; ?>"placeholder="0000000000" readonly>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="nama_brg" class="col-sm-2 col-form-label">NAMA BARANG</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" value="<?php echo $value->nama_brg; ?>" name="nama_brg" id="nama_brg" placeholder="NAMA BARANG">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="stok" class="col-sm-2 col-form-label">STOK</label>
                                       <div class="col-sm-10">
                                          <input type="text" name="stok" value="<?php echo $value->stok; ?>" class="form-control" id="stok_toko">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="harga_beli" class="col-sm-2 col-form-label">HARGA BELI</label>
                                       <div class="col-sm-10">
                                          <input type="text" name="harga_beli" value="<?php echo $value->harga_beli; ?>" class="form-control harga" id="harga_beli">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="harga_jual" class="col-sm-2 col-form-label">HARGA JUAL</label>
                                       <div class="col-sm-10">
                                          <input type="text" name="harga_jual" value="<?php echo $value->harga_jual; ?>" class="form-control harga" id="harga_jual">
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /.card-body -->
                                 <div class="card-footer">
                                    <button type="submit" class="btn btn-info">
                                       <i class="fa fa-save"></i> SIMPAN
                                    </button>
                                    <a href="<?php echo base_url('/barang'); ?>" class="btn btn-default float-right">Cancel</a>
                                 </div>
                                 <!-- /.card-footer -->
                              </form>
                              <!-- / .form -->
                              <?php endforeach; ?>
                           </div>
                           <!-- / .card-body -->
                           <div class="overlay" id="form-loading" style="display: none;"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
                        </div>
                        <!-- /.card -->
                     </div>
                     <!-- /.col-lg-6 -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
<?php
   $this->load->view('v2/dashboard/js');
?>
<script type="text/javascript">
    $(document).ready(function(){

      function btnRemoveGrosir() {
            var removeGrosir = document.querySelectorAll('.remove-grosir-item'); 
            [].forEach.call(removeGrosir, function(elm) {
                $(elm).click(function(){
                    var itemGrosir = $(this).closest('.item-grosir');
                    $(itemGrosir).remove();
                    if ($('.item-grosir').length <= 0) {
                        $('.grosir').html('<p class="text-center grosir-default">Tidak ada data Grosir</p>');
                    }
                });
            });
        }

        function autoSelect() {
            $.each($(".auto_select"), function(i, elm){
                var itemValue = $(this).attr('value');
                if ($(this).hasClass('select2')) {
                    $(this).val(itemValue);
                    $(this).trigger('change');
                } else {
                    $(this).find('option[value='+itemValue+']').attr('selected', true);
                }
            });
        }

        function btnAddGrosir() {
            $('.add-grosir').click(function(){
                if ($('.grosir-default')) {
                    $('.grosir-default').remove();
                }
                $('.grosir').append(
                    '<div class="item-grosir row">'
                        +'<div class="col-md-5 col-sm-6 form-group row">'
                            +'<label class="control-label">Min beli</label>'
                                +'<input type="text" class="col-md-5 form-control" name="grosir[min][]">'
                        +'</div>'
                        +'<div class="col-md-5 col-sm-6 form-group row">'
                            +'<label class="control-label">Harga Grosir</label>'
                                +'<input type="text" class="col-md-8 form-control harga" name="grosir[harga_jual_grosir][]">'
                        +'</div>'
                        +'<div class="col-md-2">'
                            +'<a href="javascript:void(0)" class="btn btn-danger remove-grosir-item">'
                                +'<i class="fa fa-minus-circle"></i>'
                            +'</a>'
                        +'</div>'
                    +'</div>'
                );
                inputMask();
                btnRemoveGrosir();
            });
        }

        function executeAlertMessage(alertMessage = 'wohe', alertType = 'info') {
          var Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            });

          Toast.fire({
            icon: alertType,
            title: alertMessage
          });
        }

        function inputMask() {
            $('.harga').inputmask("numeric", {
                radixPoint: ".",
                groupSeparator: ",",
                digits: 2,
                autoGroup: true,
                prefix: 'Rp ', //No Space, this will truncate the first character
                rightAlign: false,
                oncleared: function () { self.Value(''); }
            });
        }

        function ajax_form() {
          $('#form_barang').on('submit', function(e) {
              e.preventDefault();
              $('#form-loading').show();
              data = $(this).serialize();
              $.ajax({
                  url : $(this).attr('action'),
                  dataType : 'JSON',
                  type : "POST",
                  data : data
              }).done(function(r) {
                  $('#form-loading').hide();
                  console.log(r);
                  if (r.status) {
                      executeAlertMessage(r.message, r.messageType);
                  } else {
                      executeAlertMessage(r.message, r.messageType);
                  }
              }).fail(function() {
                  $('#form-loading').hide();
              });
          });
        }

        function ajax_get_list_jenis() {
            $('#select-kategori').on('select2:select', function (e) {
               var data = e.params.data;
               var id = data.id;
               $.ajax({
                   url : baseUrl+'jenis/get_list_jenis_by_kategori/'+id
               }).done(function(r) {
                  $('.ajax-jenis').html(r);
                  $('#select-jenis').select2();
               }).fail(function(jqXHR, textStatus) {
                  console.log(textStatus);
               });
            });
        }

        function init() {
            $('.select2').select2();
            btnAddGrosir();
            btnRemoveGrosir();
            inputMask();
            ajax_form();
            autoSelect();
            ajax_get_list_jenis();
        }

        init();
    });
</script>