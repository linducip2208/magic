<?php
    $menu_items = app(App\Services\Common\FrontMenuService::class)->generate();
?>

<header
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'site-header group/header absolute inset-x-0 top-0 z-50 text-white transition-[background,shadow] [&.lqd-is-sticky]:text-black',
    ]); ?>"
    x-data="{ navOffsetTop: $refs.navbar.offsetTop - parseInt(getComputedStyle($refs.navbar).marginTop, 10), isSticky: false }"
    x-init="window.scrollY > navOffsetTop && (isSticky = true)"
    @resize.window.debounce.500ms="navOffsetTop = $refs.navbar.offsetTop - parseInt(getComputedStyle($refs.navbar).marginTop, 10)"
    @scroll.window="window.scrollY > navOffsetTop ? (isSticky = true) : (isSticky = false)"
    :class="{ 'lqd-is-sticky': isSticky }"
>
    <?php echo $__env->renderWhen($fSectSettings->preheader_active, 'landing-page.header.preheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <nav
        class="site-header-nav relative flex items-center justify-between border-b border-white/10 px-7 py-4 text-xs opacity-0 transition-all duration-500 group-[.lqd-is-sticky]/header:fixed group-[.lqd-is-sticky]/header:top-0 group-[.lqd-is-sticky]/header:w-full group-[.lqd-is-sticky]/header:border-black group-[.lqd-is-sticky]/header:border-opacity-5 group-[&.lqd-is-sticky]/header:bg-white group-[.page-loaded]/body:opacity-100 group-[&.lqd-is-sticky]/header:shadow-[0_4px_20px_rgba(0,0,0,0.03)] max-sm:px-2"
        id="frontend-local-navbar"
        x-ref="navbar"
    >
        <a
            class="site-logo relative basis-1/3 max-lg:basis-1/3"
            href="<?php echo e(route('index')); ?>"
        >
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($setting->logo_sticky)): ?>
                <img
                    class="peer absolute start-0 top-1/2 -translate-y-1/2 translate-x-3 opacity-0 transition-all group-[.lqd-is-sticky]/header:translate-x-0 group-[.lqd-is-sticky]/header:opacity-100"
                    src="<?php echo e(custom_theme_url($setting->logo_sticky_path, true)); ?>"
                    <?php if(isset($setting->logo_sticky_2x_path)): ?> srcset="/<?php echo e($setting->logo_sticky_2x_path); ?> 2x" <?php endif; ?>
                    alt="<?php echo e(custom_theme_url($setting->site_name)); ?> logo"
                >
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <img
                class="transition-all group-[.lqd-is-sticky]/header:peer-first:translate-x-2 group-[.lqd-is-sticky]/header:peer-first:opacity-0"
                src="<?php echo e(custom_theme_url($setting->logo_path, true)); ?>"
                <?php if(isset($setting->logo_2x_path)): ?> srcset="/<?php echo e($setting->logo_2x_path); ?> 2x" <?php endif; ?>
                alt="<?php echo e($setting->site_name); ?> logo"
            >
        </a>
        <div
            class="site-nav-container basis-1/3 transition-all max-lg:absolute max-lg:right-0 max-lg:top-full max-lg:max-h-0 max-lg:w-full max-lg:overflow-hidden max-lg:bg-[#343C57] max-lg:text-white [&.lqd-is-active]:max-lg:max-h-[calc(100vh-150px)]">
            <div class="max-lg:max-h-[inherit] max-lg:overflow-y-scroll">
                <ul class="flex items-center justify-center gap-14 whitespace-nowrap text-center max-xl:gap-10 max-lg:flex-col max-lg:items-start max-lg:gap-5 max-lg:p-10">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $has_children = !empty($menu_item['mega_menu_id']);
                        ?>
                        <li
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'group/li w-full relative flex flex-wrap items-center gap-2 after:pointer-events-none after:absolute after:-inset-x-4 after:bottom-[calc(var(--sub-offset,0)*-1)] after:top-full [&.is-hover]:after:pointer-events-auto',
                                'has-children' => $has_children,
                                'has-mega-menu' => !empty($menu_item['mega_menu_id']),
                            ]); ?>"
                            x-data="{ hover: false }"
                            x-on:mouseover="if(window.innerWidth < 992 ) return; hover = true"
                            x-on:mouseleave="if(window.innerWidth < 992 ) return; hover = false"
                            :class="{ 'is-hover': hover }"
                        >
                            <a
                                class="relative before:absolute before:-inset-x-4 before:-inset-y-2 before:scale-75 before:rounded-lg before:bg-current before:opacity-0 before:transition-all hover:before:scale-100 hover:before:opacity-10 [&.active]:before:scale-100 [&.active]:before:opacity-10"
                                href="<?php echo e($menu_item['url']); ?>"
                                <?php if($menu_item['target']): ?> target="_blank" <?php endif; ?>
                            >
                                <?php echo e(__($menu_item['title'])); ?>


                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($has_children): ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($has_children): ?>
                                <span
                                    class="relative ms-auto inline-grid size-8 shrink-0 place-content-center align-middle before:absolute before:inset-0 before:rounded-xl before:bg-current before:opacity-5 lg:hidden"
                                    @click="hover = !hover"
                                >
                                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($menu_item['mega_menu_id'])): ?>
                                <?php echo $__env->first(['mega-menu::partials.frontend-megamenu', 'vendor.empty'], ['menu_item' => $menu_item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count(explode(',', $settings_two->languages)) > 1): ?>
                    <div class="group relative -mt-3 block border-t border-white/5 px-10 pb-5 pt-6 md:hidden">
                        <p class="mb-3 flex items-center gap-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="22"
                                height="22"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                <path d="M3.6 9h16.8"></path>
                                <path d="M3.6 15h16.8"></path>
                                <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                                <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                            </svg>
                            <?php echo e(__('Languages')); ?>

                        </p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Helpers\Classes\Localization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($localeCode, explode(',', $settings_two->languages))): ?>
                                <a
                                    class="block border-b border-black border-opacity-5 py-3 transition-colors last:border-none hover:bg-black hover:bg-opacity-5"
                                    href="<?php echo e(route('language.change', $localeCode)); ?>"
                                    rel="alternate"
                                    hreflang="<?php echo e($localeCode); ?>"
                                ><?php echo e(country2flag(substr($properties['regional'], strrpos($properties['regional'], '_') + 1))); ?>

                                    <?php echo e($properties['native']); ?></a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <div class="flex basis-1/3 justify-end gap-2 max-lg:basis-2/3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count(explode(',', $settings_two->languages)) > 1): ?>
                <div class="group relative hidden md:block">
                    <button
                        class="inline-flex size-10 items-center justify-center rounded-full border-2 border-solid border-white !border-opacity-20 transition-colors before:absolute before:end-0 before:top-full before:h-4 before:w-full group-hover:!border-opacity-100 group-hover:bg-white group-hover:text-black group-[.lqd-is-sticky]/header:border-black group-[.lqd-is-sticky]/header:group-hover:bg-black group-[.lqd-is-sticky]/header:group-hover:text-white"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="22"
                            height="22"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M3.6 9h16.8"></path>
                            <path d="M3.6 15h16.8"></path>
                            <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                            <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                        </svg>
                    </button>
                    <div
                        class="pointer-events-none absolute end-0 top-[calc(100%+1rem)] min-w-[145px] translate-y-2 rounded-md bg-white text-black opacity-0 shadow-lg transition-all group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Helpers\Classes\Localization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($localeCode, explode(',', $settings_two->languages))): ?>
                                <a
                                    class="block border-b border-black border-opacity-5 px-3 py-3 transition-colors last:border-none hover:bg-black hover:bg-opacity-5"
                                    href="<?php echo e(route('language.change', $localeCode)); ?>"
                                    rel="alternate"
                                    hreflang="<?php echo e($localeCode); ?>"
                                >
                                    <?php echo e(country2flag(substr($properties['regional'], strrpos($properties['regional'], '_') + 1))); ?>

                                    <?php echo e($properties['native']); ?>

                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="mx-3">
                    <a
                        class="relative inline-flex items-center overflow-hidden rounded-lg border-[2px] border-white !border-opacity-0 bg-white !bg-opacity-10 px-4 py-2 font-medium text-white transition-all duration-300 hover:scale-105 hover:border-black hover:bg-black hover:!bg-opacity-100 hover:text-white hover:shadow-lg group-[.lqd-is-sticky]/header:bg-black group-[.lqd-is-sticky]/header:text-black group-[.lqd-is-sticky]/header:hover:!bg-opacity-100 group-[.lqd-is-sticky]/header:hover:text-white"
                        href="<?php echo e(route('dashboard.index')); ?>"
                    >
                        <?php echo __('Dashboard'); ?>

                    </a>
                </div>
            <?php else: ?>
                <a
                    class="relative inline-flex items-center overflow-hidden rounded-lg border-[2px] border-white !border-opacity-10 px-4 py-2 font-medium text-white transition-all duration-300 hover:scale-105 hover:border-black hover:bg-black hover:text-white hover:shadow-lg group-[.lqd-is-sticky]/header:border-black group-[.lqd-is-sticky]/header:text-black group-[.lqd-is-sticky]/header:hover:text-white"
                    href="<?php echo e(route('login')); ?>"
                >
                    <?php echo __($fSetting->sign_in); ?>

                </a>
                <a
                    class="relative inline-flex items-center overflow-hidden rounded-lg border-[2px] border-white !border-opacity-0 bg-white !bg-opacity-10 px-4 py-2 font-medium text-white transition-all duration-300 hover:scale-105 hover:border-black hover:bg-black hover:!bg-opacity-100 hover:text-white hover:shadow-lg group-[.lqd-is-sticky]/header:bg-black group-[.lqd-is-sticky]/header:text-black group-[.lqd-is-sticky]/header:hover:!bg-opacity-100 group-[.lqd-is-sticky]/header:hover:text-white"
                    href="<?php echo e(route('register')); ?>"
                >
                    <?php echo __($fSetting->join_hub); ?>

                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <button
                class="mobile-nav-trigger group flex size-10 shrink-0 items-center justify-center rounded-full bg-white !bg-opacity-10 group-[.lqd-is-sticky]/header:bg-black lg:hidden"
            >
                <span class="flex w-4 flex-col gap-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i <= 1; $i++): ?>
                        <span
                            class="inline-flex h-[2px] w-full bg-white transition-transform first:origin-left last:origin-right group-[.lqd-is-sticky]/header:bg-black group-[&.lqd-is-active]:first:-translate-y-[2px] group-[&.lqd-is-active]:first:translate-x-[3px] group-[&.lqd-is-active]:first:rotate-45 group-[&.lqd-is-active]:last:-translate-x-[2px] group-[&.lqd-is-active]:last:-translate-y-[8px] group-[&.lqd-is-active]:last:-rotate-45"
                        ></span>
                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>
            </button>
        </div>
    </nav>

    <?php echo $__env->renderWhen($fSetting->floating_button_active, 'landing-page.header.floating-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</header>

<?php echo $__env->renderWhen($app_is_demo, 'landing-page.header.envato-link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<?php echo $__env->renderWhen(in_array($settings_two->chatbot_status, ['frontend', 'both']) &&
        ($settings_two->chatbot_login_require == false || ($settings_two->chatbot_login_require == true && auth()->check())),
    'panel.chatbot.widget',
    ['page' => 'landing-page']
, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
<?php /**PATH D:\project laravel\magicai\resources\views/default/layout/header.blade.php ENDPATH**/ ?>