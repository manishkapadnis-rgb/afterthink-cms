<!-- Hero Slider -->
<section class="hero-section relative h-[921px] w-full overflow-hidden">
<div class="relative w-full h-full" id="slider-container">
<?php if (!empty($heroSlides)) : ?>
<?php foreach ($heroSlides as $hi => $slide) : ?>
<?php
$bg = $slide['desktop_image'] ?? ($slide['mobile_image'] ?? '');
$link = (string) ($slide['button_link'] ?? '');
$href = $link === '' ? siteUrl('') : (preg_match('#^https?://#', $link) ? $link : siteUrl($link));
?>
<div class="hero-slide<?php echo $hi === 0 ? ' active' : ''; ?> absolute inset-0 bg-cover bg-center flex items-center justify-center" style="background-image: url('<?php echo e((string) $bg); ?>')">
<div class="absolute inset-0 bg-black/20"></div>
<div class="relative z-10 text-center text-on-primary max-w-4xl px-margin-mobile">
<?php if (!empty($slide['subtitle'])) : ?><span class="font-label-sm text-label-sm uppercase tracking-[0.4em] mb-6 block text-primary-fixed"><?php echo e((string) $slide['subtitle']); ?></span><?php endif; ?>
<?php if ($hi === 0) : ?>
<h1 class="font-display-lg text-display-lg mb-8 italic"><?php echo e((string) $slide['title']); ?></h1>
<?php else : ?>
<h2 class="font-display-lg text-display-lg mb-8 italic"><?php echo e((string) $slide['title']); ?></h2>
<?php endif; ?>
<?php if (!empty($slide['button_text'])) : ?><a class="font-label-sm text-label-sm gold-underline text-on-primary uppercase tracking-widest inline-block" href="<?php echo e($href); ?>"><?php echo e((string) $slide['button_text']); ?></a><?php endif; ?>
</div>
</div>
<?php endforeach; ?>
<?php else : ?>
<!-- Slide 1: Living Room -->
<div class="hero-slide active absolute inset-0 bg-cover bg-center flex items-center justify-center" data-alt="A sun-drenched luxury modern living room with floor-to-ceiling windows overlooking a serene garden. The interior features a sophisticated palette of warm beige, charcoal, and brushed gold accents, with a plush velvet sofa and a marble coffee table. Soft morning light creates a peaceful, high-end editorial atmosphere, emphasizing the clean architectural lines and premium materials." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC0w_EQ8L9JWV8U4s26QIq2CMZ9-ifjB4N5NGY-R0SzVNVQsMojfe8-js1XopQfz7jacAHQBVdAVLo5LL3aJGlC3IPmPpTKHZsxQjqdH0ztxce15KPXg3Znzm344rCta9Ibf8MUgUy0Ry9W0vxNpHpwVzDiqrO3x8QLM_jXTRsKU5OXxQwixt1cFsaaf4-r2N7IPSZEHJWRe0bls0S_OB2DK9__4nBGLOzQbSrmiS88VJJcHDbsOPgJr4Txb63x1aKg25cQe3nB2bA')">
<div class="absolute inset-0 bg-black/20"></div>
<div class="relative z-10 text-center text-on-primary max-w-4xl px-margin-mobile">
<span class="font-label-sm text-label-sm uppercase tracking-[0.4em] mb-6 block text-primary-fixed">Curation &amp; Design</span>
<h1 class="font-display-lg text-display-lg mb-8 italic">The Poetry of Space</h1>
<a class="font-label-sm text-label-sm gold-underline text-on-primary uppercase tracking-widest inline-block" href="<?php echo siteUrl('services'); ?>">Explore Interior Design</a>
</div>
</div>
<!-- Slide 2: Office -->
<div class="hero-slide absolute inset-0 bg-cover bg-center flex items-center justify-center" data-alt="A premium executive office suite designed with high-end minimalism. The space features dark oak paneling, a monolithic stone desk, and sculptural lighting fixtures in gold finish. The mood is powerful and quiet, with large windows showing a blurred cityscape at dusk, creating a professional yet luxurious atmosphere that prioritizes focus and refined aesthetics." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAOjgtLTL9FAmFRHCcrVydsZ8rQiOcmM0lj4hrKsd_bGht-lRn_U5EO5HVLV1oNgLQ9bdoYxvXRj9QgV8cyJkWmaPurmajAuJCX8OFgvE3kqXxs6lwOQihhl_Fsjv1KFHNAGKzBeLpSojqx-yxCl9dwPyiYgLo-ECrRO2hiF6uovJUg1ywJXlzWonaLYxucOVWn03UuAfPK3IdCBOG57j2830Ge5LLDxmYEZKZXOxeriiXYxn-5oiLoYIrx5MgcRN-P0piWC2BcStE')">
<div class="absolute inset-0 bg-black/30"></div>
<div class="relative z-10 text-center text-on-primary max-w-4xl px-margin-mobile">
<span class="font-label-sm text-label-sm uppercase tracking-[0.4em] mb-6 block text-primary-fixed">Executive Environments</span>
<h2 class="font-display-lg text-display-lg mb-8 italic">Defined Ambition</h2>
<a class="font-label-sm text-label-sm gold-underline text-on-primary uppercase tracking-widest inline-block" href="<?php echo siteUrl('portfolio'); ?>">Workspace Portfolio</a>
</div>
</div>
<!-- Slide 3: Villa -->
<div class="hero-slide absolute inset-0 bg-cover bg-center flex items-center justify-center" data-alt="An expansive modern villa with sharp geometric architecture and a white limestone exterior. The image captures the structure at the golden hour, with warm amber light reflecting off a glass-like infinity pool. The landscape is minimal with sculptural greenery, reflecting a lifestyle of breathable luxury and permanent architectural grace." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB7BKHPIC2eRwZgqWZ1vlLDYKiaFd8SHl7h1PiBMY8O1iC8vx5D4Vc6tdll_Qo1PSGePNaHhonv0GMExxOnkY530btciwAell2miY464A-asoenyqMAGuW2LRhaxGUjj8EYBuQpFEkl_ZWiJHubpYXaDVAnB2kHulw19tiv2Frnx0Rc1SHaAmAUmpzX2dS5N2nhrb30nSI32OxewbWVt_JjMjhjlGV9sk3w6mE-cR_JeLv6aYOlEOZ1scYqbkZut7ztnIW3L48-nQc')">
<div class="absolute inset-0 bg-black/20"></div>
<div class="relative z-10 text-center text-on-primary max-w-4xl px-margin-mobile">
<span class="font-label-sm text-label-sm uppercase tracking-[0.4em] mb-6 block text-primary-fixed">Architectural Mastery</span>
<h2 class="font-display-lg text-display-lg mb-8 italic">Timeless Horizons</h2>
<a class="font-label-sm text-label-sm gold-underline text-on-primary uppercase tracking-widest inline-block" href="<?php echo siteUrl('portfolio'); ?>">View Residences</a>
</div>
</div>
<?php endif; ?>
</div>
<!-- Slider Controls -->
<div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex items-center gap-12 z-20">
<button class="text-on-primary/60 hover:text-on-primary transition-colors" onclick="prevSlide()"><span class="material-symbols-outlined">west</span></button>
<div class="flex gap-4" id="slide-dots">
<?php $dotCount = !empty($heroSlides) ? count($heroSlides) : 3; ?>
<?php for ($d = 0; $d < $dotCount; $d++) : ?>
<div class="w-12 h-[1px] <?php echo $d === 0 ? 'bg-on-primary opacity-100' : 'bg-on-primary/30'; ?> transition-all duration-500"></div>
<?php endfor; ?>
</div>
<button class="text-on-primary/60 hover:text-on-primary transition-colors" onclick="nextSlide()"><span class="material-symbols-outlined">east</span></button>
</div>
</section>
<!-- About Preview -->
<section class="py-section-padding px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-12 gap-gutter items-center">
<div class="md:col-span-5 mb-12 md:mb-0">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-6 block">Our Philosophy</span>
<h2 class="font-display-lg text-headline-lg mb-8">Quiet luxury, spoken through physical form.</h2>
<p class="font-body-lg text-on-surface-variant mb-10 leading-relaxed">
                At Afterthink Studio, we believe architecture is more than just structure&mdash;it is the stage for life's most intimate moments. We curate spaces that breathe, using natural materials and light to create a silent dialogue between the inhabitant and their environment.
            </p>
