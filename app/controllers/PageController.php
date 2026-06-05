<?php

declare(strict_types=1);

class PageController extends BaseController
{
    private ?array $settingsCache = null;

    private function safeData(callable $callback, mixed $fallback = []): mixed
    {
        try {
            return $callback();
        } catch (Throwable $exception) {
            if (defined('APP_ENV') && APP_ENV === 'development') {
                error_log($exception->getMessage());
            }
            return $fallback;
        }
    }

    private function settings(): array
    {
        if ($this->settingsCache === null) {
            $this->settingsCache = (array) $this->safeData(fn (): array => (new SettingModel())->getSettings(), []);
        }
        return $this->settingsCache;
    }

    /**
     * Build SEO meta for a page, preferring a record's meta_* fields and
     * falling back to the global SEO defaults from the settings table.
     */
    private function meta(array $record = [], string $title = '', string $description = ''): array
    {
        $s = $this->settings();
        $siteName = $s['site_name'] ?? 'Afterthink Studio';

        $metaTitle = $record['meta_title'] ?? ($title !== '' ? $title : ($s['default_meta_title'] ?? $siteName));
        $metaDesc = $record['meta_description'] ?? ($description !== '' ? $description : ($s['default_meta_description'] ?? ''));

        $root = preg_replace('#^(https?://[^/]+).*#', '$1', (string) (defined('BASE_URL') ? BASE_URL : ''));
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $canonical = $record['canonical_url'] ?? ($root . $path);

        $ogImage = $record['og_image'] ?? ($record['featured_image'] ?? ($s['og_image'] ?? ''));
        if ($ogImage !== '' && !preg_match('#^https?://#', (string) $ogImage)) {
            $ogImage = siteUrl((string) $ogImage);
        }

        return [
            'title' => $metaTitle,
            'description' => $metaDesc,
            'keywords' => $record['meta_keywords'] ?? ($s['default_meta_keywords'] ?? ''),
            'canonical' => $canonical,
            'og_title' => $record['og_title'] ?? $metaTitle,
            'og_description' => $record['og_description'] ?? $metaDesc,
            'og_image' => $ogImage,
            'site_name' => $siteName,
        ];
    }

    public function home(array $params = []): void
    {
        $this->render('home', [
            'page' => 'home',
            'meta' => $this->meta([], 'Afterthink Studio — Architecture & Interior Design'),
            'heroSlides' => $this->safeData(fn (): array => (new HeroSlideModel())->getActive()),
            'services' => $this->safeData(fn (): array => (new ServiceModel())->getAll()),
            'featuredProjects' => $this->safeData(fn (): array => (new ProjectModel())->getFeatured()),
            'testimonials' => $this->safeData(fn (): array => (new TestimonialModel())->getLatest()),
        ]);
    }

    public function about(array $params = []): void
    {
        $this->render('about', ['page' => 'about', 'meta' => $this->meta([], 'About — Afterthink Studio')]);
    }

    public function services(array $params = []): void
    {
        $this->render('services', [
            'page' => 'services',
            'meta' => $this->meta([], 'Services — Afterthink Studio'),
            'services' => $this->safeData(fn (): array => (new ServiceModel())->getAll()),
        ]);
    }

    public function portfolio(array $params = []): void
    {
        $this->render('portfolio', [
            'page' => 'portfolio',
            'meta' => $this->meta([], 'Portfolio — Afterthink Studio'),
            'projects' => $this->safeData(fn (): array => (new ProjectModel())->getAll()),
        ]);
    }

    public function gallery(array $params = []): void
    {
        $this->render('gallery', ['page' => 'gallery', 'meta' => $this->meta([], 'Gallery — Afterthink Studio')]);
    }

    public function process(array $params = []): void
    {
        $this->render('process', ['page' => 'process', 'meta' => $this->meta([], 'Process — Afterthink Studio')]);
    }

    public function testimonials(array $params = []): void
    {
        $this->render('testimonials', [
            'page' => 'testimonials',
            'meta' => $this->meta([], 'Testimonials — Afterthink Studio'),
            'testimonials' => $this->safeData(fn (): array => (new TestimonialModel())->getAll()),
        ]);
    }

    public function contact(array $params = []): void
    {
        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            $name = trim((string) ($_POST['name'] ?? ''));
            $email = trim((string) ($_POST['email'] ?? ''));
            $message = trim((string) ($_POST['message'] ?? ''));

            if (!is_string($token) || !verifyCsrfToken($token)) {
                $errors[] = 'Invalid session token.';
            }
            if ($name === '') {
                $errors[] = 'Name is required.';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'A valid email is required.';
            }
            if ($message === '') {
                $errors[] = 'Message is required.';
            }

            if (empty($errors)) {
                $success = (bool) $this->safeData(fn (): bool => (new InquiryModel())->create([
                    'name' => $name,
                    'email' => $email,
                    'phone' => trim((string) ($_POST['phone'] ?? '')),
                    'message' => $message,
                    'source' => trim((string) ($_POST['source'] ?? 'contact_form')),
                ]), false);
                if (!$success) {
                    $errors[] = 'Your inquiry could not be saved right now. Please try again.';
                }
            }
        }

        $this->render('contact', [
            'page' => 'contact',
            'meta' => $this->meta([], 'Contact — Afterthink Studio'),
            'errors' => $errors,
            'success' => $success,
            'csrfToken' => csrfToken(),
            'contact' => $this->safeData(fn (): array => (new SettingModel())->getContactSettings()),
        ]);
    }

    public function blog(array $params = []): void
    {
        $this->render('blog', [
            'page' => 'blog',
            'meta' => $this->meta([], 'Journal — Afterthink Studio'),
            'posts' => $this->safeData(fn (): array => (new BlogModel())->getAllPosts()),
        ]);
    }

    public function blogPost(array $params = []): void
    {
        $post = $this->safeData(fn (): ?array => (new BlogModel())->getPostBySlug($params['slug'] ?? ''), null);
        $posts = $this->safeData(fn (): array => (new BlogModel())->getAllPosts());
        $this->render('blog', [
            'page' => 'blog',
            'meta' => $this->meta($post ?? [], $post['title'] ?? 'Journal — Afterthink Studio', $post ? excerpt($post['content'] ?? '') : ''),
            'postSlug' => $params['slug'] ?? null,
            'post' => $post,
            'posts' => $posts,
        ]);
    }

    public function projectDetail(array $params = []): void
    {
        $project = $this->safeData(fn (): ?array => (new ProjectModel())->getBySlug($params['slug'] ?? ''), null);
        $gallery = $project ? $this->safeData(fn (): array => (new ProjectModel())->getGallery((int) $project['id'])) : [];
        $this->render('project-detail', [
            'page' => 'project-detail',
            'meta' => $this->meta($project ?? [], $project['name'] ?? 'Project — Afterthink Studio', $project ? excerpt($project['description'] ?? '') : ''),
            'projectSlug' => $params['slug'] ?? null,
            'project' => $project,
            'projectGallery' => $gallery,
        ]);
    }
}
