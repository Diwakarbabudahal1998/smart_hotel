<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font-awsome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- custom css -->
    {{-- <link rel="stylesheet" href="myApp.css"> --}}
    <link rel="stylesheet" href="{{ URL::asset('css/landing.css') }}">
    <title>Smart Hotel</title>
  </head>

  <body data-spy="scroll" data-offset="150" data-target="#mainNav">

    <!-- header -->
    <header id="home">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container">
                <!-- brand -->
                    <a class="navbar-brand" href="#mainNav" id="logoBrand"><span><i class="fab fa-buromobelexperte"></i></span> Smart Hotel</a>
                <!-- toggler button -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                
                <!-- collapse -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- menu -->
                    <ul class="navbar-nav mr-auto pt-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#download">Download the App</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                    <!-- /menu -->

                    <!-- login -->
                    {{-- <form class="form-inline my-2 my-lg-0 pt-2">
                        <input class="form-control mr-sm-2" type="email" placeholder="email" aria-label="email">
                        <input class="form-control mr-sm-2" type="password" placeholder="password" aria-label="password">
                        <button class="btn btn-outline-primary btn-sm my-2 my-sm-0" type="submit">Login</button>
                    </form> --}}
                    <!-- /login -->
                </div>
                <!-- /collapse -->
            </div>
        </nav>
        <!-- /navbar -->
            
        <!-- jumbotron -->
        <div class="jumbotron text-center mt-5" id="mainHeader">
            <div class="container">
                <!-- title -->
                <h1 class="display-3">Smart Hotel</h1>
                <!-- subtitle -->
                <p class="lead">This is a hotel booking Application which provide you </p>
                <p class="lead"> most provinient way to keep your hotel booking record.</p>
                
                <hr class="my-4">
                <p>Want to know more? Contact us.</p>

                <!-- cta -->
                {{-- <div class="container">
                    <form class="form-inline justify-content-center">
                        <label class="sr-only" for="inlineFormInputGroupUsername2">Your Email</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Your Email">
                            </div>
                                <button type="submit" class="btn btn-primary mb-2">Subscribe</button>
                    </form>
                </div> --}}
            </div>
        </div>
        <!-- /jumbotron -->

    </header>
    <!-- /header -->


<!-- main -->
    <section id="about" class="p-5">
        <div class="container text-center">
        
        <!-- about -->
            <!-- title -->
            <div class="pb-5">
                <h3 class="display-4">Why this Software is so awsome</h3>
                <p>This is why this app is so awsome, you'll never need another one!</p>
            </div>
            <!-- cards -->
            <div class="row justify-content-center">
                <!-- card 1 -->
                <div class="col-lg-4">
                        <div class="card" >
                                <img src="https://images.unsplash.com/photo-1464986411762-a4275fbaf3f0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title"><span><i class="fas fa-mobile"></i></span><br>Hotel Booking</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                              </div>
                </div>
                <!-- card 2 -->
                <div class="col-lg-4">
                    <div class="card" >
                                <img src="https://images.unsplash.com/photo-1493500146995-7167488df174?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=755&q=80" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title"><span><i class="fas fa-mobile-alt"></i></span><br>Customer Record</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                              </div>
                </div>
                <!-- card 3 -->
                <div class="col-lg-4">
                    <div class="card" >
                                <img src="https://images.unsplash.com/photo-1522125670776-3c7abb882bc2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title"><span><i class="fas fa-sms"></i></span><br>Hotel Management</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                              </div>
                </div>
            </div>

        </div>


    </section>
<!-- /main -->


<!-- download -->
    <section id="download">
            <div class="jumbotron jumbotron-fluid mb-0">
                <div class="container text-center">
                    <h4 class="display-4">Get the App</h4>
                    <p class="lead">Download Smart Hotel App for iPhone or Android</p>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <!-- ipod -->
                            <button href="#"  class="downloadBtn">
                                <div class="row">
                                    <div class="col-3">
                                        <p class="appLogo"><i class="fab fa-apple"></i></p>
                                    </div>
                                    <div class="col-9">
                                        <p>Available on the<br>
                                        <span class="store">App Store</span></p>
                                    </div>
                                </div>
                            </button>
                        <!-- android -->
                            <button href="#" class="downloadBtn">
                                <div class="row">
                                    <div class="col-3">
                                        <p class="appLogo"><i class="fab fa-google-play"></i></p>
                                    </div>
                                    <div class="col-9">
                                        <p>Download from<br>
                                        <span class="store">Google Play</span></p>
                                    </div>
                                </div>
                            </button>

                    </div>
                </div>

                

            </div>
    </section>
<!-- /download -->

<!-- footer -->
    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 pr-3 pl-3">
                    <h5>Contact Us</h5>
                    <p>Nefotech Private Limited</p>
                    <p>Pulchpk, Lalitpur Nepal</p>
                   <p><i class="fa fa-phone"></i> +977980-1306-051</p>
                   <p><i class="fa fa-envelope"></i> office@nfotech.com</p>

                </div>
                {{-- <div class="col-sm-4 pr-3 pl-3">
                    <h5>Privacy Settings</h5>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat molestiae numquam illum esse reiciendis cupiditate hic rerum, et unde. Voluptates rerum explicabo deleniti eos hic incidunt saepe tempore repellat dicta!</p>
                </div> --}}
                <div class="col-sm-4 pr-3 pl-3">
                    <h5>Follow us</h5>
                    <p>Follow us to get more information about the conmpany and products. </p>
                    <ul class="social">
                        <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="container text-center">
                <p class="small">©2021, @Nefotech Copyrights reserved</p>
            </div>
        </div>
    </footer>
<!-- /footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ URL::asset('js/landing.js') }}"></script>
  </body>
</html>