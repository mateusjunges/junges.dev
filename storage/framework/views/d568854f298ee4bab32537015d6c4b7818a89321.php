<?php
    /** @var \App\Docs\Repository $repository */
    $latestVersion = $repository->aliases->first();
?>



<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.main','data' => ['title' => ''.e($page->title).' | '.e($repository->slug).'','noIndex' => $page->alias !== $latestVersion->slug,'canonical' => ''.e(url('/docs/' . $repository->slug . '/' . $latestVersion->slug . '/' . $page->slug)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($page->title).' | '.e($repository->slug).'','no-index' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->alias !== $latestVersion->slug),'canonical' => ''.e(url('/docs/' . $repository->slug . '/' . $latestVersion->slug . '/' . $page->slug)).'']); ?>
     <?php $__env->slot('description', null, []); ?> 
        <?php echo e($repository->slug); ?>

     <?php $__env->endSlot(); ?>


    <?php echo $__env->make('docs.partials.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="wrap md:grid pb-24 gap-12 md:grid-cols-10 items-stretch">
        <div class="z-10 | md:col-span-3 | lg:col-span-2 | print:hidden">
            <?php echo $__env->make('docs.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <article class="md:col-span-7 lg:col-span-8">
            <?php if(count($repository->aliases) > 1): ?>
                <div class="mb-12 p-4 flex text-sm bg-gray-light bg-opacity-50 rounded-sm md:shadow-light markup-shiki">
                    <div class="flex-none h-6 w-6 text-orange fill-current"><?php echo e(svg('icons/fal-exclamation-circle')); ?></div>
                    <div class="ml-4">
                        <p>
                            This is the documentation for <strong><?php echo e($page->alias); ?></strong><?php if($page->alias !== $latestVersion->slug): ?> but the latest version is
                            <strong><?php echo e($latestVersion->slug); ?></strong><?php endif; ?>.
                            You can switch versions in the menu <span class="hidden md:inline">on the left</span><span class="hidden">/</span><span class="inline md:hidden">at the top</span>.
                            Check your current version with the following command:
                        </p>
                        <div class="mt-2">
                            <code class="bg-gray-dark bg-opacity-50 px-2 py-1">
                                composer show mateusjunges/<?php echo e($repository->slug); ?>

                            </code>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div>

            </div>
            <div class="mb-8"></div>

            <?php if($showBigTitle): ?>
                <div class="mb-16">
                    <h1 class="banner-slogan">
                        <?php echo e(ucfirst($repository->slug)); ?>

                    </h1>
                    <div class="banner-intro flex items-center justify-start">
                        <?php echo e($alias->slogan); ?>

                    </div>
                </div>

                <h2 class="title-xl mb-8"><?php echo e($page->title); ?></h2>
            <?php else: ?>
                <h1 class="title-xl mb-8"><?php echo e($page->title); ?></h1>
            <?php endif; ?>

            <div class="markup markup-titles markup-lists markup-code markup-tables markup-shiki markup-embeds links-underline">
                <?php echo $page->contents; ?>

            </div>
        </article>

        <aside class="hidden md:block w-48 pb-16 print-hidden right-px pin-t fixed" style="right: 2px" id="freelance-ad">
            <div class="sticky top-0 py-6">
                <div class="pl-4 py-2 border-l-2 border-gray-light rounded bg-gray-dark border-opacity-50">
                    <div class="flex justify-between items-center">
                        <h3 class="mb-3 text-black font-semibold uppercase tracking-wider text-xs">
                            Do you need help with this package?
                        </h3>
                    </div>
                    <p class="grid gap-2 text-xs">
                        I'm available for freelance projects. Contact me <a href="mailto:mateus@junges.dev" class="underline hover:cursor-pointer">via email</a>
                    </p>
                    <p class="text-right mr-2 text-xs underline hover:cursor-pointer" id="close-ad">close</p>
                </div>
            </div>
        </aside>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>

    <script>
        let close = document.getElementById('close-ad');

        close.addEventListener('click', closeAd);

        function closeAd() {
            document.getElementById('freelance-ad').remove();
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/docs/show.blade.php ENDPATH**/ ?>