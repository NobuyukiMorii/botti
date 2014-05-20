<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bootply.com - 101498</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?=$this->Html->css('bootstrap.css')?>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h1 class="text-center">ログイン</h1>
      </div>
      <div class="modal-body">






          <form action="/botti/users/login" id="UserLoginForm" method="post" class="form-signin" accept-charset="utf-8" role="form">

            <h2 class="form-signin-heading">Sign Up</h2>
            <?php echo $this->Session->flash('success'); ?>
            <?php echo $this->Session->flash('fail'); ?>
            <?php echo $this->Session->flash('auth'); ?>
            <input name="data[User][username]" id="UserUsername" type="email" class="form-control" placeholder="Email address" required autofocus>
            <input name="data[User][password]" id="UserPassword" type="password" class="form-control" placeholder="Password" required>
            <label class="checkbox">
              <input name="data[User][keep_me_logged_in]" type="checkbox" value="keep_me_logged_in"> ログインしたままにする
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">ぼっちとしてログイン</button>
          </form>









      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
    <?=$this->Html->script('jquery-1.10.2.js')?>
    <?=$this->Html->script('bootstrap.js')?>
    <?=$this->Html->script('scripts.js')?>
	</body>
</html>