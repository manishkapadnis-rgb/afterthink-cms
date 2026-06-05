<?php
$project = $project ?? null;
$heroImage = $project['featured_image'] ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuBsNeXKg-biTKin-Z3AQ9vfc3ypzzu54i5Udd9SICQ0kMbHQZS90DWMW6Woav2pinw2fRGq3AQkUbWwqhNIdiPYSf-aKnepLsWWEVwm2I2zjkMKDBW4CRFw_EF-XwW4Gsr8rd-YBA_kbuLRMUa1iyoUiLHmBrgY-QDCNgBEJlH0BMF0wcfSA63TkIIqN9qNaSIstNneEVOy1q8H2z08sOnXWY1wpDdp2PpLm7VUAZKAd7r4JbKxATyme1O2VIahZvY_aPxDNADosz0';
$projectName = $project['name'] ?? 'The Monolith Residence';
$projectCategory = $project['category'] ?? 'Residential';
$projectYear = !empty($project['created_at']) ? date('Y', strtotime((string) $project['created_at'])) : '2024';
$projectDescription = $project['description']
    ?? 'Commissioned by a private collector, The Monolith Residence was conceived as a sanctuary that dissolves the boundaries between architecture and landscape. The client required a space that could house a rotating collection of large-scale sculpture while serving as a quiet, functional family retreat.';
?>
<main>
<!-- Hero Banner -->
<section class="relative w-full h-[921px] overflow-hidden">
<img alt="<?php echo e($projectName); ?> Hero" class="w-full h-full object-cover" src="<?php echo e((string) $heroImage); ?>"/>
<div class="absolute inset-0 bg-gradient-to-t from-background/40 to-transparent"></div>
<div class="absolute bottom-margin-desktop left-margin-desktop right-margin-desktop flex flex-col md:flex-row justify-between items-end">
<div class="max-w-2xl">
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest mb-4"><?php echo e($projectCategory); ?> | <?php echo e($projectYear); ?></p>
<h1 class="font-display-lg text-display-lg text-on-surface leading-none"><?php echo e($projectName); ?></h1>
</div>
<div class="hidden md:block">
<div class="flex items-center gap-4 text-tertiary">
<span class="font-label-sm text-label-sm uppercase">Scroll to Explore</span>
<span class="material-symbols-outlined animate-bounce">arrow_downward</span>
</div>
</div>
</div>
</section>
<!-- Project Overview & Requirements -->
<section class="py-section-padding px-margin-desktop max-w-[1440px] mx-auto">
<div class="grid-asymmetric">
<div class="col-span-12 md:col-span-5 border-t border-on-background/10 pt-12">
<h2 class="font-label-sm text-label-sm text-tertiary uppercase mb-8">Brief</h2>
<p class="font-body-lg text-body-lg text-on-surface mb-8">
                        <?php echo nl2br(e((string) $projectDescription)); ?>
                    </p>
<div class="space-y-6">
<div class="flex justify-between border-b border-on-background/10 pb-2">
<span class="font-label-sm text-label-sm text-on-surface-variant">Location</span>
<span class="font-label-sm text-label-sm text-on-surface">Sedona, Arizona</span>
</div>
<div class="flex justify-between border-b border-on-background/10 pb-2">
<span class="font-label-sm text-label-sm text-on-surface-variant">Area</span>
<span class="font-label-sm text-label-sm text-on-surface">8,400 sq. ft.</span>
</div>
<div class="flex justify-between border-b border-on-background/10 pb-2">
<span class="font-label-sm text-label-sm text-on-surface-variant">Client</span>
<span class="font-label-sm text-label-sm text-on-surface">Confidential Collector</span>
</div>
</div>
</div>
<div class="col-span-12 md:col-start-8 md:col-span-5 pt-12">
<h2 class="font-label-sm text-label-sm text-tertiary uppercase mb-8">The Challenge</h2>
<p class="font-body-md text-body-md text-on-surface-variant italic border-l-2 border-tertiary pl-6">
                        "The primary challenge was to create a sense of 'heavy weight' through materials like solid travertine while maintaining an atmosphere of 'lightness' through strategic voids and suspended architectural elements. We wanted the house to feel like it had always been part of the rocky terrain."
                    </p>
