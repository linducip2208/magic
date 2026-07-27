<?php

$wrapper_classname = 'group ';
$title_classname = 'mb-3 ';
$icon_classname = 'grid place-items-center shrink-0 ';

switch ($style) {
    case '1':
        $wrapper_classname .= 'flex gap-5';
        $icon_classname .= 'w-11 h-11 rounded-lg bg-[#F2F2F2] text-heading-foreground transition-all group-hover:scale-125 group-hover:shadow-xl group-hover:bg-black group-hover:text-white';
        break;
    case '2':
        $wrapper_classname .= 'p-7 bg-[#F5F5F7] rounded-2xl';
        $title_classname .= 'font-semibold font-body';
        break;
    case '3':
        $wrapper_classname .= 'px-8 pb-12 bg-[#F5F5F7] rounded-[40px] text-center overflow-hidden transition-all hover:-translate-y-2 hover:shadow-lg';
        $title_classname .= 'font-bold';
        break;
    case '4':
        $wrapper_classname .= 'text-center text-[#292E34]';
        $icon_classname .= 'mb-3 w-[71px] h-[71px] mx-auto rounded-full bg-black bg-opacity-5 text-[#6C727B] transition-all group-hover:-translate-y-2 group-hover:scale-110 group-hover:shadow-xl group-hover:bg-black group-hover:text-white';
        $title_classname = 'text-[1rem] font-body font-medium tracking-none';
        break;
}

if (!empty($wrapperClass)) {
    $wrapper_classname .= ' ' . $wrapperClass;
}

?>

<div class="<?php echo e($wrapper_classname); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($icon)): ?>
        <div class="<?php echo e($icon_classname); ?>">
            <?php echo e($icon); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($image)): ?>
        <figure class="<?php echo e($style === '2' ? 'mix-blend-multiply group-hover:scale-125' : 'group-hover:scale-105'); ?> relative z-0 inline-block transition-all duration-300">
            <?php echo e($image); ?>

        </figure>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="relative shrink">
        <h4 class="<?php echo e($title_classname); ?>">
            <?php echo $title; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($badge)): ?>
                <span class="ml-3 rounded-xl bg-[#5F499D] bg-opacity-10 px-2 py-1 text-[11px] font-semibold uppercase tracking-wider text-[#5F499D]"><?php echo e($badge); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </h4>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($desc)): ?>
            <p class="text-[14px]"><?php echo $desc; ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH D:\project laravel\magicai\resources\views/default/components/box.blade.php ENDPATH**/ ?>