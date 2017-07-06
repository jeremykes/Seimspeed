<!DOCTYPE html>
<!-- saved from url=(0039)http://getbootstrap.com/examples/theme/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Car Sale</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/mytheme.min.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://getbootstrap.com/examples/theme/#">Bootstrap theme</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://getbootstrap.com/examples/theme/#">Home</a></li>
            <li><a href="http://getbootstrap.com/examples/theme/#about">About</a></li>
            <li><a href="http://getbootstrap.com/examples/theme/#contact">Contact</a></li>
            <li class="dropdown">
              <a href="http://getbootstrap.com/examples/theme/#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="http://getbootstrap.com/examples/theme/#">Action</a></li>
                <li><a href="http://getbootstrap.com/examples/theme/#">Another action</a></li>
                <li><a href="http://getbootstrap.com/examples/theme/#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="http://getbootstrap.com/examples/theme/#">Separated link</a></li>
                <li><a href="http://getbootstrap.com/examples/theme/#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase col-md-offset-3 col-md-6" role="main" style="padding-top:100px">

        <div class="panel">
          <div class="panel-body">
            <div class="col-md-3" id="carimage">
              <img class="img-responsive" src="imgs/mycar.png"></img>
            </div>
            <div class="col-md-9">

                <!-- Options dropdown -->
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                      <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          Options <span class="caret"></span>
                      </span>
                      <ul class="dropdown-menu" role="menu">
                          <li><a href="#"><i class="fa fa-btn fa-edit"></i> Edit</a></li>
                      </ul>
                  </li>
                </ul>

                <p><span style="text-decoration:bold;font-size:14px;color:gray"><span id="carmake">Toyota</span>, White, 4-wheel drive</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">sale</label>&nbsp;<span style="font-size:20px">K10,000</span></p>
                <p>Plates: Ivory. Location: Martinique Sequi unde doloribus voluptas consequatur. Possimus adipisci in labore.</p>
                <p>In group <a href="#"><span class="label label-primary">go to group</span></a> </p>
                <p>
                  <a style="cursor:pointer"><span style="color:gray;font-size:11px"><span>5</span>  <i class="fa fa-comment-o"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a style="cursor:pointer"><span style="color:gray;font-size:11px"><span>20</span>  <i class="fa fa-money"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a style="cursor:pointer"><span style="color:gray;font-size:11px"><span>6</span>  <i class="fa fa-eye"></i></span></a>
                </p>
            </div>
            <div class="col-md-12">
              <p style="text-align:center"><span style="cursor:pointer" onclick="$('#moreinfo').toggle()"><i class="fa fa-angle-double-down"></i></span></p>
              <div style="display:none;" id="moreinfo">
                <h1>Hi hello!</h1>
              </div>
            </div>
          </div>
        </div>

    </div> <!-- /container -->


    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  

    <svg xmlns="http://www.w3.org/2000/svg" width="1140" height="500" viewBox="0 0 1140 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;">
      <defs>
      <style type="text/css"></style>
      </defs>
      <text x="0" y="57" style="font-weight:bold;font-size:57pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thirdslide</text>
    </svg>

  </body>

</html>





