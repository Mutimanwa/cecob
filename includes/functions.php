<?php

declare(strict_types=1);

function db(): ?PDO
{
    global $pdo;

    return $pdo instanceof PDO ? $pdo : null;
}

function app_url(string $path = ''): string
{
    return rtrim(APP_URL, '/') . '/' . ltrim($path, '/');
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect_to(string $path): void
{
    header('Location: ' . app_url($path));
    exit;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array
{
    if (! isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_POST['csrf_token'] ?? '';

    if (! hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        set_flash('danger', 'Session invalide. Veuillez reessayer.');
        redirect_back();
    }
}

function redirect_back(): void
{
    $target = $_SERVER['HTTP_REFERER'] ?? app_url();
    header('Location: ' . $target);
    exit;
}

function old(string $key, string $default = ''): string
{
    return $_SESSION['old'][$key] ?? $default;
}

function flash_old_input(): void
{
    $_SESSION['old'] = $_POST;
}

function clear_old_input(): void
{
    unset($_SESSION['old']);
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function fetch_all_assoc(PDOStatement $stmt): array
{
    return $stmt->fetchAll();
}

function fetch_one_assoc(PDOStatement $stmt): ?array
{
    $row = $stmt->fetch();

    return $row ?: null;
}

function count_table(string $table): int
{
    $allowed = [
        'members',
        'adhesion_requests',
        'events',
        'payments',
        'posts',
        'partners',
        'documents',
        'contact_messages',
    ];

    if (! in_array($table, $allowed, true) || ! db()) {
        return 0;
    }

    $query = db()->query("SELECT COUNT(*) AS total FROM {$table}");
    $row = $query->fetch();

    return (int) ($row['total'] ?? 0);
}

function sum_payments_by_status(string $status): float
{
    if (! db()) {
        return 0;
    }

    $stmt = db()->prepare('SELECT COALESCE(SUM(amount), 0) AS total FROM payments WHERE status = ?');
    $stmt->execute([$status]);
    $row = fetch_one_assoc($stmt);

    return (float) ($row['total'] ?? 0);
}

function fetch_latest_posts(int $limit = 3): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->prepare('SELECT id, title, excerpt, category, image_path, published_at, slug FROM posts WHERE status = ? ORDER BY published_at DESC LIMIT ?');
    $stmt->bindValue(1, 'published');
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $items = fetch_all_assoc($stmt);

    return $items;
}

function fetch_upcoming_events(int $limit = 3): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->prepare('SELECT id, title, description, starts_at, location, capacity, image_path FROM events WHERE starts_at >= CURDATE() ORDER BY starts_at ASC LIMIT ?');
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $items = fetch_all_assoc($stmt);

    return $items;
}

function fetch_leadership(): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->prepare('SELECT full_name, role_title, bio, avatar_path, mandate_start, mandate_end FROM team_members WHERE is_active = 1 ORDER BY display_order ASC');
    $stmt->execute();
    $items = fetch_all_assoc($stmt);

    return $items;
}


function fetch_members(): array
{
    if (! db()) {
        return [];
    }

    $query = '
        SELECT m.member_number, m.status, m.university, u.full_name, u.email
        FROM members m
        INNER JOIN users u ON u.id = m.user_id
        ORDER BY m.id DESC
    ';
    $stmt = db()->query($query);

    return $stmt->fetchAll();
}

function fetch_contact_messages(): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->query('SELECT name, email, subject, status, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 10');

    return $stmt->fetchAll();
}

function fetch_posts_page(): array
{
    if (! db()) {
        return [];
    }

    $stmt = db()->query("SELECT title, excerpt, category, image_path, slug, published_at FROM posts WHERE status = 'published' ORDER BY published_at DESC");

    return $stmt->fetchAll();
}

function fetch_post_by_slug(string $slug): ?array
{
    if (! db()) {
        return null;
    }

    $stmt = db()->prepare('SELECT title, excerpt, body, category, image_path, published_at FROM posts WHERE slug = ? LIMIT 1');
    $stmt->execute([$slug]);
    $post = fetch_one_assoc($stmt);

    return $post;
}

