
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Connexion · Gretagram</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js" crossorigin="anonymous"></script>
    <link rel="import" href="'scripts/headscripts.html'"/>


    <meta name="theme-color" content="#563d7c">

    <!--sweatalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <!-- Custom styles for this template -->
    <link href="css/sign.css" rel="stylesheet">


    </head>
  <!-- sign-in form style -->
  <body>

    <form method="POST" class="form-signin">
      <div class="text-center mb-4">
        <img class="mb-4 rounded-circle" src="assets/img/logo/homeicon.jpg" alt="" width="90" height="90">
        <h1 class="h3 mb-3 font-weight-bold">Log in to Gretagram</h1>
        <p class="text-center">When you start to act, <l class="text-success">hope</l> is everywhere.</p>
      </div>

      <div class="form-label-group">
        <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputUsername">Username</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <div class="custom-control custom-checkbox mb-4">
        <input type="checkbox" class="custom-control-input" id="customCheck1">
        <label class="custom-control-label" for="customCheck1">Remeber me</label>
      </div>
      <button id="login" name="login" class="btn btn-lg btn-info btn-block rounded-pill" type="button">Log in</button>
      <p class="mt-4 mb-3 text-decoration-none text-center"><a href="#" id="inscription">Join us</a></p>

  </form>

    <div class="modal">
      <div class="card text-center">
        <div class="card-header bg-transparent ">
          <div class="close">×</div>
          <img height="45" src="assets/img/logo/earthPin.png">
        </div>
        <div class="card-body m-4">
          <h5 class="card-title">Create your account </h5>

            <form method="POST" class="form-signin text-left p-5 " id="signupForm">

            <div class="form-label-group">
              <input type="text" class="form-control" name="username" id="username" placeholder=" " required autofocus>
              <label for="inputText">Username</label>
            </div>

            <div class="form-label-group">
              <input type="text" class="form-control" name="fullname" id="fullname" placeholder=" " required>

              <label for="inputText">Full name</label>
            </div>

            <div class="form-label-group">
              <input type="password" name ="password" id="password" class="form-control" placeholder="" required>
              <label for="inputPassword">Password</label>
            </div>

          <div class="row justify-content-center p-4  m-3">
            <button type="button" id="register" name="register" value="Sign-up" class="btn rounded-pill btn-info">Sing-up</button>
          </div>
          </form>

        </div>
      </div>
    </div>



  <script type="text/javascript" src='js/sign.js'></script>
  <!-- login script -->
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
  <script src="js/cookies.js"></script>
  <script type="text/javascript">

  $(function(){
    $("#login").click(function() {
      var username = $("#inputUsername").val();
      var password = $("#inputPassword").val();

      var myCookies ={};

      function saveCookies(){
        myCookies[username]='connected';
        document.cookie="";
        var expireAttribute = new Date(Date.now()+60*500).toString();
        console.log(expireAttribute);
        cookieString = (username+"="+username+"; expires="+expireAttribute) ;
        document.cookie=cookieString;
        }


      if(username =='' || password ==''){
        console.log('empty value')
      }
      else {
        $.ajax({
          type:'POST',
          url:'php/login.php',
          data: {username : username, password : password},
          success: function(data){
            if (data != 1) {
              Swal.fire({
                 'icon': 'error' ,
                 'title': 'Login failed !',
                 'text': data +'Unkown username or wrong password'
              })
            }
              else {
              saveCookies();
                location.href = "index2.html";
                var cookies = document.cookie.split(';').map(cookie => cookie.split('='))
                console.log(cookies);
            }
          },
          error: function(data){
            console.log('c pa bon ça woula')
          }
        })
      }
    })
  })
  </script>

  <!-- registering script-->
  <script type="text/javascript">

  $(function () {
    $("#register").click(function() {

          var username = $('#username').val();
          var fullname = $('#fullname').val();
          var password = $('#password').val();

          if(username == "" || fullname =="" || password =="") {
            console.log('empty');
          }
          else {
            $.ajax({
              type :'POST',
              url:'php/register.php',
              data: { username: username, fullname : fullname, password : password },
              success: function(data){
                if (data == 1) {
                Swal.fire({
                   'icon': 'success' ,
                   'title': 'Thank you !',
                   'text': 'Your account has been successfully created !'
                 })
                 modal.classList.remove('modal-active');
               } else {
                 Swal.fire({
                    'icon': 'error' ,
                    'title': 'Register failed !',
                    'text': 'This username is already used, please take an other one...'
                  })

               }
             },
            })

          }
    })
  });

  </script>
</body>
</html>
