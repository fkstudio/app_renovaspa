<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> @yield("title") | Renovaspa</title>

    <!-- App -->
    <link href="{{ URL::to('/') }}/css/app.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ URL::to('/') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font awesome -->
    <link href="{{ URL::to('/') }}/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap submenu -->
    <link href="{{ URL::to('/') }}/css/bootstrap-submenu.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield("head")
  </head>
  <body>
	
	@include("shared._navbar")    

	@yield("content")

	@include("shared._footer")

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ URL::to('/') }}/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>

    <!-- Bootstrap submenu js -->
    <script src="{{ URL::to('/') }}/js/bootstrap-submenu.min.js"></script>

    <script>
      $(document).ready(function(){
        $('.dropdown-submenu .dropdown-action').hover(function(e){
            var input = $(this);
            
            if(!input.hasClass('dropdown-no-action'))
                $('.dropdown-hide').css('display', 'none');
            else
                $('.sub-sub-menu').css('display', 'none');

  
            input.next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();  
          
        });

        $(".open-message").fadeTo(2000, 500).slideUp(500, function(){
            $(".open-message").slideUp(500);
        });

        $(document).ready(function(){
            $('[data-toggle="popover"]').popover(); 
        });
      });
    </script>

    @yield("scripts")
  </body>
</html>