<a class="font-label-sm text-label-sm gold-underline uppercase tracking-widest inline-block text-on-surface" href="<?php echo siteUrl('about'); ?>">Discover Our Story</a>
</div>
<div class="md:col-start-7 md:col-span-6 relative">
<div class="aspect-[4/5] bg-surface-container overflow-hidden">
<img alt="Architectural details" class="w-full h-full object-cover grayscale-[20%] hover:scale-105 transition-transform duration-[2s]" data-alt="A close-up, editorial photograph of architectural textures including fluted limestone, brushed brass, and smooth Venetian plaster. The lighting is soft and directional, highlighting the tactile quality of the premium materials. The composition is artistic and minimalist, embodying the sophisticated and quiet luxury of Afterthink Studio's design approach." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBtgqUVqvK7gc9pcAy5N6PkaLwEfbEDxzypfSk_v9RBFo-pNlyZSJGAQlRegWectgf78P8Vp6SAjr20b3gM6DTVGeODff4aVWsMB6aknmalBvkxC3phJGUQIflIOS8VAjN6q1FAn4Bs8JqZXhRheLK9o1A1u-TqSkVlHXGw19lkCe63t_awHFPtCkFRPh5ZnMif4eTBx-L_tYb4da8vjUbu1za8a5jTKp45zmnh0zfxg8aDgvTQ6K1nrNvo2_U2-oBdGqoQyzio0mU"/>
</div>
<div class="absolute -bottom-12 -left-12 hidden md:block w-48 h-48 bg-primary-container p-6 border border-on-background/5">
<p class="font-display-lg text-headline-md italic text-tertiary">15</p>
<p class="font-label-sm text-label-sm uppercase tracking-tighter text-on-surface-variant">Years of Curating Excellence</p>
</div>
</div>
</section>
<!-- Services Preview -->
<section class="bg-surface-container-low py-section-padding">
<div class="px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto">
<div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
<div>
<span class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-6 block">Expertise</span>
<h2 class="font-display-lg text-headline-lg">Our Disciplines</h2>
</div>
<p class="md:max-w-md font-body-md text-on-surface-variant">
                    From initial concept sketches to the final placement of a sculptural vase, we provide a holistic approach to high-end living.
                </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<?php if (!empty($services)) : ?>
    <?php foreach (array_slice($services, 0, 3) as $service) : ?>
