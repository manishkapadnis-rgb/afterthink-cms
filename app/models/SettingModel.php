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
}
