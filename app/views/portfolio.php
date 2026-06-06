<!-- Hero Section -->
<header class="px-margin-desktop py-section-padding max-w-[1440px] mx-auto">
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
<div class="md:col-span-8">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-[0.2em] mb-4 block">Curated Works</span>
<h1 class="font-display-lg text-display-lg mb-8">Elevating the quiet <br/>essence of space.</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">
                    Our portfolio is a collection of architectural narratives, where every line, texture, and light source is meticulously choreographed to create lasting resonance.
                </p>
</div>
</div>
</header>
<!-- Sticky Category Filter -->
<div class="sticky top-[80px] z-40 bg-background/50 backdrop-blur-sm border-y border-on-background/5 py-4 px-margin-desktop mb-12">
<div class="max-w-[1440px] mx-auto flex flex-wrap gap-x-12 gap-y-4 justify-start items-center">
<button class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest border-b border-tertiary pb-1">All Projects</button>
<button class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest hover:text-tertiary transition-colors duration-300">Residential</button>
<button class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest hover:text-tertiary transition-colors duration-300">Commercial</button>
<button class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest hover:text-tertiary transition-colors duration-300">Office</button>
<button class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest hover:text-tertiary transition-colors duration-300">Architecture</button>
</div>
</div>
<!-- Editorial Portfolio Grid (Staggered) -->
<main class="px-margin-desktop max-w-[1440px] mx-auto pb-section-padding">
<div class="grid grid-cols-1 md:grid-cols-12 gap-y-24 gap-x-gutter">
<?php if (!empty($projects)) : ?>
<?php
// Preserve the original editorial composition by cycling the five layout slots.
$portfolioSlots = [
    ['wrap' => 'md:col-span-7', 'aspect' => 'aspect-[4/5]', 'footer' => 'between'],
    ['wrap' => 'md:col-span-4 md:col-start-9 md:mt-32', 'aspect' => 'aspect-[3/4]', 'footer' => 'plain'],
    ['wrap' => 'md:col-span-8 md:col-start-1', 'aspect' => 'aspect-[16/9]', 'footer' => 'between'],
    ['wrap' => 'md:col-span-4 md:col-start-9 md:-mt-48', 'aspect' => 'aspect-[3/5]', 'footer' => 'plain'],
    ['wrap' => 'md:col-span-6 md:col-start-4', 'aspect' => 'aspect-square', 'footer' => 'center'],
];
?>
<?php foreach ($projects as $i => $project) : ?>
    <?php
    $slot = $portfolioSlots[$i % count($portfolioSlots)];
    $projectUrl = siteUrl('project/' . rawurlencode((string) ($project['slug'] ?? '')));
    ?>
