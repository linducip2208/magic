<!DOCTYPE html>
<html
    class="max-sm:overflow-x-hidden"
    lang="<?php echo e(\App\Helpers\Classes\Localization::getLocale()); ?>"
    dir="<?php echo e(\App\Helpers\Classes\Localization::getCurrentLocaleDirection()); ?>"
>

<head>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('facebook_domain_verification')): ?>
        <meta
            name="facebook-domain-verification"
            content="<?php echo e(setting('facebook_domain_verification')); ?>"
        />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('google_robots')): ?>
        <meta
            name="robots"
            content="noindex, nofollow"
        />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <meta charset="UTF-8" />
    <meta
        name="csrf-token"
        content="<?php echo e(csrf_token()); ?>"
    >
    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    />
    <meta
        name="description"
        content="<?php echo e(getMetaDesc($setting, $settings_two)); ?>"
    >
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($setting->meta_keywords)): ?>
        <meta
            name="keywords"
            content="<?php echo e($setting->meta_keywords); ?>"
        >
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link
        rel="icon"
        href="<?php echo e(custom_theme_url($setting->favicon_path ?? 'assets/favicon.ico')); ?>"
    >
    <title><?php echo e(getMetaTitle($setting, $settings_two)); ?></title>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($google_fonts_string = \App\Helpers\Classes\ThemeHelper::googleFontsString())): ?>
        <link
            rel="preconnect"
            href="https://fonts.bunny.net"
        >
        <link
            rel="preconnect"
            href="https://fonts.bunny.net"
            crossorigin
        >
        <link
            href="https://fonts.bunny.net/css2?<?php echo e($google_fonts_string); ?>&display=swap"
            rel="stylesheet"
        >
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <link
        rel="stylesheet"
        href="<?php echo e(custom_theme_url('assets/css/frontend/flickity.min.css')); ?>"
    >
    <link
        href="<?php echo e(custom_theme_url('assets/libs/toastr/toastr.min.css')); ?>"
        rel="stylesheet"
    />

    <?php
        $link = 'resources/views/' . get_theme() . '/scss/landing-page.scss';
    ?>
    <?php echo app('Illuminate\Foundation\Vite')($link); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($setting->frontend_custom_css != null): ?>
        <link
            rel="stylesheet"
            href="<?php echo e($setting->frontend_custom_css); ?>"
        />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($setting->frontend_code_before_head != null): ?>
        <?php echo $setting->frontend_code_before_head; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <script>
        window.liquid = {
            isLandingPage: true
        };
    </script>

    <style>
        .google-ads-728 {
            width: 100%;
            max-width: 728px;
            height: auto;
        }
    </style>

    <!--Google AdSense-->
    <?php echo adsense_header(); ?>

    <!--Google AdSense End-->

    
    
    
    

    
    <?php echo $__env->yieldPushContent('script-before'); ?>

    <?php echo app('Illuminate\Foundation\Vite')(\App\Helpers\Classes\ThemeHelper::appJsPath()); ?>

    <?php echo $__env->yieldPushContent('css'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('additional_custom_css') != null): ?>
        <?php echo setting('additional_custom_css'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="group/body bg-background font-body text-foreground">
    <div
        class="pointer-events-none invisible fixed left-0 right-0 top-0 z-[99] opacity-0 transition-opacity"
        id="app-loading-indicator"
        x-data="{}"
        :class="{ 'opacity-0': !$store.appLoadingIndicator.showing, 'invisible': !$store.appLoadingIndicator.showing }"
    >
        <div class="lqd-progress relative h-[3px] w-full bg-foreground/10">
            <div class="lqd-progress-bar lqd-progress-bar-indeterminate lqd-app-loading-indicator-progress-bar absolute inset-0 bg-primary dark:bg-heading-foreground">
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($smoothScroll) && filled($smoothScroll)): ?>
        <div x-data="liquidScrollSmooth">
            <div id="smooth-wrapper">
                <div
                    class="bg-background"
                    id="smooth-content"
                >
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($smoothScroll) && filled($smoothScroll)): ?>
        </div><!-- liquidScrollSmooth -->
        </div><!-- #smooth-wrapper -->
        </div><!-- #smooth-content -->
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($setting->frontend_custom_js != null): ?>
        <script src="<?php echo e($setting->frontend_custom_js); ?>"></script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($setting->frontend_code_before_body != null): ?>
        <?php echo $setting->frontend_code_before_body; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($show_promo_banner) && $show_promo_banner === true): ?>
        <?php echo $__env->make('discount-manager::components.promo-banner', ['bannerInfo' => $bannerInfo, 'landingPage' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <script src="<?php echo e(custom_theme_url('assets/libs/jquery/jquery.min.js')); ?>"></script>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($settings_two->chatbot_status, ['frontend', 'both'])): ?>
        <script src="<?php echo e(custom_theme_url('assets/js/panel/openai_chatbot.js')); ?>"></script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <script src="<?php echo e(custom_theme_url('assets/libs/vanillajs-scrollspy.min.js')); ?>"></script>
    <script src="<?php echo e(custom_theme_url('assets/libs/flickity.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(custom_theme_url('assets/js/frontend.js')); ?>"></script>
    <script src="<?php echo e(custom_theme_url('assets/js/frontend/frontend-animations.js')); ?>"></script>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($setting->gdpr_status == 1): ?>
        <script src="<?php echo e(custom_theme_url('assets/js/gdpr.js')); ?>"></script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <script src="<?php echo e(custom_theme_url('assets/libs/fslightbox/fslightbox.js')); ?>"></script>
    <script src="<?php echo e(custom_theme_url('assets/libs/toastr/toastr.min.js')); ?>"></script>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($smoothScroll) && filled($smoothScroll)): ?>
        <script src="<?php echo e(custom_theme_url('/assets/libs/gsap/minified/ScrollSmoother.min.js')); ?>"></script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\Session::has('message')): ?>
        <script>
            toastr.<?php echo e(\Session::get('type')); ?>('<?php echo e(\Session::get('message')); ?>')
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig(); ?>


    <?php echo $__env->yieldPushContent('script'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($app_is_demo): ?>
        <?php if (isset($component)) { $__componentOriginal9ceb171f1767f45e800191509ce86428 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ceb171f1767f45e800191509ce86428 = $attributes; } ?>
<?php $component = App\View\Components\DemoSwitcher::resolve(['themesType' => 'Frontend'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('demo-switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\DemoSwitcher::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ceb171f1767f45e800191509ce86428)): ?>
<?php $attributes = $__attributesOriginal9ceb171f1767f45e800191509ce86428; ?>
<?php unset($__attributesOriginal9ceb171f1767f45e800191509ce86428); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ceb171f1767f45e800191509ce86428)): ?>
<?php $component = $__componentOriginal9ceb171f1767f45e800191509ce86428; ?>
<?php unset($__componentOriginal9ceb171f1767f45e800191509ce86428); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

	<?php if ($__env->exists('demoextension::switcher')) echo $__env->make('demoextension::switcher', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH D:\project laravel\magicai\resources\views/default/layout/app.blade.php ENDPATH**/ ?>