<!-- Service -->
<div class="group cursor-pointer">
<div class="aspect-[16/9] overflow-hidden mb-6 bg-surface-variant">
<img alt="<?php echo e((string) $service['name']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]" src="<?php echo e((string) ($service['image'] ?? '')); ?>"/>
</div>
<h3 class="font-display-lg text-headline-md mb-4 group-hover:text-tertiary transition-colors duration-300"><?php echo e((string) $service['name']); ?></h3>
<div class="w-full h-[1px] bg-on-background/10 mb-4"></div>
<p class="font-body-md text-on-surface-variant mb-6"><?php echo e(excerpt($service['description'] ?? '', 120)); ?></p>
<a class="font-label-sm text-label-sm gold-underline uppercase tracking-widest text-on-surface group-hover:text-tertiary transition-colors" href="<?php echo siteUrl('services'); ?>">Details</a>
</div>
    <?php endforeach; ?>
<?php else : ?>
<!-- Service 1 -->
<div class="group cursor-pointer">
<div class="aspect-[16/9] overflow-hidden mb-6 bg-surface-variant">
<img alt="Interior Design" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]" data-alt="A luxury interior design scene showcasing a high-end minimalist dining area. A solid walnut table is surrounded by artisanal chairs, with a sculptural gold chandelier hanging above. The background features large windows with soft linen drapes, capturing a warm, magazine-style lighting that emphasizes sophisticated living." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDbmtiUNiR0L745LDVENrRkfi9RW8BIr1gHXt0ttuyN8goSCjvNcKjARD1Bl3d_C_GCMtFGqgMKr9vW8rgAMebsthSsXA0oWsqHYboFJahh922elsHBftFgWbA-6Qvwh9csBdtSGQCXbXpoFphE2R0Sjoz7WPwPoAvuMFMEEMbfi5TY_VAHNKbh_IgO15zeWSfmyjG-UREgn11OgYSDtq7-hEsEi-538hWvTY2c97EQv8Fi0cabcfSd_QaMoPHD_pnVJSSflZq46UY"/>
</div>
<h3 class="font-display-lg text-headline-md mb-4 group-hover:text-tertiary transition-colors duration-300">Interior Curation</h3>
<div class="w-full h-[1px] bg-on-background/10 mb-4"></div>
<p class="font-body-md text-on-surface-variant mb-6">Bespoke interior solutions that blend contemporary art with functional permanence.</p>
<a class="font-label-sm text-label-sm gold-underline uppercase tracking-widest text-on-surface group-hover:text-tertiary transition-colors" href="<?php echo siteUrl('services'); ?>">Details</a>
</div>
<!-- Service 2 -->
<div class="group cursor-pointer">
<div class="aspect-[16/9] overflow-hidden mb-6 bg-surface-variant">
<img alt="Architecture" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]" data-alt="A modern architectural structure with dramatic cantilevers and expansive glass facades. The scene is shot at twilight, with the interior lights casting a warm, inviting glow against the cool blue of the evening sky. The design represents cutting-edge luxury residential architecture with clean lines and premium materials." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA20Ube3BKt4N49Anv10bEcd8K6VCRA50o33788LO_AFNbhZQChb0p9THTL9T8jyX3TeWzksgISwNZ4_DHP3-GegrQ_pS36vj1cJqeD1U99HNmODtrNNZSq2EyP5mJUj_xajmMpKgG6CW2U2o45yAMK-UEKanmNvYPWNT38jdBkwD_MOBdHgdEnR0wGpDzjLWAt70QPaNeaTyXrhAuQawuPphlIwy9K-s1Mf--rP0Hi2GBxXVqByKR05aQlzUXSjUMZN1btG524JlQ"/>
</div>
<h3 class="font-display-lg text-headline-md mb-4 group-hover:text-tertiary transition-colors duration-300">Architectural Design</h3>
<div class="w-full h-[1px] bg-on-background/10 mb-4"></div>
<p class="font-body-md text-on-surface-variant mb-6">Structural masterpieces designed to integrate seamlessly with the natural landscape.</p>
<a class="font-label-sm text-label-sm gold-underline uppercase tracking-widest text-on-surface group-hover:text-tertiary transition-colors" href="<?php echo siteUrl('services'); ?>">Details</a>
</div>
<!-- Service 3 -->
<div class="group cursor-pointer">
<div class="aspect-[16/9] overflow-hidden mb-6 bg-surface-variant">
<img alt="Landscape Design" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]" data-alt="A minimalist luxury garden design featuring a series of geometric stone pathways through manicured tall grasses and sculptural olive trees. A quiet, still reflecting pond adds a sense of serenity. The lighting is high-key and natural, creating a breathable, peaceful outdoor sanctuary that complements a modern architectural home." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCTWj4aeVRyVkjsq7POMhrLSkWS5bUoFzSPbZLRWEoi3agxS_gOW4FGv0lorb0zrR6cKvMHiHZ3_MdmuYZD1vAuEuICAqTn7pcWygQ0HYtcDLgn4705vo2V7aRfdCNqU78Hicf61sxN3N0zkCjV2t7coEObnGwb5G-4s03E42X0exjv3_1Vm4tngMWRTAPhfjnEH8DpO_v13P8ES2RzxEUwq4XJCD5Hya2qplzNOhO684fg7aOoEca_AHryvZkYtFgAm6VCpFG6iPk"/>
</div>
<h3 class="font-display-lg text-headline-md mb-4 group-hover:text-tertiary transition-colors duration-300">Exterior Artistry</h3>
<div class="w-full h-[1px] bg-on-background/10 mb-4"></div>
<p class="font-body-md text-on-surface-variant mb-6">Landscape and terrace designs that serve as an extension of the internal living experience.</p>
<a class="font-label-sm text-label-sm gold-underline uppercase tracking-widest text-on-surface group-hover:text-tertiary transition-colors" href="<?php echo siteUrl('services'); ?>">Details</a>
</div>
<?php endif; ?>
</div>
</div>
</section>
<!-- Featured Projects (Masonry) -->
<section class="py-section-padding px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto">
<div class="mb-24 text-center">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-6 block">Selected Works</span>
<h2 class="font-display-lg text-headline-lg">Archival Projects</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-x-gutter gap-y-24">
<?php if (!empty($featuredProjects)) : ?>
    <?php foreach ($featuredProjects as $fp) : ?>
        <?php $fpYear = !empty($fp['created_at']) ? date('Y', strtotime((string) $fp['created_at'])) : ''; ?>
