<?php
$wrapper_classnames = ['lqd-section-header', 'mx-auto', 'text-center'];

if (empty($width)) {
    $wrapper_classnames[] = 'w-2/5';
} else {
    $wrapper_classnames[] = $width;
}
if (empty($mb)) {
    $wrapper_classnames[] = 'mb-14';
} else {
    $wrapper_classnames[] = 'mb-' . $mb;
}
?>

<header class="<?php echo e(implode(' ', $wrapper_classnames)); ?> max-xl:w-8/12 max-lg:w-10/12 max-md:w-full">
	<?php echo e($slot); ?>

	<h2 class="lqd-section-header-title mb-[0.45em]"><?php echo e($title); ?></h2>
	<p class="lqd-section-header-desc text-[18px] leading-[1.444em]"><?php echo e($subtitle); ?></p>
</header>
<?php /**PATH D:\project laravel\magicai\resources\views/default/components/section-header.blade.php ENDPATH**/ ?>