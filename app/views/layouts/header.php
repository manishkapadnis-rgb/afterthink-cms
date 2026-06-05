<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400..900;1,400..900&amp;family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo assetUrl('css/style.css'); ?>">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-primary-fixed": "#1c1c19",
                        "surface-bright": "#f9f9f9",
                        "error": "#ba1a1a",
                        "background": "#f9f9f9",
                        "on-error": "#ffffff",
                        "surface-container-highest": "#e2e2e2",
                        "secondary-container": "#e2dfde",
                        "primary-fixed-dim": "#c9c6c2",
                        "primary-fixed": "#e5e2dd",
                        "on-background": "#1a1c1c",
                        "inverse-on-surface": "#f0f1f1",
                        "on-primary-fixed-variant": "#474743",
                        "secondary-fixed-dim": "#c8c6c5",
                        "on-tertiary-fixed": "#261900",
                        "on-primary-container": "#6f6e6a",
                        "tertiary": "#775a19",
                        "secondary-fixed": "#e5e2e1",
                        "tertiary-container": "#fff0db",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f3f3f4",
                        "surface-container": "#eeeeee",
                        "surface": "#f9f9f9",
                        "inverse-surface": "#2f3131",
                        "on-surface": "#1a1c1c",
                        "surface-container-high": "#e8e8e8",
                        "primary": "#5f5e5b",
                        "surface-tint": "#5f5e5b",
                        "on-tertiary-container": "#896928",
                        "error-container": "#ffdad6",
                        "on-tertiary-fixed-variant": "#5d4201",
                        "primary-container": "#f5f2ed",
                        "surface-dim": "#dadada",
                        "secondary": "#5f5e5e",
                        "surface-container-lowest": "#ffffff",
                        "outline": "#787770",
                        "on-secondary-container": "#636262",
                        "on-error-container": "#93000a",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#474741",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed-variant": "#474746",
                        "tertiary-fixed-dim": "#e9c176",
                        "tertiary-fixed": "#ffdea5",
                        "on-secondary-fixed": "#1c1b1b",
                        "outline-variant": "#c8c7be",
                        "surface-variant": "#e2e2e2",
                        "inverse-primary": "#c9c6c2"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    spacing: {
                        "section-padding": "120px",
                        "margin-mobile": "24px",
                        "margin-desktop": "64px",
                        gutter: "32px"
                    },
                    fontFamily: {
                        "display-lg": ["Bodoni Moda"],
                        "headline-lg-mobile": ["Bodoni Moda"],
                        "headline-lg": ["Bodoni Moda"],
                        "headline-md": ["Bodoni Moda"],
                        "body-md": ["DM Sans"],
                        "body-lg": ["DM Sans"],
                        "label-sm": ["DM Sans"]
                    },
                    fontSize: {
                        "display-lg": ["84px", { lineHeight: "92px", letterSpacing: "0", fontWeight: "400" }],
                        "headline-lg-mobile": ["32px", { lineHeight: "40px", fontWeight: "400" }],
                        "headline-lg": ["48px", { lineHeight: "56px", fontWeight: "400" }],
                        "headline-md": ["32px", { lineHeight: "40px", fontWeight: "400" }],
                        "body-md": ["16px", { lineHeight: "28px", fontWeight: "400" }],
                        "body-lg": ["18px", { lineHeight: "32px", fontWeight: "400" }],
                        "label-sm": ["12px", { lineHeight: "16px", letterSpacing: "0.1em", fontWeight: "500" }]
                    }
                }
            }
        };
    </script>
    <?php $meta = $meta ?? []; ?>
    <title><?php echo e($meta['title'] ?? (ucwords(str_replace('-', ' ', (string) ($page ?? 'Afterthink Studio'))) . ' | Afterthink Studio')); ?></title>
    <?php if (!empty($meta['description'])) : ?><meta name="description" content="<?php echo e($meta['description']); ?>"><?php endif; ?>
    <?php if (!empty($meta['keywords'])) : ?><meta name="keywords" content="<?php echo e($meta['keywords']); ?>"><?php endif; ?>
    <?php if (!empty($meta['canonical'])) : ?><link rel="canonical" href="<?php echo e($meta['canonical']); ?>"><?php endif; ?>
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo e($meta['site_name'] ?? 'Afterthink Studio'); ?>">
    <meta property="og:title" content="<?php echo e($meta['og_title'] ?? ($meta['title'] ?? 'Afterthink Studio')); ?>">
    <?php if (!empty($meta['og_description'])) : ?><meta property="og:description" content="<?php echo e($meta['og_description']); ?>"><?php endif; ?>
    <?php if (!empty($meta['canonical'])) : ?><meta property="og:url" content="<?php echo e($meta['canonical']); ?>"><?php endif; ?>
    <?php if (!empty($meta['og_image'])) : ?><meta property="og:image" content="<?php echo e($meta['og_image']); ?>"><?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
