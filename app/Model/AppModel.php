<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public function checkCompare($valid_field1 , $valid_field2) {
        // フィールド名とフォームへの入力値の配列から、キーであるフィールド名を取得
        $fieldname = key($valid_field1);
     
         // 2つのフィールドの入力値を比較
        if($this->data[$this->name][$fieldname] === $this->data[$this->name][$valid_field2]){
            return true;
        }

        return false;
    }

	protected function _getCurrentUser() {
    App::uses('CakeSession', 'Model/Datasource');
    $Session = new CakeSession();
 
    $user = $Session->read('Auth.User.id');
    return $user;
	}

     public function dataIter(&$results, $callback) {
            
            if (! $isVector = isset($results[0])) {
                $results = array($results);
            }
            
            $modeled = array_key_exists($this->alias, $results[0]);
            
            foreach ($results as &$value) {
                if (! $modeled) {
                    $value = array($this->alias => $value);
                }
                
                $continue = $callback($value, $this);
                
                if (! $modeled) {
                    $value = $value[$this->alias];
                }
                
                if (! is_null($continue) && ! $continue) {
                    break;
                }
            }
            
            if (! $isVector) {
                $results = $results[0];
            }
        }


}
