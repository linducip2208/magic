<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('landing-page.banner.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->renderWhen($fSectSettings->features_active == 1, 'landing-page.features.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->generators_active == 1, 'landing-page.generators.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->who_is_for_active == 1, 'landing-page.who-is-for.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->custom_templates_active == 1, 'landing-page.custom-templates.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->tools_active == 1, 'landing-page.tools.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->how_it_works_active == 1, 'landing-page.how-it-works.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->testimonials_active == 1, 'landing-page.testimonials.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->pricing_active == 1, 'landing-page.pricing.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->faq_active == 1, 'landing-page.faq.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($fSectSettings->blog_active == 1, 'landing-page.blog.section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <?php echo $__env->renderWhen($setting->gdpr_status == 1, 'landing-page.gdpr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\project laravel\magicai\resources\views/default/index.blade.php ENDPATH**/ ?>