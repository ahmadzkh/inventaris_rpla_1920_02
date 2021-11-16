<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\LokasiModel;
use App\Models\SumberModel;
use App\Models\SupplierModel;

/**
 * @author Ahmad Zaky Humami
 * @filesource BarangController.php
 * @description class dari object Barang
 */
class BarangController extends BaseController
{
    protected $barangModel;
    protected $lokasiModel;
    protected $sumberModel;
    protected $supplierModel;
    
    /**
     * @method
     * @description digunakan untuk menginisialisasi object
     */
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->lokasiModel = new LokasiModel();
        $this->sumberModel = new SumberModel();
        $this->supplierModel = new SupplierModel();
    }
    
    /**
     * @method
     * @description untuk menampilkan halaman barang
     */
    public function index()
    {
        $keyword = $this->request->getPost('keyword');

        if ($keyword) {
            $barang = $this->barangModel->search($keyword);
        } else {
            $barang = $this->barangModel;
        }

        $data = [
            'title' => 'UKOM | Stuffs',
            'barang' => $barang->paginate(3, 'barang'),
            'countBarang' => $this->barangModel->countAll(),
            'pager' => $this->barangModel->pager,
        ];

        // dd($data['users']);

        return view('pages/barang/index', $data);
    }

    /**
     * @method
     * @description untuk menampilkan halaman detail barang
     */
    public function detail($id)
    {
        $data = [
            'title' => 'UKOM | Detail Stuffs',
            'barang' => $this->barangModel->where('id_barang', $id)->first(),
        ];

        // dd($data['users']);

        return view('pages/barang/detail', $data);
    }
    
    /**
     * @method
     * @description untuk menampilkan form add barang
     */
    public function create()
    {
        $data = [
            'title' => 'UKOM | Create Stuffs',
            'id' => $this->barangModel->newkodebarang(),
            'lokasi' => $this->lokasiModel->findAll(),
            'sumber' => $this->sumberModel->findAll(),
            'supplier' => $this->supplierModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        // dd($data['lokasi']);

        return view('pages/barang/create', $data);
    }
    
    /**
     * @method
     * @description untuk melakukan insert data ke table barang
     */
    public function store()
    {
        if (!$this->validate([
            'nama_barang' => 'required|max_length[225]',
            'spesifikasi' => 'required',
            'lokasi' => 'required|max_length[4]',
            'kondisi' => 'required|alpha',
            'jumlah_barang' => 'required|integer',
            'sumber' => 'required|max_length[4]',
            'gambar' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
            'supplier' => 'required|max_length[6]'
        ])) {
            return redirect()->to('dashboard/stuffs/create')->withInput();
        }

        $spesifikasi = $this->request->getPost('spesifikasi');
        $nama_barang = $this->request->getPost('nama_barang');
        $lokasi = $this->request->getPost('lokasi');
        $kondisi = $this->request->getPost('kondisi');
        $jumlah_barang = $this->request->getPost('jumlah_barang');
        $sumber = $this->request->getPost('sumber');
        $supplier = $this->request->getPost('supplier');

        $fileGambar = $this->request->getFile('gambar');

        $newStuff = $this->barangModel;
        $newStuff = $newStuff->asObject()->where('nama_barang', $nama_barang)->first();

        // dd($fileGambar);
        if ($fileGambar->getError() == 4) {
            $nameGambar = 'default.png';
            // dd($nameGambar);
        } else {
            $nameGambar = $id_barang . '.jpg';
            $fileGambar->move('img', $nameGambar);            
        }
        
        if ($newStuff == NULL) {
            $this->barangModel->add_newbarang($nama_barang, $spesifikasi, $lokasi, $kondisi, $jumlah_barang, $sumber, $nameGambar, $supplier);
            
            session()->setFlashdata('message', 'New Stuff Added Successfully');
            return redirect()->to('/dashboard/stuffs');
        } else {
            session()->setFlashdata('message', 'Duplicate Code Entry');
            return redirect()->to('/dashboard/stuffs');
        }
    }
    
    /**
     * @method
     * @param id
     * @description untuk menampilkan halaman form edit barang
     */
    public function edit($id)
    {
        $id = $id;

        $barang = $this->barangModel->where('id_barang', $id)->first();
        
        if ($barang === NULL) {
            session()->setFlashdata('missing', 'Stuff Not Found');
            return redirect()->to('/dashboard/stuff');
        }
        
        $data = [
            'title' => 'UKOM | Edit Stuffs',
            'id' => $id,
            'barang' => $barang,
            'lokasi' => $this->lokasiModel->findAll(),
            'sumber' => $this->sumberModel->findAll(),
            'supplier' => $this->supplierModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        
        return view('pages/barang/edit', $data);
    }
    
    /**
     * @method
     * @param id
     * @description digunakan untuk melakukan update data ke table barang
     */
    public function update($id)
    {
        if (!$this->validate([
            'nama_barang' => 'required|max_length[225]',
            'spesifikasi' => 'required',
            'lokasi' => 'required',
            'kondisi' => 'required|alpha',
            'jumlah_barang' => 'required|integer',
            'sumber' => 'required',
            'gambar' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->to('dashboard/stuffs/edit/' . $id)->withInput();
        }

        $id_barang = $this->request->getPost('id_barang');
        $spesifikasi = $this->request->getPost('spesifikasi');
        $nama_barang = $this->request->getPost('nama_barang');
        $lokasi = $this->request->getPost('lokasi');
        $kondisi = $this->request->getPost('kondisi');
        $jumlah_barang = $this->request->getPost('jumlah_barang');
        $sumber = $this->request->getPost('sumber');
        $supplier = $this->request->getPost('supplier');

        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar->getError() == 4) {
            $nameGambar = $this->request->getPost('oldGambarName');
        } else {
            if ($this->request->getPost('oldGambarName') != 'default.png') {
                unlink('assets/img/' . $this->request->getPost('oldGambarName'));
            }

            $nameGambar = $id_barang . '.jpg';
            $fileGambar->move('assets/img', $nameGambar);
        }
        
        $this->barangModel->save([
            'id_barang' => $id_barang,
            'nama_barang' => $nama_barang,
            'spesifikasi' => $spesifikasi,
            'lokasi' => $lokasi,
            'kondisi'=> $kondisi,
            'jumlah_barang' => $jumlah_barang,
            'sumber_dana' => $sumber,
            'gambar' => $nameGambar
        ]);

        session()->setFlashdata('message', 'Stuff Changed Successfully');
        return redirect()->to('/dashboard/stuffs');
    }

    /**
     * @method
     * @param id
     * @description untuk melakukan hapus data pada table barang
     */
    public function delete($id)
    {
        $this->barangModel->delete($id);

        session()->setFlashdata('message', 'Stuff Deleted Successfully.');
        return redirect()->to('/dashboard/stuffs');
    }
}