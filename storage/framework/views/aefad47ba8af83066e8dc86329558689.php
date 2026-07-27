<?php echo adsense_templates_728x90(); ?>

<section
    class="site-section pb-9 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
    id="templates"
>
    <div class="container">
        <div class="rounded-[50px] border p-10 max-sm:px-5">
            <?php if (isset($component)) { $__componentOriginal044312fc7e45484e118b3e1951e4e85f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal044312fc7e45484e118b3e1951e4e85f = $attributes; } ?>
<?php $component = App\View\Components\SectionHeader::resolve(['mb' => '7','width' => 'w-3/5','title' => ''.__($fSectSettings->custom_templates_title).'','subtitle' => ''.$fSectSettings->custom_templates_description ??
                    'Create your own template or use pre-made templates and examples for various content types and industries to help you get started quickly.'.''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SectionHeader::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <h6 class="mb-6 inline-block rounded-md bg-[#083D91] bg-opacity-15 px-3 py-1 text-[13px] font-medium text-[#083D91]">
                    <?php echo __($fSectSettings->custom_templates_subtitle_one); ?>

                    <span class="dot"></span>
                    <span class="opacity-50"><?php echo __($fSectSettings->custom_templates_subtitle_two); ?></span>
                </h6>
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
            <div class="flex flex-col items-center">
                <div class="mx-auto mb-10 inline-flex flex-wrap items-center gap-2 rounded-lg border p-[0.35rem] text-[12px] font-semibold leading-none max-md:justify-center">
                    <?php if (isset($component)) { $__componentOriginal8c9d13af251f41b73923e8410f290df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c9d13af251f41b73923e8410f290df1 = $attributes; } ?>
<?php $component = App\View\Components\TabsTrigger::resolve(['target' => '.templates-all','style' => '2','label' => ''.e(__('All')).'','active' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabs-trigger'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\TabsTrigger::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c9d13af251f41b73923e8410f290df1)): ?>
<?php $attributes = $__attributesOriginal8c9d13af251f41b73923e8410f290df1; ?>
<?php unset($__attributesOriginal8c9d13af251f41b73923e8410f290df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c9d13af251f41b73923e8410f290df1)): ?>
<?php $component = $__componentOriginal8c9d13af251f41b73923e8410f290df1; ?>
<?php unset($__componentOriginal8c9d13af251f41b73923e8410f290df1); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal8c9d13af251f41b73923e8410f290df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c9d13af251f41b73923e8410f290df1 = $attributes; } ?>
<?php $component = App\View\Components\TabsTrigger::resolve(['target' => '.templates-'.e(\Illuminate\Support\Str::slug($filter->name)).'','style' => '2','label' => ''.e(__($filter->name)).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabs-trigger'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\TabsTrigger::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c9d13af251f41b73923e8410f290df1)): ?>
<?php $attributes = $__attributesOriginal8c9d13af251f41b73923e8410f290df1; ?>
<?php unset($__attributesOriginal8c9d13af251f41b73923e8410f290df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c9d13af251f41b73923e8410f290df1)): ?>
<?php $component = $__componentOriginal8c9d13af251f41b73923e8410f290df1; ?>
<?php unset($__componentOriginal8c9d13af251f41b73923e8410f290df1); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div class="relative">
                <div class="templates-cards grid max-h-[28rem] grid-cols-3 gap-4 overflow-hidden max-lg:grid-cols-2 max-md:grid-cols-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->active != 1): ?>
                            <?php continue; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php echo $__env->make('landing-page.custom-templates.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="templates-cards-overlay absolute inset-x-0 bottom-0 z-10 h-[230px] bg-gradient-to-t from-background from-20% to-transparent">
                </div>
            </div>
            <div class="relative z-20 mt-2 text-center">
                <button class="templates-show-more text-[14px] font-semibold text-[#5A4791]">
                    <span class="size-7 mr-1 inline-grid place-content-center rounded-lg bg-[#885EFE] bg-opacity-10">
                        <svg
                            width="12"
                            height="12"
                            viewBox="0 0 12 12"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M5.671 11.796V0.996H7.125V11.796H5.671ZM0.998 7.125V5.671H11.798V7.125H0.998Z" />
                        </svg>
                    </span>
                    <span class="inline-grid h-7 place-content-center rounded-lg bg-[#885EFE] bg-opacity-10 px-2">
                        <?php echo e(__('Show more')); ?>

                    </span>
                </button>
            </div>
        </div>
    </div>
</section>
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/custom-templates/section.blade.php ENDPATH**/ ?>