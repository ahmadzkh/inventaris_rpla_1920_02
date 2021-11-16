<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * @author Ahmad Zaky Humami
 * @description Model untuk tabel barang_masuk
 */
class BrgMasukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'id_barang';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * @method
     * @description function countInput() digunakan untuk menjumlahkan seluruh jml_masuk dari barang_masuk
     * dan dikembalikan sebagai sebuah nilai
     */
    public function countInput()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SUM(jml_masuk) AS `input` FROM barang_masuk");
        $query = $query->getResultArray();

        // dd($query);
        return $query;
    }
}
