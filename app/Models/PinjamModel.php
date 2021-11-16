<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'pinjam_barang';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_pinjam', 'peminjam', 'tgl_pinjam', 'barang_pinjam', 'jml_pinjam', 'tgl_kembali', 'kondisi'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    public function getInvent()
    {
        $db = \Config\Database::connect();
        $id = session()->id_user;

        $query = $db->query("SELECT * FROM $this->table WHERE peminjam = '$id'");
        $query = $query->getResultArray();

        // dd($query);
        return $query;
    }

    public function countInvent()
    {
        $db = \Config\Database::connect();
        $id = session()->id_user;

        $query = $db->query("SELECT SUM(jml_pinjam) AS my_invent FROM $this->table WHERE peminjam = '$id'");
        $query = $query->getResultArray();

        return $query;
    }
}