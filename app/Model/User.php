<?php

class User extends AppModel {

    public $name = 'User';

    public $uses  = array('User','Attachment','Bar');

    public $hasMany = array(
        'Image' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
        ),
    );

    /*
    *上記記述より下の方が良さそうなので、置き換えた。
    */
    public function beforeSave() {

        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;

    }

    public $virtualFields = array(
        'age' => '(year(curdate()) - year(User.birthday)) - (right(curdate(),5) < right(User.birthday,5))'
    );

    public function confirmPassword( $field, $plain, $plain_confirm) {
        if ($plain == $plain_confirm) {
          // パスワードハッシュ化
          $this->request->data['User']['password'] = Security::hash( $plain, 'sha512', true);
          return true;
        }
    }


    //user_id_1とのリレーションをどうす
    public function afterFind ($results, $primary = true) {

        foreach($results as $i => $item){

            if(is_array($item)) {

            foreach (array('User') as $model) {
                if (array_key_exists($model, $item) && $results[0][$model] != false) {

                    if ($item[$model]['gender'] == 1) {
                        $item[$model]['genderText'] = '男性';
                    } else {
                        $item[$model]['genderText'] = '女性';
                    }
                    /*
                    /*
                    *kibouyoubiに関する処理はforeachで書きたいが、どう書けばいいか良くわからない
                    */
                    if ($item[$model]['kibouyoubi'] == 1) {
                        $item[$model]['kibouyoubiText'] = '月曜日';
                    } elseif ($item[$model]['kibouyoubi'] == 2) {
                        $item[$model]['kibouyoubiText'] = '火曜日';
                    } elseif ($item[$model]['kibouyoubi'] == 3) {
                        $item[$model]['kibouyoubiText'] = '水曜日';
                    } elseif ($item[$model]['kibouyoubi'] == 4) {
                        $item[$model]['kibouyoubiText'] = '木曜日';
                    } elseif ($item[$model]['kibouyoubi'] == 5) {
                        $item[$model]['kibouyoubiText'] = '金曜日';
                    } elseif ($item[$model]['kibouyoubi'] == 6) {
                        $item[$model]['kibouyoubiText'] = '土曜日';
                    } elseif ($item[$model]['kibouyoubi'] == 0) {
                        $item[$model]['kibouyoubiText'] = '日曜日';
                    } 

                }
            }
        }

            $results[$i] = $item;

        }
        return $results;
    }

    /*
    なんかメッセージが表示されない。
    あ、ビューに表示させるところがないからだ。作ろう。
    */

	public $validate = array(

        'username' => array(
            'isUnique' => array(
                'rule'    => 'isUnique',
                'message' =>'入力されたメールアドレスは既に登録されています。'
             ),
            'email' => array(
                'rule'    => array('email',true),
                'message' =>'正しいメールアドレスを入力してください。'
             ),
            'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' =>'メールアドレスを入力してください。'
            )
        ),

        'plain' => array(
             // パスワード・確認パスワードの一致
             'match' => array(
                 'rule' => array( 'confirmPassword', 'plain', 'plain_confirm'),
                 'message' => 'パスワードが違います'
             )  
        ),

        'password' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'パスワードは必ず入力してください'//追加
            ),
            'alphaNumeric' => array(
                'rule' => '/^[a-z\d]*$/i',
                'message' => '半角英数で入力してください',
            ),
            'between' => array(
                'rule' => array('between', 6, 16),
                'message' => 'パスワードは6文字以上16文字以下で入力してください',
            )
        ),

        'new_password1' => array(
            'alphaNumeric' => array(
                'rule' => '/^[a-z\d]*$/i',
                'message' => '半角英数で入力してください',
            ),
            'between' => array(
                'rule' => array('between', 6, 16),
                'message' => 'パスワードは6文字以上16文字以下で入力してください',
            )
        ),

        'new_password2' => array(
            'alphaNumeric' => array(
                'rule' => '/^[a-z\d]*$/i',
                'message' => '半角英数で入力してください',
            ),
            'between' => array(
                 'rule' => array('between', 6, 16),
                 'message' => 'パスワードは6文字以上16文字以下で入力してください',
            ),
            'same' => array(
                'rule' => array('checkCompare', 'new_password1'),
                'message' => '上下で同じ内容を入力してください',
            ),
        ),

        'last_name' => array(
            array(
                'rule' => 'notEmpty',
                'message' => 'お名前は必ず入力して下さい。'
            ),
            array(
                'rule' => array('maxLength', 30),
                'message' => '10文字以内で入力して下さい。'
            )
        ),

        'first_name' => array(
            array(
                'rule' => 'notEmpty',
                'message' => 'お名前は必ず入力して下さい。'
            ),
            array(
                'rule' => array('maxLength', 30),
                'message' => '10文字以内で入力して下さい。'
            )
        ),

        'nickname' => array(
            array(
                'rule' => 'notEmpty',
                'message' => 'ニックネームは必ず入力して下さい。'
            ),
            array(
                'rule' => array('maxLength', 30),
                'message' => '30文字以内で入力して下さい。'
            )
        ),

        'telnumber' => array(
                'rule'=>array('custom','/\d{2,4}-\d{2,4}-\d{4}/'),
                'message'=>'電話番号を正確に入力してください。'
        ),

        'gender' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '必ず入力して下さい。',
            ),
            array(
                'rule' => 'numeric',
                'message' => 'プルダウンから選択して下さい。'
            ),
            array(
                'rule' => array('comparison','<=',2),
                'message' => 'プルダウンから選択して下さい。'
            )
        ),

        'birthday' => array(
            array(
                'rule' => 'notEmpty',
                'message' => 'お誕生日は必ず入力して下さい。'
            ),
            array(
                'rule' => array('date','ymd'),
                'message' => 'フォーマットの形式で入力して下さい。'
            )
        ),
        
        'work' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '必ず入力して下さい。',
            ),
        ),

        'moyorieki' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '必ず入力して下さい。',
            ),
        ),

        'amount' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '必ず入力して下さい。',
            ),
        ),

        'kibouyoubi' => array(
                'rule' => 'notEmpty',
                //'allowEmpty' => false
                'message' => '希望日は必ず入力して下さい。',   
        ),

        'kibouzikan' => array(
                'rule' => 'notEmpty',
                //'allowEmpty' => false
                'message' => '待ち合わせ時間は必ず入力して下さい。',   
        ),

        'kibouzikan_finish' => array(
                'rule' => 'notEmpty',
                //'allowEmpty' => false
                'message' => 'お別れの時間は必ず入力して下さい。',   
        ),

        'message' => array(
            array(
                'rule' => array('maxLength', 150),
                'message' => '「50文字以内で入力して下さい。',
            )
        ),



    );

}
?>