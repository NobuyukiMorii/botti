<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */


class AppController extends Controller {

	public $components = array('Auth');

    public function beforeFilter(){

        $this->Auth->allow('login','Control_login','admin_register','admin_notice','admin_confirm','acceptance','add','/gachakoi/View/xml/default');

        $this->Auth->authorize = "Controller";//2014/4/24 users/edit/idとするため追記

        if (!$this->Auth->loggedIn()) {
            $this->Auth->authError = false;
        }

        $this->Auth->loginError = "ログインに失敗しました。";
    }

    public function isAuthorized() {
        $this->Session->setFlash(
        	'ログインしています。(ユーザー名：'.
            $this->Auth->user('nickname').')',true);

		return true;
    }

    public function beforeRender(){
        $this->set('LoginUserNickname', $this->Auth->user('nickname'));
        $this->set('LoginUserId', $this->Auth->user('id'));
        $this->set('group_id',$this->Auth->user('group_id'));
	}

}

