<?php
class Home extends CI_Controller{
    public function atom_request(){
        date_default_timezone_set('Asia/Calcutta');
        $date = date("d-m-Y");
        $time = date("h:i:s");

        $sessionId = $this->session->userdata('user');

        $data['membe'] = $this->datawork->get_id('member', ['m_id' => $sessionId]);
        $accountid  = $data['membe']['m_accountid'];
        $name       = $data['membe']['m_fullname'];
        $mobile     = $data['membe']['m_mobile'];
        $email      = $data['membe']['m_email'];
        $address    = $data['membe']['m_address'];
     
        $this->atompay->atom_request($txnid, $_POST['amount'], $name, $mobile, $email, $sessionId);
    }

    public function atom_response(){
        date_default_timezone_set('Asia/Calcutta');
        $date = date("d-m-Y");
        $time = date("h:i:s");
        
        $sessionId = $this->session->userdata('user');
        $response = $this->atompay->atomResponse();

         echo $status = $response['f_code'];
         echo $amt    = $response['amt'];
         echo $bank_txn    = $response['bank_txn'];
         echo $txnid    = $response['mer_txn'];
         echo $udf4    = $response['udf4'];


        $data['member'] = $this->datawork->get_id('member', ['m_id' => $udf4]);
        $accountid  = $data['member']['m_accountid'];
        $m_balance  = $data['member']['m_balance'];
        $holdingbal  = $data['member']['holdingbal'];

        $data['bals'] = $this->datawork->get_id('balance', ['bal_orderid' => $txnid]);
        $bal_updated  = $data['bals']['bal_updated'];
        $bal_method   = $data['bals']['bal_method'];


        $yummy = json_encode($response, true);

        $data['resp'] = $this->atompay->atomResponse();
        redirect(base_url('/home/success'));
    }
}