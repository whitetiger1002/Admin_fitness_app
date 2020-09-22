<?php $__env->startSection('content'); ?>
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">FoodItem</h1>
        </div>
    </div>
</div>
<!-- END Hero -->
<!-- Page Content -->
<div class="content">
    <!-- Your Block -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">FoodItem List</h3>
            <div class="block-options">
                <div class="pull-right">
                    <a class="btn btn-primary" href="<?php echo e(route('fooditems.create')); ?>" data-toggle="tooltip" title="Create">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content">
            <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success">
                <p style="margin-bottom:0;"><?php echo e($message); ?></p>
            </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">No</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Food Category</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Food Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Carbon</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Protein</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Fat</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Portion In Grams</th>
                            <th class="d-none d-md-table-cell text-center" style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $fooditems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foodItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e(++$i); ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo e($foodItem->food_name); ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo e($foodItem->foodcategory->name); ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo e($foodItem->carbon); ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo e($foodItem->protein); ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo e($foodItem->fat); ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo e($foodItem->portion_in_grams); ?></td>
                            <td class="text-center">
                                <form id="delete" action="<?php echo e(route('fooditems.destroy',$foodItem->id)); ?>" method="POST">
                                    <div class="btn-group">
                                        <a class="btn btn-success" href="<?php echo e(route('fooditems.show',$foodItem->id)); ?>" data-toggle="tooltip" title="Show">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-primary" href="<?php echo e(route('fooditems.edit',$foodItem->id)); ?>" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <!-- 
                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-id="<?php echo e($foodItem->id); ?>" title="Delete">
                                            <i class="fa fa-times"></i>
                                        </button> -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-block-normal" title="Delete">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <!-- Normal Default Modal -->
                                        <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><i class="fa fa-check"></i>Warning</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body pb-1">
                                                        <p>Are you sure to delete this <span class="text-info">Food item</span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="confirm" class="btn btn-sm btn-primary" data-id="<?php echo e($foodItem->id); ?>">Yes</button>
                                                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Normal Default Modal -->
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="text-center"><?php echo $fooditems->links(); ?></div>
            </div>
        </div>
    </div>
    <!-- END Your Block -->
</div>
<!-- END Page Content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#confirm').click(function() {
            $('#delete').submit();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Fitness\resources\views/fooditems/index.blade.php ENDPATH**/ ?>