<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TabelDataLokasiObjek;

class Home extends BaseController
{
    protected $tabledatalokasiobjek;

    public function __construct()
    {
        $this->tabledatalokasiobjek = new TabelDataLokasiObjek();
    }

    public function index()
    {

        return view('v_peta');
    }

    public function peta()
    {
        return view('v_peta');
    }

    public function input()
    {
        session();
        return view('v_input');
    }

    public function simpan_tambah_data()
    {

        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'Nama harus diisikan'
                ]

            ],
            'latitude' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'Latitude harus diisikan'
                ]

            ],
            'longitude' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'Longitude harus diisikan'
                ]

            ],

        ])) {
            return redirect()->to(base_url('home/input'))
                ->with(
                    'message',
                    array(
                        'type' => 'danger',
                        'content' => $this->validator->listErrors()
                    )
                );
        }

        //menangkap file photonya
        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
            $nama_foto = NULL;
        } else {
            //membuat folder upload foto
            $foto_dir = 'upload/foto/';
            if (!is_dir($foto_dir)) {
                mkdir($foto_dir, 0777, TRUE);
            }
            //GET FOTO NAMA 
            $nama_foto = preg_replace('/\s+/', '_', $foto->getName());

            // /\s+/ adalah spasi yang terbaca dalam filename foto
            // '_' adalah pengganti dari spasi dalam file name foto dalam database 

            //memindahkan file 
            $foto->move($foto_dir, $nama_foto);
        }

        // get error 4 : ga upload file

        $data = [
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi'],
            'latitude' => $_POST['latitude'],
            'longitude' => $_POST['longitude'],

            'foto' => $nama_foto,

            // foto tidak menggunakan post, karena perlu proses penanganan yang beda ex: size, format dll
        ];

        if (!$this->tabledatalokasiobjek->save($data)) {
            return redirect()->to(base_url('home/input'))
                ->with(
                    'message',
                    array(
                        'type' => 'danger',
                        'content' => 'Data gagal disimpan'
                    )
                );
        }
        return redirect()->to(base_url('home/input'))
            ->with(
                'message',
                array(
                    'type' => 'success',
                    'content' => 'Data berhasil disimpan'
                )
            );

        // save : berfungsi 2 method yaitu create dan update. 
    }

    public function tabel()
    {
        $data['dataobjek'] = $this->tabledatalokasiobjek->findAll();

        return view('v_tabel', $data);
    }

    // Acara 5 20/03/2023 = Method hapus data
    public function hapus_data($id)
    {

        if (!$this->tabledatalokasiobjek->delete($id)) {
            return redirect()->to(base_url('home/tabel'))
                ->with(
                    'message',
                    array(
                        'type' => 'danger',
                        'content' => 'Data gagal dihapus'
                    )
                );
        }
        return redirect()->to(base_url('home/tabel'))
            ->with(
                'message',
                array(
                    'type' => 'success',
                    'content' => 'Data berhasil dihapus'
                )
            );
    }

    //($id) itu parameter

    // Acara 5 20/03/2023 = Method edit data

    public function edit_data($id)
    {
        $data['dataobjek'] = $this->tabledatalokasiobjek->find($id);

        return view('v_edit', $data);
    }

    // acara 5 20/03/2023 = method simpan edit data tanpa penanganan foto

    public function simpan_edit_data($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'Nama harus diisikan'
                ]

            ],
            'latitude' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'Latitude harus diisikan'
                ]

            ],
            'longitude' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'Longitude harus diisikan'
                ]

            ],

        ])) {
            return redirect()->to(base_url('home/tabel'))
                ->with(
                    'message',
                    array(
                        'type' => 'danger',
                        'content' => $this->validator->listErrors()
                    )
                );
        }

        // acara 5 24/03/2023 = method simpan edit data dengan penanganan foto

        //menangkap file photonya
        $foto = $this->request->getFile('foto');

        $fotolama = $_POST['fotolama'];

        if ($foto->getError() == 4) {
            
            // $nama_foto = NULL;
            
            $nama_foto = $fotolama;

        } else {
            //membuat folder upload foto
            $foto_dir = 'upload/foto/';
            if (!is_dir($foto_dir)) {
                mkdir($foto_dir, 0777, TRUE);
            }

            //hapus fotolama
            if ($fotolama != "") {
                if (file_exists($foto_dir .$fotolama)) {
                    unlink($foto_dir.$fotolama);
                }
            }

            //GET FOTO NAMA 
            $nama_foto = preg_replace('/\s+/', '_', $foto->getName());

            // /\s+/ adalah spasi yang terbaca dalam filename foto
            // '_' adalah pengganti dari spasi dalam file name foto dalam database 

            //memindahkan file 
            $foto->move($foto_dir, $nama_foto);
        }

        // get error 4 : ga upload file


        $data = [
            'id' => $id,
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi'],
            'latitude' => $_POST['latitude'],
            'longitude' => $_POST['longitude'],
            'foto' => $nama_foto
        ];

        if (!$this->tabledatalokasiobjek->save($data)) {
            return redirect()->to(base_url('home/tabel'))
                ->with(
                    'message',
                    array(
                        'type' => 'danger',
                        'content' => 'Data Edit gagal disimpan'
                    )
                );
        }
        return redirect()->to(base_url('home/tabel'))
            ->with(
                'message',
                array(
                    'type' => 'success',
                    'content' => 'Data Edit berhasil disimpan'
                )
            );
    }

    public function test() 
    {
        if (auth ()->loggedIn()) {
            echo "user sudah login";
        }else {
            echo "user belum login";
        }
    }

    
}