<div class="<?php echo $slot['wrap']; ?> group project-card">
<div class="overflow-hidden <?php echo $slot['aspect']; ?> bg-surface-container mb-6">
<img alt="<?php echo e($project['name']); ?>" class="w-full h-full object-cover luxury-transition project-image" src="<?php echo e((string) ($project['featured_image'] ?? '')); ?>"/>
</div>
<?php if ($slot['footer'] === 'between') : ?>
<div class="flex justify-between items-baseline">
<div>
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest block mb-1"><?php echo e((string) ($project['category'] ?? '')); ?></span>
<h2 class="font-headline-md text-headline-md group-hover:text-tertiary luxury-transition"><?php echo e($project['name']); ?></h2>
</div>
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline" href="<?php echo $projectUrl; ?>">View Project</a>
</div>
<?php elseif ($slot['footer'] === 'center') : ?>
<div class="text-center">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest block mb-1"><?php echo e((string) ($project['category'] ?? '')); ?></span>
<h2 class="font-headline-md text-headline-md group-hover:text-tertiary luxury-transition"><a href="<?php echo $projectUrl; ?>"><?php echo e($project['name']); ?></a></h2>
</div>
<?php else : ?>
<div>
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest block mb-1"><?php echo e((string) ($project['category'] ?? '')); ?></span>
<h2 class="font-headline-md text-headline-md group-hover:text-tertiary luxury-transition"><a href="<?php echo $projectUrl; ?>"><?php echo e($project['name']); ?></a></h2>
</div>
<?php endif; ?>
</div>
<?php endforeach; ?>
<?php else : ?>
<!-- Project 1: Large Featured (Full Height) -->
<div class="md:col-span-7 group project-card">
<div class="overflow-hidden aspect-[4/5] bg-surface-container mb-6">
<img alt="The Monolith Residence" class="w-full h-full object-cover luxury-transition project-image" data-alt="A luxurious minimalist residential villa in a serene coastal setting. Large glass floor-to-ceiling windows reflect a soft sunset sky. The architecture features clean horizontal lines and natural limestone walls. Soft golden hour lighting illuminates a pristine infinity pool in the foreground, creating a mood of high-end, quiet luxury." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6kWN8_cqy_7Htz-KecVEUKQ7C2EyzJvGUmQwjKbu7JU8mYHrGHbMus5UsD-kiMDnB77hQSXQr2Vrv1eN-fa3ESQ8eGiW2m7RZx0D9qOtoXyI7WtYmcTpRcK-r8PAUvWTP9WH0WxZNYzkvEASguATklpJhgMhLOKEOFXTPTs50OQPj1beQDzmUzFFEvYQNi4bdEq9RRQqy0uk_10yYBFtmoNIKK_QXOr3f3neDOgYqtKaelpTbgrz-GKgUGrrVGGCE8YuXIrtwggs"/>
</div>
<div class="flex justify-between items-baseline">
<div>
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest block mb-1">Residential &mdash; Mallorca</span>
<h2 class="font-headline-md text-headline-md group-hover:text-tertiary luxury-transition">The Monolith Residence</h2>
</div>
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline" href="<?php echo siteUrl('project/the-monolith-residence'); ?>">View Project</a>
</div>
</div>
<!-- Project 2: Smaller Offset -->
<div class="md:col-span-4 md:col-start-9 md:mt-32 group project-card">
<div class="overflow-hidden aspect-[3/4] bg-surface-container mb-6">
<img alt="Apex HQ" class="w-full h-full object-cover luxury-transition project-image" data-alt="A sophisticated modern office interior featuring an open layout with dark walnut wood paneling and gold accent lighting. Sleek charcoal grey furniture is arranged neatly on a polished concrete floor. Large windows overlook a blurred cityscape at twilight. The atmosphere is professional, quiet, and exudes executive luxury." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD3X2OX7doTPL2BldncMBU5zuZcLKrQ-kPAtdJBW5D2WAKoGSIx6TwqZaI5CR5cHkqNmnPQCpqm6_IDBQ4586MscVMPF_l4dRn34KCHxcfFCKbaoOd_WLWi3IQj8fx991H330EA_4a7GOznQIFINKYGtKNpJ0qTHmr7nA6BigMcy3SvLAkdRnqaQ_wUo3ASDDksaR9jLeFz6ab5WrlUqs55BOvweo6T85qms3MylcEtfckkSHSZmTHUpfxQf4bcQc8UYW21bvADHpU"/>
</div>
<div>
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest block mb-1">Office &mdash; London</span>
<h2 class="font-headline-md text-headline-md group-hover:text-tertiary luxury-transition">Apex HQ</h2>
</div>
</div>
<!-- Project 3: Wide Horizontal -->
<div class="md:col-span-8 md:col-start-1 group project-card">
<div class="overflow-hidden aspect-[16/9] bg-surface-container mb-6">
<img alt="Lumina Concept Store" class="w-full h-full object-cover luxury-transition project-image" data-alt="A high-end retail boutique interior with sculptural white display pedestals. The space is illuminated by soft, diffused ceiling lights and elegant gold-trimmed shelving units. The floor is a continuous light beige marble. The overall aesthetic is museum-like, airy, and exceptionally minimal, focusing on a few curated luxury items." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEfgw5YMshZzK0DN3Z1wLDIDClbq0ytDoKb871uGg2AXYXl_sR7K2U0gMSz0PW-MXjyEzmuRfmepWHRtB8bTEmxa6YNRRrmy3np8TpDgWo58oqHGTMe8zJQ84WK49aM5D6ysE9cCJShfTHWKxq0sT0cmjNBermMKtToS_JOYliWpiJcWKMb5ieOQD7_vImMmDOw3ZvL7EhkLN71dSEroU6URcsSLA5P6DxoBlhVzPDHN6d5S0kWqp9Qnn4yWKbh9JeCGdKe_4H_ts"/>
</div>
<div class="flex justify-between items-baseline">
<div>
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest block mb-1">Commercial &mdash; Tokyo</span>
<h2 class="font-headline-md text-headline-md group-hover:text-tertiary luxury-transition">Lumina Concept Store</h2>
</div>
<a class="font-label-sm text-label-sm uppercase tracking-widest gold-underline" href="<?php echo siteUrl('project/the-monolith-residence'); ?>">View Project</a>
</div>
</div>
<!-- Project 4: Vertical Right -->
<div class="md:col-span-4 md:col-start-9 md:-mt-48 group project-card">
<div class="overflow-hidden aspect-[3/5] bg-surface-container mb-6">
<img alt="Vertical Flow House" class="w-full h-full object-cover luxury-transition project-image" data-alt="Detail shot of a contemporary staircase in a luxury home. The steps are made of light oak wood, supported by a hidden steel structure and a seamless glass railing with a slim gold handrail. Morning light casts sharp, geometric shadows against a textured plaster wall, emphasizing the architectural precision and material quality." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhh7O1L23XUtVI0Hq3gyXpZMcyzACD97ovvo9m-e2LaG7OzN-5O3o5zye-oBGStyQLFSDzWItLB55IGJ-XBqWO0p0CM2tWEEo3PQ8hAfWhiODkMTsMp7nmbd3VEDFs_JLPcnCTb0b4C4ErTZ-Fgnh4MBd34STVtFo5An5Fgn3z65vIYVNOixFOzOQxiQWKpiINGXj-uMKyBKen9v_gdx34Aw3qcPt4SpAfuKRpuXmtAlNdny2xOWW0cRlSjnKFBza7GA3hy8iAQYQ"/>
</div>
<div>
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest block mb-1">Architecture &mdash; Copenhagen</span>
<h2 class="font-headline-md text-headline-md group-hover:text-tertiary luxury-transition">Vertical Flow House</h2>
</div>
</div>
<!-- Project 5: Asymmetric Center -->
<div class="md:col-span-6 md:col-start-4 group project-card">
<div class="overflow-hidden aspect-square bg-surface-container mb-6">
<img alt="Soot &amp; Silk Penthouse" class="w-full h-full object-cover luxury-transition project-image" data-alt="A serene master bathroom featuring a free-standing matte black bathtub on a raised wooden platform. The walls are finished in a dark grey micro-cement, and a large skylight provides natural top-lighting. A single gold towel rail adds a touch of warmth. The scene is meditative, dark, and highly textural." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4OrYbDtErhBAAIiamQBAZn5hamyJnK1et61VHLog1BzkdoG5zXvAJxPz_p0J8bhN13943V23uYls_EgqlcCc2IuM9-WFKbrDy9RAKD9BuXIrjapQ3884fuMNPWxmYaC4d2vY-ksAF5iUZrLH6XleFarsOxJfBUktXrQKkqoO26OLaHZJfQgjnNoYmVkFKyyUxVx9f6zM7amU_ab5Lu61x0qN5Vz931wrwS6THpEhPfZC8fcf0P2qisHQ01jBqQIyepLz4D1zDQlA"/>
</div>
<div class="text-center">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest block mb-1">Residential &mdash; New York</span>
<h2 class="font-headline-md text-headline-md group-hover:text-tertiary luxury-transition">Soot &amp; Silk Penthouse</h2>
</div>
</div>
<?php endif; ?>
</div>
</main>
<!-- WhatsApp Floating Support -->
<div class="fixed bottom-8 right-8 z-50">
<a class="bg-primary-container text-tertiary rounded-full p-4 shadow-lg flex items-center justify-center hover:scale-110 transition-transform duration-300 group" href="https://wa.me/afterthink">
<span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">chat</span>
<span class="max-w-0 overflow-hidden group-hover:max-w-xs group-hover:ml-3 transition-all duration-500 whitespace-nowrap font-label-sm text-label-sm">Start a Conversation</span>
</a>
</div>
<!-- Footer -->
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.project-card').forEach(card => {
                card.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-1000', 'ease-out');
                observer.observe(card);
            });
        });
    </script>

