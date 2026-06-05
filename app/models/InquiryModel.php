<?php

declare(strict_types=1);

class InquiryModel extends Model
{
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO inquiries (name, email, phone, message, source) VALUES (:name, :email, :phone, :message, :source)');
        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'],
            'source' => $data['source'] ?? 'contact_form',
        ]);
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM inquiries ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function updateStatus(int $id, string $status): bool
    {
        if (!in_array($status, ['new', 'read', 'archived'], true)) {
            return false;
        }

        $stmt = $this->db->prepare('UPDATE inquiries SET status = :status WHERE id = :id');
        return $stmt->execute(['id' => $id, 'status' => $status]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM inquiries WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
