<?php

declare(strict_types=1);

class HeroSlideModel extends Model
{
    public function getActive(): array
    {
        $stmt = $this->db->query("SELECT * FROM hero_slides WHERE status = 'published' ORDER BY sort_order ASC, id ASC");
        return $stmt->fetchAll();
    }
}
