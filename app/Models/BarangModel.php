<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * @author Ahmad Zaky Humami
 * @filesource BarangModel.php
 * @description Barang Model
 */
class BarangModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'barang';
    protected $primaryKey           = 'id_barang';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_barang', 'nama_barang', 'spesifikasi', 'lokasi', 'kondisi', 'jumlah_barang', 'sumber_dana', 'gambar'];

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

    /**
     * @method
     * @description get all id barang
     */
    public function getAllID()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT id_barang AS id FROM barang");
        $query = $query->getResultArray();

        return $query;
    }

    /**
     * @method
     * @description generate kode barang baru
     */
    public function newkodebarang()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT newkodebarang() AS id");
        $query = $query->getResultArray();

        return $query[0]['id'];
    }

    /**
     * @method
     * @param string
     * @description untuk memanggil procedure
     */
    public function add_newbarang($nama, $spek, $lokasi, $kondisi, $jml, $sumber, $gambar, $supplier)
    {
        $db = \Config\Database::connect();
        $id = $db->query("SELECT newkodebarang() AS id");
        $id = $id->getResultArray();
        $id = $id[0]['id'];
        $query = $db->query("CALL add_newbarangin('$id', '$nama', '$spek', '$lokasi', '$kondisi', '$jml', '$sumber', '$gambar', '$supplier')");
        $query = $query->getResultArray();
        // dd($query);

        return $query;
    }
}