<div class="w-full lg:w-1/5 lg:px-6 text-xl text-grey-darkest leading-normal">
    <p class="text-base font-bold py-2 lg:pb-6 hidden lg:block text-grey-darker">Menu</p>
    <div class="w-full sticky pin hidden h-64 lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 border
                border-grey-light lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20"
         style="top:5em;" id="menu-content">
        <?php echo e(\Spatie\Menu\Laravel\Menu::primary()
            ->addClass('list-reset text-left')
            ->addItemClass('py-2 md:my-0 hover:bg-purple-lightest lg:hover:bg-transparent text-sm no-underline')
            ->setActiveClass('font-bold text-black border-l-2 border-black px-2')); ?>

    </div>
</div>
<?php /**PATH /home/mateus/Documents/projects/junges.dev/resources/views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>