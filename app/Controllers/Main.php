<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BarangModel;
use App\Models\BrgMasukModel;
use App\Models\BrgKeluarModel;
use App\Models\BarangLogModel;
use App\Models\StokModel;
use App\Models\StokBarangModel;
use App\Models\PinjamModel;
use App\Models\SumberModel;
use App\Models\SupplierModel;

/**
 * @author Ahmad Zaky Humami
 * @filesource Main.php
 */
class Main extends BaseController
{
    protected $barangModel;
    protected $userModel;
    protected $stokModel;
    protected $inventModel;
    protected $sourceModel;

    /**
     * @method
     * @description __construct() digunakan untuk menginisialisasi object
     */
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->barangKeluarModel = new BrgKeluarModel();
        $this->barangMasukModel = new BrgMasukModel();
        $this->userModel = new UserModel();
        $this->stokModel = new StokModel();
        $this->stokBarangModel = new StokBarangModel();
        $this->inventModel = new PinjamModel();
        $this->sourceModel = new SumberModel();
        $this->supplierModel = new SupplierModel();
    }
    
    /**
     * @method
     * @description index() untuk menampilkan halaman view dashboard
     */
    public function index()
    {
        $id = session()->id_user;

        // dd(session()->id_user);
        
        $data = [
            'title' => 'UKOM | Dashboard',
            'countStuffs' => $this->barangModel->countAll(),
            'countOutput' => $this->barangKeluarModel->countOutput(),
            'countStock' => $this->stokModel->countStock(),
            'out' => $this->barangKeluarModel->orderBy('tgl_keluar DESC , id_barang DESC')->paginate(3, 'barang_keluar'),
            'in' => $this->barangMasukModel->orderBy('tgl_masuk', 'DESC')->paginate(3, 'barang_masuk')
        ];
        
        // dd($source);
        return view('pages/index', $data);
    }

    /**
     * @method
     * @description index barang keluar
     */
    public function barangkeluar()
    {
        $keyword = $this->request->getPost('keyword');

        if ($keyword) {
            $barangKeluar = $this->barangKeluarModel->search($keyword);
        } else {
            $barangKeluar = $this->barangKeluarModel;
        }

        $data = [
            'title' => 'UKOM | Stuffs Output',
            'out' => $barangKeluar->orderBy('tgl_keluar DESC , id_barang DESC')->paginate(10, 'barang_keluar'),
            'pager' => $this->barangKeluarModel->pager,
        ];
        
        return view('pages/barang/brgkeluar/index', $data);
    }


    public function stock()
    {
        $keyword = $this->request->getPost('keyword');

        if ($keyword) {
            $stokBarang = $this->stokBarangModel->search($keyword);
        } else {
            $stokBarang = $this->stokBarangModel;
        }

        $data = [
            'title' => 'UKOM | Stuff Stock',
            'stokbarang' => $stokBarang->paginate(10, 'stok_barang'),
            'pager' => $this->stokBarangModel->pager,
        ];

        return view('pages/barang/stock/index', $data);
    }
}