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
}
