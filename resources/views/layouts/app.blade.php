<!DOCTYPE html>
<html lang="en" ng-app="OrderApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Datia - Ordersystem</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/theme.min.css">
    <link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!-- <link href="/vendor/backgrid/src/backgrid.css" rel="stylesheet" />
    <link href="/vendor/backgrid-select-all/backgrid-select-all.min.css" rel="stylesheet" />
    <link href="/vendor/backgrid-filter/backgrid-filter.min.css" rel="stylesheet" />
    <link href="/vendor/backgrid-paginator/backgrid-paginator.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <link href="/css/style.css" rel="stylesheet" />


    <link rel="icon"type="image/png"href="/img/punkter.png" />
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
         chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
         https://code.google.com/p/chromium/issues/detail?id=332189
         */
    </script>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="/">
                    <img src="/img/datia.png" style="max-width:100px"/>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (!Auth::guest())
                <ul class="nav navbar-nav">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-btn fa-file-text"></i> Order <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/home">Kö</a></li>
                            <li><a href="/calendar">Kalender</a></li>
                            <li><a href="/order/create"><i class="fa fa-btn fa-plus"></i> Skapa order</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                           <i class="fa fa-btn fa-tag"></i> Artikel <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/article">Lista</a></li>
                            <li><a href="/article/create"><i class="fa fa-btn fa-plus"></i> Skapa artikel</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                           <i class="fa fa-btn fa-user"></i> Kund <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/customer">Lista</a></li>
                            <li><a href="/customer/create"><i class="fa fa-btn fa-plus"></i> Skapa kund</a></li>
                        </ul>
                    </li>
                    <li><a href="/archive"><i class="fa fa-btn fa-archive"></i> Arkiv</a></li>
                </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="/login">Logga in</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if ( Auth::user()->isAdmin())
                                <li><a href="/admin/create_user"><i class="fa fa-btn fa-user-plus"></i> Skapa användare</a></li>
                                @endif
                                <li><a href="/logout"><i class="fa fa-btn fa-sign-out"></i> Logga ut</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="/vendor/jquery/dist/jquery.min.js"></script>

    <script src="/vendor/angular/angular.min.js"></script>
    <script src="/vendor/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="/vendor/ngstorage/ngStorage.min.js"></script>
    <script src="/vendor/angular-resource/angular-resource.min.js"></script>
    <script src="/vendor/angular-ui-utils/event.min.js"></script>
    <script src="/vendor/angular-animate/angular-animate.min.js"></script>
    <script src="/vendor/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
    <script src='/vendor/bootstrap-select/dist/js/bootstrap-select.min.js'></script>

    <!-- Loading bar -->
    <script src="/vendor/angular-loading-bar/build/loading-bar.min.js"></script>

    <!-- page specific angular libs. may be removed -->
    <script src="/vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="/vendor/angular-datatables/dist/angular-datatables.min.js"></script>
    <script src="/vendor/angular-datatables/dist/plugins/bootstrap/angular-datatables.bootstrap.min.js"></script>

    <!-- <script src="vendor/angular-ui-calendar/src/calendar.js"></script> -->

    <!-- common libs. previous bootstrap-sass version was used, but due to a need to have single compiled file using bootstrap's version -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="/vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/vendor/widgster/widgster.js"></script>
    <!-- <script data-pace-options='{ "target": ".content-wrap", "ghostTime": 1000 }' src="/vendor/pace.js/pace.min.js"></script>-->
    <script src="/vendor/jquery-touchswipe/jquery.touchSwipe.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script src="/js/parsley.min.js"></script>
    <script src="/js/parsley-sv.js"></script>
    <!--  -->
    <script src="/js/app.js" type="text/javascript"></script>

    @yield('script')
</body>
</html>
