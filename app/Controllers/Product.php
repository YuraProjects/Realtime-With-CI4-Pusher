<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Pusher\Pusher;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class Product extends BaseController
{
    public function __construct()
    {
        $this->model = new ProductModel();
    }

    use ResponseTrait;
    public function index()
    {
        return view('product_v');
    }

    function getProduct()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => preg_replace("/[^0-9]/", "", $this->request->getPost('price')),
        ];

        $saved = $this->model->save($data);

        // if ($saved) {
        $options = [
            'cluster' => 'ap1',
            'useTLS' => true
        ];
        $pusher = new Pusher(
            'b2ae92299a92763dda42',
            '9ea2d511f7e214152554',
            '1370401',
            $options
        );

        $data['message'] = 'Success!';
        $pusher->trigger('my-channel', 'my-event', $data);
        // }
    }

    function update()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'price' => preg_replace("/[^0-9]/", "", $this->request->getPost('price')),
        ];

        $updated = $this->model->save($data);

        // if ($updated) {
        $options = [
            'cluster' => 'ap1',
            'useTLS' => true
        ];
        $pusher = new Pusher(
            'b2ae92299a92763dda42',
            '9ea2d511f7e214152554',
            '1370401',
            $options
        );

        $data['message'] = 'Success!';
        $pusher->trigger('my-channel', 'my-event', $data);
        // }
    }

    function delete()
    {
        $id = $this->request->getPost('id');
        $deleted = $this->model->delete($id);

        // if ($deleted) {
        $options = [
            'cluster' => 'ap1',
            'useTLS' => true
        ];
        $pusher = new Pusher(
            'b2ae92299a92763dda42',
            '9ea2d511f7e214152554',
            '1370401',
            $options
        );

        $data['message'] = 'Success!';
        $pusher->trigger('my-channel', 'my-event', $data);
        // }
    }
}
