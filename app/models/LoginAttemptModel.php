<?php

declare(strict_types=1);

class LoginAttemptModel extends Model
{
    private const MAX_ATTEMPTS = 5;
    private const WINDOW_MINUTES = 15;

    public function recentFailures(string $ip): int
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM login_attempts
             WHERE ip_address = :ip AND attempted_at > (NOW() - INTERVAL :minutes MINUTE)'
        );
        $stmt->bindValue(':ip', $ip);
        $stmt->bindValue(':minutes', self::WINDOW_MINUTES, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function isLockedOut(string $ip): bool
    {
        return $this->recentFailures($ip) >= self::MAX_ATTEMPTS;
    }

    public function recordFailure(string $ip, string $email): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO login_attempts (ip_address, email) VALUES (:ip, :email)'
        );
        return $stmt->execute(['ip' => $ip, 'email' => $email]);
    }

    public function clearFailures(string $ip): bool
    {
        $stmt = $this->db->prepare('DELETE FROM login_attempts WHERE ip_address = :ip');
        return $stmt->execute(['ip' => $ip]);
    }

    public function maxAttempts(): int
    {
        return self::MAX_ATTEMPTS;
    }

    public function windowMinutes(): int
    {
        return self::WINDOW_MINUTES;
    }
}
