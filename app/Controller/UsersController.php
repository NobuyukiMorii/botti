<?php

class UsersController extends AppController
{

// Sweet,Commentモデルを使用する
    public $name = 'Users';

    public $uses = array('User','Meeting','Bar');

    public $components = array('Auth','Session','Cookie','Paginator');

    public $helpers = array("DatePicker");

public function add(){

    $this->layout = 'non_nav';
    
    $options_bar = $this->Bar->find('list',array(
        'callbacks' => false,
        'fields' => array('Bar.id','Bar.name')
        )
    );
    $this->set('options_bar',$options_bar);

    $this->Paginator->settings = array(
        'conditions' => array(),
        'limit' => 4,
        'sort' => 'Bar.station'
    );
    $data = $this->Paginator->paginate('Bar');
    $this->set(compact('data'));

    if(!empty($this->request->data)){
        if($this->request->data){
            $this->User->create($this->request->data);

            if(!$this->User->validates()){
                $this->set("error",$this->User->validationErrors);
                $this->render("add");
            } else {

                $last_char = mb_substr($this->request->data['User']['moyorieki'],-1);
                if($last_char != "駅") {$this->request->data['User']['moyorieki'] = $this->request->data['User']['moyorieki']."駅";}

                $this->User->saveAll($this->request->data);
                $this->Session->setFlash('ユーザー登録を完了しました。', 'default', array(), 'success');
                $this->redirect(array('action'=>'login'));
            }

        }
    } else {

    }
}

public function Control_add(){
    $this->layout = 'Control_non_nav';
    if(!empty($this->request->data)){
        if($this->request->data){
            $this->User->create($this->request->data);

            if(!$this->User->validates()){
                $this->set("error",$this->User->validationErrors);
                $this->render("add");
            } else {
                $this->User->saveAll($this->request->data);
                $this->Session->setFlash('ユーザー登録を完了しました。', 'default', array(), 'success');
                $this->redirect(array('action'=>'login'));
            }

        }
    }
}

public function image($cid){
    //画面表示用テンプレート読み込み動作
    $this->autoRender = FALSE;
    //指定したidに沿ってデータを一件検索
    $graphic = $this->User->findById($cid);
    //画像ファイルをアップロードする際の定型コード
    header('Content-type: image/jpeg');
    //画像ファイルの呼び出し
    echo $graphic["User"]["image"];
    exit;
    }

public function login() {

    $this->autoLayout = false;
    $this->autoRender = true;

    if (!empty($this->request->data) ) {
        // ログイン OK
        if ($this->Auth->login()) {
            // keep_me_logged_inがチェックされている場合
            if (isset($this->request->data['User']['keep_me_logged_in'])) {
                // cookieへの書き込みにkeep_me_logged_inを除外
                unset($this->request->data['User']['keep_me_logged_in']);
                $cookie = $this->request->data;
                // cookie書き込み
                $this->Cookie->write('Auth', $cookie, true, '+2 weeks');

            // keep_me_logged_inがチェックされていない場合
            } else {

            }
            // リダイレクト
            return $this->redirect('/Meetings/roulette/');
            $this->Session->setFlash('ログインしました。','default',array(),'auth');

        // ログイン NG
        } else {
            $this->Session->setFlash('ユーザー名かパスワードが違います。','default',array(),'auth');
        }
    }

    if (empty($this->request->data) ) {
        // cookie 有り
        if ($this->Cookie->check('Auth')) {
            // cookieをログイン用データに書き込み
            $this->request->data = $this->Cookie->read('Auth');
            // ログイン OK
            if ($this->Auth->login()) {
                // ログインリダイレクト
                return $this->redirect('/Meetings/roulette/');
            // ログイン NG
            } else {
                // coockie削除
                $this->Cookie->delete('Auth');    //    クッキー削除
            }
        // cookie 無し
        } else {
            // ログイン画面表示
        }
    }
}

public function Control_login() {

    $this->autoLayout = false;
    $this->autoRender = true;

    if (!empty($this->request->data) ) {
        // ログイン OK
        if ($this->Auth->login()) {
            // keep_me_logged_inがチェックされている場合
            if (isset($this->request->data['User']['keep_me_logged_in'])) {
                // cookieへの書き込みにkeep_me_logged_inを除外
                unset($this->request->data['User']['keep_me_logged_in']);
                $cookie = $this->request->data;
                // cookie書き込み
                $this->Cookie->write('Auth', $cookie, true, '+2 weeks');

            // keep_me_logged_inがチェックされていない場合
            } else {

            }
            // リダイレクト
            return $this->redirect('/Meetings/Control_meetinglist/');
            $this->Session->setFlash('ログインしました。','default',array(),'auth');

        // ログイン NG
        } else {
            $this->Session->setFlash('ユーザー名かパスワードが違います。','default',array(),'auth');
        }
    }

    if (empty($this->request->data) ) {
        // cookie 有り
        if ($this->Cookie->check('Auth')) {
            // cookieをログイン用データに書き込み
            $this->request->data = $this->Cookie->read('Auth');
            // ログイン OK
            if ($this->Auth->login()) {
                // ログインリダイレクト
                return $this->redirect('/Meetings/Control_meetinglist/');
            // ログイン NG
            } else {
                // coockie削除
                $this->Cookie->delete('Auth');    //    クッキー削除
            }
        // cookie 無し
        } else {
            // ログイン画面表示
        }
    }
}

public function logout(){
    
    $this->Cookie->delete('Auth');
    return $this->redirect( $this->Auth->logout());
}

public function Control_logout(){
    
    $this->Cookie->delete('Auth');
    return $this->redirect('/Users/Control_login/');
}

public function profile($id = null){

    $data = $this->User->find('first',array(
        'conditions' => array('User.id' => $this->Auth->User('id')),
        )
    );
    $this->set(compact('data'));

    $bar = $this->Bar->find('first',array(
        'conditions' => array('Bar.id' => $this->Auth->User('bar_id')),
        )
    );
    $this->set(compact('bar'));

}

public function my_bar($id = null) {

    $this->Paginator->settings = array(
        'conditions' => array(),
        'limit' => 10,
        'sort' => 'Bar.station'
    );
    $data = $this->Paginator->paginate('Bar');
    $this->set(compact('data'));

    $this->User->id = $id;
    if (!$this->User->exists()) {
        throw new NotFoundException(__('Invalid user'));
    }

    if ($this->request->is('post') || $this->request->is('put')) {

        unset($this->User->validate['username']['isUnique']);

        if ($this->User->save($this->request->data)) {
                // 更新成功
            $this->Session->setFlash('バー登録を更新しました！！', 'default', array(), 'success');
                // 2つのパスワード入力フォームを空で表示するために、配列から破棄

            $this->redirect(array('controller' => 'Users','action' => 'profile'));

        } else {
                // 更新失敗
            $this->Session->setFlash('バー登録の更新に失敗しました！！', 'default', array(), 'fail');
            $this->redirect('/users/my_bar/'.$this->Auth->user('id'));

        }
    } else {
            // 初期表示時
        $this->request->data = $this->User->read(null, $id);

    }
}

public function edit($id = null) {

    $this->Paginator->settings = array(
        'conditions' => array(),
        'limit' => 10,
        'sort' => 'Bar.station'
    );
    $data = $this->Paginator->paginate('Bar');
    $this->set(compact('data'));

    $this->User->id = $id;
    if (!$this->User->exists()) {
        throw new NotFoundException(__('Invalid user'));
    }

    unset($this->User->validate['new_password1']['between']);
    unset($this->User->validate['new_password2']['between']);

    if ($this->request->is('post') || $this->request->is('put')) {

            // 更新処理時
            // User.new_password1、User.new_password2 ともに入力の場合はパスワードの更新を行う
        if ($this->request->data['User']['new_password1'] !== '' && $this->request->data['User']['new_password2'] !== '') {
                // User.password が存在しないので、リクエストの配列に追加
            $this->request->data['User']['password'] = $this->request->data['User']['new_password1'];
        }

        unset($this->User->validate['username']['isUnique']);

        $last_char = mb_substr($this->request->data['User']['moyorieki'],-1);
        if($last_char != "駅") {$this->request->data['User']['moyorieki'] = $this->request->data['User']['moyorieki']."駅";}

        if ($this->User->save($this->request->data)) {
                // 更新成功
            $this->Session->setFlash('プロフィールを更新しました！！', 'default', array(), 'success');
                // 2つのパスワード入力フォームを空で表示するために、配列から破棄
            unset($this->request->data['User']['new_password1'], $this->request->data['User']['new_password2']);

            $this->redirect(array('action' => 'roulette','controller' => 'Meetings'));

        } else {
                // 更新失敗
            $this->Session->setFlash('プロフィールを更新に失敗しました！！', 'default', array(), 'fail');
            $this->redirect('/users/edit/'.$this->Auth->user('id'));

        }
    } else {
            // 初期表示時
        $this->request->data = $this->User->read(null, $id);

    }
}

public function password($id = null) {

    $this->User->id = $id;
    if (!$this->User->exists()) {
        throw new NotFoundException(__('Invalid user'));
    }

    unset($this->User->validate['new_password1']['between']);
    unset($this->User->validate['new_password2']['between']);

    if ($this->request->is('post') || $this->request->is('put')) {

            // 更新処理時
            // User.new_password1、User.new_password2 ともに入力の場合はパスワードの更新を行う
        if ($this->request->data['User']['new_password1'] !== '' && $this->request->data['User']['new_password2'] !== '') {
                // User.password が存在しないので、リクエストの配列に追加
            $this->request->data['User']['password'] = $this->request->data['User']['new_password1'];
        }

        unset($this->User->validate['username']['isUnique']);

        if ($this->User->save($this->request->data)) {
                // 更新成功
            $this->Session->setFlash('パスワードを更新しました！！', 'default', array(), 'success');
                // 2つのパスワード入力フォームを空で表示するために、配列から破棄
            unset($this->request->data['User']['new_password1'], $this->request->data['User']['new_password2']);

            $this->redirect('/users/profile/'.$this->Auth->user('id'));

        } else {
                // 更新失敗
            $this->Session->setFlash('パスワード更新に失敗しました！！', 'default', array(), 'fail');
            $this->redirect('/users/password/'.$this->Auth->user('id'));

        }
    } else {
            // 初期表示時
        $this->request->data = $this->User->read(null, $id);

    }
}

public function admin_userlist(){

        $this->Paginator->settings = array(
            'conditions' => array('User.group_id' => 1),
            'limit' => 10,
            'sort' => 'User.id'
        );
        $user = $this->Paginator->paginate('User');
        $this->set(compact('user'));

}

public function admin_barlist(){

        $this->Paginator->settings = array(
            'conditions' => array('User.group_id' => 2),
            'limit' => 10,
            'sort' => 'User.id'
        );
        $bar = $this->Paginator->paginate('User');
        $this->set(compact('bar'));

}


}
