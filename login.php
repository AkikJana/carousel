    <?php include("header.php") ?>
    <?php require_once("config.php") ?>

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

</head>
 <body class="text-center">
  <?php include("top_nav.php"); ?>
    <form class="form-signin" method="post">
      <?php login(); ?>
      
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      
      <label for="inputNumber" class="sr-only">Email</label>
      <input type="Email" id="inputEmail" name="mail" class="form-control" placeholder="Email" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>