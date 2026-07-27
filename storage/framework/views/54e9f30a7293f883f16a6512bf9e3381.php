    <?php echo adsense_how_it_works_728x90(); ?>

    <section
        class="site-section py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
        id="how-it-works"
    >
        <div class="container">
            <div
                class="rounded-[50px] bg-[#010101] bg-cover p-10 py-24 text-white text-opacity-60 shadow-xl max-sm:bg-bottom max-sm:px-5"
                style="background-image: url(<?php echo e(custom_theme_url('assets/img/landing-page/steps-bg.jpg')); ?>);"
            >
                <div class="mx-auto mb-14 w-2/5 text-center max-xl:w-1/2 max-lg:w-8/12 max-md:w-full">
                    <h2 class="text-[64px] leading-none text-[#E5E6E6] max-sm:text-[45px]"><?php echo __($fSectSettings->how_it_works_title); ?>

                    </h2>
                </div>
                <div class="grid-cols-<?php echo e(count($howitWorks)); ?> mb-20 grid gap-7 max-md:grid-cols-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $howitWorks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('landing-page.how-it-works.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($howitWorksDefaults['option'] == 1): ?>
                    <div class="flex justify-center text-[#A2B2C9]">
                        <?php echo $howitWorksDefaults['html']; ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/how-it-works/section.blade.php ENDPATH**/ ?>