<?php
    /** @var \App\Docs\Repository $repository */
?>

<li class="flex px-2 mb-4 w-full leading-5 text-left, break-words lg:w-1/2 md:w-1/2 text-slate-300 border-none">
    <div class="flex p-4 w-full leading-5 text-left break-words rounded-md border border-solid border-neutral-700 bg-gray text-slate-300">
        <div class="flex flex-col p-4 w-full leading-5 text-left rounded-md
            text-slate-300">
            <div class="leading-5 text-left items-center text-slate-300">
                <a href="<?php echo e(action([\App\Http\Controllers\Docs\DocsController::class, 'repository'], $repository->slug)); ?>" class="flex items-center">
                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1"
                         width="16" class="text-black mr-1"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path>
                    </svg>
                    <span
                        class="font-semibold leading-5 text-left text-blue-400 break-words cursor-pointer"
                        title="laravel-kafka">

                            mateusjunges/<?php echo e($repository->slug); ?>


                </span>
                </a>
            </div>

            <!-- Slogan -->
            <p class="flex-grow flex-shrink-0 mt-2 mb-0 text-xs leading-4 text-left break-words basis-auto text-zinc-400">
                <?php echo e(optional($repository->aliases->last())->slogan); ?>

            </p>


            <!-- Available documentation versions -->
            <div class="mt-2 text-xs grid grid-flow-col gap-2 justify-start items-center">
                Available Versions:
                <?php $__currentLoopData = $repository->aliases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alias): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span>
                            <a class="inline-flex items-center justify-center rounded-full w-8 h-8 px-2 bg-opacity-50 hover:bg-opacity-100 hover:font-super-bold <?php echo e($loop->first ? 'bg-white text-black hover:text-black font-bold' : 'bg-gray-light text-black hover:font-super-bold'); ?>" href="<?php echo e(action([\App\Http\Controllers\Docs\DocsController::class, 'repository'], [$repository->slug, $alias->slug])); ?>">
                                <?php echo e($alias->slug); ?>

                            </a>
                        </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- statistics -->
            <div class="mt-2 mb-0 text-xs leading-4 text-left break-words text-zinc-400 flex flex-row justify-between">
                <!-- Stars -->
                <div class="flex">
                    <a href="<?php echo e($repository->getStargazersUrl()); ?>"
                       class="inline-block text-xs leading-4 text-left text-blue-400 break-words bg-transparent cursor-pointer flex items-center"
                       style="text-decoration: none; list-style: outside none none;">
                        <?php echo e(svg('icons/github-star')); ?>

                        <?php echo e($githubRepositories->where('name', $repository->slug)->first()->stars); ?>

                    </a>

                    <!-- Forks -->
                    <?php if($githubRepositories->where('name', $repository->slug)->first()->forks !== null || app()->environment('local')): ?>
                        <a
                            href="<?php echo e($repository->getForksUrl()); ?>"
                            class="flex ml-4 text-xs leading-4 text-left text-blue-400 break-words bg-transparent cursor-pointer items-center">
                            <?php echo e(svg('icons/github-forks')); ?>

                            <?php echo e($githubRepositories->where('name', $repository->slug)->first()->forks ?? rand(1, 150)); ?>

                        </a>
                    <?php endif; ?>
                </div>

                <!-- Composer install statistics -->
                <div class="text-right flex">
                    <span class="mr-2"><?php echo e(svg('icons/download')); ?></span>
                    <p><?php echo e($githubRepositories->where('name', $repository->slug)->first()->downloads); ?></p>
                </div>
            </div>

        </div>
    </div>
</li>
<?php /**PATH /home/mateus/Documents/projects/junges.dev/resources/views/docs/partials/repository.blade.php ENDPATH**/ ?>