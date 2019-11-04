<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Transact extends CI_Controller
{
    private $api_key = 'de9ef3439b3b5506a4707b124951c28e';
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username')) {
            $this->load->model('Model_Order');
            $this->load->model('Model_Product');
            $this->load->model('Model_Invoice');
        } else {
            redirect('login');
        }
    }
    public function index()
    {

        $this->checkAdmin();
        $data['invoices'] = $this->Model_Invoice->getAllInvoices();
        $this->load->view('Form_List_Invoice', $data);
    }



    public function listHistory()
    {

        $username = $this->session->userdata('username');
        $data['invoices'] = $this->Model_Invoice->getInvoiceByIDUser($username);
        if (empty($data['invoices'])) {
            $this->session->set_flashdata('error', 'Please Checkout First');
            $this->load->view('Form_List_Invoice');
            return;
        }
        $this->load->view('Form_List_Invoice', $data);
    }


    private function checkAdmin()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('error', 'you are not admin!');
            redirect('C_Product/listForCostumer/');
        }
    }

    public function showDetailInvoice($id)
    {
        $data['invoice'] = $this->Model_Invoice->getInvoiceByID($id);
        if (!$this->isValidUser($data['invoice'])) {
            $this->session->set_flashdata('error', 'this invoice was not made by you!');
            redirect('C_Transact/listHistory/');
        }
        $data['orders'] = $this->Model_Order->getOrderByInvoice($data['invoice']->id_invoice);
        $this->load->view('Form_Detail_Invoice', $data);
    }

    private function isValidUser($invoice)
    {
        if (empty($invoice)) {
            return false;
        } else if ($invoice->username == $this->session->userdata('username') || $this->session->userdata('type') == 'admin') {
            return true;
        }
        return false;
    }
    public function setStatusPaid($id_invoice)
    {
        $this->checkAdmin();
        $this->Model_Invoice->setStatusInvoice($id_invoice,'paid');
        $this->session->set_flashdata('success', 'Confirmation is success!');
        redirect("C_Transact/showDetailInvoice/$id_invoice");
    }
    public function setStatusRejected($id_invoice)
    {
        $this->checkAdmin();
        $this->Model_Invoice->setStatusInvoice($id_invoice,'rejected');
        $this->session->set_flashdata('success', 'Rejected is success!');
        redirect("C_Transact/showDetailInvoice/$id_invoice");
    }

    public function showFormProof($id_invoice)
    {

        $data['id_invoice'] = $id_invoice;
        $this->load->view('Form_Proof', $data);
    }
    private function uploadProofRules()
    {
        $data = [
            [
                "field" => 'id_invoice',
                "label" => 'Id Invoice',
                "rules" => 'required|numeric'
            ]
        ];
        if (empty($_FILES['proof']['name'])) {
            $this->form_validation->set_rules('proof', 'Proof', 'required');
            
        }
        
                
        $validation = $this->form_validation;
        $validation->set_rules($data);
        return $validation->run();
    }

    public function uploadProof()
    {
        $id_invoice = $this->input->post()['id_invoice'];
        if ($this->uploadProofRules()) {
            $invoice = $this->Model_Invoice->getInvoiceByID($id_invoice);
            if (!$invoice || $invoice->username != $this->session->userdata('username')) {
                $this->session->set_flashdata('error', "this invoice id is not made by you!");
                $this->showFormProof($id_invoice);
                return;
            }
            if($this->Model_Invoice->setProof()){
                $this->session->set_flashdata('success', "proof is successfully uploaded!");
            }else{
                $error=$this->upload->display_errors('<p>', '</p>');
                $this->session->set_flashdata('error',"$error");
            }
            $this->showDetailInvoice($id_invoice);
            
        } else {
            $this->session->set_flashdata('error', "Please follow rules!" . validation_errors());
            redirect("C_Transact/showFormProof/$id_invoice");
        }
    }


    //below not updated code
    public function showFormCheckout()
    {
        $this->checkEmptyCart();
        $data['provinces'] = $this->getProvincesAPI();
        $this->load->view('Form_Checkout', $data);
    }

    private function checkoutRules()
    {
        $data = [
            [
                "field" => 'name',
                "label" => 'Fullname',
                "rules" => 'required'
            ],
            [
                "field" => 'street_address',
                "label" => 'Street Address',
                'rules' => 'required'
            ],
            [
                "field" => 'province_name',
                "label" => 'Province Name',
                "rules" => 'required'
            ],
            [
                "field" => 'city_name',
                "label" => 'City Name',
                'rules' => 'required'
            ],
            [
                "field" => 'phone_number',
                "label" => 'Phone Number',
                "rules" => 'required|numeric'
            ],
            [
                "field" => 'cost',
                "label" => 'Services',
                'rules' => 'required'
            ],

        ];
        $validation = $this->form_validation;
        $validation->set_rules($data);
        return $validation->run();
    }


    //below
    public function checkout()
    {

        if ($this->checkoutRules()) {
            $this->checkStock();
            $invoice = $this->Model_Invoice->create_invoice();
            $this->Model_Order->process($invoice);
            $this->cart->destroy();
            $this->session->set_flashdata('success', 'Checkout success!Please pay first! then upload proof in photo!');
            redirect('C_Transact/showDetailInvoice/' . $invoice->id_invoice);
        } else {
            $this->session->set_flashdata('error', 'Please follow rules!' . validation_errors());
            redirect('C_Transact/showFormCheckout/');
        }
    }

    private function checkEmptyCart()
    {
        if ($this->cart->total_items() <= 0) {
            $this->session->set_flashdata('error', 'your cart is empty! please buy something first');
            redirect('C_Product/listForCostumer');
        }
    }
    private function checkStock()
    {
        foreach ($this->cart->contents() as $item) {
            $id = $item['id'];
            $product = $this->Model_Product->getById($id);
            if ($product->stock < $item['qty']) {
                $this->session->set_flashdata('error', "available item $product->name is only $product->stock");
                redirect('welcome/display_cart');
            }
        }
    }



    public function getCost($destination, $courier)
    {
        $origin = $this->getOriginCityAPI()['city_id'];
        $weight = 0;
        foreach ($this->cart->contents() as $item) {
            $weight += $item['weight'];
        }
        $services = $this->getCostAPI($origin, $destination, $weight, $courier)['results'][0]['costs'];
        $output = '<option value="">- Service -</option>';

        foreach ($services as $service) {
            $output .= '<option value="' . $service['cost'][0]['value'] . '">' . $service['service'] . ' harga:Rp. ' . $service['cost'][0]['value'] . '</option>';
        }
        echo $output;
    }

    public function getCity($id_province)
    {
        $city = $this->getCityAPI($id_province);
        $output = '<option value="">- Kota -</option>';

        foreach ($city->rajaongkir->results as $cty) {
            $output .= '<option value="' . $cty->city_id . '">' . $cty->city_name . '</option>';
        }

        echo $output;
    }

    private function getProvincesAPI()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response, true)['rajaongkir']['results'];
        }
    }

    private function getCityAPI($id_province)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$id_province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            echo "cURL error:# $curl";
        } else
            return json_decode($response);
    }

    private function getOriginCityAPI()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=36",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return json_decode($response, true)['rajaongkir']['results'];
    }

    private function getCostAPI($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response, true)['rajaongkir'];
        }
    }

    public function checkExpired()
    {
        $this->checkAdmin();
        $invoices = $this->Model_Invoice->checkExpired();
        $this->Model_Product->checkExpired($invoices);
        redirect('C_Transact/');
    }

    
}
