<?php if (isset($component)) { $__componentOriginalf8d22cb0bbc2c20a18faee8523755af5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5 = $attributes; } ?>
<?php $component = App\View\Components\Box::resolve(['title' => ''.__($item->title).'','desc' => ''.__($item->description).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Box::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('icon', null, []); ?> 
        <?php echo $item->image; ?>

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
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/features/item.blade.php ENDPATH**/ ?>