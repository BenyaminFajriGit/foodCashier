<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username')) {
            $this->load->model('Model_Product');
        } else {
            $this->session->set_flashdata('error', "Please Login First!");
            redirect('C_User/login');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $data['products'] = $this->Model_Product->getAllProducts();
        $this->load->view('Form_List_Product', $data);
    }

    public function showFormAddProduct()
    {
        $this->checkAdmin();
        $this->load->view("Form_New_Product");
    }

    public function add()
    {
        if ($this->checkProductRules()) {
            $this->Model_Product->addProduct();
            if($this->upload->display_errors()){
                $this->session->set_flashdata('error', 'Input Should Follow Rules!' .$this->upload->display_errors());    
            }
            else{
                $this->session->set_flashdata('success', 'Product Is Successfully added!');
            }
            
        } else {
            $this->session->set_flashdata('error', 'Input Should Follow Rules!' . validation_errors());
        }
        redirect('C_Product/showFormAddProduct/');
    }

    public function checkProductRules()
    {
        $data = [
            [
                "field" => 'name',
                "label" => 'name',
                "rules" => 'required'
            ],
            [
                "field" => 'category',
                "label" => 'category',
                'rules' => 'required'
            ],
            [
                "field" => 'price',
                "label" => 'price',
                "rules" => 'numeric|required'
            ],
            [
                "field" => 'stock',
                "label" => 'stock',
                "rules" => 'numeric|required'
            ],
            [
                "field" => 'description',
                "label" => 'description',
                "rules" => 'required'
            ]
        ];
        if (empty($_FILES['photo']['name'])) {
            $this->form_validation->set_rules('photo', 'Photo', 'required');
        }
        $validation = $this->form_validation;
        $validation->set_rules($data);
        return $validation->run();
    }

    public function listForCostumer()
    {
        $data['products'] = $this->Model_Product->getAllProducts();
        $this->load->view('Form_List_Product_Costumer', $data);
    }


    public function edit($id = null)
    {
        $this->checkAdmin();
        if (!isset($id)) redirect('C_Product/');
        $product = $this->Model_Product;
        $data['product'] = $product->getById($id);
        if (!$data['product']) {
            show_404();
        }
        $this->load->view("Form_Edit_Product", $data);
    }

    public function checkEditRules()
    {
        $data = [
            [
                "field" => 'name',
                "label" => 'name',
                "rules" => 'required'
            ],
            [
                "field" => 'category',
                "label" => 'category',
                'rules' => 'required'
            ],
            [
                "field" => 'price',
                "label" => 'price',
                "rules" => 'numeric|required'
            ],
            [
                "field" => 'stock',
                "label" => 'stock',
                "rules" => 'numeric|required'
            ],
            [
                "field" => 'description',
                "label" => 'description',
                "rules" => 'required'
            ]
        ];
        $validation = $this->form_validation;
        $validation->set_rules($data);
        return $validation->run();
    }

    public function editProcess($id = null)
    {
        if ($this->checkEditRules()) {
            $this->Model_Product->setProduct();
            if($this->upload->display_errors()){
                $this->session->set_flashdata('error', 'Input Should Follow Rules!' .$this->upload->display_errors());    
            }else{
                $this->session->set_flashdata('success', 'Product is Successfully Updated');
            }
            
        } else {
            $this->session->set_flashdata('error', 'Input Should Follow Rules!');
            redirect('C_Product/edit/');
        }
        redirect('C_Product/');
    }


    public function deleteProduct($id)
    {
        $this->checkAdmin();
        $this->Model_Product->delete($id);
        $this->session->set_flashdata('success', 'Product is Successfully Deleted');
        redirect(site_url('C_Product/'));
    }

    //not below the new one edited


    public function detailProduct($id_product)
    {
        $data['product'] = $this->Model_Product->getByID($id_product);
        if (empty($data['product'])) {
            $this->session->set_flashdata('error', 'product not found!');
            redirect('C_Product/listForCostumer/');
        }
        $this->load->view('Form_Detail_Product', $data);
    }
    public function search()
    {
        unset($_SESSION['error']);
        $search = $this->input->get('search');
        $data['products'] = $this->Model_Product->search($search);
        if (empty($data['products'])) {
            $this->session->set_flashdata('error', 'product not found!');
        }
        $this->load->view('Form_List_Product_Costumer', $data);
    }

    private function checkAdmin()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('error', 'you are not admin!');
            redirect('C_Product/listForCostumer/');
        }
    }
}
