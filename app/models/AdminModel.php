<?php

declare(strict_types=1);

class AdminModel extends Model
{
    public function getByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM admins WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();
        return $user ? $user : null;
    }

    public function updateLastLogin(int $id): bool
    {
        $stmt = $this->db->prepare('UPDATE admins SET last_login = NOW() WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM admins WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function updateProfile(int $id, string $fullName, string $email): bool
    {
        $stmt = $this->db->prepare('UPDATE admins SET full_name = :name, email = :email WHERE id = :id');
        return $stmt->execute(['name' => $fullName, 'email' => $email, 'id' => $id]);
    }

    public function updatePassword(int $id, string $passwordHash): bool
    {
        $stmt = $this->db->prepare('UPDATE admins SET password = :pw WHERE id = :id');
        return $stmt->execute(['pw' => $passwordHash, 'id' => $id]);
    }

    public function emailTakenByOther(string $email, int $excludeId): bool
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM admins WHERE email = :email AND id <> :id');
        $stmt->execute(['email' => $email, 'id' => $excludeId]);
        return (int) $stmt->fetchColumn() > 0;
    }
}
