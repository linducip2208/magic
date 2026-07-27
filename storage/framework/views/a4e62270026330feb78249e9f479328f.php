<?php if (isset($component)) { $__componentOriginal8c9d13af251f41b73923e8410f290df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c9d13af251f41b73923e8410f290df1 = $attributes; } ?>
<?php $component = App\View\Components\TabsTrigger::resolve(['target' => '#'.e(\Illuminate\Support\Str::slug($item->menu_title)).'','label' => ''.__($item->menu_title).'','active' => ''.e($loop->first ? 'true' : '').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/generators/item-trigger.blade.php ENDPATH**/ ?>