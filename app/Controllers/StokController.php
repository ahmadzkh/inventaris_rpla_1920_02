<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class StokController extends BarangController
{
    public function index()
    {
        $data = [
            'title' => 'UKOM | Stuffs',
            'barang' => $this->barangModel->paginate(10, 'barang'),
            'countBarang' => $this->barangModel->countAll(),
            'pager' => $this->barangModel->pager,
        ];

        // dd($data['users']);

        return view('pages/barang/index', $data);
    }

    public function edit($id)
    {
        $id = $id;
        $barang = $this->barangModel;
        $barang = $barang->asObject()->where('id_barang', $id)->first();

        $db = \Config\Database::connect();
        $query2 = $db->query("SELECT id_lokasi FROM lokasi");
        $query2 = $query2->getResultArray();

        $query3 = $db->query("SELECT id_sumber FROM sumber_dana");
        $query3 = $query3->getResultArray();

        $query4 = $db->query("SELECT id_supplier FROM supplier");
        $query4 = $query4->getResultArray();
        
        $data = [
            'title' => 'UKOM | Add Stock Stuffs',
            'barang' => $barang,
            'id' => $id,
            'lokasi' => $query2,
            'sumber' => $query3,
            'supplier' => $query4,
            'validation' => \Config\Services::validation()
        ];

        if ($barang === NULL) {
            session()->setFlashdata('missing', 'Stuff Not Found');
            return redirect()->to('/dashboard/stuff');
        }
        
        return view('pages/barang/add-stok', $data);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $procedure = $db->query("CALL tambah_barangmasuk($id, $supplier, $masuk)");
    }
}