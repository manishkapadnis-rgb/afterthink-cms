<?php

declare(strict_types=1);

class SettingModel extends Model
{
    public function getSettings(): array
    {
        $stmt = $this->db->query('SELECT * FROM settings ORDER BY id DESC LIMIT 1');
        $settings = $stmt->fetch();
        return $settings ?: [];
    }

    public function getContactSettings(): array
    {
        $stmt = $this->db->query('SELECT * FROM contact_settings ORDER BY id DESC LIMIT 1');
        $settings = $stmt->fetch();
        return $settings ?: [];
    }

    private function upsert(string $table, array $allowed, array $data): bool
    {
        $row = $this->db->query("SELECT id FROM {$table} ORDER BY id DESC LIMIT 1")->fetch();
        $clean = [];
        foreach ($allowed as $col) {
            $clean[$col] = $data[$col] ?? null;
        }

        if ($row) {
            $sets = implode(', ', array_map(static fn (string $c): string => "{$c} = :{$c}", $allowed));
            $clean['id'] = (int) $row['id'];
            $stmt = $this->db->prepare("UPDATE {$table} SET {$sets} WHERE id = :id");
            return $stmt->execute($clean);
        }

        $cols = implode(', ', $allowed);
        $ph = implode(', ', array_map(static fn (string $c): string => ':' . $c, $allowed));
        $stmt = $this->db->prepare("INSERT INTO {$table} ({$cols}) VALUES ({$ph})");
        return $stmt->execute($clean);
    }

    public function updateSettings(array $data): bool
    {
        return $this->upsert('settings', [
            'site_name', 'logo', 'favicon',
            'default_meta_title', 'default_meta_description', 'default_meta_keywords', 'og_image',
        ], $data);
    }

    public function updateContactSettings(array $data): bool
    {
        return $this->upsert('contact_settings', [
            'phone', 'email', 'address', 'google_map',
            'facebook', 'instagram', 'linkedin', 'twitter',
        ], $data);
    }
}
