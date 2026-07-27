    <?php echo adsense_testimonials_728x90(); ?>

    <section
        class="site-section relative py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
        id="testimonials"
    >
        <div
            class="absolute inset-x-0 top-0 -z-1 h-[150vh]"
            style="background: linear-gradient(to bottom, transparent, #F0EFFA, transparent)"
        ></div>
        <div class="container relative">
            <div
                class="rounded-[50px] border bg-contain bg-center bg-no-repeat p-11 pb-24 max-sm:px-5"
                style="background-image: url(<?php echo e(custom_theme_url('assets/img/landing-page/world-map.png')); ?>)"
            >
                <?php if (isset($component)) { $__componentOriginal044312fc7e45484e118b3e1951e4e85f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal044312fc7e45484e118b3e1951e4e85f = $attributes; } ?>
<?php $component = App\View\Components\SectionHeader::resolve(['width' => 'w-1/2','mb' => '10','title' => ''.$fSectSettings->testimonials_title.'','subtitle' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SectionHeader::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <h6 class="mb-6 inline-block rounded-md bg-[#28027C] bg-opacity-15 px-3 py-1 text-[13px] font-medium text-[#28027C]">
                        <?php echo __($fSectSettings->testimonials_subtitle_one); ?>

                        <span class="dot"></span>
                        <span class="opacity-50"><?php echo __($fSectSettings->testimonials_subtitle_two); ?></span>
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
                <div class="max-lg:11/12 mx-auto w-8/12 max-md:w-full">
                    <div class="mb-20">
                        <div
                            class="mx-auto mb-7 w-[235px] gap-5"
                            data-flickity='{ "asNavFor": ".testimonials-main-carousel", "contain": false, "pageDots": false, "cellAlign": "center", "prevNextButtons": false, "wrapAround": true, "draggable": false }'
                            style="mask-image: linear-gradient(to right, transparent 0%, #000 15%, #000 85%, transparent 100% ); -webkit-mask-image: linear-gradient(to right, transparent 0%, #000 15%, #000 85%, transparent 100% );"
                        >
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('landing-page.testimonials.item-image', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div
                            class="testimonials-main-carousel text-center text-[26px] leading-[1.27em] text-heading-foreground max-sm:text-lg max-sm:[&_.flickity-button-icon]:!left-1/4 max-sm:[&_.flickity-button-icon]:!top-1/4 max-sm:[&_.flickity-button-icon]:!h-1/2 max-sm:[&_.flickity-button-icon]:!w-1/2 [&_.flickity-button.next]:-right-16 max-md:[&_.flickity-button.next]:-right-10 [&_.flickity-button.previous]:-left-16 max-md:[&_.flickity-button.previous]:-left-10 [&_.flickity-button]:opacity-40 [&_.flickity-button]:transition-all [&_.flickity-button]:hover:bg-transparent [&_.flickity-button]:hover:opacity-100 [&_.flickity-button]:focus:shadow-none max-sm:[&_.flickity-button]:relative max-sm:[&_.flickity-button]:!left-auto max-sm:[&_.flickity-button]:!right-auto max-sm:[&_.flickity-button]:top-auto max-sm:[&_.flickity-button]:!mx-4 max-sm:[&_.flickity-button]:translate-y-0"
                            data-flickity='{ "contain": true, "wrapAround": true, "pageDots": false, "adaptiveHeight": true }'
                        >
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('landing-page.testimonials.item-quote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>
                    </div>
                    <div class="flex justify-center gap-20 opacity-80 max-lg:gap-12 max-sm:gap-4">
						<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$avatarSrc = custom_theme_url('assets/img/auth/default-avatar.png');

								if (isset($entry->avatar)) {
									if (str_starts_with($entry->avatar, 'asset')) {
										$avatarSrc = custom_theme_url($entry->avatar);
									} else {
										$avatarSrc = url('') . '/clientAvatar/' . $entry->avatar;
									}
								}
							?>

							<img
								class="h-full w-full object-cover object-center"
								style="max-width: 48px; max-height: 48px;"
								src="<?php echo e($avatarSrc); ?>"
								alt="<?php echo e(__($entry->alt)); ?>"
								title="<?php echo e(__($entry->title)); ?>"
							>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/testimonials/section.blade.php ENDPATH**/ ?>