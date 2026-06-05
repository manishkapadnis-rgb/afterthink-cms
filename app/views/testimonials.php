<main class="max-w-[1440px] mx-auto px-margin-desktop">
<!-- Hero Section -->
<section class="py-section-padding">
<div class="max-w-4xl">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest mb-4 block">Kind Words</span>
<h1 class="font-display-lg text-display-lg mb-8 italic">The space is the mirror of the soul. Our clients' voices reflect the harmony we build together.</h1>
</div>
</section>
<!-- Google Reviews Summary Card -->
<section class="mb-section-padding">
<div class="grid grid-cols-12 gap-gutter">
<div class="col-span-12 md:col-span-4 bg-surface-container-low p-12 border border-on-background/5">
<div class="flex items-center gap-2 mb-6">
<span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<div class="font-headline-md text-headline-md mb-2">4.9 / 5.0</div>
<div class="font-body-md text-body-md text-on-surface-variant mb-6">Based on 124 verified client experiences on Google Business.</div>
<a class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest text-underline-gold inline-block" href="<?php echo siteUrl('testimonials'); ?>">Read All Google Reviews</a>
</div>
<div class="col-span-12 md:col-span-8 flex flex-col justify-center">
<div class="font-body-lg text-body-lg text-on-surface-variant italic border-l-2 border-tertiary pl-8">
                        "<?php echo e((string) ($testimonials[0]['review'] ?? 'Afterthink Studio didn\'t just design a house; they choreographed a lifestyle. Every shadow, every ray of light, and every material choice feels deeply intentional and uniquely ours.')); ?>"
                    </div>
