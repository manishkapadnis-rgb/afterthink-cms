<main>
<?php if (!empty($postSlug)) : ?>
    <?php if (!empty($post)) : ?>
        <?php
        $publishedAt = !empty($post['published_at'])
            ? date('F j, Y', strtotime((string) $post['published_at']))
            : '';
        ?>
<!-- Blog Detail -->
<article class="px-margin-mobile md:px-margin-desktop py-section-padding max-w-[960px] mx-auto">
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline inline-block mb-12" href="<?php echo siteUrl('blog'); ?>">Back to Journal</a>
<?php if (!empty($post['category_name'])) : ?>
<span class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-4 block"><?php echo e((string) $post['category_name']); ?></span>
<?php endif; ?>
<h1 class="font-display-lg text-display-lg mb-6"><?php echo e((string) $post['title']); ?></h1>
<?php if ($publishedAt !== '') : ?>
<p class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant mb-12"><?php echo e($publishedAt); ?></p>
<?php endif; ?>
<?php if (!empty($post['featured_image'])) : ?>
<div class="aspect-[16/9] overflow-hidden bg-surface-container mb-12">
<img alt="<?php echo e((string) $post['title']); ?>" class="w-full h-full object-cover" src="<?php echo e((string) $post['featured_image']); ?>"/>
</div>
<?php endif; ?>
<div class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed"><?php echo nl2br(e((string) ($post['content'] ?? ''))); ?></div>
</article>
    <?php else : ?>
<!-- Post Not Found -->
<section class="px-margin-mobile md:px-margin-desktop py-section-padding max-w-[960px] mx-auto text-center">
<h1 class="font-display-lg text-headline-lg mb-8">Note not found.</h1>
<p class="font-body-md text-body-md text-on-surface-variant mb-12">The journal entry you are looking for is no longer available.</p>
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline" href="<?php echo siteUrl('blog'); ?>">Back to Journal</a>
</section>
    <?php endif; ?>
<?php else : ?>
<section class="px-margin-mobile md:px-margin-desktop py-section-padding max-w-[1440px] mx-auto">
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
<div class="md:col-span-8">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest mb-4 block">Journal</span>
<h1 class="font-display-lg text-display-lg mb-8">Notes on material, light, and spatial permanence.</h1>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mt-16">
<?php if (!empty($posts)) : ?>
    <?php foreach ($posts as $listPost) : ?>
<article class="border-t border-on-background/10 pt-8">
<?php if (!empty($listPost['category_name'])) : ?>
<p class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-4"><?php echo e((string) $listPost['category_name']); ?></p>
<?php endif; ?>
<h2 class="font-headline-md text-headline-md mb-5"><?php echo e((string) $listPost['title']); ?></h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-8"><?php echo e(excerpt($listPost['content'] ?? '')); ?></p>
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline" href="<?php echo siteUrl('blog/' . rawurlencode((string) ($listPost['slug'] ?? ''))); ?>">Read Note</a>
</article>
    <?php endforeach; ?>
<?php else : ?>
<article class="border-t border-on-background/10 pt-8">
<p class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-4">Material Studies</p>
<h2 class="font-headline-md text-headline-md mb-5">The quiet authority of stone in residential architecture</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-8">A look at how mass, shadow, and surface temperature shape the emotional reading of a room.</p>
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline" href="<?php echo siteUrl('blog/stone-in-residential-architecture'); ?>">Read Note</a>
</article>
<article class="border-t border-on-background/10 pt-8">
<p class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-4">Process</p>
<h2 class="font-headline-md text-headline-md mb-5">Why restraint is a practical construction discipline</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-8">Minimal compositions only feel effortless when detailing, sequencing, and trade coordination are exact.</p>
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline" href="<?php echo siteUrl('blog/restraint-as-discipline'); ?>">Read Note</a>
</article>
<article class="border-t border-on-background/10 pt-8">
<p class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-4">Lighting</p>
<h2 class="font-headline-md text-headline-md mb-5">Designing rooms around the day, not the fixture</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-8">Natural light is not a bonus layer. It is one of the earliest materials in the plan.</p>
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline" href="<?php echo siteUrl('blog/rooms-around-the-day'); ?>">Read Note</a>
</article>
<?php endif; ?>
</div>
</section>
<?php endif; ?>
</main>
