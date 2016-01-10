<!DOCTYPE html>
<html lang="en" ng-app="OrderApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Autoexperten - Ordersystem</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
   
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/theme-two.min.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="/vendor/fullcalendar/fullcalendar.css"/>
    <link rel="stylesheet" href="/css/select2.min.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="/css/style.css"  />

    <link rel="icon"type="image/png" href="/images/favicon.png" />
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
                    <img src="/images/logo.png" style="max-width:100px"/>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (!Auth::guest())
                <ul class="nav navbar-nav">

                    <li class="{{ Request::is('calendar*') ? 'active' : '' }}">
                        <a href="/calendar"><i class="fa fa-btn fa-calendar"></i> Kalender</a>
                    </li>
                    <li class="{{ Request::is('order/create') ? 'active' : '' }}">
                        <a href="/order/create"><i class="fa fa-btn fa-file-text"></i> Skapa order</a>
                    </li>
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-btn fa-file-text"></i> Order <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/home">Kö</a></li>
                            <li><a href="/calendar">Kalender</a></li>
                            <li><a href="/order/create"><i class="fa fa-btn fa-plus"></i> Skapa order</a></li>
                        </ul>
                    </li> -->
                    
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                           <i class="fa fa-btn fa-tag"></i> Artikel <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/article">Lista</a></li>
                            <li><a href="/article/create"><i class="fa fa-btn fa-plus"></i> Skapa artikel</a></li>
                        </ul>
                    </li> -->

                    <li class="dropdown {{ Request::is('customer*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                           <i class="fa fa-btn fa-user"></i> Kund <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/customer">Lista</a></li>
                            <li><a href="/customer/create"><i class="fa fa-btn fa-plus"></i> Skapa kund</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('archive') ? 'active' : '' }}">
                        <a href="/archive"><i class="fa fa-btn fa-archive"></i> Arkiv</a>
                    </li>
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

    <!-- Bootstrap & jQuery -->
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src="/js/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="/vendor/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="/vendor/moment/locale/sv.js"></script>
    <script type="text/javascript" src="/vendor/bootstrap/js/transition.js"></script>
    <script type="text/javascript" src="/vendor/bootstrap/js/collapse.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>

    <script src="/js/select2.min.js"></script>

    <script src="/vendor/angular/angular.min.js"></script>
    <script src="/vendor/angular-resource/angular-resource.min.js"></script>
    <script src="/vendor/angular-animate/angular-animate.min.js"></script>

    <script src="/js/jquery.dataTables.js"></script>
    <script src="/js/angular-datatables.min.js"></script>
    <script src="/js/angular-datatables.bootstrap.min.js"></script>
    <script src="/vendor/fullcalendar/fullcalendar.min.js"></script>

    <script src="/js/parsley.min.js"></script>
    <script src="/js/parsley-sv.js"></script>

    <script src="/js/app.js" type="text/javascript"></script>
    @yield('script')
</body>
</html>
