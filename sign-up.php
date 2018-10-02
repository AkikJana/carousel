    <?php include("header.php") ?>
    <?php require_once("config.php") ?>

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>
<?php include("top_nav.php"); ?>
 <body class="text-center">
  
    <form class="form-signin" method="post">
      <?php sign_up(); ?>
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
       <label for="inputName" class="sr-only">UserName</label>
     <input type="text" id="inputName" name="inputName" class="form-control" placeholder="Enter Name" required>
     
      <button class="btn btn-lg mt-2 btn-primary btn-block" name="submit" type="submit">Sign up</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>