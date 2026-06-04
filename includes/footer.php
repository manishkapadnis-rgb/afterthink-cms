</main>
<footer class="site-footer bg-dark text-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <h5>Afterthink Studio</h5>
                <p><?= getSafe($siteSettings['footer_text'] ?? 'Luxury architecture and interior design brought to life with craftsmanship and clarity.') ?></p>
            </div>
            <div class="col-md-3">
                <h6>Contact</h6>
                <p class="mb-1"><?= getSafe($siteSettings['address'] ?? '123 Premium Ave, Design City') ?></p>
                <p class="mb-1">Phone: <?= getSafe($siteSettings['phone'] ?? '+1 555 854 3210') ?></p>
                <p>Email: <a class="text-white" href="mailto:<?= getSafe($siteSettings['contact_email'] ?? 'info@afterthinkstudio.com') ?>"><?= getSafe($siteSettings['contact_email'] ?? 'info@afterthinkstudio.com') ?></a></p>
            </div>
            <div class="col-md-3">
                <h6>Follow Us</h6>
                <div class="d-flex flex-column gap-2">
                    <?php foreach (getSocialLinks() as $item): ?>
                        <a class="text-white" href="<?= getSafe($item['url']) ?>" target="_blank"><?= getSafe($item['platform']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="mt-4 text-center text-muted">&copy; <?= date('Y') ?> <?= getSafe($siteSettings['site_name'] ?? 'Afterthink Studio') ?>. All rights reserved.</div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= baseUrl('assets/js/main.js') ?>"></script>
</body>
</html>