</div>
</div>
</section>
<!-- Design Concept Section -->
<section class="bg-surface-container-low py-section-padding px-margin-desktop">
<div class="max-w-[1440px] mx-auto">
<div class="text-center mb-16">
<h2 class="font-display-lg text-headline-lg text-on-surface">Design Concept: The Void</h2>
</div>
<div class="grid-asymmetric items-center">
<div class="col-span-12 md:col-span-7">
<div class="image-zoom-container bg-surface-container border border-on-background/5">
<img alt="Architectural Sketch" class="w-full mix-blend-multiply opacity-80" data-alt="An architectural conceptual sketch of a modern minimalist residence. The sketch shows clean, charcoal lines on a textured beige paper background, illustrating the interplay of solid stone masses and negative space. High-end editorial feel with artistic notations and subtle shadows that emphasize the three-dimensional form of the project." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_vZE_Q0ptLVT4TUf2xCaZHR3nkQXtelsMczYx8DRrLfikgjwxbNd5R8dxA9hFyMlePvcDIoIjQDSOm_8aGh8ZGLqWp7xhvoDNnB0bhtWrNJM7jLa4LWIR51K3X5j91lEy5PQLfIuBbIXUvbmahmpkBit8fkYdBouIZH2ik_I2LKgITkndI_QsYHNsopsB3Pv6Vv5ZTvF-GrTxkqRt1KDqTBsKgVRLs4y5bbMMHJhsWjgeyudmwbzEYo6Ph1VQqznQ-yL617DC5j8"/>
</div>
</div>
<div class="col-span-12 md:col-span-4 md:col-start-9">
<p class="font-label-sm text-label-sm text-tertiary uppercase mb-4">Initial Ideation</p>
<h3 class="font-headline-md text-headline-md text-on-surface mb-6">Structural Poetics</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Our process began with hand-drawn charcoal sketches to capture the raw emotional weight of the site. We explored the concept of 'subtractive architecture'&mdash;where the living spaces are carved out of a single monolithic block, creating framed vistas of the desert horizons.
                        </p>
