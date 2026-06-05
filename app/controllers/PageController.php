<?php

declare(strict_types=1);

class PageController extends BaseController
{
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

    public function home(array $params = []): void
    {
        $this->render('home', [
            'page' => 'home',
            'services' => $this->safeData(fn (): array => (new ServiceModel())->getAll()),
            'featuredProjects' => $this->safeData(fn (): array => (new ProjectModel())->getFeatured()),
            'testimonials' => $this->safeData(fn (): array => (new TestimonialModel())->getLatest()),
        ]);
    }

    public function about(array $params = []): void
    {
        $this->render('about', ['page' => 'about']);
    }

    public function services(array $params = []): void
    {
        $this->render('services', ['page' => 'services', 'services' => $this->safeData(fn (): array => (new ServiceModel())->getAll())]);
    }

    public function portfolio(array $params = []): void
    {
        $this->render('portfolio', ['page' => 'portfolio', 'projects' => $this->safeData(fn (): array => (new ProjectModel())->getAll())]);
    }

    public function gallery(array $params = []): void
    {
        $this->render('gallery', ['page' => 'gallery']);
    }

    public function process(array $params = []): void
    {
        $this->render('process', ['page' => 'process']);
    }

    public function testimonials(array $params = []): void
    {
        $this->render('testimonials', ['page' => 'testimonials', 'testimonials' => $this->safeData(fn (): array => (new TestimonialModel())->getAll())]);
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
            'errors' => $errors,
            'success' => $success,
            'csrfToken' => csrfToken(),
            'contact' => $this->safeData(fn (): array => (new SettingModel())->getContactSettings()),
        ]);
    }

    public function blog(array $params = []): void
    {
        $this->render('blog', ['page' => 'blog', 'posts' => $this->safeData(fn (): array => (new BlogModel())->getAllPosts())]);
    }

    public function blogPost(array $params = []): void
    {
        $post = $this->safeData(fn (): ?array => (new BlogModel())->getPostBySlug($params['slug'] ?? ''), null);
        $posts = $this->safeData(fn (): array => (new BlogModel())->getAllPosts());
        $this->render('blog', ['page' => 'blog', 'postSlug' => $params['slug'] ?? null, 'post' => $post, 'posts' => $posts]);
    }

    public function projectDetail(array $params = []): void
    {
        $project = $this->safeData(fn (): ?array => (new ProjectModel())->getBySlug($params['slug'] ?? ''), null);
        $gallery = $project ? $this->safeData(fn (): array => (new ProjectModel())->getGallery((int) $project['id'])) : [];
        $this->render('project-detail', ['page' => 'project-detail', 'projectSlug' => $params['slug'] ?? null, 'project' => $project, 'projectGallery' => $gallery]);
    }
}
