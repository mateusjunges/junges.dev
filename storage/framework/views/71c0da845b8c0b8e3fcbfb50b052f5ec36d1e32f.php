<section id="breadcrumb" class="hidden md:block container wrap py-4 md:py-6 lg:py-8 items-stretch">
    <div class="px-4">
        <p class="mt-4">
            <a href="<?php echo e(route('docs')); ?>" class="link-underline">Docs</a>
            <span class="icon mx-2 opacity-50 fill-current text-blue"><?php echo e(svg('icons/far-angle-right')); ?></span>
            <a
                class="link-underline"
                href="<?php echo e(action([\App\Http\Controllers\Docs\DocsController::class, 'repository'], [$repository->slug, $alias->slug])); ?>"
            ><?php echo e(ucfirst($repository->slug)); ?></a>
            <?php if(! $page->isRootPage()): ?>
                <span class="icon mx-2 opacity-50 fill-current text-blue"><?php echo e(svg('icons/far-angle-right')); ?></span>
                <span><?php echo e(ucfirst($page->section)); ?></span>
            <?php endif; ?>
            <span class="icon mx-2 opacity-50 fill-current text-blue"><?php echo e(svg('icons/far-angle-right')); ?></span>
            <span><?php echo e($page->title); ?></span>
        </p>
    </div>
</section>
<?php /**PATH /var/www/resources/views/docs/partials/breadcrumbs.blade.php ENDPATH**/ ?>