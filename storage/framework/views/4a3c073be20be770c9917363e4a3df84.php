<?php if (isset($component)) { $__componentOriginal128a9a5e7887d8246812b1454fe28d25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal128a9a5e7887d8246812b1454fe28d25 = $attributes; } ?>
<?php $component = App\View\Components\AccordionItem::resolve(['id' => 'faq-'.e($item->id).'','title' => ''.__($item->question).'','content' => ''.__($item->answer).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('accordion-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AccordionItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal128a9a5e7887d8246812b1454fe28d25)): ?>
<?php $attributes = $__attributesOriginal128a9a5e7887d8246812b1454fe28d25; ?>
<?php unset($__attributesOriginal128a9a5e7887d8246812b1454fe28d25); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal128a9a5e7887d8246812b1454fe28d25)): ?>
<?php $component = $__componentOriginal128a9a5e7887d8246812b1454fe28d25; ?>
<?php unset($__componentOriginal128a9a5e7887d8246812b1454fe28d25); ?>
<?php endif; ?>
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/faq/item.blade.php ENDPATH**/ ?>