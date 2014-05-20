<?php

class BarsController extends AppController
{

// Sweet,Commentモデルを使用する
    public $uses = array('Meeting','User','Bar');

    // Sessionコンポーネントを使用する

    public $components = array('Auth','Session','Paginator');

    public function admin_register(){

        $this->layout = 'non_nav';


    }

	public function admin_confirm(){

        $this->layout = 'non_nav';

        if ($this->request->is('post')) {

            //バリデーションチェック
            $this->Bar->set($this->request->data);

            //バリデーションエラーがあれば、admin_register画面に戻し、エラーを表示する
            if(!$this->Bar->validates()){

                $this->set("error",$this->Bar->validationErrors);
                $this->render("admin_register");
            } else {
                $this->Session->write('hozon',$this->request->data);
                $this->render("admin_confirm");
            }
        }
    }


    public function image2(){
        //指定したidに沿ってデータを一件検索
        $graphic = $this->Session->read('hozon');
        //画像ファイルをアップロードする際の定型コード。どんな データなのかを教えるおまじない。
        header('Content-type: image/jpeg');
        //画像ファイルの呼び出し
        echo ($graphic["Bar"]["image"]);
        exit;
    }

    public function admin_notice(){

        $this->layout = 'non_nav';
        
        $register = $this->request->data;

            //住所から緯度と経度を計算する
        $coordinates = $this->getLatLng($register['Bar']['location']);
        $geo_info = explode(',', $coordinates);
        
        $register['Bar']['latitude'] = $geo_info[0];
        $register['Bar']['longitude'] = $geo_info[1];

        $last_char = mb_substr($register['Bar']['station'],-1);
        if($last_char != "駅") {$register['Bar']['station'] = $register['Bar']['station']."駅";}

        if ($this->Bar->saveAll($register, array( 'validate' => false))) {
            return $this->redirect('/users/add/');
        }

    }

    public function getLatLng($location)
    {
        $api_uri = 'http://maps.googleapis.com/maps/api/geocode/xml?address='.urlencode($location).'&sensor=false';

        $xml = simplexml_load_file($api_uri);
        $code = $xml->status;
        if ($code == 'OK')
        {
            $lat = $xml->result->geometry->location->lat;
            $lng = $xml->result->geometry->location->lng;
            $coordinates = $lat. ',' . $lng;
        } else 
        {
            $coordinates = false;
        }
        return $coordinates;
    }

    public function image($cid){
        //画面表示用テンプレート読み込み動作
        $this->autoRender = FALSE;
        //指定したidに沿ってデータを一件検索
        $graphic = $this->Bar->findById($cid);
        //画像ファイルをアップロードする際の定型コード
        header('Content-type: image/jpeg');
        //画像ファイルの呼び出し
        echo $graphic["Bar"]["image"];
        exit;
    }

    public function admin_list() {
        $this->Paginator->settings = array(
            'conditions' => array(),
            'limit' => 10,
            'sort' => 'Bar.station'
        );
        $data = $this->Paginator->paginate('Bar');
        $this->set(compact('data'));
    }

    public function search(){
        
    }

    public function result() {
        $data = null;
        if(!empty($this->request->data)){
            $data = $this->Bar->find('all', array('conditions' => 
                array('Bar.name like' => "%{$this->data['Bar']['name']}%")));
        } else {
            $data = $this->Board->find('all');
        }
        $this->set('data',$data);

    }



    public $paginate = array(
        'page' => 1,
        'limit' => 5,
        'limit' =>100,
        'order' => array('Meeting.date' => 'ASC','Meeting.time' => 'ASC')
    );

    public function bar_control() {

        $this->Paginator->settings = array(
            'Meeting' => array(
                'limit' => 20,
                'order' => array('date' => 'ASC'),
                // 'group' => array('week', 'home_team_id', 'away_team_id'),
            )
        );

        $data = $this->Paginator->paginate('Meeting');
        $this->set(compact('data'));

    }


}