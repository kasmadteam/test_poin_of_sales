<?php


/**
*
*/
class Barang extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(
            [
                'barang_model',
            ]
        );
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function index()
    {
        $data['barang'] = $this->barang_model->getAll();
        $data['required_style'] = [
            'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
            'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'plugins/toastr/toastr.min.css'
        ];
        $data['required_js'] = [
                'plugins/datatables/jquery.dataTables.min.js',
                'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables-responsive/js/dataTables.responsive.min.js',
                'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                'plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
                'plugins/jszip/jszip.min.js',
                'plugins/pdfmake/pdfmake.min.js',
                'plugins/pdfmake/vfs_fonts.js',
                'plugins/datatables-buttons/js/buttons.html5.min.js',
                'plugins/datatables-buttons/js/buttons.print.min.js',
                'plugins/datatables-buttons/js/buttons.colVis.min.js',
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/header', $data);
        $this->load->view('v2/dashboard/barang/view', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function add()
    {
        $data['barang'] = $this->barang_model->getAll();
        $data['kode_brg'] = $this->findMaxId();
        $data['required_style'] = [
            'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
            'plugins/select2/css/select2.min.css',
            'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
            'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'plugins/toastr/toastr.min.css'
        ];
        $data['required_js'] = [
                'plugins/datatables/jquery.dataTables.min.js',
                'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables-responsive/js/dataTables.responsive.min.js',
                'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                'plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
                'plugins/jszip/jszip.min.js',
                'plugins/pdfmake/pdfmake.min.js',
                'plugins/pdfmake/vfs_fonts.js',
                'plugins/datatables-buttons/js/buttons.html5.min.js',
                'plugins/datatables-buttons/js/buttons.print.min.js',
                'plugins/datatables-buttons/js/buttons.colVis.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/moment/moment.min.js',
                'plugins/inputmask/jquery.inputmask.min.js',
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/header', $data);
        $this->load->view('v2/dashboard/barang/add', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function edit($id)
    {
        $data['barang'] = $this->barang_model->getBarangById($id);
        $data['required_style'] = [
            'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
            'plugins/select2/css/select2.min.css',
            'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
            'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'plugins/toastr/toastr.min.css'
        ];
        $data['required_js'] = [
                'plugins/datatables/jquery.dataTables.min.js',
                'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables-responsive/js/dataTables.responsive.min.js',
                'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                'plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
                'plugins/jszip/jszip.min.js',
                'plugins/pdfmake/pdfmake.min.js',
                'plugins/pdfmake/vfs_fonts.js',
                'plugins/datatables-buttons/js/buttons.html5.min.js',
                'plugins/datatables-buttons/js/buttons.print.min.js',
                'plugins/datatables-buttons/js/buttons.colVis.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/moment/moment.min.js',
                'plugins/inputmask/jquery.inputmask.min.js',
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/header', $data);
        $this->load->view('v2/dashboard/barang/edit', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function autocomplete()
    {
        $result = [];
        if ($_GET['term']) {
            $data = [
                "kode_brg" => $_GET['term']
            ];
            $barang = $this->barang_model->getByTerm($data);
        } else {
            $barang = $this->barang_model->getAll();
        }
        foreach ($barang as $keyBarang => $dataBarang) {
            $result[] = [
                'id' => $dataBarang->kode_brg,
                'value' => $dataBarang->kode_brg
            ];
        }

        if (!empty($result)) {
            echo json_encode($result);
        }
    }

    protected function findMaxId($kode_brg = 'BRG')
    {
        $data = [
            'kode_brg' => $kode_brg
        ];

        $maxId = $this->barang_model->getMaxId($data);

        if (isset($maxId[0]->kode_brg)) {
            $maxId = (int)$maxId[0]->kode_brg;
            $maxId++;
            $kodeBaru = $kode_brg . sprintf("%06s", $maxId);

            $res = $kodeBaru;
        } else {
            $res = $kode_brg . '000001';
        }
        return $res;
    }

    public function ajaxCariId($id)
    {
        $data = [
            'kode_brg' => $id
        ];

        $brg = $this->barang_model->getById($data);

        $brg = $brg[0];

        $barang = [
            'kode_brg'  => $brg->kode_brg,
            'harga'     => idr_format($brg->harga_jual),
            'nama_brg'  => $brg->nama_brg
        ];
        
        echo json_encode($barang);
    }

    public function ajaxCariBarcode($barcode)
    {
        $data = [
            'barcode' => $barcode
        ];

        $brg = $this->barang_model->getByBarcode($data);

        $brg = $brg[0];

        $barang = [
            'kode_brg'  => $brg->kode_brg,
            'harga'     => idr_format($brg->harga_jual),
            'nama_brg'  => $brg->nama_brg
        ];
        
        echo json_encode($barang);
    }

    public function update($id)
    {
        $input = $this->input->post();
        $barang = $this->barang_model->getBarangById($id);

        $args = [
            'kode_brg'      => strtoupper($input['kode_brg']),
            'nama_brg'      => strtoupper($input['nama_brg']),
            'stok'          => $input['stok'],
            'harga_jual'    => idrToString($input['harga_jual']),
            'harga_beli'    => idrToString($input['harga_beli'])
        ];

        if (substr($input['kode_brg'], 0,3) !== 'BRG') {
            $args['kode_brg'] = $this->findMaxId();
        }

        $update = $this->barang_model->update($args, $id);
        if ($update) {
            $result = [
                'status' => 'true',
                'messageType' => 'success',
                'message' => 'Data barang berhasil diubah.'
            ];
        } else {
            $result = [
                'status' => 'false',
                'messageType' => 'danger',
                'message' => 'Data barang gagal diubah.'
            ];
        }

        echo json_encode($result);
    }

    public function save()
    {
        $input = $this->input->post();

        $args = [
            'kode_brg'      => strtoupper($input['kode_brg']),
            'nama_brg'      => strtoupper($input['nama_brg']),
            'stok'          => $input['stok'],
            'harga_jual'    => idrToString($input['harga_jual']),
            'harga_beli'    => idrToString($input['harga_beli'])
        ];
        
        $save = $this->barang_model->insert($args);
        if ($save) {
            $result = [
                'status' => 'true',
                'messageType' => 'success',
                'message' => 'Data barang berhasil disimpan.'
            ];
        } else {
            $result = [
                'status' => 'false',
                'messageType' => 'danger',
                'message' => 'Data barang gagal disimpan.'
            ];
        }

        echo json_encode($result);
    }

    public function delete($id)
    {
        $deleted = $this->barang_model->delete($id);
        if ($deleted) {
            $result = [
                'status' => 'true',
                'messageType' => 'success',
                'messageInfo' => 'Berhasil!',
                'message' => 'Data barang berhasil dihapus.'
            ];
        } else {
            $result = [
                'status' => 'false',
                'messageType' => 'danger',
                'messageInfo' => 'Gagal!',
                'message' => 'Data barang gagal dihapus.'
            ];
        }
        echo json_encode($result);
    }
}
