<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">TAMBAH DATA USER BARU</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">DASHBOARD</a></li>
                           <li class="breadcrumb-item"><a href="<?php echo base_url('users'); ?>">USER</a></li>
                           <li class="breadcrumb-item active">TAMBAH BARU</li>
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
                        <div class="card" id="card-users">
                           <div class="card-header">
                              <h3 class="card-title">ISI DATA USER</h3>
                           </div>
                           <div class="card-body">
                              <!-- form start -->
                              <form class="form-horizontal" id="form_users" action="<?php echo base_url('users/save'); ?>" method="POST">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label for="name" class="col-sm-4 col-form-label">NAMA USER</label>
                                       <div class="col-sm-8">
                                          <input type="text" class="form-control" name="name" id="name" placeholder="NAMA USER">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="email" class="col-sm-4 col-form-label">EMAIL</label>
                                       <div class="col-sm-8">
                                          <input type="email" class="form-control" name="email" id="email" placeholder="john@dehli.com">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="pass" class="col-sm-4 col-form-label">PASSWORD</label>
                                       <div class="col-sm-8">
                                          <input type="password" class="form-control" name="pass" id="pass">
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /.card-body -->
                                 <div class="card-footer">
                                    <button type="submit" class="btn btn-info">
                                       <i class="fa fa-save"></i> SIMPAN
                                    </button>
                                    <a href="<?php echo base_url('users'); ?>" class="btn btn-default float-right">Cancel</a>
                                 </div>
                                 <!-- /.card-footer -->
                              </form>
                              <!-- / .form -->
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

        function ajax_form() {
          $('#form_users').on('submit', function(e) {
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

        function init() {
            ajax_form();
        }

        init();
    });
</script>