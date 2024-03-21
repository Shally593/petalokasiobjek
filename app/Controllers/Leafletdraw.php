<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TbldatapointModel;
use App\Models\TbldatapolygonModel;
use App\Models\TbldatalineModel;

class Leafletdraw extends BaseController
{
    protected $TbldatapointModel;
    protected $TbldatapolygonModel;
    protected $TbldatalineModel;


    public function __construct()
    {
        $this->TbldatapointModel = new TbldatapointModel();
        $this->TbldatapolygonModel = new TbldatapolygonModel();
        $this->TbldatalineModel = new TbldatalineModel();
    }

    public function index()
    {
        return view('leafletdraw/v_create');
    }

    public function simpan_point()
    {
        $data = [
            'nama' => $this->request->getPost('input_point_name'),
            'geom' => $this->request->getPost('input_point_geometry'),
        ];
        $this->TbldatapointModel->save($data);
        return redirect()->to('/');
    }

    public function simpan_polygon()
    {
        $data = [
            'nama' => $this->request->getPost('input_polygon_name'),
            'geom' => $this->request->getPost('input_polygon_geometry'),
        ];
        $this->TbldatapolygonModel->save($data);
        return redirect()->to('/');
    }

    public function simpan_polyline()
    {
        $data = [
            'nama' => $this->request->getPost('input_polyline_name'),
            'geom' => $this->request->getPost('input_polyline_geometry'),
        ];
        $this->TbldatalineModel->save($data);
        return redirect()->to('/');
    }

    // ACARA 9 : Method edit point 

    public function edit_point()
    {
        return view('leafletdraw/v_edit_point');
    }

    // ACARA 9 : Method simpan edit point 

    public function simpan_edit_point()
    {
        $id = (int)$this->request->getPost('id_point');
        $data = [
            'nama' => $this->request->getPost('edit_point_name'),
            'geom' => $this->request->getPost('edit_point_geometry'),
        ];
        $this->TbldatapointModel->update($id, $data);
        return redirect()->to('/editpoint');
    }

    // ACARA 9 : Method edit polyline 

    public function edit_polyline()
    {
        return view('leafletdraw/v_edit_polyline');
    }


    // ACARA 9 : Method simpan edit polyline 
    public function simpan_edit_polyline()
    {
        $id = (int)$this->request->getPost('id_polyline');
        $data = [
            'nama' => $this->request->getPost('edit_polyline_name'),
            'geom' => $this->request->getPost('edit_polyline_geometry'),
        ];
        $this->TbldatalineModel->update($id, $data);
        return redirect()->to('/editpolyline');
    }

    // ACARA 9 : Method edit polygon
    public function edit_polygon()
    {
        return view('leafletdraw/v_edit_polygon');
    }


    // ACARA 9 : Method simpan edit polygon
    public function simpan_edit_polygon()
    {
        $id = (int)$this->request->getPost('id_polygon');
        $data = [
            'nama' => $this->request->getPost('edit_polygon_name'),
            'geom' => $this->request->getPost('edit_polygon_geometry'),
        ];
        $this->TbldatapolygonModel->update($id, $data);
        return redirect()->to('/editpolygon');
    }

    //ACARA 10 - 22/05/2023 : Method delete fitur point
    public function delete_point($id)
    {
        $this->TbldatapointModel->delete($id);
        return redirect()->to('/editpoint');
    }

    //ACARA 10 - 22/05/2023 : Method delete fitur polyline
    public function delete_polyline($id)
    {
        $this->TbldatalineModel->delete($id);
        return redirect()->to('/editpolyline');
    }

    //ACARA 10 - 22/05/2023 : Method delete fitur polygon
    public function delete_polygon($id)
    {
        $this->TbldatapolygonModel->delete($id);
        return redirect()->to('/editpolygon');
    }
}
