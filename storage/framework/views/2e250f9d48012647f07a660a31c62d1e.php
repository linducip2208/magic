<?php echo adsense_tools_728x90(); ?>

<section class="site-section py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100">
    <div class="container">
        <div class="rounded-[50px] border p-10 max-sm:px-6 max-sm:py-16">
            <?php if (isset($component)) { $__componentOriginal044312fc7e45484e118b3e1951e4e85f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal044312fc7e45484e118b3e1951e4e85f = $attributes; } ?>
<?php $component = App\View\Components\SectionHeader::resolve(['mb' => '14','title' => ''.e(__($fSectSettings->tools_title)).'','subtitle' => ''.e(__($fSectSettings->tools_description) ?? __('MagicAI has all the tools you need to create and manage your SaaS platform.')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SectionHeader::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal044312fc7e45484e118b3e1951e4e85f)): ?>
<?php $attributes = $__attributesOriginal044312fc7e45484e118b3e1951e4e85f; ?>
<?php unset($__attributesOriginal044312fc7e45484e118b3e1951e4e85f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal044312fc7e45484e118b3e1951e4e85f)): ?>
<?php $component = $__componentOriginal044312fc7e45484e118b3e1951e4e85f; ?>
<?php unset($__componentOriginal044312fc7e45484e118b3e1951e4e85f); ?>
<?php endif; ?>
            <div class="grid grid-cols-3 gap-3 max-lg:grid-cols-2 max-md:grid-cols-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('landing-page.tools.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/tools/section.blade.php ENDPATH**/ ?>