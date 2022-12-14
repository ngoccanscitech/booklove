<?php
    extract($data);
    if(isset($category))
        extract($category->toArray());
?>
<?php $__env->startSection('seo'); ?>
<?php
$data_seo = array(
    'title' => $title_head.' | '.Helpers::get_option_minhnn('seo-title-add'),
);
$seo = WebService::getSEO($data_seo);
?>
<?php echo $__env->make('admin.partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2 justify-content-end">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active"><?php echo e($title_head); ?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  	<div class="container-fluid">
        <form action="<?php echo e(route('admin.postCategoryPostDetail')); ?>" method="POST" id="frm-create-category" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo e($id??''); ?>">
    	    <div class="row">
    	      	<div class="col-9">
    	        	<div class="card">
    		          	<div class="card-header">
    		            	<h3 class="card-title"><?php echo e($title_head); ?></h3>
    		          	</div> <!-- /.card-header -->
    		          	<div class="card-body">
                            <!-- show error form -->
                            <div class="errorTxt"></div>
                            <ul class="nav nav-tabs hidden" id="tabLang" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">Ti???ng vi???t</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">Ti???ng Anh</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                    <div class="form-group">
                                        <label for="name">Ti??u ????? th??? lo???i tin</label>
                                        <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Ti??u ?????" value="<?php echo e($name ?? ''); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug th??? lo???i tin</label>
                                        <input type="text" class="form-control slug_slugify" id="slug" name="slug" placeholder="Slug" value="<?php echo e($slug ?? ''); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Tr??ch d???n</label>
                                        <textarea id="description" name="description"><?php echo $description ?? ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="form-group">
                                        <label for="name_en">Title category</label>
                                        <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="<?php echo e($name_en ?? ''); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="description_en">Description category</label>
                                        <textarea id="description_en" name="description_en"><?php echo $description_en?? ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="template_checkID" class="title_txt">Ch???n th??? lo???i Cha</label>
                                <?php
                                    $parent = $parent ?? 0;
                                    $list_cate = App\Model\Category::where('parent', 0)->get();
                                ?>
                                <select class="custom-select mr-2" name="category_parent">
                                    <option value="0">== Kh??ng c?? ==</option>
                                    <?php $__currentLoopData = $list_cate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cate->id); ?>" <?php echo e($parent == $cate->id ? 'selected' : ''); ?>><?php echo e($cate->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post_title">S???p x???p(C??ng l???n c??ng n???m tr??n c??ng)</label>
                                <input type="text" class="form-control" id="sort" name="sort" value="<?php echo e($sort ?? 0); ?>">
                            </div>
                            <?php echo $__env->make('admin.form-seo.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    		        	</div> <!-- /.card-body -->
    	      		</div><!-- /.card -->
    	    	</div> <!-- /.col-9 -->
                <div class="col-3">
                    <?php echo $__env->make('admin.partials.action_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('admin.partials.image', ['title'=>'H??nh ???nh', 'id'=>'img', 'name'=>'image', 'image'=> ($image ?? '')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('admin.partials.image', ['title'=>'Banner', 'id'=>'cover-img', 'name'=>'cover', 'image'=>($cover ?? '')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div> <!-- /.col-9 -->
    	  	</div> <!-- /.row -->
        </form>
  	</div> <!-- /.container-fluid -->
</section>
<script type="text/javascript">
    jQuery(document).ready(function ($){

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD hh:mm:ss'
        });

        editorQuote('description');
        editorQuote('description_en');

        $('#thumbnail_file').change(function(evt) {
            $("#thumbnail_file_link").val($(this).val());
            $("#thumbnail_file_link").attr("value",$(this).val());
        });
        
        //x??? l?? validate
        $("#frm-create-category").validate({
            rules: {
                post_title: "required",
            },
            messages: {
                post_title: "Nh???p ti??u ????? th??? lo???i tin",
            },
            errorElement : 'div',
            errorLabelContainer: '.errorTxt',
            invalidHandler: function(event, validator) {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expro\Laravel\book-ecommerce\resources\views/admin/category/single.blade.php ENDPATH**/ ?>