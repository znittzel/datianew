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
    <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="/vendor/angular-loading-bar/build/loading-bar.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!-- <link href="/vendor/backgrid/src/backgrid.css" rel="stylesheet" />
    <link href="/vendor/backgrid-select-all/backgrid-select-all.min.css" rel="stylesheet" />
    <link href="/vendor/backgrid-filter/backgrid-filter.min.css" rel="stylesheet" />
    <link href="/vendor/backgrid-paginator/backgrid-paginator.min.css" rel="stylesheet" /> -->
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
                    <!-- <li class="dropdown {{{ (Request::is('home') ? 'active' : Request::is('order/*/*') ? 'active' : '') }}}">
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/home">Order</a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Order <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/home"><i class="fa fa-btn fa-cubes"></i>Aktiva</a></li>
                            <li><a href="/order/create"><i class="fa fa-btn fa-plus"></i>Skapa order</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Kund <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/customer"><i class="fa fa-btn fa-users"></i>Alla</a></li>
                            <li><a href="/customer/create"><i class="fa fa-btn fa-plus"></i>Skapa kund</a></li>
                        </ul>
                    </li>
                    <li><a href="/archive">Arkiv</a></li>
                </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="/login">Logga in</a></li>
                        <li><a href="/register">Registrera</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/logout"><i class="fa fa-btn fa-sign-out"></i>Logga ut</a></li>
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
    <!--
    <script src="/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="/vendor/angular-bootstrap-select/build/angular-bootstrap-select.min.js"></script>
    <script src="/vendor/angular-confirm-modal/angular-confirm.min.js"></script>
    <script src="/vendor/angular-master/src/js/core.js"></script>
    <script src="/vendor/angular-master/scalyr.js"></script>
    <script src="/vendor/angular-master/src/js/directives/slyEvaluate.js"></script>
    <script src="/vendor/angular-master/src/js/directives/slyRepeat.js"></script>

    <script src='vendor/underscore/underscore-min.js'></script>
    <script src='vendor/backbone/backbone.js'></script>
    <script src='vendor/backbone.paginator/lib/backbone.paginator.min.js'></script>
    <script src='vendor/backgrid/lib/backgrid.js'></script>
    <script src='vendor/backgrid-paginator/backgrid-paginator.js'></script>
    <script src='vendor/backgrid-select-all/backgrid-select-all.min.js'></script>
    <script src='vendor/backgrid-filter/backgrid-filter.min.js'></script>-->
    <script src='vendor/bootstrap-select/dist/js/bootstrap-select.min.js'></script>

    <!-- Loading bar -->
    <script src="/vendor/angular-loading-bar/build/loading-bar.min.js"></script>

    <!-- page specific angular libs. may be removed -->
    <script src="/vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="/vendor/angular-datatables/dist/angular-datatables.min.js"></script>
    <script src="/vendor/angular-datatables/dist/plugins/bootstrap/angular-datatables.bootstrap.min.js"></script>

    <!-- <script src="vendor/angular-ui-calendar/src/calendar.js"></script> -->

    <!-- common libs. previous bootstrap-sass version was used, but due to a need to have single compiled file using bootstrap's version -->
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/vendor/widgster/widgster.js"></script>
    <!-- <script data-pace-options='{ "target": ".content-wrap", "ghostTime": 1000 }' src="/vendor/pace.js/pace.min.js"></script>-->
    <script src="/vendor/jquery-touchswipe/jquery.touchSwipe.min.js"></script>
    <script src="/vendor/bpopup/jquery.bpopup.min.js"></script>

    <script src="/js/parsley.min.js"></script>
    <script src="/js/parsley-sv.js"></script>
    <!--  -->
    <script src="/js/app.js" type="text/javascript"></script>

    @yield('script')
</body>
</html>
