<?php

$classname = 'transition-all ';

switch ($style) {
    case '1':
        $classname .= 'p-7 text-[1.25rem] text-center border rounded-xl font-heading font-medium hover:text-heading-foreground [&.lqd-is-active]:bg-white [&.lqd-is-active]:text-heading-foreground [&.lqd-is-active]:border-white [&.lqd-is-active]:shadow-lg';
        break;
    case '2':
        $classname .= 'px-4 py-2 rounded-lg hover:text-heading-foreground [&.lqd-is-active]:text-heading-foreground [&.lqd-is-active]:bg-white [&.lqd-is-active]:shadow-xl';
        break;
    case '3':
        $classname .= 'px-4 py-[0.35rem] min-w-[210px] rounded-lg hover:text-heading-foreground [&.lqd-is-active]:text-heading-foreground [&.lqd-is-active]:bg-white [&.lqd-is-active]:shadow-xs max-sm:w-full max-sm:h-10';
        break;
}

if ($active) {
    $classname .= ' lqd-is-active';
}

?>

<button
    class="<?php echo e($classname); ?>"
    data-target="<?php echo e($target); ?>"
>
    <?php echo e(ucfirst($label)); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($badge)): ?>
        <span class="ml-1 inline-block rounded-md bg-[#684AE2] bg-opacity-10 p-[0.375rem] px-2 text-[#684AE2]"><?php echo e($badge); ?></span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</button>
<?php /**PATH D:\project laravel\magicai\resources\views/default/components/tabs-trigger.blade.php ENDPATH**/ ?>