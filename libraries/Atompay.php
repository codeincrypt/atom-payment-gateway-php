  
<?php
class Atompay{

  private $login;
  private $password;
  private $transactionType;
  private $productId;
  private $amount;
  private $transactionCurrency;
  private $transactionAmount;
  private $clientCode;
  private $transactionId;
  private $transactionDate;
  private $customerAccount;
  private $customerName;
  private $customerEmailId;
  private $customerMobile;
  private $customerBillingAddress;
  private $returnUrl;
  private $mode = "test";
  private $transactionUrl;
  private $nbType = "NBFundTransfer";
  private $ccType = "CCFundTransfer";
  private $reqHashKey = "";
  private $respHashKey = "";

  public function getReqHashKey(){
      return $this->reqHashKey;
  }

  public function setReqHashKey($reqHashKey){
      $this->reqHashKey = $reqHashKey;
  }

  public function getRespHashKey(){
      return $this->respHashKey;
  }

  public function setRespHashKey($respHashKey){
      $this->respHashKey = $respHashKey;
  }

  public function getLogin(){
      return $this->login;
  }

  public function setLogin($login){
      $this->login = $login;
  }

  public function getPassword(){
      return $this->password;
  }

  public function setPassword($password){
      $this->password = $password;
  }

  public function getTransactionType(){
      return $this->transactionType;
  }

  public function setTransactionType($transactionType){
      $this->transactionType = $transactionType;
  }

  public function getProductId(){
      return $this->productId;
  }

  public function setProductId($productId){
      $this->productId = $productId;
  }

  public function getAmount(){
      return $this->amount;
  }

  public function setAmount($amount){
      $this->amount = $amount;
  }

  /**
   * @return the $transactionCurrency
   */
  public function getTransactionCurrency()
  {
      return $this->transactionCurrency;
  }

  /**
   * @param string $transactionCurrency
   */
  public function setTransactionCurrency($transactionCurrency)
  {
      $this->transactionCurrency = $transactionCurrency;
  }

  /**
   * @return the $transactionAmount
   */
  public function getTransactionAmount()
  {
      return $this->transactionAmount;
  }

  /**
   * @param string $transactionAmount
   */
  public function setTransactionAmount($transactionAmount)
  {
      $this->transactionAmount = $transactionAmount;
  }

  /**
   * @return the $transactionId
   */
  public function getTransactionId()
  {
      return $this->transactionId;
  }

  /**
   * @param string $transactionId
   */
  public function setTransactionId($transactionId)
  {
      $this->transactionId = $transactionId;
  }

  /**
   * @return the $transactionDate
   */
  public function getTransactionDate()
  {
      return $this->transactionDate;
  }

  /**
   * @param string $transactionDate
   */
  public function setTransactionDate($transactionDate)
  {
      $this->transactionDate = $transactionDate;
  }

  /**
   * @return the $customerAccount
   */
  public function getCustomerAccount()
  {
      return $this->customerAccount;
  }

  /**
   * @param string $customerAccount
   */
  public function setCustomerAccount($customerAccount)
  {
      $this->customerAccount = $customerAccount;
  }

  /**
   * @return the $customerName
   */
  public function getCustomerName()
  {
      return $this->customerName;
  }

  /**
   * @param string $customerName
   */
  public function setCustomerName($customerName)
  {
      $this->customerName = $customerName;
  }

  /**
   * @return the $customerEmailId
   */
  public function getCustomerEmailId()
  {
      return $this->customerEmailId;
  }

  /**
   * @param string $customerEmailId
   */
  public function setCustomerEmailId($customerEmailId)
  {
      $this->customerEmailId = $customerEmailId;
  }

  /**
   * @return the $customerMobile
   */
  public function getCustomerMobile()
  {
      return $this->customerMobile;
  }

  /**
   * @param string $customerMobile
   */
  public function setCustomerMobile($customerMobile)
  {
      $this->customerMobile = $customerMobile;
  }

  /**
   * @return the $customerBillingAddress
   */
  public function getCustomerBillingAddress()
  {
      return $this->customerBillingAddress;
  }

  /**
   * @param string $customerBillingAddress
   */
  public function setCustomerBillingAddress($customerBillingAddress)
  {
      $this->customerBillingAddress = $customerBillingAddress;
  }

  /**
   * @return the $returnUrl
   */
  public function getReturnUrl()
  {
      return $this->returnUrl;
  }

  /**
   * @param string $returnUrl
   */
  public function setReturnUrl($returnUrl)
  {
      $this->returnUrl = $returnUrl;
  }

  /**
   * @return the $mode
   */
  public function getMode()
  {
      return $this->mode;
  }

  /**
   * @param string $mode
   */
  public function setMode($mode)
  {
      $this->mode = $mode;
  }

  /**
   * @return the $transactionUrl
   */
  public function getTransactionUrl()
  {
      return $this->transactionUrl;
  }

  /**
   * @param string $transactionUrl
   */
  public function setTransactionUrl($transactionUrl)
  {
      $this->transactionUrl = $transactionUrl;
  }

