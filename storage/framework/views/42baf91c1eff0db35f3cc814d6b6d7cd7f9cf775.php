<?php $__env->startSection('content'); ?>
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add New Recipe</h1>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Your Block -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add New Recipe</h3>
            <div class="block-options">
                <div class="pull-right">
                    <a class="btn btn-primary" href="<?php echo e(route('recipes.index')); ?>"> Back</a>
                </div>
            </div>
        </div>
        <div class="block-content">
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>
            <form action="<?php echo e(route('recipes.store')); ?>" id="store" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row justify-content-center">
                    <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4">Title:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title...">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="categories_id" class="col-sm-4">Category:</label>
                            <div class="col-sm-8">
                                <select name="categories_id" id="categories_id" class="form-control">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4">Description:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-4">Image:</label>
                            <div class="col-sm-8">
                                <input type="file" name="image" id="image" placeholder="Image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4">Food List:</label>
                            <div class="col-sm-8 food-list">
                                <button type="button" class="btn btn-primary" id="add">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="food_id" id="food_id">
                            <input type="hidden" name="food_amount" id="food_amount">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 ml-auto">
                                <button type="button" class="btn btn-primary send">
                                    <i class="fa fa-fw fa-check"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Your Block -->
</div>
<!-- END Page Content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" /> -->

<!-- <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"> -->


<script>
    $(document).ready(function() {
        CKEDITOR.replace('description');
        var i = 1;
        $("#add").click(function() {
            $(this).before(
                '<div class="food-menu row mb-2">\
                        <label class="col-sm-3">Food:</label>\
                        <div class="col-sm-4 id-div">\
                            <select name="food-id" id="food-id-' + i + '" class="form-control">\
                                <?php $__currentLoopData = $fooditems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fooditem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\
                                <option value="<?php echo e($fooditem->id); ?>"><?php echo e($fooditem->food_name); ?></option>\
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\
                            </select>\
                        </div>\
                        <div class="col-sm-4 amount-div">\
                            <input type="text" name="food-amount" id="food-amount" class="form-control" placeholder="Amount">\
                        </div>\
                        <div class="col-sm-1">\
                            <button class="btn btn-danger" id="delete" onclick="deleteTag(this)"><i class="fa fa-times"></i></button>\
                        </div>\
                    </div>'
            );
            $("#food-id-" + i).select2();
            i++;
        });


        deleteTag = (val) => {
            val.parentNode.parentNode.remove();
        }

        $(".send").click(function() {
            var id_arr = [];
            var amount_arr = [];
            $(".food-menu").each(function(i) {
                id_arr.push($(this).children('.id-div').children('#food-id').val());

                if (!$(this).children('.amount-div').children('#food-amount').val()) {
                    amount_arr.push(0);
                } else {
                    amount_arr.push($(this).children('.amount-div').children('#food-amount').val());
                }
            });

            $("input:hidden[name='food_id']").val(id_arr);
            $("input:hidden[name='food_amount']").val(amount_arr);
            $("#store").submit();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Fitness\resources\views/recipes/create.blade.php ENDPATH**/ ?>