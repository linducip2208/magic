<?php if (isset($component)) { $__componentOriginalf8d22cb0bbc2c20a18faee8523755af5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5 = $attributes; } ?>
<?php $component = App\View\Components\Box::resolve(['wrapperClass' => 'templates-all templates-'.e(\Illuminate\Support\Str::slug($item->filters)).'','style' => '2','title' => ''.e(__($item->title)).'','desc' => ''.e(__($item->description)).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Box::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('image', null, []); ?> 
        <span
            class="size-11 mb-4 inline-flex items-center justify-center rounded-lg bg-gradient-to-bl from-[#f0f0f2] to-[#d7d7d9] [&_path]:fill-inherit [&_svg]:h-5 [&_svg]:w-6 [&_svg]:fill-[#7c7c7e]"
        >
            <?php echo stripslashes($item->image); ?>

        </span>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5)): ?>
<?php $attributes = $__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5; ?>
<?php unset($__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d22cb0bbc2c20a18faee8523755af5)): ?>
<?php $component = $__componentOriginalf8d22cb0bbc2c20a18faee8523755af5; ?>
<?php unset($__componentOriginalf8d22cb0bbc2c20a18faee8523755af5); ?>
<?php endif; ?>
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/custom-templates/item.blade.php ENDPATH**/ ?>