<!-- Project -->
<div class="masonry-item">
<div class="aspect-[4/5] overflow-hidden mb-8 bg-surface-container">
<a href="<?php echo siteUrl('project/' . rawurlencode((string) ($fp['slug'] ?? ''))); ?>">
<img alt="<?php echo e((string) $fp['name']); ?>" class="w-full h-full object-cover grayscale-[10%] hover:grayscale-0 transition-all duration-[1s]" src="<?php echo e((string) ($fp['featured_image'] ?? '')); ?>"/>
</a>
</div>
<div class="flex justify-between items-start">
<div>
<p class="font-label-sm text-label-sm text-tertiary uppercase mb-2"><?php echo e((string) ($fp['category'] ?? '')); ?></p>
<h4 class="font-display-lg text-headline-md italic"><a href="<?php echo siteUrl('project/' . rawurlencode((string) ($fp['slug'] ?? ''))); ?>"><?php echo e((string) $fp['name']); ?></a></h4>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant"><?php echo e($fpYear); ?></span>
</div>
</div>
    <?php endforeach; ?>
<?php else : ?>
<!-- Project 1 -->
<div class="masonry-item">
<div class="aspect-[4/5] overflow-hidden mb-8 bg-surface-container">
<img alt="Project One" class="w-full h-full object-cover grayscale-[10%] hover:grayscale-0 transition-all duration-[1s]" data-alt="An editorial shot of a minimalist luxury kitchen featuring dark charcoal cabinetry and a massive white marble island. The space is accented by hidden lighting and a single, large-scale modern art piece on the wall. The mood is sophisticated and moody, showcasing premium finishes and an immaculate sense of order." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAV-YvhUPY7VQX67eAI_3W5IuYCUF4c3o_E68uzIQWqa89Xe-22SSOjbcU1rKtV1xkkNSzJiF-Z23cI15ef-nivSP2JyeRxgv62iur7BmAflktxKR8UCP6k8Fm3NzzOIdjIkoMcf59gMdPiKQgN5XqkQwcsBWf_HqUerjpgAvjPh4E-3uuBeh4hnJE0aUZyld3uL4U1bX1-6iBGk3ExD-P3C5WEzCt1gnMPcRtd-yWvZo19DCeEJPOfxmQVuNc9IVw4F96GTAjJS8"/>
</div>
<div class="flex justify-between items-start">
<div>
<p class="font-label-sm text-label-sm text-tertiary uppercase mb-2">Residential &bull; Zurich</p>
<h4 class="font-display-lg text-headline-md italic">The Monolith House</h4>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">2023</span>
</div>
</div>
<!-- Project 2 -->
<div class="masonry-item">
<div class="aspect-[4/5] overflow-hidden mb-8 bg-surface-container">
<img alt="Project Two" class="w-full h-full object-cover grayscale-[10%] hover:grayscale-0 transition-all duration-[1s]" data-alt="A stunning high-end bedroom design with a low-profile platform bed in light wood. Large windows frame a mountain landscape, and the room is decorated with minimal but rich textures like raw silk and natural wool. The morning light is soft and hazy, creating a dreamlike, editorial aesthetic for a luxury retreat." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC33jxIYwCTB28xZxMgkA3nroePgkRQXkyu_pqTYolLhttPoptw7qHkNqlb0eJVcNHYvW5tLMev1CCSFSkMcIt2yYR83ONyYyUoeUCOs5sIzVOsFJunGLVupvc6cMPM8mTBQIOz2JTq2y6QiEfoCzsoZfvbR0xSf_PAyBRgLrV62tvtFcFE7eEcjMUIzdv6WBg_oJIJMV4mxTCqibEEud7MELAeay97jeSbtLjdDRUlJoBwOcy7qeLEjjd9qqkgzeCSWUCdFgDMBZ8"/>
</div>
<div class="flex justify-between items-start">
<div>
<p class="font-label-sm text-label-sm text-tertiary uppercase mb-2">Hospitality &bull; Tuscany</p>
<h4 class="font-display-lg text-headline-md italic">Villa Serenity</h4>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">2022</span>
</div>
</div>
<!-- Project 3 -->
<div class="masonry-item">
<div class="aspect-[4/5] overflow-hidden mb-8 bg-surface-container">
<img alt="Project Three" class="w-full h-full object-cover grayscale-[10%] hover:grayscale-0 transition-all duration-[1s]" data-alt="A sophisticated home library or study with floor-to-ceiling dark wood shelving and a vintage leather lounge chair. A single designer floor lamp provides warm light, casting elegant shadows across the room. The atmosphere is intellectual and deeply private, capturing the essence of personalized luxury and quiet permanence." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAvMr_bh8LMJPk3GDPyhMLPL8QoXq9sKx8nk3M7-d7BbVluv3LoUPI0IuA28TAPjCnfGukjjcU-1Accy3bcxYgHI2Ze6m6TIzDoAAK4pfbXTHjWyz83vuC7GbYM32WBmbWrcpFNoKo4DLt-_XtGp6Cqq9MV322aAV38H8b_1d7kLoM0RaDYGya567leskMPfaeocPnDvrbSuYsgD8d-6q_ByBSs_KRl9CJCpEhdodIMLI6gpj9Ez78JQjcFWQFOiDOY10MfitCsKiY"/>
</div>
<div class="flex justify-between items-start">
<div>
<p class="font-label-sm text-label-sm text-tertiary uppercase mb-2">Private Office &bull; London</p>
<h4 class="font-display-lg text-headline-md italic">The Archive Suite</h4>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">2023</span>
</div>
</div>
<!-- Project 4 -->
<div class="masonry-item">
<div class="aspect-[4/5] overflow-hidden mb-8 bg-surface-container">
<img alt="Project Four" class="w-full h-full object-cover grayscale-[10%] hover:grayscale-0 transition-all duration-[1s]" data-alt="An expansive modern hallway with an arched architectural ceiling and limestone flooring. The space is illuminated by warm, concealed cove lighting, and a single sculptural marble pedestal stands at the end of the corridor. The design is a masterclass in minimalism and light-play, creating a museum-like residential experience." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSfqZZHnLWqTW_4YWfPEGWV769VcRirBl5_QQI9aX2e4e8SsBBU60XU9cAXEb1x4_ONzvR2seEzbmDXe93zoAPN4AhYRnQ1hDrmVZxUSRsrDt_xFky-ooHFhP5qmNoAjMjgc2gFJnMkNuQp5sToqCJX27wBTgzf31owoBoycinQqSEjJ9cTw0XU87IHOkD8xS9ZureWBA6BZRC9YAi5f7mPlsEu6Hpj0mnYDLumWvt6XTP9DOavKjOOO3fRuMWGB3iDUwEQEP43qs"/>
</div>
<div class="flex justify-between items-start">
<div>
<p class="font-label-sm text-label-sm text-tertiary uppercase mb-2">Cultural &bull; Kyoto</p>
<h4 class="font-display-lg text-headline-md italic">Stone Path Pavilion</h4>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">2024</span>
</div>
</div>
<?php endif; ?>
</div>
<div class="mt-32 text-center">
<button class="font-label-sm text-label-sm border border-on-background px-12 py-5 uppercase tracking-widest hover:bg-on-background hover:text-background transition-all duration-500">View All Projects</button>
</div>
</section>
<!-- Why Choose Us -->
<section class="bg-primary-container py-section-padding px-margin-mobile md:px-margin-desktop">
<div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-12 gap-gutter">
<div class="md:col-span-4">
<h2 class="font-display-lg text-headline-lg mb-8 italic">The Afterthink Distinction</h2>
<p class="font-body-md text-on-surface-variant mb-12">We go beyond drafting plans. We curate a legacy of living well through uncompromising standards.</p>
</div>
<div class="md:col-start-6 md:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-12">
<div>
<span class="material-symbols-outlined text-tertiary mb-6 text-4xl" data-icon="diamond">diamond</span>
<h5 class="font-label-sm text-label-sm uppercase tracking-widest mb-4">Artisanal Sourcing</h5>
<p class="font-body-md text-on-surface-variant">Exclusive access to global quarries and furniture ateliers that craft only for the elite.</p>
</div>
<div>
<span class="material-symbols-outlined text-tertiary mb-6 text-4xl" data-icon="architecture">architecture</span>
<h5 class="font-label-sm text-label-sm uppercase tracking-widest mb-4">Precision Craft</h5>
<p class="font-body-md text-on-surface-variant">A 1mm tolerance policy that ensures every joint and finish is structurally and visually perfect.</p>
</div>
<div>
<span class="material-symbols-outlined text-tertiary mb-6 text-4xl" data-icon="auto_awesome">auto_awesome</span>
<h5 class="font-label-sm text-label-sm uppercase tracking-widest mb-4">Bespoke Journeys</h5>
<p class="font-body-md text-on-surface-variant">A personalized white-glove service that manages every logistical nuance from start to finish.</p>
</div>
<div>
<span class="material-symbols-outlined text-tertiary mb-6 text-4xl" data-icon="history_edu">history_edu</span>
<h5 class="font-label-sm text-label-sm uppercase tracking-widest mb-4">Future Archiving</h5>
<p class="font-body-md text-on-surface-variant">Designs engineered for longevity, using materials that age gracefully and gain character over time.</p>
</div>
</div>
</div>
</section>
<!-- Process Section -->
<section class="py-section-padding px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto">
<div class="flex flex-col items-center mb-24">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary mb-6 block">The Journey</span>
<h2 class="font-display-lg text-headline-lg text-center">From Concept to Concrete</h2>
</div>
<div class="space-y-0">
<div class="group py-12 border-b border-on-background/10 hover:bg-surface-container-low transition-all duration-500 px-6">
<div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6">
<span class="md:col-span-1 font-display-lg text-headline-md italic text-on-surface-variant/30 group-hover:text-tertiary transition-colors">01</span>
<h4 class="md:col-span-3 font-display-lg text-headline-md">Discovery</h4>
<p class="md:col-span-7 font-body-md text-on-surface-variant">An immersive dialogue where we uncover your lifestyle patterns, aesthetic leanings, and functional needs.</p>
<span class="md:col-span-1 material-symbols-outlined justify-self-end group-hover:translate-x-2 transition-transform" data-icon="arrow_forward">arrow_forward</span>
</div>
</div>
<div class="group py-12 border-b border-on-background/10 hover:bg-surface-container-low transition-all duration-500 px-6">
<div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6">
<span class="md:col-span-1 font-display-lg text-headline-md italic text-on-surface-variant/30 group-hover:text-tertiary transition-colors">02</span>
<h4 class="md:col-span-3 font-display-lg text-headline-md">Curation</h4>
<p class="md:col-span-7 font-body-md text-on-surface-variant">The development of mood, material palettes, and architectural forms that resonate with your vision.</p>
<span class="md:col-span-1 material-symbols-outlined justify-self-end group-hover:translate-x-2 transition-transform" data-icon="arrow_forward">arrow_forward</span>
</div>
</div>
<div class="group py-12 border-b border-on-background/10 hover:bg-surface-container-low transition-all duration-500 px-6">
<div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6">
<span class="md:col-span-1 font-display-lg text-headline-md italic text-on-surface-variant/30 group-hover:text-tertiary transition-colors">03</span>
<h4 class="md:col-span-3 font-display-lg text-headline-md">Execution</h4>
<p class="md:col-span-7 font-body-md text-on-surface-variant">Precision engineering and artisan collaboration to bring the digital vision into physical reality.</p>
<span class="md:col-span-1 material-symbols-outlined justify-self-end group-hover:translate-x-2 transition-transform" data-icon="arrow_forward">arrow_forward</span>
</div>
</div>
</div>
</section>
<!-- Testimonials Slider -->
<section class="bg-surface-dim/30 py-section-padding">
<div class="px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto text-center">
<span class="material-symbols-outlined text-tertiary text-6xl mb-12" data-icon="format_quote">format_quote</span>
<div class="relative h-[250px]" id="testimonial-container">
<?php $homeTestimonial = $testimonials[0] ?? null; ?>
<div class="testimonial-slide active transition-opacity duration-700 absolute inset-0">
<p class="font-display-lg text-headline-md italic mb-10 max-w-4xl mx-auto leading-relaxed">
                        "<?php echo e((string) ($homeTestimonial['review'] ?? "Afterthink Studio didn't just design our home; they designed our daily experience. Every morning feels like waking up in a gallery that was built specifically for us.")); ?>"
                    </p>
