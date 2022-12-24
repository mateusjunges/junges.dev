<!doctype html>
<html lang="en">
<head>
    <?php echo $__env->make('layouts.partials.meta', ['title' => 'Welcome!'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
<?php echo \Livewire\Livewire::styles(); ?>

<?php echo $__env->yieldPushContent('head'); ?>
</head>

<body class="tracking-wide flex justify-center w-full md:w-2/5 mx-auto bg-white text-black">

<div class="container w-screen flex flex-col md:flex-row bg-white text-black">
    <?php echo $__env->yieldContent('sidebar'); ?>
    <div class="w-full mt-10 md:mt-10 lg:mt-6 text-black leading-normal font-inter text-black">
        <div class="m-auto mt-0 mx-4">
            <div class="w-full">
                <h1 class="text-5xl text-black font-super-bold leading-12">junges.dev</h1>
            </div>
            <div class="w-full">
                <h3 class="text-sm font-super-bold text-black uppercase">About Me</h3>
                <div>
                    <p class="leading-tight text-sm font-light">
                        Mateus Junges. Senior Software Engineer based in Brazil 🇧🇷 working for
                        <a href="https://www.interaction-design.org/" rel="noopener noreferrer" target="_blank" class="underline">The Interaction Design Foundation</a>, in Dubai 🇦🇪.
                    </p>
                </div>
            </div>
            <dl class="mt-3 w-full">
                <dt class="text-sm font-super-bold text-black uppercase">Social Media</dt>
                <dd class="flex">
                    <div class="flex justify-between">
                        <a href="mailto:mateus@junges.dev" class="pr-2 text-black font-super-bold text-3xl cursor-pointer" target="_blank"><?php echo e(svg('mail')); ?></a>
                        <a href="https://github.com/mateusjunges" class="pr-2 text-black font-super-bold text-3xl cursor-pointer" target="_blank"><?php echo e(svg('github-1')); ?></a>
                        <a href="https://twitter.com/mateusjungess/" class="pr-2 text-black font-super-bold text-3xl cursor-pointer" target="_blank"><?php echo e(svg('twitter')); ?></a>
                        <a href="https://www.linkedin.com/in/mateusjunges/" class="text-black font-super-bold text-3xl cursor-pointer" target="_blank"><?php echo e(svg('linkedin')); ?></a>
                    </div>
                </dd>
            </dl>
            <div class="mt-10 font-inter text-">
                <div class="experience flex flex-col bg-gray rounded py-4 px-2 hover:bg-gray-60 my-4">
                    <h3 class="font-super-bold">Want to hire me?</h3>
                    <h5 class="font-light text-sm">Please contact me by
                        <a href="mailto:mateus@junges.dev" class="underline">email</a>.
                    </h5>
                </div>
                <a href="<?php echo e(route('docs')); ?>">
                    <div class="experience flex flex-col bg-gray rounded py-4 px-2 hover:bg-gray-100 my-4">
                        <h3 class="font-super-bold flex items-center">Documentations</h3>
                        <h5 class="font-light text-sm">Here you can find the documentation for my open source projects.</h5>
                    </div>
                </a>
                <a href="<?php echo e(route('open-source')); ?>">
                    <div class="experience flex flex-col bg-gray rounded py-4 px-2 hover:bg-gray-100 my-4">
                        <h3 class="font-super-bold flex items-center">Open Source</h3>
                        <h5 class="font-light text-sm">Public projects I contributed through commits, issues, pull requests or reviews on Github</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
</body>
<?php /**PATH /home/mateus/Documents/projects/junges.dev/resources/views/welcome.blade.php ENDPATH**/ ?>