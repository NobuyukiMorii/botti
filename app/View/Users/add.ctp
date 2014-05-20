<div class="col-sm-4 col-sm-offset-8">
<a href="<?php echo $this->Html->url('/bars/admin_register'); ?>"><button class="btn btn-lg btn-default ">あなたの行きつけバーを登録</button></a>
</div>

      <?php echo $this->Form->create
            (
            'User',
            array(
                  'type' => 'file', 
                  'action'=>'add', 
                  'enctype' => 'multipart/form-data',
                  'role' => 'form',
                  'class' => 'form-horizontal text-left'
                  )
            );
      ?>

      <?php echo $this->Form->hidden
            (
            'User.group_id', 
             array(
                  'value'=>'1'
                  )
            );
      ?>

      <h4>①行きつけるお店</h4>
      <h6>誰かがあなたを飲みに誘う時、ここで選択したお店に誘われます。あなたの行きつけのお店がある時は、「あなたの行きつけのバーを登録」ボタンから登録して下さい。</h6>
      <div class ="well">

            <div class="pagination pagination-large" style="margin-top : -20px;">
                <ul class="pagination">
                  <?php
                    echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                    echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                  ?>
                </ul>
            </div>
                                 
              <div class="panel panel-default" style="margin-top : -30px;"><!-- panel panel-default --> 
                <div class="panel-body"><!-- panel-body --> 

            <?php for ($i = 0; $i < count($data); $i++) { ?>


                    <div class="col-sm-6"><!-- col-sm-12 -->

                      <div class="col-sm-4"><!-- col-sm-4 --> 
                         <!-- PartnerImage -->
                        <div class="panel-thumbnail">
                          <img src="<?php echo $this->Html->url("/webroot/files/image/photo_bar/".$data[$i]['Image'][0]['dir']."/thumb250_".$data[$i]['Image'][0]['photo_bar']);?>" class="img-responsive">
                        </div>
                        <?php echo $this->Form->radio('User.bar_id',
                              array(
                                    $data[$i]['Bar']['id'] => "", 
                              ), 
                              array(
                                    'legend' => false,
                                    'id' => "UserBarId"
                              ),
                              array(
                                    'class' => 'form-group',
                                    'required' => false
                              )
                        )
                        ;?>
                        <!-- /PartnerImage -->          
                      </div> <!-- /col-sm-4 --> 
                      <div class="col-sm-8"><!-- col-sm-8 --> 
                            <!-- プロフィール -->
                              <ul class="list-group">
                                <li class="list-group-item">店名：<?php echo h($data[$i]['Bar']['name']); ?></li>
                                <li class="list-group-item">ジャンル：<?php echo h($data[$i]['Bar']['genreText']); ?></li>
                                <li class="list-group-item">料金：平均<?php echo h($data[$i]['Bar']['price']); ?>円</li>
                                <li class="list-group-item">最寄駅：<?php echo h($data[$i]['Bar']['station']); ?></li>
                                <li class="list-group-item">駅から：徒歩<?php echo h($data[$i]['Bar']['walk_time']); ?>分</li>
                              </ul>
                             <!-- /プロフィール -->

                      </div> <!-- /col-sm-8 --> 

                    </div><!-- col-sm-12 -->

            <?php } ?>

                </div><!-- /panel-body -->
              </div><!-- panel panel-default -->
      </div><!-- /デートするお店 --> 


      <h4>②プロフィール</h4>
      <h6>中の人のスキル不足により写真は変更出来ないので、ご注意を。はじめからあなたの１番の写真を登録することを強くお勧めします。</h6>
      <div class ="well">

            <div class="form-group">
                  <label for="Image0Model" class="col-sm-2 control-label">写真</label>
                  <div class="col-sm-10">

                        <?php echo $this->Form->hidden
                              (
                              'Image.0.model', 
                              array(
                                    'value'=>'User'
                                    )
                              );
                        ?>

                        <?php echo $this->Form->input
                              (
                              'Image.0.photo_user',
                              array(
                                    'type' => 'file',
                                    'required' => false,
                                    'label' => false , 
                                    'id' => "Image0Model"
                                    )
                              ); 
                        ?>

                  </div>
            </div>

            <div class="form-group">
                  <label for="UserUsername" class="col-sm-2 control-label">メールアドレス</label>
                  <div class="col-sm-5">
                        <?php echo $this->Form->input
                              (
                              'User.username', 
                                    array(
                                          'class' => 'form-control',
                                          'required' => false,
                                          'label' => false , 
                                          'div' => false,
                                          'placeholder' => "メールアドレスを入力して下さい。",
                                          'id' => "UserUsername",
                                          )
                              );
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="UserPassword" class="col-sm-2 control-label">パスワード</label>
                  <div class="col-sm-5">
                        <?php echo $this->Form->input
                              (
                              'User.password', 
                              array(
                                    'class' => 'form-control',
                                    'required' => false,
                                    'label' => false , 
                                    'div' => false,
                                    'placeholder' => "半角英数字、6文字以上16文字以下で入力して下さい。",
                                    'id' => "UserPassword"
                                    )
                              );
                        ?>
                  </div>
            </div>

                  <div class="form-group form-inline">
                        <label for="UserName" class="col-sm-2 control-label">お名前</label>
                        <div class="col-sm-2">
                              <?php echo $this->Form->input
                                    (
                                    'User.last_name', 
                                    array('class' => 'form-control',
                                          'required' => false,
                                          'label' => false , 
                                          'div' => false,
                                          'placeholder' => "姓",
                                          'id' => "UserName"
                                          )
                                    );
                              ?>
                        </div>

                        <div class="col-sm-3">
                              <?php echo $this->Form->input
                                    (
                                    'User.first_name', 
                                    array('class' => 'form-control',
                                          'required' => false,
                                          'label' => false , 
                                          'div' => false,
                                          'placeholder' => "名",
                                          'id' => "UserName"
                                          )
                                    );
                              ?>
                        </div>
                  </div>

            <div class="form-group">
                  <label for="UserNickname" class="col-sm-2 control-label">ニックネーム</label>
                  <div class="col-sm-5">
                        <?php echo $this->Form->input
                              (
                              'User.nickname', 
                              array('class' => 'form-control',
                                    'required' => false,
                                    'label' => false , 
                                    'div' => false,
                                    'placeholder' => "ニックネームを入力して下さい。",
                                    'id' => "UserNickname"
                                    )
                              );
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="UserTelnumber" class="col-sm-2 control-label">電話番号</label>
                  <div class="col-sm-2">
                        <?php echo $this->Form->input
                              (
                              'User.telnumber', 
                              array('class' => 'form-control',
                                    'required' => false,
                                    'label' => false , 
                                    'div' => false,
                                    'placeholder' => "xxx-xxxx-xxxx",
                                    'id' => "UserTelnumber"
                                    )
                              );
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="User.gender" class="col-sm-2 control-label">性別</label>
                  <div class="col-sm-10">
                        <?php echo $this->Form->radio('User.gender',
                              array(
                                    "1" => '男性', 
                                    "2" => '女性'
                              ), 
                              array(
                                    'legend' => false,
                                    'id' => "User.gender"
                              ),
                              array(
                                    'class' => 'form-group',
                                    'required' => false
                              )
                        )
                        ;?>
                  </div>
            </div>

            <div class="form-group form-inline">
                  <label for="UserBirthday" class="col-sm-2 control-label">生年月日</label>
                  <div class="col-sm-10">
                        <?php echo $this->JpForm->datetime(
                              'User.birthday', 
                              'YMD',
                               null, 
                               array(
                                    'separator' => array('年', '月', '日'), 
                                    'maxYear' => date('YMD', strtotime("-20 year")),
                                    'minYear' => date('YMD', strtotime("-80 year")),
                                    'label' => false,
                                    'default' => date('Y-m-d', strtotime('1988-1-1')),
                                    'empty' => true,
                                    'required' => false,
                                    'class' => 'form-control',
                                    'id' => "UserBirthday"
                                    )
                              ) 
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="UserWork" class="col-sm-2 control-label">ご職業</label>
                  <div class="col-sm-5">
                        <?php echo $this->Form->input
                              (
                              'User.work', 
                              array('class' => 'form-control',
                                    'required' => false,
                                    'label' => false , 
                                    'div' => false,
                                    'placeholder' => "保険会社の営業など",
                                    'id' => "UserWork"
                                    )
                              );
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="Userlike" class="col-sm-2 control-label">好きな食べ物</label>
                  <div class="col-sm-5">
                        <?php echo $this->Form->input
                              (
                              'User.like', 
                              array('class' => 'form-control',
                                    'required' => false,
                                    'label' => false , 
                                    'div' => false,
                                    'placeholder' => "唐揚げ、ステーキなど",
                                    'id' => "Userlike"
                                    )
                              );
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="UserTopic" class="col-sm-2 control-label">話したい話題</label>
                  <div class="col-sm-5">
                        <?php echo $this->Form->input
                              (
                              'User.topic', 
                              array('class' => 'form-control',
                                    'required' => false,
                                    'label' => false , 
                                    'div' => false,
                                    'placeholder' => "恋愛相談、趣味のテニスのこと、会社の愚痴、などなど",
                                    'id' => "UserTopic"
                                    )
                              );
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="UserDrink" class="col-sm-2 control-label">好きなドリンク</label>
                  <div class="col-sm-5">
                        <?php echo $this->Form->input
                              (
                              'User.drink', 
                              array('class' => 'form-control',
                                    'required' => false,
                                    'label' => false , 
                                    'div' => false,
                                    'placeholder' => "ビール、カシオレなど",
                                    'id' => "UserTopic"
                                    )
                              );
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="UserAmount" class="col-sm-2 control-label">飲む量（自称）</label>
                  <div class="col-sm-10">
                        <?php echo $this->Form->input(
                              'User.amount',
                              array(
                                    'type'=>'select',
                                    'options'=>
                                          array(
                                                'すげー飲む'=>'すげー飲む',
                                                'まあまあ飲む'=>'まあまあ飲む',
                                                'ほろ酔い程度に'=>'ほろ酔い程度に',
                                                'ソフトドリンクを・・'=>'ソフトドリンクを・・',
                                          ),
                                    'required' => false,
                                    'label' => false ,
                                    'div' => false,
                                    'id' => "UserAmount"
                                    )
                              ); 
                        ?>
                  </div>
            </div>

            <div class="form-group">
                  <label for="UserMessage" class="col-sm-2 control-label">飲み相手にひとこと</label>
                  <div class="col-sm-5">
                        <?php echo $this->Form->input
                              (
                              'User.message', 
                              array('class' => 'form-control',
                                    'required' => false,
                                    'label' => false ,
                                    'div' => false,
                                    'placeholder' => "50文字以下で入力して下さい。空欄でも大丈夫です。",
                                    'id' => "UserMessage",
                                    'rows' => 2
                                    )
                              );
                        ?>
                  </div>
            </div>

      </div>

      <h4>③ぼっち飲みのタイミング</h4>
      <h6>多分ここに登録したタイミングでぼっち飲みに誘われる確率が高くなります。</h6>
      <div class ="well">

            <div class="form-group">
                  <label for="UserKibouyoubi" class="col-sm-2 control-label">希望曜日</label>
                  <div class="col-sm-10">
                        <?php echo $this->Form->input
                              ('User.kibouyoubi',
                              array('type'=>'select',
                                    'options'=>
                                          array(
                                                '1'=>'月曜日',
                                                '2'=>'火曜日',
                                                '3'=>'水曜日',
                                                '4'=>'木曜日',
                                                '5'=>'金曜日',
                                                '6'=>'土曜日',
                                                '0'=>'日曜日'
                                                ),
                                    'required' => false,
                                    'label' => false ,
                                    'div' => false,
                                    'id' => "UserKibouyoubi"
                                    )
                              )
                        ?>
                  </div>
            </div>

            <div class="form-group form-inline">
                  <label for="UserKibouzikan" class="col-sm-2 control-label">希望待ち合わせ時間</label>
                  <div class="col-sm-10">
                              <?php
                              echo $this->form->input
                              ('User.kibouzikan',
                               array(
                                    'label' => false,
                                    'timeFormat' => '24',
                                    'dateFormat' => 'H:i:s',
                                    'default' => date('19:00'),
                                    'empty' => true,
                                    'interval' => 30,
                                    'class' => 'form-control',
                                    'required' => false,
                                    'id' => "UserKibouzikan"
                                    )
                               );
                              ?>
                  </div>
            </div>

            <div class="form-group form-inline">
                  <label for="UserKibouzikan_finish" class="col-sm-2 control-label">希望終了時間</label>
                  <div class="col-sm-10">
                              <?php
                              echo $this->form->input
                              ('User.kibouzikan_finish',
                               array(
                                    'label' => false,
                                    'timeFormat' => '24',
                                    'dateFormat' => 'H:i:s',
                                    'default' => date('22:00'),
                                    'empty' => true,
                                    'interval' => 30,
                                    'class' => 'form-control',
                                    'required' => false,
                                    'id' => "UserKibouzikan_finish"
                                    )
                               );
                              ?>
                  </div>
            </div>

             <!-- content -->
       </div><!-- /wellデートの希望 -->  
            <div class="form-group">
                  <div class="col-sm-2 col-sm-offset-10">
                        <?php echo $this->Form->submit('ぼっち飲みを始める', array('class' => 'btn btn-primary'));?>
                  </div>
            </div>
      <?php echo $this->Form->end(); ?>







