<div
    class="lqd-tabs-content <?php echo e(!$loop->first ? 'hidden' : ''); ?>"
    id="<?php echo e(\Illuminate\Support\Str::slug($item->menu_title)); ?>"
>
    <div class="flex flex-wrap justify-between max-md:gap-4">
        <div class="flex w-[47%] flex-col items-start rounded-xl p-8 shadow-lg max-md:w-full">
            <h6 class="mb-10 rounded-xl bg-[#F3E5F5] px-3 py-1">
                <?php echo __($item->subtitle_one); ?>

                <span class="dot"></span>
                <span class="opacity-50"><?php echo __($item->subtitle_two); ?></span>
            </h6>
            <h3 class="mb-7 mt-auto"><?php echo __($item->title); ?></h3>
            <p class="text-lg leading-[25px] [&_strong]:font-semibold [&_strong]:text-black">
                <?php echo __($item->text); ?></p>
        </div>
        <div
            class="group w-[47%] rounded-xl p-8 max-md:w-full"
            style="background-color: <?php echo e($item->color); ?>;"
        >
            <div class="text-center">
                <figure class="mb-6 w-full">
                    <img
                        class="w-full rounded-2xl shadow-[0px_3px_45px_rgba(0,0,0,0.07)] transition-all duration-300 group-hover:-translate-y-2 group-hover:scale-[1.025] group-hover:shadow-[0px_20px_65px_rgba(0,0,0,0.05)]"
                        width="878"
                        height="748"
                        src="<?php echo e(custom_theme_url($item->image, true)); ?>"
                        alt="<?php echo e(__($item->image_title)); ?>"
                    >
                </figure>
                <p class="text-lg font-semibold text-heading-foreground"><?php echo __($item->image_title); ?></p>
                <p class="text-[12px] text-heading-foreground"><?php echo __($item->image_subtitle); ?></p>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\project laravel\magicai\resources\views/default/landing-page/generators/item-content.blade.php ENDPATH**/ ?>