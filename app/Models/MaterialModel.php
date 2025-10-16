<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table      = 'materials';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'course_id',
        'file_name',
        'file_path',
        'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function insertMaterial($data)
    {
        return $this->insert($data);
    }

    public function getMaterialsByCourse($course_id)
    {
        return $this->where('course_id', $course_id)->findAll();
    }

    public function getMaterialById($material_id)
    {
        return $this->find($material_id);
    }

    public function deleteMaterial($material_id)
    {
        $material = $this->find($material_id);
        if ($material) {
            // Delete the file from filesystem
            if (file_exists($material['file_path'])) {
                unlink($material['file_path']);
            }
            // Delete from database
            return $this->delete($material_id);
        }
        return false;
    }
}