function slugify(string $text): string
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);

    return empty($text) ? 'n-a' : $text;
}

function upload_file(array $file, string $targetDir): ?string
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = bin2hex(random_bytes(8)) . '.' . $extension;
    $targetPath = rtrim($targetDir, '/') . '/' . $filename;

    if (move_uploaded_file($file['tmp_name'], APP_ROOT . '/' . $targetPath)) {
        return $targetPath;
    }

    return null;
}

// --- Team Management ---
function fetch_all_team(): array
{
    if (! db()) return [];
    $stmt = db()->query('SELECT * FROM team_members ORDER BY display_order ASC');
    return $stmt->fetchAll();
}

function save_team_member(array $data): bool
{
    if (! db()) return false;
    if (empty($data['full_name']) || empty($data['role_title'])) return false;

    if (isset($data['id'])) {
        $stmt = db()->prepare('UPDATE team_members SET full_name = ?, role_title = ?, bio = ?, avatar_path = ?, mandate_start = ?, mandate_end = ?, display_order = ?, is_active = ? WHERE id = ?');
        return $stmt->execute([$data['full_name'], $data['role_title'], $data['bio'], $data['avatar_path'], $data['mandate_start'], $data['mandate_end'], $data['display_order'], $data['is_active'], $data['id']]);
    }
    $stmt = db()->prepare('INSERT INTO team_members (full_name, role_title, bio, avatar_path, mandate_start, mandate_end, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute([$data['full_name'], $data['role_title'], $data['bio'], $data['avatar_path'], $data['mandate_start'], $data['mandate_end'], $data['display_order']]);
}

// --- Partners Management ---
function fetch_all_partners(): array
{
    if (! db()) return [];
    $stmt = db()->query('SELECT * FROM partners ORDER BY created_at DESC');
    return $stmt->fetchAll();
}

function save_partner(array $data): bool
{
    if (! db()) return false;
    if (empty($data['name'])) return false;

    if (isset($data['id'])) {
        $stmt = db()->prepare('UPDATE partners SET name = ?, description = ?, logo_path = ?, website_url = ? WHERE id = ?');
        return $stmt->execute([$data['name'], $data['description'], $data['logo_path'], $data['website_url'], $data['id']]);
    }
    $stmt = db()->prepare('INSERT INTO partners (name, description, logo_path, website_url) VALUES (?, ?, ?, ?)');
    return $stmt->execute([$data['name'], $data['description'], $data['logo_path'], $data['website_url']]);
}

// --- Posts & Events Management ---
function save_post(array $data): bool
{
    if (! db()) return false;
    if (empty($data['title']) || empty($data['body']) || empty($data['excerpt']) || empty($data['category'])) return false;

    if (isset($data['id'])) {
        $stmt = db()->prepare('UPDATE posts SET title = ?, slug = ?, category = ?, excerpt = ?, body = ?, image_path = ?, status = ? WHERE id = ?');
        return $stmt->execute([$data['title'], $data['slug'], $data['category'], $data['excerpt'], $data['body'], $data['image_path'], $data['status'], $data['id']]);
    }
    $stmt = db()->prepare('INSERT INTO posts (title, slug, category, excerpt, body, image_path, status) VALUES (?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute([$data['title'], $data['slug'], $data['category'], $data['excerpt'], $data['body'], $data['image_path'], $data['status']]);
}

function save_event(array $data): bool
{
    if (! db()) return false;
    if (empty($data['title']) || empty($data['starts_at']) || empty($data['location'])) return false;

    if (isset($data['id'])) {
        $stmt = db()->prepare('UPDATE events SET title = ?, description = ?, starts_at = ?, location = ?, capacity = ?, image_path = ? WHERE id = ?');
        return $stmt->execute([$data['title'], $data['description'], $data['starts_at'], $data['location'], $data['capacity'], $data['image_path'], $data['id']]);
    }
    $stmt = db()->prepare('INSERT INTO events (title, description, starts_at, location, capacity, image_path) VALUES (?, ?, ?, ?, ?, ?)');
    return $stmt->execute([$data['title'], $data['description'], $data['starts_at'], $data['location'], $data['capacity'], $data['image_path']]);
}

// --- Payment & Documents ---
function fetch_all_payments(): array
{
    if (! db()) return [];
    $stmt = db()->query('SELECT p.*, m.member_number, u.full_name FROM payments p LEFT JOIN members m ON m.id = p.member_id LEFT JOIN users u ON u.id = m.user_id ORDER BY p.created_at DESC');
    return $stmt->fetchAll();
}

function update_payment_status(int $id, string $status): bool
{
    if (! db()) return false;
    return db()->prepare('UPDATE payments SET status = ?, paid_at = ? WHERE id = ?')->execute([$status, $status === 'paid' ? date('Y-m-d H:i:s') : null, $id]);
}

function fetch_all_documents(): array
{
    if (! db()) return [];
    return db()->query('SELECT * FROM documents ORDER BY created_at DESC')->fetchAll();
}

// --- Membership ---
function fetch_membership_requests(string $status = 'pending'): array
{
    if (! db()) return [];
    $stmt = db()->prepare('SELECT * FROM adhesion_requests WHERE review_status = ? ORDER BY created_at DESC');
    $stmt->execute([$status]);
    return $stmt->fetchAll();
}

function process_membership_request(int $id, string $action): bool
{
    if (! db()) return false;

    $stmt = db()->prepare('SELECT * FROM adhesion_requests WHERE id = ?');
    $stmt->execute([$id]);
    $request = $stmt->fetch();
    if (! $request) return false;

    if ($action === 'reject') {
        return db()->prepare('UPDATE adhesion_requests SET review_status = "rejected" WHERE id = ?')->execute([$id]);
    }

    if ($action === 'approve') {
        db()->beginTransaction();
        try {
            // Check if user already exists
            $stmt = db()->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$request['email']]);
            if ($stmt->fetch()) {
                db()->rollBack();
                return false; // Already exists
            }

            // Update status
            db()->prepare('UPDATE adhesion_requests SET review_status = "approved" WHERE id = ?')->execute([$id]);

            // Create User
            $stmt = db()->prepare('INSERT INTO users (full_name, email, password_hash, account_status) VALUES (?, ?, ?, "active")');
            $stmt->execute([$request['full_name'], $request['email'], $request['password_hash']]);
            $userId = db()->lastInsertId();

            // Create Member
            $memberNumber = 'CECOB-' . date('Y') . '-' . str_pad((string) $id, 4, '0', STR_PAD_LEFT);
            $stmt = db()->prepare('INSERT INTO members (user_id, member_number, university, faculty, department, academic_level) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([
                $userId,
                $memberNumber,
                $request['university'],
                $request['faculty'],
                $request['department'],
                $request['academic_level']
            ]);

            db()->commit();
            return true;
        } catch (Exception $e) {
            db()->rollBack();
            return false;
        }
    }
    return false;
}

function save_document(array $data): bool
{
    if (! db()) return false;
    $stmt = db()->prepare('INSERT INTO documents (title, category, file_path, visibility) VALUES (?, ?, ?, ?)');
    return $stmt->execute([$data['title'], $data['category'], $data['file_path'], $data['visibility']]);
}

function update_contact_status(int $id, string $status): bool
{
    if (! db()) return false;
    return db()->prepare('UPDATE contact_messages SET status = ? WHERE id = ?')->execute([$status, $id]);
}

// --- Delete Utilities ---
function delete_record(string $table, int $id): bool
{
    $allowed = ['posts', 'events', 'team_members', 'partners', 'documents', 'contact_messages'];
    if (! in_array($table, $allowed, true) || ! db()) return false;
    return db()->prepare("DELETE FROM {$table} WHERE id = ?")->execute([$id]);
}
