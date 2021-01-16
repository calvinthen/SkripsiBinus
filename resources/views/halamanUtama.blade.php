<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- TITLE -->
  <title>Playmaker</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- fonts -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/css_halaman_utama/custom.css" rel="stylesheet">
  <link href="css/css_halaman_utama/custom.scss" rel="stylesheet">
  <link href="css/css_halaman_utama/login.css" rel="stylesheet">

  <!-- AOS INITIALIZE -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
</head>

<body>
  <!-- NAVIGATION BAR -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">
        <!-- INPUT LOGO HERE -->
        <img class ="rounded mx-auto d-block" src="images/asset/logo.png" alt="" height="35px">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Log In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- BACK TO TOP BUTTON -->
  <button onclick="topFunction()" class="btn btn-backTop" id="backTopBtn" title="Go to top">Top</button>

  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <div class="row">
          <div class="container">
            <h1 class="masthead-heading mb-0">
              <!-- INPUT LOGO HERE, BUAT DI HEADER-->
            </h1>
            <h2 class="masthead-subheading mb-0">
               PLAYMAKER
            </h2>
            <h4>
              Your gaming friends finding platform
            </h4>
            <a href="#sect1" class="btn btn-primary btn-xl rounded-pill mt-5">
              Learn More
            </a>
          </div>
        </div>
      </div>
      <br>
      <!-- GARIS PUTIH DI HEADER -->
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
          <div class="line"></div>
        </div>
        <div class="col-sm-1"></div>
      </div>

      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
          <!-- REGISTER -->
          <a href="{{ route('register') }}" class="btn btn-customWhite btn-xl rounded-pill mt-5">
            Sign Up
          </a>
        </div>
        <div class="col-sm-3">
          <!-- LOGIN -->
          <a href="{{ route('login') }}" class="btn btn-customBlack btn-xl rounded-pill mt-5">
            Login
          </a>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </div>
  </header>

  <section id="sect1" style="background: #222831; color: #eeeeee">
    <div class="container" data-aos="fade-left">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="rounded mx-auto d-block" src="images/asset/add-friend.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Find your friends</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="sect2" style="background: #eeeeee; color: #222831">
    <div class="container" data-aos="fade-right">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="p-5">
            <img class="rounded mx-auto d-block" src="images/asset/users-group.png" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">Join a team or Create One!</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section id="sect3" style="background: #222831; color: #eeeeee">
    <div class="container" data-aos="fade-left">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="rounded mx-auto d-block" src="images/asset/trophy.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Climb up the rank!</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; Playmaker 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript / ABAIKAN KALO UDAH PAKE JS BOOTSTRAP-->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- SCRIPT AOS -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      offset: 250,
      duration: 1000,
    })
  </script>

  <!-- SCRIPT BACK TO TOP BUTTON -->
  <script>
    //Get the button
    var mybutton = document.getElementById("backTopBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>
</body>

</html>
