<nav class="h-full pb-6 md:py-6 md:shadow-light rounded-sm pl-4 pr-4 md:px-4">
    <div class="flex justify-between items-center pb-4 border-b-2 border-gray-lighter py-2 my-2">
        <div class="text-xs font-normal leading-normal select h-12 bg-white">
            <select name="alias" class="text-lg bg-white text-gray-700" onChange="location='/documentation/<?php echo e($repository->slug); ?>/' + this.options[this.selectedIndex].value">
                <?php $__currentLoopData = $repository->aliases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aliasOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($aliasOption->slug); ?>" <?php echo e($page->alias === $aliasOption->slug ? 'selected="selected"' : ''); ?>>
                        <?php echo e($aliasOption->slug); ?> (<?php echo e($aliasOption->branch); ?>)
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <span class="select-arrow text-black">
            <?php echo e(svg('icons/far-angle-down')); ?></span>
        </div>
        <div class="ml-auto pl-2 flex items-center">
            <a class="text-xs underline hover:text-black-500" href="<?php echo e($alias->githubUrl); ?>/blob/<?php echo e($alias->branch); ?>/docs/<?php echo e($page->slug); ?>.md"
               target="_blank">
                Edit
            </a>
            <a class="ml-2 flex text-xs link-gray" href="<?php echo e($alias->githubUrl); ?>/tree/<?php echo e($alias->branch); ?>"
               target="_blank">
                <span class="w-4 h-4 text-black">
                    <?php echo e(svg('github')); ?>

                </span>
            </a>
        </div>
    </div>

    <div class="pt-4 ">

        <ol class="text-xs">
            <?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key !== '_root'): ?>
                    <h2 class="title-sm text-sm mb-2"><?php echo e($section['_index']['title']); ?></h2>
                <?php endif; ?>

                <ul class="mb-6 space-y-1 <?php if($key !== '_root'): ?> pl-2 border-l-2 border-gray-lighter border-opacity-75 <?php endif; ?>">
                    <?php $__currentLoopData = $section['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="leading-snug">
                            <a href="<?php echo e($navItem->url); ?>" class="<?php if($page->slug === $navItem->slug): ?> font-bold underline <?php endif; ?>">
                                <?php echo e($navItem->title); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>

</nav>

<?php /**PATH /var/www/resources/views/docs/partials/navigation.blade.php ENDPATH**/ ?>