</div>
</div>
</div>
</section>
<!-- Gallery Grid -->
<section class="py-section-padding px-margin-desktop max-w-[1440px] mx-auto">
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
<?php if (!empty($projectGallery)) : ?>
<?php
$gallerySlots = [
    'md:col-span-8 image-zoom-container h-[600px]',
    'md:col-span-4 image-zoom-container h-[600px]',
    'md:col-span-4 image-zoom-container h-[400px] mt-8',
    'md:col-span-8 image-zoom-container h-[400px] mt-8',
];
?>
<?php foreach ($projectGallery as $g => $galleryItem) : ?>
<div class="<?php echo $gallerySlots[$g % count($gallerySlots)]; ?>">
<img alt="<?php echo e((string) ($galleryItem['caption'] ?? $projectName)); ?>" class="w-full h-full object-cover" src="<?php echo e((string) ($galleryItem['image_path'] ?? '')); ?>"/>
<?php if (!empty($galleryItem['caption'])) : ?>
<p class="mt-4 font-label-sm text-label-sm text-on-surface-variant uppercase"><?php echo e((string) $galleryItem['caption']); ?></p>
<?php endif; ?>
</div>
<?php endforeach; ?>
<?php else : ?>
<div class="md:col-span-8 image-zoom-container h-[600px]">
<img alt="Interior Living Space" class="w-full h-full object-cover" data-alt="Internal view of a luxury living room with high ceilings. The floor is polished beige travertine, and the walls are natural walnut wood panels. Minimalist furniture including a low-profile white linen sofa faces a large window overlooking a serene garden. Soft, diffused daylight fills the space, creating a calm and sophisticated luxury atmosphere." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBczb4KLw8NGuyT-IB2QCELCjjAWV8u8_ckcCz9i5qMpzLFiYM3GltAXU1yVrWJClHcKFCvWvrY8EckXO00TEZX1s5iCu3B1hdvfslFZ_OQztxKIw-eio5A_H23nv2pq72vSFYfjcpum3HMrXjbB1Y2aqYFLRVcImq1qnRYQb3XCRa0mSWYnvp5yH1R6cudTPR4CjnhStoijfnlZo9cmiSY2Iobz5vuhrNWk6m7f_1rDTkt4TR6Nd9Ju93ay_MsgSyMvskAusvjxWU"/>
<p class="mt-4 font-label-sm text-label-sm text-on-surface-variant uppercase">Living Sanctuary</p>
</div>
<div class="md:col-span-4 image-zoom-container h-[600px]">
<img alt="Architectural Detail" class="w-full h-full object-cover" data-alt="Close-up architectural detail of a cantilevered concrete staircase inside a minimalist residence. The steps appear to float out of a smooth travertine wall. The lighting is dramatic, casting soft long shadows. The overall aesthetic is industrial yet refined, featuring a muted color palette of greys and warm beiges." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJAHHeLOZMdK5u-8k1onoTCfZCQmkmr0anGt_Kzzzf2EGmSHf8EHL0b1ZYp_YUKZHOG-dLYv7zXFHtNULkBs7Sx7TrojTvgCQudE4teo9EbScPaDiZYWnaCEYPvOoN18I7jnjzlrmhlWPJXh6ZbKgZEMTTDUaCAC3wFp27lD-Ms2lrLQb-n7_KuJr7Ru1thwOLVIdwdlp_O-PccYEnmikZUWFIWsECqJDra5R6Dj451aytKO_cgBs8StVNU1nSYpVtZdy2y0IcQjA"/>
<p class="mt-4 font-label-sm text-label-sm text-on-surface-variant uppercase">The Floating Staircase</p>
</div>
<div class="md:col-span-4 image-zoom-container h-[400px] mt-8">
<img alt="Kitchen Detail" class="w-full h-full object-cover" data-alt="A modern, minimalist kitchen featuring seamless walnut cabinetry and a large waterfall island made of matte dark stone. The design is clean with no visible hardware. Soft recessed lighting illuminates the workspace, emphasizing the rich textures of the natural materials against the light-colored walls." src="https://lh3.googleusercontent.com/aida-public/AB6AXuANGjqdottSN6PvFkJaNSx3OxTL6axJDuPBzZQX5CQx-UibjEpIXPtyBccjBqft6QsbIUm_1Mc5kdRvY0lbQQuAxUEubN3cRVNNGL6chHo0kiKojJwCUTpO9V9f4DIwNYnfsGB4rk7xcRL2BfevrdxupjBvwoKfjTR6jRx2XmTMfZue2In8RlBw7kYYArgsgrsS3FkVxhrAof4zmhTOa6YJ0eczATLOC0uTipdiOnrLxboN98ikl1PaJCSlrIhf4GvrYXo72bMW-NI"/>
</div>
<div class="md:col-span-8 image-zoom-container h-[400px] mt-8">
<img alt="Evening Reflection" class="w-full h-full object-cover" data-alt="An evening shot of a luxury villa's outdoor patio area. A long rectangular reflection pool is perfectly still, reflecting the warm interior lights of the glass-walled house. The patio is paved in travertine, and the surrounding landscape is dark and silent, creating a sense of ultimate privacy and high-end serenity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8kWp-LL1Ovqn6Ws86gRuIGnXLDTMu6lCPcB2quoiKyISOnqWP2K5Rw4JxU7Keiz-_s5PVa2W_XNmPmhnjMhvtJSP0VwQz2n5pzcdiUuTdMROFow-dMbjK1exnYRxWeL5TyAB-dPSYDGxCkb8q6DRAb9wBgt4hNGzD9w9b7Wz9qRbarFItu67319C1nrWFoiaYr9zSziR2TpkhW8oqgouQcFk2bip4TWRQUP11vO9bk92WFKef4sAMkPhBDn7P-Fm-v4O6JyCqd60"/>
</div>
<?php endif; ?>
</div>
</section>
<!-- Video Walkthrough Placeholder -->
<section class="bg-surface-container-highest py-section-padding px-margin-desktop">
<div class="max-w-[1200px] mx-auto">
<div class="relative group cursor-pointer aspect-video bg-on-background/5 overflow-hidden">
<img alt="Video Thumbnail" class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-1000" data-alt="A blurred, cinematic architectural shot of a luxury home exterior at twilight. The focus is soft, showing glowing windows and sharp rooflines against a deep blue sky. A large play icon is overlaid in the center, inviting the viewer to watch a video walkthrough. The mood is mysterious and high-end." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqiblxH5FtlYKWFoZfCANJcmzWCqD_N4QoqSW_JmDCga7c4NpNl2Nw4hmORvcCT9C6L4dOJIIy-P1Dj1EvxnLCkSKEbAH51kwoeqIcOPHuK-xFS86LxtSpUex6mpPGN5FkaRmL7Bbnu-wFR-G6HmODKg3rNP0fsSSJ6dL5rrtsUZ2N7w0zBCGhujBHSIQSwSG9eEpkyC0f1j2gRKdV2TiN9wGGVGU04VbPz1nUnM_zmnuetdRzoYnwa7ah8oh57NG8qPIHCPzXNdw"/>
<div class="absolute inset-0 flex items-center justify-center">
<div class="w-24 h-24 rounded-full border border-on-surface/20 flex items-center justify-center bg-background/10 backdrop-blur-sm group-hover:bg-tertiary transition-colors duration-500">
<span class="material-symbols-outlined text-4xl text-on-surface">play_arrow</span>
</div>
</div>
</div>
<div class="mt-8 text-center">
<h4 class="font-headline-md text-headline-md text-on-surface">Cinematic Walkthrough</h4>
<p class="font-label-sm text-label-sm text-on-surface-variant mt-2 uppercase tracking-widest">Experience the flow of space</p>
</div>
</div>
</section>
<!-- Materials Section -->
<section class="py-section-padding px-margin-desktop max-w-[1440px] mx-auto">
<div class="mb-16">
<h2 class="font-label-sm text-label-sm text-tertiary uppercase mb-4">Materiality</h2>
<h3 class="font-display-lg text-headline-lg text-on-surface">Earth, Wood, &amp; Stone</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
<div class="space-y-6">
<div class="aspect-square bg-surface-container overflow-hidden">
<img alt="Travertine Texture" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700" data-alt="A macro photograph of raw, cream-colored travertine stone. The surface shows intricate natural pits and tonal variations of ivory, beige, and sand. The lighting is side-lit to emphasize the porous, tactile quality of the stone. Clean, editorial composition." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgz1nkHs7rhwWqzWXbtT9zyF3aspT3vcbYfY1sMQuE2G98cyzDBj-kU2mG8jXUDvJFDJFHSkj6ha6zo3YQlTmnF-mGUzeebLbI3Ds66W7Xvl1oJhXPSGQZd5Dhz4xSjzVXASVBErQPKexy9bvruR3V1_OUjI4F9IIrS91PxV0mG56hdx0UogmI3JF862TERmIOtxb8HqPd5mOKtF2vg0J4gIbQ1HpzvebMTxB4g30pz_Ypie5Ig72S6OLdpGY128BPA41rO2IRPj4"/>
</div>
<h4 class="font-headline-md text-body-lg font-bold text-on-surface">Silver Travertine</h4>
<p class="font-body-md text-body-md text-on-surface-variant">Sourced from Italian quarries, providing a timeless, porous warmth to the structural walls.</p>
</div>
<div class="space-y-6">
<div class="aspect-square bg-surface-container overflow-hidden">
<img alt="Walnut Texture" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700" data-alt="A high-resolution close-up of dark walnut wood grain. The wood features rich chocolate tones with fluid, darker waves of natural grain. The finish is matte, showing a smooth, luxurious texture that reflects soft light. Professional architectural material sample shot." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAheNyfYGUOz4SknBjyMD7tkC3JwSHRoQ0AW312NV7w6qISNzQn720tBrz4kx-m8iq8ycvRlTdqSKQMOvXof1TVcYNvdJa5D7TtSlt9Jz_VUDtSvPujTuhzjDJQwx65UgMcDYt9519JEhJXVqy9W3Qr3vb9joD1y_F-kg9A0F15njvTpn5RAcfuypeNiOnbRAlUc8_lwTqzfLRtkcz6ljv-wJ3Q1-WhoU7-LxAcunbMjnqU3rSf_SinaD3i6YCWV7EJSTo7rQ3oFmM"/>
</div>
<h4 class="font-headline-md text-body-lg font-bold text-on-surface">American Walnut</h4>
<p class="font-body-md text-body-md text-on-surface-variant">Used throughout the millwork to provide a rich, dark contrast to the stone surfaces.</p>
</div>
<div class="space-y-6">
<div class="aspect-square bg-surface-container overflow-hidden">
<img alt="Glass &amp; Metal" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700" data-alt="A clean architectural photograph of a high-performance floor-to-ceiling glass panel. The glass shows subtle reflections of a minimalist interior, while its dark charcoal aluminum frame is sharp and thin. The composition is geometric and emphasizes transparency and modern precision." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAfJNVNUsp3OHQqbFugtlG_s4jfHfLNez_Z4Q9RNap8paNJrXWb1qlNjPGTFj91iofZyq2fw-5IgB6CL8SWs7giL_sk32dnPm-48rqatLNZv4hGiFXld_9F9goCqD3DJuZ0YFRG33Yx52vPsl5zK4OrdafbXRYNpJef6GWJxw98WC1TmqRSXPiDmZYl-YcJcXWbhRTV0r32tNW7JOBT5uM7cChpPKM5myWtpbSwhuSZsLugGtzGnEMqDnHJCFYISwQ9NZkDiyOS7hA"/>
</div>
<h4 class="font-headline-md text-body-lg font-bold text-on-surface">Oversized Glass</h4>
<p class="font-body-md text-body-md text-on-surface-variant">Custom-engineered panels that blur the line between interior and the Arizona desert.</p>
</div>
</div>
</section>
<!-- Execution & Outcome -->
<section class="py-section-padding px-margin-desktop bg-surface max-w-[1440px] mx-auto border-t border-on-background/10">
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
<div class="md:col-span-5">
<h2 class="font-label-sm text-label-sm text-tertiary uppercase mb-8">Process</h2>
<div class="space-y-12">
<div class="relative pl-12 border-l border-outline-variant">
<div class="absolute -left-1.5 top-0 w-3 h-3 bg-tertiary rounded-full"></div>
<h5 class="font-label-sm text-label-sm font-bold text-on-surface uppercase mb-2">Phase 01: Excavation</h5>
<p class="font-body-md text-body-md text-on-surface-variant">Integrating the foundation into the existing basalt rock formation of the site.</p>
</div>
<div class="relative pl-12 border-l border-outline-variant">
<div class="absolute -left-1.5 top-0 w-3 h-3 bg-outline-variant rounded-full"></div>
<h5 class="font-label-sm text-label-sm font-bold text-on-surface uppercase mb-2">Phase 02: Structural Framing</h5>
<p class="font-body-md text-body-md text-on-surface-variant">Erecting the steel skeleton to support the massive cantilevered roof sections.</p>
</div>
<div class="relative pl-12 border-l border-outline-variant">
<div class="absolute -left-1.5 top-0 w-3 h-3 bg-outline-variant rounded-full"></div>
<h5 class="font-label-sm text-label-sm font-bold text-on-surface uppercase mb-2">Phase 03: Finishing</h5>
<p class="font-body-md text-body-md text-on-surface-variant">Meticulous stone cladding and bespoke millwork installation over six months.</p>
</div>
</div>
</div>
<div class="md:col-span-6 md:col-start-7 bg-primary-container p-12 flex flex-col justify-center">
<span class="material-symbols-outlined text-4xl text-tertiary mb-8">format_quote</span>
<p class="font-headline-md text-headline-md text-on-primary-container mb-8">
                        "Afterthink Studio didn't just build a house; they created a piece of art that breathes with the land. Every morning, the way the light hits the travertine is a new experience."
                    </p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-outline-variant"></div>
