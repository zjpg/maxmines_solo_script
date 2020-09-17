<?php

class Main{
    public $config;
    public $mma;
    
    public $balance;
    public $rate;
    public $admin=0;
    public $users;
    public $chart;
    
    public function __construct($config, $mma){
        $this->config = $config;
        $this->mma    = $mma;
        $this->users  = $this->load_users_from_file();
        $this->history = $this->load_site_stats_from_file();
        switch(true){
            case $this->is_admin():
                $this->admin         = true;
                $this->rate          = file_get_contents(dirname(__FILE__)."/../../hash_rate.json") != '' ? file_get_contents(dirname(__FILE__)."/../../hash_rate.json") : $mma->hash_rate(1000000)["xmr"]-$config->comission; ;
                
                return;
                break;
            
            case !isset($_COOKIE['xmr_address']):
                $this->rate          = file_get_contents(dirname(__FILE__)."/../../hash_rate.json") != '' ? file_get_contents(dirname(__FILE__)."/../../hash_rate.json") : $mma->hash_rate(1000000)["xmr"]-$config->comission; ;
                return;
                break;
            
            case isset($_COOKIE['xmr_address'])&&!isset($_COOKIE['rate']):
                $this->rate          = file_get_contents(dirname(__FILE__)."/../../hash_rate.json") != '' ? file_get_contents(dirname(__FILE__)."/../../hash_rate.json") : $mma->hash_rate(1000000)["xmr"]-$config->comission; ;
                $user                = $this->get_user($_COOKIE['xmr_address']);
                if($user!==false){
                    $this->balance   = $user->balance;
                }else{
                    $this->balance   = 0;
                }
                try{
                    setcookie("rate", $this->rate, time() + 61);
                    setcookie("balance", $this->balance, time() + 61);
                } catch(Exception $e) {
                    echo $e;
                }
                break;
            
            default:
                $this->rate=$_COOKIE['rate'];
                $this->balance=$_COOKIE['balance'];
        }
    }
    
    public function set_address($address){
        try {
            setcookie("xmr_address", $address, time() + 2592000);
            echo "success";
        } catch(Exception $e) {
            echo $e;
        }
        return;
    }
    
    
    public function withdraw($address, $hashes){
        $rate=$this->mma->hash_rate(1000000)["xmr"]-$this->config->comission;
        $user=$this->mma->user_withdraw($address, $hashes);
        var_dump($user);
        $user_balans_mai=$user->hashes/1000000*$rate;
        if($user_balans_mai>=$this->config->minimal_payout){
            $this->mma->user_reset($address);
            if($result['success']==true){
                echo "success";
                setcookie("rate", '', time() - 3600);
                return;
            } else {
                echo $result['message'];
            }
            
        } else {
            echo "Bạn cần phải khai thác thêm một chút để rút tiền ...";
        }
    }
    
    public function delete_user($address){
        $this->mma->user_reset($address);
    }
    
    public function get_users($threshold=0){
        $users=$this->mma->user_list(4096);
        if($users["success"] == "true"){
            $this->users=$users["users"];
        } else {
            $this->users=false;
            return "{message: 'no users'}";
        }
        return json_encode($users["users"]);
    }
    public function get_chart_data() {
        $chart = $this->history->history;
        $val = array();
        foreach($chart as $data) {
            array_push($val, [intval($data->time)*1000, (float) $data->hashesPerSecond]);
        }
        return json_encode($val);
    }
    public function load_users_from_file(){
        return json_decode(file_get_contents(dirname(__FILE__)."/../../users.json"));
    }
    public function load_site_stats_from_file(){
        return json_decode(file_get_contents(dirname(__FILE__)."/../../history.json"));
    }
    public function get_user($address){
        $users=$this->users;
        if($users!=null){
            foreach($users as $user){
                if ($user->name == $address){
                    return $user;
                }
            }
        }
        return false;
    }
    
    public function withdraw_all(){
        $users = json_decode($this->get_users($this->config->minimal_payout/$this->rate*1000000));
        if($users == NULL){
            echo "Không có người dùng nào có đủ tiền để rút.";
            return;
        }
        $sum = 0;
        foreach($users as $user){
            $sum=$sum+round($user->balance/1000000*$this->rate);
            $this->mma->user_withdraw($user->name, $user->balance);
        }
        $this->mma->user_reset_all($this->config->minimal_payout/$this->rate*1000000);
    }
    
    public function draw_users_table(){
        $this->get_users();
        if(!$this->users){
            echo "Không có người dùng nào cả";
            die();
        }
        echo "<br><a href='?admin_name=".$this->config->admin_name."&admin_pwd=".$this->config->admin_pwd."&action=withdraw_all' class='btn btn-success'>Rút tất cả</a>
        <div style='padding-bottom:10px'></div>

            <table class='table' id='users-table'>
                <colgroup>
                    <col width='100%' />
                    <col width='0%' />
                </colgroup>
                <thead>
                  <tr>
                    <th scope='col'>Tên</th>
                    <th scope='col'>Số dư</th>
                    <th scope='col'>Hành động</th>
                  </tr>
                </thead>
                <tbody>";
        foreach($this->users as $user){
            if($user["balance"] != 0)
            echo "<tr>
                    <th scope='row'  style='white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;'><textarea class='form-control'>".$user["name"]."</textarea></th>
                    <td>".number_format($user["balance"]/1000000*$this->rate, 8)."</td>
                    <td>
                        <a href='?admin_name=".$this->config->admin_name."&admin_pwd=".$this->config->admin_pwd."&action=withdraw&address=".$user["name"]."&hashes=".$user["balance"]."' class='btn btn-success'>Rút</a>
                        <div style='padding-top:10px'></div>
                        <a href='?admin_name=".$this->config->admin_name."&admin_pwd=".$this->config->admin_pwd."&action=delete&address=".$user["name"]."' class='btn btn-danger'>Xóa</a>
                    </td>
                  </tr>";
        }
        echo "          
                </tbody>
              </table>
        ";
    }
    
    private function is_admin(){
        if(isset($_GET['admin_name'])&& isset($_GET['admin_pwd'])&&$_GET['admin_name']==$this->config->admin_name&&$_GET['admin_pwd']==$this->config->admin_pwd){
            return true;
        }else{
            return false;
        }
    }
}