<?php $__env->startSection('seo'); ?>
<?php
$data_seo = array(
    'title' => 'List Category Post | '.Helpers::get_option_minhnn('seo-title-add'),
    'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
    'description' => Helpers::get_option_minhnn('seo-description-add'),
    'og_title' => 'List Category Post | '.Helpers::get_option_minhnn('seo-title-add'),
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
        <h1 class="m-0 text-dark">List Category Post</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">List Category Post</li>
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
		            	<h3 class="card-title">List Category Post</h3>
		          	</div> <!-- /.card-header -->
		          	<div class="card-body">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="btn btn-danger" onclick="delete_id('category')" href="javascript:void(0)"><i class="fas fa-trash"></i> Delete</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="<?php echo e(route('admin.createCategoryPost')); ?>" style="margin-left: 6px;"><i class="fas fa-plus"></i> Add New</a>
                            </li>
                        </ul>
                        <br/>
                        <table class="table table-bordered" id="table_index"></table>

                        <script>
                            $(function() {
                                let data2 =<?php echo $data_category; ?>;
                                $('#table_index').DataTable({
                                    data: data2,
                                    columns: [
                                      {title: '<input type="checkbox" id="selectall" onclick="select_all()">', data: 'id'},
                                      {title: 'Title', data: 'name'},
                                      {title: 'Thumbnail', data: 'image'},
                                      {title: 'Created', data: 'updated_at'},
                                    ],
                                    order: [[ 3, "desc" ]],
                                    columnDefs: [
                                    {//ID
                                        visible: true,
                                        targets: 0,
                                        className: 'text-center',
                                        orderable: false,
                                        render: function (data, type, full, meta) {
                                            return '<input type="checkbox" id="'+data+'" name="seq_list[]" value="'+data+'">';
                                        }
                                    },
                                    {//Title
                                        visible: true,
                                        targets: 1,
                                        className: '',
                                        render: function (data, type, full, meta) {
                                            return '<a href="<?php echo e(route("admin.dashboard")); ?>/category-post/' + full.id + '"><b>'+data+'</b><br/><b style="color:#c76805;">'+ full.slug +'</b></a>';
                                        }
                                    },
                                    {//Thumbnail
                                        visible: true,
                                        targets: 2,
                                        className: 'text-center',
                                        render: function (data, type, full, meta) {
                                            if(data != ''){
                                                return '<img src="'+data+'" style="height: 100px;">';
                                            }
                                            return '';
                                        }
                                    },
                                    {//Created
                                        visible: true,
                                        targets: 3,
                                        className: 'text-center',
                                        render: function (data, type, full, meta) {
                                            if(full.status == 1){
                                                var st = 'Public';
                                            }else{
                                                var st = 'Draft';
                                            }
                                            return data+'<br/>'+st;
                                        }
                                    }
                                ],
                                });
                            });
                        </script>
		        	</div> <!-- /.card-body -->
	      		</div><!-- /.card -->
	    	</div> <!-- /.col -->
	  	</div> <!-- /.row -->
  	</div> <!-- /.container-fluid -->
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expro\Laravel\book-ecommerce\resources\views/admin/category/index.blade.php ENDPATH**/ ?>