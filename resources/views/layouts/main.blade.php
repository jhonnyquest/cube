<?php
/**
 * Created by PhpStorm.
 * User: jhonnyquest
 * Date: 21/12/17
 * Time: 12:26 PM
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cube test</title>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

        <!-- Bootstrap CSS File -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Libraries CSS Files -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

        <!-- Main Stylesheet File -->
        <link href="css/style.css" rel="stylesheet">

    </head>
    <body>
        <!--==========================
        Header Section
        ============================-->
        <header id="header">
            <div class="container">

                <div id="logo" class="pull-left">
                    <a href="#hero"><img src="img/logo.gif" alt="" title="" /></img></a>
                    <!-- Uncomment below if you prefer to use a text image -->
                    <!--<h1><a href="#hero">Header 1</a></h1>-->
                </div>
            </div>
        </header>
        <!-- #header -->

        <!--==========================
        Main Section
        ============================-->
        <div class="container" id="main">
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- #main -->

        <!--==========================
        Footer
        ============================-->
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            &copy; Copyright <strong>Jhonny Muñoz</strong>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- #footer -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.14/vue.min.js"></script>
        <script src="js/app.js"></script>
        <!-- Required JavaScript Libraries -->
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="lib/superfish/hoverIntent.js"></script>
        <script src="lib/superfish/superfish.min.js"></script>
        <script src="lib/morphext/morphext.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/stickyjs/sticky.js"></script>
        <script src="lib/easing/easing.js"></script>

        <!-- Template Specisifc Custom Javascript File -->
        <script src="js/custom.js"></script>

        <script src="contactform/contactform.js"></script>
    </body>
</html>