</div>
</div>
</section>
<div class="hairline-divider mb-section-padding"></div>
<!-- Detailed Case Study Testimonials -->
<section class="mb-section-padding space-y-32">
<?php if (!empty($testimonials)) : ?>
<?php foreach ($testimonials as $t => $testimonial) : ?>
<?php
$photo = (string) ($testimonial['photo'] ?? '');
$company = (string) ($testimonial['company'] ?? '');
?>
<?php if ($t % 2 === 0) : ?>
<!-- Case Study (image left) -->
<div class="grid grid-cols-12 gap-gutter items-center">
<div class="col-span-12 md:col-span-5">
<div class="relative group overflow-hidden">
<img class="w-full aspect-[4/5] object-cover grayscale group-hover:grayscale-0 transition-all duration-700 ease-in-out" alt="<?php echo e((string) $testimonial['client_name']); ?>" src="<?php echo e($photo); ?>"/>
</div>
</div>
<div class="col-span-12 md:col-span-6 md:col-start-7">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest mb-6 block"><?php echo e($company !== '' ? $company : 'Client Testimonial'); ?></span>
<h2 class="font-headline-lg text-headline-lg mb-8 italic">"<?php echo e((string) $testimonial['review']); ?>"</h2>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden bg-surface-container">
<img class="w-full h-full object-cover" alt="<?php echo e((string) $testimonial['client_name']); ?>" src="<?php echo e($photo); ?>"/>
</div>
<div>
<div class="font-label-sm text-label-sm font-bold uppercase tracking-widest"><?php echo e((string) $testimonial['client_name']); ?></div>
<div class="font-label-sm text-label-sm text-on-surface-variant"><?php echo e($company); ?></div>
</div>
</div>
</div>
</div>
<?php else : ?>
<!-- Case Study (text left) -->
<div class="grid grid-cols-12 gap-gutter items-center">
<div class="col-span-12 md:col-span-6 order-2 md:order-1">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest mb-6 block"><?php echo e($company !== '' ? $company : 'Client Testimonial'); ?></span>
<h2 class="font-headline-lg text-headline-lg mb-8 italic">"<?php echo e((string) $testimonial['review']); ?>"</h2>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden bg-surface-container">
<img class="w-full h-full object-cover" alt="<?php echo e((string) $testimonial['client_name']); ?>" src="<?php echo e($photo); ?>"/>
</div>
<div>
<div class="font-label-sm text-label-sm font-bold uppercase tracking-widest"><?php echo e((string) $testimonial['client_name']); ?></div>
<div class="font-label-sm text-label-sm text-on-surface-variant"><?php echo e($company); ?></div>
</div>
</div>
</div>
<div class="col-span-12 md:col-span-5 md:col-start-8 order-1 md:order-2">
<div class="relative group overflow-hidden">
<img class="w-full aspect-[4/5] object-cover grayscale group-hover:grayscale-0 transition-all duration-700 ease-in-out" alt="<?php echo e((string) $testimonial['client_name']); ?>" src="<?php echo e($photo); ?>"/>
</div>
</div>
</div>
<?php endif; ?>
<?php endforeach; ?>
<?php else : ?>
<!-- Case Study 1 -->
<div class="grid grid-cols-12 gap-gutter items-center">
<div class="col-span-12 md:col-span-5">
<div class="relative group overflow-hidden">
<img class="w-full aspect-[4/5] object-cover grayscale group-hover:grayscale-0 transition-all duration-700 ease-in-out" data-alt="A luxurious modern architectural living room with floor-to-ceiling windows overlooking a serene pine forest. The interior features minimalist furniture, a large stone fireplace, and warm ambient lighting reflecting off polished concrete floors. The color palette is composed of soft beiges, warm wood tones, and charcoal grey accents, creating an atmosphere of high-end editorial elegance." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_7SpVHIu-jXIfz9e2NeR9uXuiZ74Ui9OFMzR4sHxnSnp_tiU89NV2jbIfuLJMtl4IEfDuVqqTFhDEk6df7WuHSy7dy9j2Ye9JOjD16hwci-_ikOsOjQti-6sgQihQHEm2mz-dOdBKqJ3n4AaqT1g9ap6ivuASY1yaxAe8fTwjMFfUOjHBf1Ny5gEI1RIOY_DdiWn49AKlKQjXEVtMO6t0k_gJtccrbfU5m3vGFeFTNpFvKNajk8xA-wZl5BVJgyWqTwzSWUTz-MY"/>
<div class="absolute bottom-4 left-4 bg-background p-4 border border-on-background/10 max-w-[140px] shadow-sm">
<span class="font-label-sm text-[10px] uppercase tracking-tighter mb-1 block">The Origin</span>
<img class="w-full h-16 object-cover" data-alt="A small thumbnail showing a dusty, unfinished construction site of a modern house interior with exposed concrete and wooden scaffolding. The lighting is harsh and natural, contrasting with the final polished design. The image serves as a 'before' reference for an architectural transformation." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCVYnNhjLA59QWgKl8PoiOH4tTtXX28uq3hQxQyNMPZwFBrMjPU-J1Q1Sl_mVzGfT8UjTc_oIAuGoYP5yraXVz1Oxe5gZSio24jSs57DmJ0Fzo5okbcJOiytC98EOslQ6vcYl0t-qFYqN6XtuStcnEYCJASWafPdiabEUr3fGCU-jsY-iwFkhFRcxj90vJzYWDBYHhumsglDO8f41qo0uvCPF5kDagbzKFkkFONGfWt6hWr_zHwjAfS7cs-Agn4JyD0C0sd7LYSBgc"/>
</div>
</div>
</div>
<div class="col-span-12 md:col-span-6 md:col-start-7">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest mb-6 block">Project: The Pine Ridge Estate</span>
<h2 class="font-headline-lg text-headline-lg mb-8 italic">"The process felt less like a renovation and more like an artistic awakening."</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-8">Working with Afterthink was a masterclass in subtlety. They took our vague ideas about 'light and space' and translated them into a physical reality that exceeded our wildest dreams. The way the morning sun hits the kitchen island is something we cherish every single day.</p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A professional headshot of a woman in her late 40s with a warm, confident smile, wearing a minimalist black turtleneck. The background is a soft-focus studio setting with warm, neutral tones that align with the sophisticated brand identity of Afterthink Studio." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDU0niwy8UqQ2EbVm9wp5SakGYToj4vKdhsvjPy62bXLDARso9xgyVTwNqGPlvu9dw8StDbvsKiRpfpc0T_RocUfZ88k76qF_3KI1ypV2KIqrGghOWj-1ZkPwYon52Ta3H90AU44wlyD1akegymfElCFjXaTGuw15UDYCFBNjmZEY4IblFOsquzQmzjArIYFViu7bLcN2ESvPNzUkB0OxgMl16PP8PooJwEQT52GIUth8qG83oyxPlts8bBCXt7neB2o6Wx_EKWv-0"/>
</div>
<div>
<div class="font-label-sm text-label-sm font-bold uppercase tracking-widest">Eleanor Vance</div>
<div class="font-label-sm text-label-sm text-on-surface-variant">Residential Client, California</div>
</div>
</div>
</div>
</div>
<!-- Case Study 2 -->
<div class="grid grid-cols-12 gap-gutter items-center">
<div class="col-span-12 md:col-span-6 order-2 md:order-1">
<span class="font-label-sm text-label-sm text-tertiary uppercase tracking-widest mb-6 block">Project: Atelier Ocre</span>
<h2 class="font-headline-lg text-headline-lg mb-8 italic">"An uncompromising vision that respected the soul of the existing structure."</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-8">Most designers try to impose their style on you. Afterthink did something rarer: they listened to the building. The result is a studio space that feels ancient and futuristic all at once. It's the perfect environment for my creative practice.</p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A close-up portrait of a man with a creative, refined aesthetic, featuring a well-groomed beard and a charcoal linen shirt. The lighting is soft and directional, highlighting textures and creating a serene, museum-like quality in the photograph." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAig9Halhe9cu5plg48aNIHQsps86XjitJ3EmPLpG-hyJsQbQ8lQ2WqTZpEkWBoBXQHljrlB4eMuFT_ljJrMPSDNBRb40OUxeULkscbIDje_SPiRuNvs_gpFdQ8UQ25x3B8nhgCU-Wtbw1MZNiykKwSJv7LrznVGUV4jGpVm7mOP6yyJU0JHAUTleeGQS-zN9nX0AA1eOwmdW7G0gqQHTs4VgJwFUyGbchkjTbzRwRKlf0mwvSET5umUK36-9xi0yPqR6UqYuzWFvw"/>
</div>
<div>
<div class="font-label-sm text-label-sm font-bold uppercase tracking-widest">Julian Marat</div>
<div class="font-label-sm text-label-sm text-on-surface-variant">Artist &amp; Gallery Owner</div>
</div>
</div>
</div>
<div class="col-span-12 md:col-span-5 md:col-start-8 order-1 md:order-2">
<div class="relative group overflow-hidden">
<img class="w-full aspect-[4/5] object-cover grayscale group-hover:grayscale-0 transition-all duration-700 ease-in-out" data-alt="A wide-angle shot of a renovated industrial loft used as a creative atelier. The space features original brick walls painted in a soft white, soaring ceilings with timber beams, and large steel-framed windows. Minimalist black shelving units and a large oak communal table dominate the center, bathed in diffuse natural light." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBL662fyhN3pBwyP5Jwz12aPYXgZTyFSR_c2OROrMdAf_MNF99ZSvaIolic6VNGdZDD9aiIQtbEjyPc5iJ1ger433-nUuAW4bkgugHcp4yGzqnYAC8pY13f-IVkqrv74z6UdKBc4WndlbKfBX5rvJ4DX_NNqNSrRuBn6wOto3dITWyYxuryxQbtezmFFEadKuatcmANIUpFxJabIrrd-23d3KhOq7OrlKFui_6WdaRO1PVtCdi-uC5vZyEwVhP6V70owHQHSy3QZvc"/>
<div class="absolute bottom-4 right-4 bg-background p-4 border border-on-background/10 max-w-[140px] shadow-sm">
<span class="font-label-sm text-[10px] uppercase tracking-tighter mb-1 block">Initial Draft</span>
<img class="w-full h-16 object-cover" data-alt="A grainy, monochrome architectural sketch on vellum paper, showing the early conceptual layout of the atelier. The sketch is messy but professional, showing hand-drawn lines and geometric explorations for the final space." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCfH_nm6kgznawTln7j6ykwQ4LQ2GKSfSQ1-QT21uxIFM6uX4kztSjbJpnLdcBHXkJeTmOsPOvnOaqY_SBdXwkJssi0VkJ7Sh4SFcrA1LNPzykY18E74DxPpBJ_i9Qd3I3Yb2tZBW0F5icKQZ-tvOA6undqh_gVghSK6cdcmu8lIguLN4qAljzm97v8mtgfb3UKb3FRcA-_6weJ50xdOffJZ6FsSe4XJQwuFS4kY2NfDLzMM8xZD35Fl8bncRDruYCgqunA8dIXmx0"/>
</div>
</div>
</div>
</div>
<?php endif; ?>
</section>
<!-- Video Reviews Grid (Bento Style) -->
<section class="mb-section-padding">
<h2 class="font-headline-md text-headline-md mb-12">Conversations on Craft</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Video 1 -->
<div class="relative aspect-square bg-surface-container overflow-hidden group">
<img class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-1000" data-alt="A static frame from a high-quality video review showing a modern kitchen with marble countertops and gold fixtures. In the center is a blurry silhouette of a person gesturing toward the craftsmanship. The image has a cinematic, soft-focus quality with warm highlights and deep, rich shadows." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAL5VrNLW_GX_tJiJ3GflZwZ7lT8qikeg_nbZBJ_RmCIvD37yVUkFpwA_KYwXDeAk8U8Gv6oDSiLp11u-EpIKyhD3dNIsLb7lwBQnSKdOn853Zivgpz3pcIPF0u5Hn5ZblCTRsQH3FmhFW2SpxbJtvE632Ns2W-fyMBexBQsWbnmqn8I5zUvz-fas7ZBcOXCTpSVCB37Q4x1vG5b1UeDGxpPQOsLb-QkDwoM31dAQg5rrLmzGlRSedCtvFJe9OAXVulLUcZkD4Tl3M"/>
<div class="absolute inset-0 flex items-center justify-center">
<div class="w-16 h-16 rounded-full border border-on-primary flex items-center justify-center group-hover:bg-tertiary transition-colors duration-300">
<span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
</div>
</div>
<div class="absolute bottom-0 left-0 p-8 text-on-primary w-full bg-gradient-to-t from-black/60 to-transparent">
<div class="font-label-sm text-label-sm uppercase tracking-widest">The Lakehouse Project</div>
<div class="font-body-md text-body-md italic opacity-80">"Building with intention"</div>
</div>
</div>
<!-- Video 2 -->
<div class="relative aspect-square bg-surface-container overflow-hidden group">
<img class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-1000" data-alt="A cinematic video preview of a luxury bathroom featuring a freestanding tub and a wall of natural slate. The lighting is low and atmospheric, creating a spa-like feel. The palette consists of earthy greens, deep greys, and warm wood, perfectly aligned with the studio's aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgAxi7l9q8kqRhlFwuUBlPC_OWerIeLfGWzuDw1j3VRD3NFfFABD3-zpL7VqArNUanbqiCeTTYQCaxSQSR00cSijfO2MnKUpR9DTIt-suw8f684_NeEHLCzV131ie_8J-EzmiKChXxLgFXPtkJVELnwtC3eHNR7UJ8j1sb8TrP_k50ABcwT60Tiw_C5QOrFIXxeenajAOIpAN6tb8-flPdei-7fYEkZZ1z-me0ML3vgPeBFEmeNE-aoDmGigv3aDZypOah-Gamyvw"/>
<div class="absolute inset-0 flex items-center justify-center">
<div class="w-16 h-16 rounded-full border border-on-primary flex items-center justify-center group-hover:bg-tertiary transition-colors duration-300">
<span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
</div>
</div>
<div class="absolute bottom-0 left-0 p-8 text-on-primary w-full bg-gradient-to-t from-black/60 to-transparent">
<div class="font-label-sm text-label-sm uppercase tracking-widest">The Urban Sanctuary</div>
<div class="font-body-md text-body-md italic opacity-80">"A quiet retreat in the city"</div>
</div>
</div>
<!-- Video 3 -->
<div class="relative aspect-square bg-surface-container overflow-hidden group">
<img class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-1000" data-alt="A video still of a minimalist bedroom with high-end linens and a wall-to-wall library. The morning light is streaming through thin white curtains, casting soft, elongated shadows on the wooden floor. The mood is peaceful, curated, and deeply personal." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCE93dGcDfvdmo14erJA5rq4XePieTvP9S2lQk6svhC50mGVUHRn7ITbt2Mq2ixkgcb19P7jRLnmQ_3WFu6MCYjlirw1ser8haoFr6HLwJLRtq8AgGomNjNjCiPcumnJELoXOobW2kIIDfLlRpAnVxwiuI1MT9-UQkM3Q0BeOU9OLkWvOUzVCCzvx5OsmeRw7hiMJ80AkWoAr4WzO_QVDBpg5bIdc3mraypv4_pRn-nPlvqeWZiUgpwScVaX7e3sEktxtNXcwdSe98"/>
<div class="absolute inset-0 flex items-center justify-center">
<div class="w-16 h-16 rounded-full border border-on-primary flex items-center justify-center group-hover:bg-tertiary transition-colors duration-300">
<span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
</div>
</div>
<div class="absolute bottom-0 left-0 p-8 text-on-primary w-full bg-gradient-to-t from-black/60 to-transparent">
<div class="font-label-sm text-label-sm uppercase tracking-widest">Library Suite</div>
<div class="font-body-md text-body-md italic opacity-80">"Curating a lifetime of collections"</div>
</div>
</div>
</div>
</section>
<!-- Final Call to Action -->
<section class="py-section-padding text-center border-t border-on-background/10">
<h2 class="font-headline-lg text-headline-lg mb-8 italic">Ready to tell your story?</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto mb-12">Every great space starts with a single conversation. Let's discuss how we can bring your vision to life with the same care and precision we gave to these clients.</p>
<button class="bg-on-background text-background px-12 py-5 font-label-sm text-label-sm uppercase tracking-widest hover:bg-tertiary transition-colors duration-500">
                Start Your Journey
            </button>
</section>
</main>
<!-- SideNavBar (WhatsApp Support) -->
<div class="fixed bottom-8 right-8 z-50">
<a class="bg-primary-container dark:bg-primary-container text-tertiary dark:text-on-tertiary-container rounded-full p-4 flex items-center gap-3 shadow-lg hover:scale-110 transition-transform duration-300" href="https://wa.me/1234567890" target="_blank">
<span class="material-symbols-outlined" data-icon="chat">chat</span>
<span class="font-label-sm text-label-sm font-bold uppercase tracking-widest hidden md:inline">Consult an Architect</span>
</a>
</div>
<!-- Footer -->
<script>
        // Micro-interactions and atmospheric effects
        document.addEventListener('DOMContentLoaded', () => {
            // Scroll reveal for sections
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('section').forEach(section => {
                section.classList.add('transition-all', 'duration-1000', 'ease-out', 'opacity-0', 'translate-y-8');
                observer.observe(section);
            });

            // Video placeholder click interaction
            document.querySelectorAll('.group .w-16.h-16').forEach(button => {
                button.addEventListener('click', () => {
                    alert('This would typically open a high-end video light-box for a detailed client interview.');
                });
            });
        });
    </script>