<div>
<p class="font-label-sm text-label-sm font-bold text-on-surface">The Client</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Owner, The Monolith Residence</p>
</div>
</div>
</div>
</div>
</section>
<!-- WhatsApp Support Float -->
<div class="fixed bottom-8 right-8 z-50">
<a class="bg-primary-container dark:bg-primary-container text-tertiary dark:text-on-tertiary-container rounded-full p-4 shadow-lg flex items-center group hover:scale-110 transition-transform duration-300" href="<?php echo siteUrl('contact'); ?>">
<span class="material-symbols-outlined text-3xl" data-icon="chat">chat</span>
<span class="max-w-0 overflow-hidden group-hover:max-w-xs group-hover:ml-4 transition-all duration-500 font-label-sm text-label-sm whitespace-nowrap">Chat with Architect</span>
</a>
</div>
</main>
<!-- Footer -->
<script>
        // Subtle Parallax & Reveal Effects
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroImg = document.querySelector('section img');
            if(heroImg) {
                heroImg.style.transform = `translateY(${scrolled * 0.4}px)`;
            }
            
            // Fade-in navigation background
            const nav = document.querySelector('nav');
            if (scrolled > 100) {
                nav.classList.add('shadow-sm');
            } else {
                nav.classList.remove('shadow-sm');
            }
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1
        };

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section').forEach(section => {
            section.classList.add('transition-all', 'duration-1000', 'ease-out', 'opacity-0', 'translate-y-10');
            revealObserver.observe(section);
        });
    </script>

