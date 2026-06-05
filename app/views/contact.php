<main>
<section class="px-margin-mobile md:px-margin-desktop py-section-padding max-w-[1440px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
        <div class="md:col-span-7">
            <span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest mb-4 block">Begin a Project</span>
            <h1 class="font-display-lg text-display-lg mb-8">Let us compose the atmosphere of your next space.</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Share the first outline of your residence, workplace, hospitality concept, or cultural project. Our studio will respond with a thoughtful next step.</p>
        </div>
        <aside class="md:col-span-4 md:col-start-9 border-l border-on-background/10 pl-8">
            <p class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-4">Studio</p>
            <p class="font-body-md text-body-md text-on-surface-variant mb-8"><?php echo nl2br(e($contact['address'] ?? "Afterthink Studio\nArchitecture and Interiors")); ?></p>
            <p class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-4">Contact</p>
            <p class="font-body-md text-body-md text-on-surface-variant"><?php echo e($contact['email'] ?? 'hello@afterthink.studio'); ?><br><?php echo e($contact['phone'] ?? '+1 212 555 0184'); ?></p>
        </aside>
    </div>
</section>
<section class="bg-surface-container-low py-section-padding px-margin-mobile md:px-margin-desktop">
    <form class="max-w-[960px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-gutter" method="post" action="<?php echo siteUrl('contact'); ?>">
        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken ?? csrfToken()); ?>">
        <?php if (!empty($success)) : ?>
            <div class="md:col-span-2 font-body-md text-body-md text-tertiary">Thank you. Your inquiry has been received.</div>
        <?php endif; ?>
        <?php if (!empty($errors)) : ?>
            <div class="md:col-span-2 font-body-md text-body-md text-error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">Name
            <input class="mt-3 w-full border-0 border-b border-on-background/20 bg-transparent px-0 py-4 font-body-md text-body-md focus:border-tertiary focus:ring-0" type="text" name="name" required>
        </label>
        <label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">Email
            <input class="mt-3 w-full border-0 border-b border-on-background/20 bg-transparent px-0 py-4 font-body-md text-body-md focus:border-tertiary focus:ring-0" type="email" name="email" required>
        </label>
        <label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">Phone
            <input class="mt-3 w-full border-0 border-b border-on-background/20 bg-transparent px-0 py-4 font-body-md text-body-md focus:border-tertiary focus:ring-0" type="tel" name="phone">
        </label>
        <label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">Project Type
            <input class="mt-3 w-full border-0 border-b border-on-background/20 bg-transparent px-0 py-4 font-body-md text-body-md focus:border-tertiary focus:ring-0" type="text" name="source">
        </label>
        <label class="md:col-span-2 font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">Message
            <textarea class="mt-3 min-h-48 w-full border-0 border-b border-on-background/20 bg-transparent px-0 py-4 font-body-md text-body-md focus:border-tertiary focus:ring-0" name="message" required></textarea>
        </label>
        <div class="md:col-span-2">
            <button class="font-label-sm text-label-sm bg-primary text-on-primary px-8 py-4 uppercase tracking-widest hover:bg-tertiary transition-all duration-300" type="submit">Send Inquiry</button>
        </div>
    </form>
</section>
</main>