  public function getnbType() {
  return $this->nbType;
  }

  public function getccType() {
  return $this->ccType;
  }

  private function setUrl() {
  $port = 443;
  if($this->getMode() == "live"){
    $url = "https://payment.atomtech.in/paynetz/epi/fts";
  } else {
    $url = "https://paynetzuat.atomtech.in/paynetz/epi/fts";
  }
  $this->setTransactionUrl($url);
  $this->setPort($port);
  }

  public function setClientCode($clientCode) {
  if($clientCode == NULL || $clientCode == ""){
    $this->clientCode = urlencode(base64_encode(123));
  } else {
    $this->clientCode = urlencode(base64_encode($clientCode));
  }
  }

  private function getClientCode() {
  return $this->clientCode;
  }

  private function setPort($port) {
  $this->port = $port;
  }

  private function getPort() {
  return $this->port;
  }


  public function getChecksum(){
      $str = $this->login . $this->password . "NBFundTransfer" . $this->productId . $this->transactionId . $this->amount . "INR";
     // echo $str;exit;
      $signature =  hash_hmac("sha512",$str,$this->reqHashKey,false);
      return $signature;
  }

  private function getData(){
    $strReqst = "";
    $strReqst .= "login=".$this->getLogin();
    $strReqst .= "&pass=".$this->getPassword();
    //$txnType = $this->getTransactionType();
    //if($txnType== 'NB'){
        $strReqst .= "&ttype=NBFundTransfer";
    //}else{
      //$strReqst .= "&ttype=".$this->getccType();
    //}
    $strReqst .= "&prodid=".$this->getProductId();
    $strReqst .= "&amt=".$this->getAmount();
    $strReqst .= "&txncurr=".$this->getTransactionCurrency();
    $strReqst .= "&txnscamt=".$this->getTransactionAmount();
    $strReqst .= "&ru=".$this->getReturnUrl();
    $strReqst .= "&clientcode=".$this->getClientCode();
    $strReqst .= "&txnid=".$this->getTransactionId();
    $strReqst .= "&date=".$this->getTransactionDate();
    $strReqst .= "&udf1=".$this->getCustomerName();
    $strReqst .= "&udf2=".$this->getCustomerEmailId();
    $strReqst .= "&udf3=".$this->getCustomerMobile();
    $strReqst .= "&udf4=".$this->getCustomerBillingAddress();
    $strReqst .= "&custacc=".$this->getCustomerAccount();
    $strReqst .= "&signature=".$this->getChecksum();

    return $strReqst;
  }

  /**
   * This function returns transaction token url
   * @return string
   */
  public function getPGUrl(){
      if ($this->mode != null && $this->mode != "") {
          try {
      $this->setUrl();
              $data = $this->getData();
      $this->writeLog($data);
      return $this->transactionUrl . "?" .$data;
          } catch ( Exception $ex ) {
              echo "Error while getting transaction token : " . $ex->getMessage();
              return;
          }
      } else {
          return "Please set mode live or test";
      }
  }

  private function writeLog($data){
    $fileName = "date".date("Y-m-d").".txt";
    $fp = fopen("log/".$fileName, 'a+');
    $data = date("Y-m-d H:i:s")." - ".$data;
    fwrite($fp,$data);
    fclose($fp);
  }

  // RESPONSE
  public function validateResponse($responseParams)
  {
      $str = $responseParams["mmp_txn"].$responseParams["mer_txn"].$responseParams["f_code"].$responseParams["prod"].$responseParams["discriminator"].$responseParams["amt"].$responseParams["bank_txn"];
      $signature =  hash_hmac("sha512",$str,$this->respHashKey,false);
      if($signature == $responseParams["signature"]){
          return true;
      } else {
          return false;
      }

  }

  public function atomResponse(){
    $this->setRespHashKey("KEYRESP123657234");
    if($this->validateResponse($_POST)){
        return $_POST;
    } else {
        return "Invalid Signature";
    }
  }
  // CREATE
  public function atom_request($orderid, $amount, $name, $mobile, $email, $sessionid){
    //Setting all values here
    $transactionId = rand(1,1000000);
    $datenow = date("d/m/Y h:m:s");
    $transactionDate = str_replace(" ", "%20", $datenow);

    $this->setMode("test");
    $this->setLogin(197);
    $this->setPassword("Test@123");

    $this->setProductId("NSE");
    $this->setAmount($amount);
    $this->setTransactionCurrency("INR");
    $this->setTransactionAmount($amount);
    $this->setReturnUrl(base_url().'home/atom_response');
    $this->setClientCode(123);
    $this->setTransactionId($orderid);
    $this->setTransactionDate($transactionDate);
    $this->setCustomerName($name);
    $this->setCustomerEmailId($email);
    $this->setCustomerMobile($mobile);
    $this->setCustomerBillingAddress($sessionid);
    $this->setCustomerAccount("639827");
    $this->setReqHashKey("KEY123657234");

    $url = $this->getPGUrl();
    redirect($url);
  }
}
?>