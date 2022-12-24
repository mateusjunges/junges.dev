<!doctype html>
<html lang="en">
<head>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->make('layouts.partials.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>

<body class="bg-white tracking-wide text-black">

<?php echo $__env->make('layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="flex-grow" role="main">

        <?php echo e($slot); ?>




</div>
<!--/container-->

<?php echo $__env->make('layouts.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
<?php /**PATH /home/mateus/Documents/projects/junges.dev/resources/views/layouts/main.blade.php ENDPATH**/ ?>