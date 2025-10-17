<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'content'];

    protected $returnType = 'array';
}
