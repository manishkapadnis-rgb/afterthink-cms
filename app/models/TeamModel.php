<?php

declare(strict_types=1);

class TeamModel extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM team_members WHERE status = 'published' ORDER BY id ASC");
        return $stmt->fetchAll();
    }
}