</head>
<body class="bg-background text-on-surface font-body-md overflow-x-hidden">
<header class="w-full top-0 sticky z-50 bg-background/90 backdrop-blur-md border-b border-on-background/10 transition-all ease-in-out duration-300">
    <nav class="flex justify-between items-center px-margin-mobile md:px-margin-desktop py-6 max-w-[1440px] mx-auto">
        <a class="font-display-lg text-headline-md text-on-background uppercase tracking-widest" href="<?php echo siteUrl(''); ?>">Afterthink Studio</a>
        <div class="hidden md:flex items-center gap-8" aria-label="Main navigation">
            <a class="font-label-sm text-label-sm <?php echo ($page ?? '') === 'home' ? 'text-tertiary border-b border-tertiary pb-1' : 'text-on-surface-variant hover:text-tertiary'; ?> transition-colors duration-500" href="<?php echo siteUrl(''); ?>">Home</a>
            <a class="font-label-sm text-label-sm <?php echo ($page ?? '') === 'about' ? 'text-tertiary border-b border-tertiary pb-1' : 'text-on-surface-variant hover:text-tertiary'; ?> transition-colors duration-500" href="<?php echo siteUrl('about'); ?>">About</a>
            <a class="font-label-sm text-label-sm <?php echo ($page ?? '') === 'portfolio' || ($page ?? '') === 'project-detail' ? 'text-tertiary border-b border-tertiary pb-1' : 'text-on-surface-variant hover:text-tertiary'; ?> transition-colors duration-500" href="<?php echo siteUrl('portfolio'); ?>">Portfolio</a>
            <a class="font-label-sm text-label-sm <?php echo ($page ?? '') === 'gallery' ? 'text-tertiary border-b border-tertiary pb-1' : 'text-on-surface-variant hover:text-tertiary'; ?> transition-colors duration-500" href="<?php echo siteUrl('gallery'); ?>">Gallery</a>
            <a class="font-label-sm text-label-sm <?php echo ($page ?? '') === 'process' ? 'text-tertiary border-b border-tertiary pb-1' : 'text-on-surface-variant hover:text-tertiary'; ?> transition-colors duration-500" href="<?php echo siteUrl('process'); ?>">Process</a>
            <a class="font-label-sm text-label-sm <?php echo ($page ?? '') === 'contact' ? 'text-tertiary border-b border-tertiary pb-1' : 'text-on-surface-variant hover:text-tertiary'; ?> transition-colors duration-500" href="<?php echo siteUrl('contact'); ?>">Contact</a>
        </div>
        <div class="flex items-center gap-3">
            <a class="hidden md:inline-block font-label-sm text-label-sm bg-primary text-on-primary px-6 py-3 uppercase tracking-widest hover:bg-tertiary transition-all duration-300" href="<?php echo siteUrl('contact'); ?>">Get Quote</a>
            <button id="mobile-menu-toggle" class="md:hidden inline-flex items-center justify-center text-on-background p-1" aria-label="Open menu" aria-controls="mobile-menu" aria-expanded="false">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
        </div>
    </nav>
    <!-- Mobile off-canvas menu -->
    <div id="mobile-menu" class="mobile-menu md:hidden" aria-hidden="true">
        <div class="mobile-menu__backdrop" data-menu-close></div>
        <nav class="mobile-menu__panel" aria-label="Mobile navigation">
            <button class="mobile-menu__close" data-menu-close aria-label="Close menu">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
            <a href="<?php echo siteUrl(''); ?>">Home</a>
            <a href="<?php echo siteUrl('about'); ?>">About</a>
            <a href="<?php echo siteUrl('portfolio'); ?>">Portfolio</a>
            <a href="<?php echo siteUrl('gallery'); ?>">Gallery</a>
            <a href="<?php echo siteUrl('process'); ?>">Process</a>
            <a href="<?php echo siteUrl('contact'); ?>">Contact</a>
            <a class="mobile-menu__cta" href="<?php echo siteUrl('contact'); ?>">Get Quote</a>
        </nav>
    </div>
</header>
