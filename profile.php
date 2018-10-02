<?php include("header.php"); ?>
<?php require_once("config.php"); ?>
    
  </head>
  <body>
    <?php include("top_nav.php"); ?>
    <br>
    <br>
    <div class="mt-5 mx-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">RESUME</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">APPLICATIONS</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">PREFERENCES</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><ul class="list-group">
  <li class="list-group-item"><h1><?php echo $_SESSION['username']; ?></h1></li>
  <li class="list-group-item"><h3><?php echo $_SESSION['mail']; ?></h3></li>
  <li class="list-group-item"><h4>Education:<?php usereducation();?></h4></li>
</ul></div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
   <h3> <?php sum(); ?></h3>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
</div>
<?php include("footer.php"); ?>
  </body>
</html>