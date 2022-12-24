<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.main','data' => ['title' => 'Documentation']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Documentation']); ?>
    <div class="container wrap min-h-12">
        <div>
            <h1 class="banner-slogan text-2xl mt-4 md:mt-0 font-bold text-gray-700 md:text-4xl">Docs</h1>
            <p class="mt-4 text-lg">
                In this page you can find the documentation for all of my open source packages available
                <a href="https://github.com/mateusjunges" class="underline font-bold">at github</a>.
            </p>
        </div>














        <div class="mt-6">
            <?php $__currentLoopData = $repositories->groupBy('category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $repositories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-24">
                    <ol class="flex flex-wrap list-none">
                        <?php $__currentLoopData = $repositories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repository): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('docs.partials.repository', ['githubRepositories' => $githubRepositories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

<?php /**PATH /var/www/resources/views/docs/index.blade.php ENDPATH**/ ?>