<?php if (isset($component)) { $__componentOriginal5d09e94efc1ca4d9287c0910c455330e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d09e94efc1ca4d9287c0910c455330e = $attributes; } ?>
<?php $component = App\View\Components\ColorBox::resolve(['title' => ''.__($item->title).'','color' => ''.e($item->color).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('color-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ColorBox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d09e94efc1ca4d9287c0910c455330e)): ?>
<?php $attributes = $__attributesOriginal5d09e94efc1ca4d9287c0910c455330e; ?>
<?php unset($__attributesOriginal5d09e94efc1ca4d9287c0910c455330e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d09e94efc1ca4d9287c0910c455330e)): ?>
<?php $component = $__componentOriginal5d09e94efc1ca4d9287c0910c455330e; ?>
<?php unset($__componentOriginal5d09e94efc1ca4d9287c0910c455330e); ?>
<?php endif; ?>
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/who-is-for/item.blade.php ENDPATH**/ ?>