<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bootply.com - 62603</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?=$this->Html->css('bootstrap.css')?>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
    <?=$this->Html->css('styles.css')?>
	</head>
	<body>

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item active">
      <img src="../img/glasses.jpg" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1>Bootstrap 3 Carousel Layout</h1>
          <pthis is="" an="" example="" layout="" with="" carousel="" that="" uses="" the="" bootstrap="" 3="" styles.<="" small=""><p></p>
          <p><a class="btn btn-lg btn-primary" href="<?php echo $this->Html->url('/users/login'); ?>">ログイン</a>
        </p></pthis></div>
      </div>
    </div>
    <div class="item">
      <img src="../img/beer.jpg" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1>Changes to the Grid</h1>
          <p>Bootstrap 3 still features a 12-column grid, but many of the CSS class names have completely changed.</p>
          <p><a class="btn btn-large btn-primary" href="<?php echo $this->Html->url('/users/login'); ?>">ログイン</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="../img/glass.jpg" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1>Percentage-based sizing</h1>
          <p>With "mobile-first" there is now only one percentage-based grid.</p>
          <p><a class="btn btn-large btn-primary" href="<?php echo $this->Html->url('/users/login'); ?>">ログイン</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- Controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="icon-prev"></span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="icon-next"></span>
  </a>  
</div>
<!-- /.carousel -->


<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

  <!-- Three columns of text below the carousel -->
  <div class="row">
    <div class="col-md-4 text-center">
      <img class="img-circle" src="http://placehold.it/140x140">
      <h2>Mobile-first</h2>
      <p>Tablets, phones, laptops. The new 3 promises to be mobile friendly from the start.</p>
      <p><a class="btn btn-default" href="#">View details »</a></p>
    </div>
    <div class="col-md-4 text-center">
      <img class="img-circle" src="http://placehold.it/140x140">
      <h2>One Fluid Grid</h2>
      <p>There is now just one percentage-based grid for Bootstrap 3. Customize for fixed widths.</p>
      <p><a class="btn btn-default" href="#">View details »</a></p>
    </div>
    <div class="col-md-4 text-center">
      <img class="img-circle" src="http://placehold.it/140x140">
      <h2>LESS is More</h2>
      <p>Improved support for mixins make the new Bootstrap 3 easier to customize.</p>
      <p><a class="btn btn-default" href="#">View details »</a></p>
    </div>
  </div><!-- /.row -->


  <!-- START THE FEATURETTES -->

  <hr class="featurette-divider">

  <div class="featurette">
    <img class="featurette-image img-circle pull-right" src="http://placehold.it/512">
    <h2 class="featurette-heading">Responsive Design. <span class="text-muted">It'll blow your mind.</span></h2>
    <p class="lead">In simple terms, a responsive web design figures out what resolution of device it's being served on. Flexible grids then size correctly to fit the screen.</p>
  </div>

  <hr class="featurette-divider">

  <div class="featurette">
    <img class="featurette-image img-circle pull-left" src="http://placehold.it/512">
    <h2 class="featurette-heading">Smaller Footprint. <span class="text-muted">Lightweight.</span></h2>
    <p class="lead">The new Bootstrap 3 promises to be a smaller build. The separate Bootstrap base and responsive.css files have now been merged into one. There is no more fixed grid, only fluid.</p>
  </div>

  <hr class="featurette-divider">

  <div class="featurette">
    <img class="featurette-image img-circle pull-right" src="http://placehold.it/512">
    <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Flatness.</span></h2>
    <p class="lead">A big design trend for 2013 is "flat" design. Gone are the days of excessive gradients and shadows. Designers are producing cleaner flat designs, and Bootstrap 3 takes advantage of this minimalist trend.</p>
  </div>

  <hr class="featurette-divider">

  <!-- /END THE FEATURETTES -->


  <!-- FOOTER -->
  <footer>
    <p class="pull-right"><a href="#">Back to top</a></p>
    <p>This Bootstrap layout is compliments of Bootply. · <a href="http://www.bootply.com/62603">Edit on Bootply.com</a></p>
  </footer>

</div><!-- /.container -->
	<!-- script references -->
		<?=$this->Html->script('jquery-1.10.2.js')?>
		<?=$this->Html->script('bootstrap.js')?>
		<?=$this->Html->script('scripts.js')?>

	</body>
</html>