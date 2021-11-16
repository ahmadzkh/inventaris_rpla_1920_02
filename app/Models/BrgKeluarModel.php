<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * @author Ahmad Zaky Humami
 * @description Model untuk tabel barang_keluar
 */
class BrgKeluarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_keluar';
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
     * @description digunakan untuk menjumlahkan seluruh jml_keluar dari barang_keluar
     * dan dikembalikan sebagai sebuah nilai
     */
    public function countOutput()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SUM(jml_keluar) AS `output` FROM barang_keluar");
        $query = $query->getResultArray();

        // dd($query);
        return $query;
    }

    /**
     * @method
     * @description digunakan untuk mencari data yang similiar
     */
    public function search($keyword)
    {
        $builder = $this->table('barang_keluar');
        
        $builder->like('id_barang', $keyword);
        $builder->orLike('tgl_keluar', $keyword);

        return $builder;
    }

    /**
     * @method
     * @param string
     * @description untuk memanggil procedure
     */
    public function add_barangout($id, $jml, $supplier)
    {
        $db = \Config\Database::connect();

        $query = $db->query("CALL add_barangout('$id', '$jml', '$supplier')");
        $query = $query->getResultArray();
        // dd($query);

        return $query;
    }
}