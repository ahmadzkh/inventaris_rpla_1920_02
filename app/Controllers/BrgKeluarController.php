<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BrgKeluarModel;
use App\Models\BrgMasukModel;
use App\Models\SupplierModel;

/**
 * @author Ahmad Zaky Humami
 * @filesource BrgKeluarController.php
 */
class BrgKeluarController extends BaseController
{
    protected $barangKeluarModel;
    protected $barangMasukModel;
    
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->barangKeluarModel = new BrgKeluarModel();
        $this->barangMasukModel = new BrgMasukModel();
        $this->supplierModel = new SupplierModel();
    }
    
    public function create()
    {
        $data = [
            'title' => 'UKOM | Add Output',
            'id_barang' => $this->barangModel->getAllID(),
            'out' => $this->barangKeluarModel->orderBy('tgl_keluar', 'DESC')->paginate(3, 'barang_keluar'),
            'supplier' => $this->supplierModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/barang/brgkeluar/create', $data);
    }
    
    public function store()
    {
        if (!$this->validate([
            'date' => 'required|max_length[225]',
            'jml_keluar' => 'required|integer',
            'supplier' => 'required|max_length[6]'
        ])) {
            return redirect()->to('dashboard/stuffs/output/create')->withInput();
        }

        $id_barang = $this->request->getPost('id_barang');
        $jml_keluar = $this->request->getPost('jml_keluar');
        $supplier = $this->request->getPost('supplier');

            $this->barangKeluarModel->add_barangout($id_barang, $jml_keluar, $supplier);
            
            session()->setFlashdata('message', 'New Output Added Successfully');
            return redirect()->to('/dashboard/stuffs/output');
    }
}