<p class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface"><?php echo e($homeTestimonial ? trim(($homeTestimonial['client_name'] ?? '') . (!empty($homeTestimonial['company']) ? ', ' . $homeTestimonial['company'] : '')) : 'Elena & Marco Rossi, Lake Como'); ?></p>
</div>
</div>
</div>
</section>
<!-- WhatsApp Support FAB -->
<a class="fixed bottom-8 right-8 z-50 bg-primary-container text-tertiary rounded-full p-4 shadow-lg hover:scale-110 transition-transform duration-300 group flex items-center gap-2" href="<?php echo siteUrl('contact'); ?>">
<div class="max-w-0 overflow-hidden group-hover:max-w-[200px] transition-all duration-500 whitespace-nowrap">
<span class="font-label-sm text-label-sm pr-2">Start a Conversation</span>
</div>
<span class="material-symbols-outlined" data-icon="chat">chat</span>
</a>
<!-- Footer -->
<script>
        (function () {
            const slider = document.getElementById('slider-container');
            if (!slider) return;
            const slides = slider.querySelectorAll('.hero-slide');
            const dotsWrap = document.getElementById('slide-dots');
            const dots = dotsWrap ? dotsWrap.children : [];
            let current = 0;
            let timer = null;

            function update() {
                slides.forEach((slide, i) => slide.classList.toggle('active', i === current));
                Array.from(dots).forEach((dot, i) => { dot.style.opacity = (i === current) ? '1' : '0.3'; });
            }
            function go(n) { current = (n + slides.length) % slides.length; update(); }

            // Exposed for the prev/next button onclick handlers.
            window.nextSlide = function () { go(current + 1); };
            window.prevSlide = function () { go(current - 1); };

            function start() { stop(); if (slides.length > 1) timer = setInterval(window.nextSlide, 5000); }
            function stop() { if (timer) { clearInterval(timer); timer = null; } }

            // Swipe support on touch devices.
            let startX = null;
            slider.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; stop(); }, { passive: true });
            slider.addEventListener('touchend', function (e) {
                if (startX === null) return;
                const dx = e.changedTouches[0].clientX - startX;
                if (Math.abs(dx) > 40) { dx < 0 ? window.nextSlide() : window.prevSlide(); }
                startX = null;
                start();
            }, { passive: true });

            update();
            start();
        })();

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (!header) return;
            if (window.scrollY > 50) {
                header.classList.add('py-4', 'bg-background/95', 'backdrop-blur-md');
                header.classList.remove('py-6');
            } else {
                header.classList.add('py-6');
                header.classList.remove('py-4', 'bg-background/95', 'backdrop-blur-md');
            }
        });
    </script>

