<?php


class MaxMinesAPI {
    private $secret = null;
    const API_URL = 'https://api.maxmines.com';

    public function __construct($secret) {
        if (strlen($secret) !== 40) {
            throw new Exception('Invalid Secret key');
        }
        $this->secret = $secret;
    }
  
    function get($path, $data = []) {
        $data['secret'] = $this->secret;
        $url = self::API_URL.$path.'?'.http_build_query($data);
        $response = $this->api_request($url, false, null);
        return json_decode($response, true);
    }

    function post($path, $data = []) {
        $data['secret'] = $this->secret;
        $context = http_build_query($data);
        $url = SELF::API_URL.$path;
        $response = $this->api_request($url, true, $context);
        return json_decode($response, true);
    }

    function api_request($url, bool $post, $context) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FAILONERROR, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_POST, $post);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $context);
        curl_setopt($curl, CURLOPT_SSLVERSION, 1);
        curl_setopt($curl, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    
    public function token_verify($token, $hashes){
        return $this->post("token/verify", [
            'token' => $token,
            'hashes' => $hashes
        ]);
    }
    
    public function user_balance($username){
        return $this->get("/user/balance", [
            'name' => $username
        ]);
    }
    
    public function user_withdraw($username, $amount){
        return $this->post("/user/withdraw", [
            'name' => $username,
            'amount' => $amount
        ]);
    }

    public function user_top($count = 128, $order = 'total'){
        return $this->get("/user/top", [
            'count' => $count,
            'order' => $order
        ]);
    }
    
    public function user_list($count = 4096, $page = null){
        return $this->get("/user/list", [
            'count' => $count,
            'page' => $page
        ]);
    }
    
    public function user_reset($username){
        return $this->post("/user/reset", [
            'name' => $username
        ]);
    }
    
    public function user_reset_all(){
        return $this->post("/user/reset-all", []);
    }
    
    public function link_create($url, $hashes){
        return $this->post("/link/create", [
            'url' => $url,
            'hashes' => $hashes
        ]);
    }
    
    public function stats_payout(){
        return $this->get("/stats/payout", []);
    }
    
    public function stats_site(){
        return $this->get("/stats/site", []);
    }
    
    public function stats_history($begin, $end){
        return $this->get("/stats/history", [
            'begin' => $begin,
            'end' => $end
        ]);
    }
    
    public function stats_user($username){
        return $this->get("/stats/user", [
            "name" => $username
        ]);
    }
}
