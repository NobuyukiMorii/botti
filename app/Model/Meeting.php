<?php

class Meeting extends AppModel {

	public $uses  = array('Meeting','User','Bar');

    public $recursive = 2;

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Bar' => array(
			'className' => 'Bar',
			'foreignKey' => 'bar_id'
		),
	);

	public function afterFind ($results, $primary) {

        foreach($results as $i => $item){

            foreach (array('Meeting') as $model) {
                if (array_key_exists($model, $item)) {

                    if ($item[$model]['result'] == 1) {
                        $item[$model]['resultText'] = '検討中';
                    } elseif ($item[$model]['result'] == 2) {
                        $item[$model]['resultText'] = '成立';
                    } elseif ($item[$model]['result'] == 3)  {
                        $item[$model]['resultText'] = 'キャンセル';
                    }
                }

                if (array_key_exists($model, $item)) {

                    if ($this->_getCurrentUser() == $item[$model]['user_id']){

                        $item[$model]['date_partner'] = $this->User->find('first',array('conditions' => array('User.id' => $item[$model]['match_user'])));

                    } elseif ($this->_getCurrentUser() == $item[$model]['match_user']) {

                        $item[$model]['date_partner'] = $this->User->find('first',array('conditions' => array('User.id' => $item[$model]['user_id'])));

                    } else {

                        $item[$model]['date_partner'] = $this->User->find('first',array('conditions' => array('User.id' => $item[$model]['match_user'])));

                    }

                }

                if (array_key_exists($model, $item)) {

                    $item[$model]['time'] = date("H時i分", strtotime($item[$model]['time']));
                    $item[$model]['created'] = date("Y年n月j日H時i分", strtotime($item[$model]['created']));
                    $item[$model]['modified'] = date("Y年n月j日H時i分", strtotime($item[$model]['modified']));

                }

                if (array_key_exists($model, $item)) {

                    $item[$model]['date'] = date("Y年n月j日", strtotime($item[$model]['date']));
                    
                }


            }
            $results[$i] = $item;
        }
        return $results;
    }

    public $validate = array(

        'date' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '日付は必ず入力して下さい。'
            ),
        ),

        'time' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '時間は必ず入力して下さい。'
            ),
            array(
                'rule' => array('time','H:i:s'),
                'message' => '◯◯:◯◯の形式で入力して下さい。'
            )
        ),

    );


}
?>