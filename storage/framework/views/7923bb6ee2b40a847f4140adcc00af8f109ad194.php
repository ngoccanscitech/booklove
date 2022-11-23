<?php $__env->startSection('seo'); ?>
<?php
$data_seo = array(
    'title' => 'Đổi mật khẩu | '.Helpers::get_option_minhnn('seo-title-add'),
    'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
    'description' => Helpers::get_option_minhnn('seo-description-add'),
    'og_title' => 'Đổi mật khẩu | '.Helpers::get_option_minhnn('seo-title-add'),
    'og_description' => Helpers::get_option_minhnn('seo-description-add'),
    'og_url' => Request::url(),
    'og_img' => asset('images/logo_seo.png'),
    'current_url' =>Request::url(),
    'current_url_amp' => ''
);
$seo = WebService::getSEO($data_seo);
?>
<?php echo $__env->make('admin.partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Thông tin nhân viên </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
          <li class="breadcrumb-item active">Thông tin nhân viên</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Thông tin nhân viên</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                  <form id="frm-updateinfo-useradmin" action="<?php echo e(route('admin.postChangePassword')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="error-msg"><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- email.ten dang nhap -->
                    <div class="form-group">
                      <label for="post_title">Email/tên đăng nhập</label>
                      <input type="text" class="form-control title_slugify" id="post_title" name="email" placeholder="" value="<?php echo e(Auth::guard('admin')->user()->email); ?>">
                    </div>
                    <!-- ten cua hang -->
                    <div class="form-group">
                      <label for="name">Tên nhân viên</label>
                      <input type="text" class="form-control slug_slugify" id="name" name="name" placeholder="" value="<?php echo e(Auth::guard('admin')->user()->name); ?>">
                    </div>
                    <!-- wrap pass -->
                    <div class="">
                      <div class="form-group">
                        <label for="">Đổi mật khẩu?</label>
                        <input type="checkbox" value="" name="check_pass" id="check_pass" >
                        <input type="hidden" id="check_pass_value" name="check_pass_value" value="off">
                      </div>
                      <div class="wrap-pass">
                      <div class="form-group">
                        <label for="current_password">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" disabled>
                        <small class="error"></small>
                      </div>
                      <div class="form-group">
                        <label for="new_password">Mật khẩu mới</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" disabled>
                      </div>
                      <div class="form-group">
                        <label for="confirm_password">Xác nhận lại mật khẩu</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" disabled>
                      </div>
                    </div>
                    <!-- so dien thoai -->
                    <div class="form-group">
                      <label for="name">Số điện thoại</label>
                      <input type="text" class="form-control slug_slugify" id="phone" name="phone" placeholder="" value="<?php echo e(Auth::guard('admin')->user()->phone); ?>">
                    </div>
                    <!-- dia chi -->
                    <div class="form-group">
                      <label for="name">Địa chỉ</label>
                      <input type="text" class="form-control slug_slugify" id="address" name="address" placeholder="" value="<?php echo e(Auth::guard('admin')->user()->address); ?>">
                    </div>
                   <!--  <div class="form-group">
                      <label for="name">Ảnh đại diện</label>
                      <input type="file" class="form-control slug_slugify" id="avatar" name="avatar" placeholder="" value="">
                    </div> -->
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary" value="Cập nhật">
                    </div>
                  </form>
              </div> <!-- /.card-body -->
            </div><!-- /.card -->
        </div> <!-- /.col -->
      </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</section>
<script>
  jQuery(document).ready(function ($){
    $('input[name="check_pass"]').click(function() {
      let check_pass_length = $('#check_pass:checked').length;
      console.log(check_pass_length);
      if(check_pass_length==1){
        //show pass
        $('#current_password').removeAttr('disabled');
        $('#new_password').removeAttr('disabled');
        $('#confirm_password').removeAttr('disabled');
        $('#check_pass_value').val('on');
      }else{
        //hide pass
        $('#current_password').attr('disabled', 'true');
        $('#new_password').attr('disabled', 'true');
        $('#confirm_password').attr('disabled', 'true');
        $('#check_pass_value').val('off')
      }
      $('.wrap-pass').toggleClass('avtive-wpap-pass');

      //check password equal
      $('#current_password').change(function(){
        var current_password = $(this).val();
        $.ajax({
          type: "get",
          url: admin_url+"/check-password",
            data: {current_password: current_password} ,
            cache: false,
            beforeSend: function() {

            },
            success: function(data){
             console.log(data)
             $('.error').html(data);
            }
        });//ajax
      });

      //validate
      $("#frm-updateinfo-useradmin").validate({
            rules: {
                email: "required",
                name: "required",
                current_password: "required",
                new_password: "required",
                repassword: {
                    equalTo: "#password"
                },
            },
            messages: {
                email: "Nhập email/tên đăng nhập",
                name: "Nhập tên nhân viên",
                current_password: "Nhập mật khẩu hiện tại",
                new_password: "Nhập mật khẩu mới",
                confirm_password: "Mật khẩu không chính xác",
            },

            // errorElement : 'div',
            // errorLabelContainer: '.errorTxt',
            invalidHandler: function(event, validator) {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
            }
        });
      //end validate
    });
  });
  
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<style>
  .wrap-pass{
    display: none;
  }
  .avtive-wpap-pass{
    display: block;
  }
  .error{
    color:#dc3545;
    font-size: 13px;
    font-weight: bold;
  }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expro\Laravel\book-ecommerce\resources\views/admin/change-password.blade.php ENDPATH**/ ?>