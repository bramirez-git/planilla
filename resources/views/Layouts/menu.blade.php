<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />
    @yield('head')

    <title>App Planilla Profesional</title>
    <!-- AQUI SE INCLUYEN TODOS LOS CSS-->
    @include('common.global_styles')
    @stack('headers')
</head>

<body>
<input type="hidden" id="data-ruta-imagen-cargando" data-ruta-imagen-cargando="{{asset('img/339_loader.gif')}}">
<div class="body-container">
    <nav class="navbar navbar-expand-lg navbar-fixed navbar-blue">
        <div class="navbar-inner">

            <div class="navbar-intro justify-content-xl-between">

                <button type="button" class="btn btn-burger burger-arrowed static collapsed ml-2 d-flex d-xl-none" data-toggle-mobile="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                    <span class="bars"></span>
                </button><!-- mobile sidebar toggler button -->


                <a class="navbar-brand text-white text-center" href="#">
                    <!--<i class="fa fa-leaf"></i> -->
                    <span class="text-85">Planilla Profesional</span>
                </a><!-- /.navbar-brand -->

                <button type="button" class="btn btn-burger mr-2 d-none d-xl-flex" data-toggle="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
                    <span class="bars"></span>
                </button>

            </div><!-- /.navbar-intro -->


            <div class="navbar-content">

                <button class="navbar-toggler py-2" type="button" data-toggle="collapse" data-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle navbar search">
                    <i class="fa fa-search text-white text-90 py-1"></i>
                </button><!-- mobile #navbarSearch toggler -->

                <div class="collapse navbar-collapse navbar-backdrop" id="navbarSearch">
                    <div class="d-flex align-items-center ml-lg-4 py-1">
                        <i class="fa fa-search text-white d-none d-lg-block pos-rel"></i>
                        <input type="text" class="navbar-input mx-3 flex-grow-1 mx-md-auto pr-1 pl-lg-4 ml-lg-n3 py-2 autofocus" placeholder="SEARCH ..." aria-label="Search" />
                    </div>
                </div>

            </div><!-- .navbar-content -->

            <!-- mobile #navbarMenu toggler button -->
            <button class="navbar-toggler ml-1 mr-2 px-1" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navbar menu">
            <span class="pos-rel">
                   @if(session()->get('foto_user_existe'))
                    <img class="border-2 brc-white-tp1 radius-round" width="36" src="{{ route('image.show', ['dir_group' =>'usuarios' ,'filename' => session()->get('foto_user_name')]) }}">
                @else
                    <img class="border-2 brc-white-tp1 radius-round" width="36" src="{{ asset('estilos/assets/image/avatar/default-usuario.png') }}">
                @endif
                  <span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-n1px mt-n1px"></span>
            </span>
            </button>


            <div class="navbar-menu collapse navbar-collapse navbar-backdrop" id="navbarMenu">

                <div class="navbar-nav">
                    <ul class="nav">

                        <li class="nav-item dropdown dropdown-mega">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-list-alt mr-2 d-lg-none"></i>
                                Mega
                                <i class="caret fa fa-angle-down d-none d-lg-block"></i>
                                <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                            </a>
                            <div class="dropdown-menu p-0 dropdown-animated bgc-secondary-l4 brc-primary-m3 border-t-0 border-b-2 ace-scrollbar">
                                <div class="d-flex flex-column">

                                    <div class="row mx-0">

                                        <div class="col-lg-4 col-12 p-2 p-lg-3 p-xl-4 d-flex flex-column align-items-center">
                                            <div class="w-100 mb-3">
                                                <h5 class="col-lg-9 mx-auto text-dark-m2 px-0">
                                                    <i class="fa fa-clipboard-check mr-1 text-purple-m1"></i>
                                                    Current Tasks
                                                </h5>
                                            </div>

                                            <div class="col-lg-9 list-group px-0 border-1 brc-default-l2 radius-1 shadow-md">
                                                <a href="#" class="border-0 bgc-h-primary-l4 list-group-item list-group-item-action">
                                                    <i class="fab fa-facebook text-blue-m1 text-110 mr-2"></i>
                                                    Cras justo odio
                                                </a>
                                                <a href="#" class="border-0 bgc-h-primary-l4 list-group-item list-group-item-action text-primary">
                                                    <i class="fa fa-user text-success-m1 text-110 mr-2"></i>
                                                    Dapibus ac facilisis in
                                                </a>
                                                <a href="#" class="border-0 bgc-h-primary-l4 list-group-item list-group-item-action">
                                                    <i class="fa fa-clock text-purple-m1 text-110 mr-2"></i>
                                                    Morbi leo risus
                                                </a>
                                                <a href="#" class="border-0 list-group-item list-group-item-action bgc-success-l2">
                                                    <i class="fa fa-check text-orange-d1 text-110 mr-2"></i>
                                                    Porta ac consectetur
                                                    <span class="ml-2 badge badge-primary badge-pill badge-lg">14</span>
                                                </a>
                                                <a href="#" class="border-0 list-group-item list-group-item-action disabled">Vestibulum at eros</a>
                                            </div>
                                        </div><!-- .col:mega tasks -->



                                        <div class="bgc-white col-lg-4 col-12 p-4">
                                            <h5 class="text-dark-m2">
                                                <i class="fas fa-bullhorn mr-1 text-primary-m1"></i>
                                                Notifications
                                            </h5>

                                            <div class="mt-3">
                                                <div class="media mt-2 px-3 pt-1 border-l-2 brc-purple-m2">
                                                    <div class="bgc-purple radius-1 mr-3 p-3">
                                                        <i class="fa fa-user text-white text-150"></i>
                                                    </div>
                                                    <div class="media-body pb-0 mb-0 text-90 text-grey-m1">
                                                        <div class="text-grey-d2 font-bolder">@username1</div>
                                                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus...
                                                    </div>
                                                </div>

                                                <hr />

                                                <div class="media mt-2 px-3 pt-1 border-l-2 brc-warning-m2">
                                                    <div class="bgc-warning radius-1 mr-3 p-3">
                                                        <i class="fa fa-user text-white text-150"></i>
                                                    </div>
                                                    <div class="media-body pb-0 mb-0 text-90 text-grey-m1">
                                                        <div class="text-grey-d2 font-bolder">@username2</div>
                                                        Fusce dapibus, tellus ac cursus commodo, tortor mauris...
                                                    </div>
                                                </div>

                                                <hr />

                                                <div class="media mt-2 px-3 pt-1 border-l-2 brc-success-m2">
                                                    <div class="bgc-success radius-1 mr-3 p-3">
                                                        <i class="fa fa-user text-white text-150"></i>
                                                    </div>
                                                    <div class="media-body pb-0 mb-0 text-90 text-grey-m1">
                                                        <div class="text-grey-d2 font-bolder">@username3</div>
                                                        Tortor mauris condimentum nibh, fusce dapibus...
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- .col:mega notifications -->


                                        <div class="col-lg-4 col-12 p-4 dropdown-clickable">
                                            <h5 class="text-dark-m2">
                                                <i class="fa fa-envelope mr-1 text-green-m1"></i>
                                                Contact Us
                                            </h5>

                                            <form class="my-3">
                                                <div class="form-group mb-2">
                                                    <input placeholder="Name" type="text" class="form-control border-l-2" />
                                                </div>

                                                <div class="form-group mb-2">
                                                    <input placeholder="Email" type="text" class="form-control border-l-2" />
                                                </div>

                                                <div class="form-group mb-4">
                                                    <textarea class="form-control brc-primary-m2 border-l-2 text-grey-d1" rows="3" placeholder="Your message..."></textarea>
                                                </div>

                                                <div class="text-center">
                                                    <button type="reset" class="btn px-3 btn-secondary btn-bold tex1t-110">
                                                        Reset
                                                    </button>

                                                    <button data-dismiss="dropdown" type="button" class="btn btn-outline-primary btn-bgc-white px-3 btn-bold btn-text-slide-x" style="width: 8rem;">
                                                        Submit<i class="btn-text-2  move-right fa fa-arrow-right text-120 align-text-bottom ml-1"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div><!-- .col:mega contact -->

                                    </div><!-- .row: mega -->



                                    <!-- Big Action Buttons -->
                                    <div class="order-first order-lg-last ">
                                        <hr class="d-none d-lg-block brc-default-l1 my-0" /><!-- border above buttons in desktop mode -->

                                        <div class="row mx-0 bgc-primary-l4">
                                            <div class="col-lg-8 offset-lg-2 d-flex justify-content-center py-4 d-flex">

                                                <button class="mx-2px btn btn-sm btn-app btn-outline-warning btn-h-outline-warning btn-a-outline-warning radius-1 border-2">
                                                    <i class="fa fa-cog text-190 d-block mb-2 h-4"></i>
                                                    <span class="text-muted">Settings</span>
                                                </button>

                                                <button class="mx-2px btn btn-sm btn-app btn-outline-info btn-h-outline-info radius-1 border-2">
                                                    <i class="fa fa-edit text-190 d-block mb-2 h-4"></i>
                                                    Edit
                                                    <span class="position-tr text-danger-m2 text-130 mr-1">*</span>
                                                </button>

                                                <button class="mx-2px btn btn-sm btn-app btn-dark radius-1">
                                                    <i class="fa fa-lock text-150 d-block mb-2 h-4"></i>
                                                    Lock
                                                </button>

                                            </div>
                                        </div><!-- .row:megamenu big buttons -->

                                        <hr class="d-lg-none brc-default-l1 mt-0" /><!-- border below buttons in mobile mode -->
                                    </div>


                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown dropdown-mega">
                            <a class="nav-link dropdown-toggle pl-lg-3 pr-lg-4" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell text-110 icon-animated-bell mr-lg-2"></i>

                                <span class="d-inline-block d-lg-none ml-2">Notifications</span><!-- show only on mobile -->
                                <span id="id-navbar-badge1" class="badge badge-sm bgc-warning-d2 text-white radius-round text-85 border-1 brc-white-tp5">3</span>

                                <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                                <div class="dropdown-caret brc-white"></div>
                            </a>
                            <div class="dropdown-menu dropdown-sm dropdown-animated p-0 bgc-white brc-primary-m3 border-b-2 shadow">
                                <ul class="nav nav-tabs nav-tabs-simple w-100 nav-justified dropdown-clickable border-b-1 brc-secondary-l2" role="tablist">
                                    <li class="nav-item">
                                        <a class="d-style px-0 mx-0 py-3 nav-link active text-600 brc-blue-m1 text-dark-tp5 bgc-h-blue-l4" data-toggle="tab" href="#navbar-notif-tab-1" role="tab">
                                            <span class="d-active text-blue-d1 text-105">Notifications</span>
                                            <span class="d-n-active">Notifications</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="d-style px-0 mx-0 py-3 nav-link text-600 brc-purple-m1 text-dark-tp5 bgc-h-purple-l4" data-toggle="tab" href="#navbar-notif-tab-2" role="tab">
                                            <span class="d-active text-purple-d1 text-105">Messages</span>
                                            <span class="d-n-active">Messages</span>
                                        </a>
                                    </li>
                                </ul> <!-- .nav-tabs -->


                                <div class="tab-content tab-sliding p-0">

                                    <div class="tab-pane mh-none show active px-md-1 pt-1" id="navbar-notif-tab-1" role="tabpanel">

                                        <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <i class="fab fa-twitter bgc-blue-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                                            <span class="text-muted">Followers</span>
                                            <span class="float-right badge badge-danger radius-round text-80">- 4</span>
                                        </a>
                                        <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <i class="fa fa-comment bgc-pink-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                                            <span class="text-muted">New Comments</span>
                                            <span class="float-right badge badge-info radius-round text-80">+12</span>
                                        </a>
                                        <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <i class="fa fa-shopping-cart bgc-success-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                                            <span class="text-muted">New Orders</span>
                                            <span class="float-right badge badge-success radius-round text-80">+8</span>
                                        </a>
                                        <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <i class="far fa-clock bgc-purple-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                                            <span class="text-muted">Finished processing data!</span>
                                        </a>

                                        <hr class="mt-1 mb-1px brc-secondary-l2" />
                                        <a href="#" class="mb-0 py-3 border-0 list-group-item text-blue-m1 text-uppercase text-center text-85 font-bolder">
                                            See All Notifications
                                            <i class="ml-2 fa fa-arrow-right text-muted"></i>
                                        </a>

                                    </div> <!-- .tab-pane : notifications -->


                                    <div class="tab-pane mh-none pl-md-2" id="navbar-notif-tab-2" role="tabpanel">
                                        <div data-ace-scroll='{"ignore": "mobile", "height": 300, "smooth":true}'>
                                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                                <img alt="Alex's avatar" src="{{ asset('estilos/assets/image/avatar/avatar.png') }}" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                                <div>
                                                    <span class="text-primary-m1 font-bolder">Alex:</span>
                                                    <span class="text-grey text-90">Ciao sociis natoque penatibus et auctor ...</span>
                                                    <br />
                                                    <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  a moment ago
                                              </span>
                                                </div>
                                            </a>
                                            <hr class="my-1px brc-grey-l3" />
                                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                                <img alt="Susan's avatar" src="{{ asset('estilos/assets/image/avatar/avatar3.png') }}" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                                <div>
                                                    <span class="text-primary-m1 font-bolder">Susan:</span>
                                                    <span class="text-grey text-90">Vestibulum id ligula porta felis euismod ...</span>
                                                    <br />
                                                    <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  20 minutes ago
                                              </span>
                                                </div>
                                            </a>
                                            <hr class="my-1px brc-grey-l3" />
                                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                                <img alt="Bob's avatar" src="{{ asset('estilos/assets/image/avatar/avatar4.png') }}" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                                <div>
                                                    <span class="text-primary-m1 font-bolder">Bob:</span>
                                                    <span class="text-grey text-90">Nullam quis risus eget urna mollis ornare ...</span>
                                                    <br />
                                                    <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  3:15 pm
                                              </span>
                                                </div>
                                            </a>
                                            <hr class="my-1px brc-grey-l3" />
                                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                                <img alt="Kate's avatar" src="{{ asset('estilos/assets/image/avatar/avatar2.png') }}" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                                <div>
                                                    <span class="text-primary-m1 font-bolder">Kate:</span>
                                                    <span class="text-grey text-90">Ciao sociis natoque eget urna mollis ornare ...</span>
                                                    <br />
                                                    <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  1:33 pm
                                              </span>
                                                </div>
                                            </a>
                                            <hr class="my-1px brc-grey-l3" />
                                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                                <img alt="Fred's avatar" src="{{ asset('estilos/assets/image/avatar/avatar5.png') }}" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                                <div>
                                                    <span class="text-primary-m1 font-bolder">Fred:</span>
                                                    <span class="text-grey text-90">Vestibulum id penatibus et auctor  ...</span>
                                                    <br />
                                                    <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  10:09 am
                                              </span>
                                                </div>
                                            </a>

                                        </div> <!-- ace-scroll -->

                                        <hr class="my-1px brc-secondary-l2 border-double" />
                                        <a href="#" class="mb-0 py-3 border-0 list-group-item text-purple-m1 text-uppercase text-center text-85 font-bolder">
                                            See All Messages
                                            <i class="ml-2 fa fa-arrow-right text-muted"></i>
                                        </a>
                                    </div> <!-- .tab-pane : messages -->

                                </div>
                            </div>
                        </li>


                        <li class="nav-item dd-backdrop dropdown dropdown-mega">
                            <a class="nav-link dropdown-toggle pl-lg-3 pr-lg-4" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-flask text-110 icon-animated-vertical mr-lg-1"></i>

                                <span class="d-inline-block d-lg-none ml-2">Tasks</span><!-- show only on mobile -->
                                <span id="id-navbar-badge2" class="badge badge-sm text-95 text-yellow-l4">+2</span>

                                <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                                <div class="dropdown-caret brc-warning-l2"></div>
                            </a>
                            <div class="dropdown-menu dropdown-xs dropdown-animated animated-1 p-0 bgc-white brc-warning-l1 shadow">
                                <div class="bgc-orange-l2 py-25 px-4 border-b-1 brc-orange-l2">
                      <span class="text-dark-tp4 text-600 text-90 text-uppercase">
                              <i class="fa fa-check mr-2px text-warning-d2 text-120"></i>
                              4 Tasks to complete
                            </span>
                                </div>


                                <div class="px-4 py-2">
                                    <div class="text-95">
                                        <span class="text-grey-d1">Software update</span>
                                    </div>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bgc-info" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                    </div>
                                </div>

                                <hr class="my-1 mx-4" />
                                <div class="px-4 py-2">
                                    <div class="text-95">
                                        <span class="text-grey-d1">Hardware upgrade</span>
                                    </div>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bgc-warning" role="progressbar" style="width: 40%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">40%</div>
                                    </div>
                                </div>

                                <hr class="my-1 mx-4" />
                                <div class="px-4 py-2">
                                    <div class="text-95">
                                        <span class="text-grey-d1">Customer support</span>
                                    </div>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bgc-danger" role="progressbar" style="width: 30%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">30%</div>
                                    </div>
                                </div>

                                <hr class="my-1 mx-4" />
                                <div class="px-4 py-2">
                                    <div class="text-95">
                                        <span class="text-grey-d1">Fixing bugs</span>
                                    </div>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bgc-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 85%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">85%</div>
                                    </div>
                                </div>




                                <hr class="my-1px mx-2 brc-info-l2 " />
                                <a href="#" class="d-block bgc-h-primary-l4 py-3 border-0 text-center text-blue-m2">
                                    <span class="text-85 text-600 text-uppercase">See All Tasks</span>
                                    <i class="ml-2 fa fa-arrow-right text-muted"></i>
                                </a>
                            </div>
                        </li>


                        <li class="nav-item dropdown order-first order-lg-last">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                @if(session()->get('foto_user_existe'))
                                    <img id="id-navbar-user-image" width="36px" class="d-none d-lg-inline-block radius-round border-2 brc-white-tp1 mr-2 w-6" src="{{ route('image.show', ['dir_group' =>'usuarios' ,'filename' => session()->get('foto_user_name')]) }}">
                                @else
                                    <img id="id-navbar-user-image" width="36px" class="d-none d-lg-inline-block radius-round border-2 brc-white-tp1 mr-2 w-6" src="{{ asset('estilos/assets/image/avatar/default-usuario.png') }}">
                                @endif
                                <span class="d-inline-block d-lg-none d-xl-inline-block">
                                    <span class="text-90" id="id-user-welcome">Usuario:</span>
                                      <span class="nav-user-name">{{ session()->get('name') }}</span>
                                 </span>
                                <i class="caret fa fa-angle-down d-none d-xl-block"></i>
                                <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                            </a>

                            <div class="dropdown-menu dropdown-caret dropdown-menu-right dropdown-animated brc-primary-m3 py-1">
                                <div class="d-none d-lg-block d-xl-none">
                                    <div class="dropdown-header">
                                        Welcome, Jason
                                    </div>
                                    <div class="dropdown-divider"></div>
                                </div>

                                <div class="dropdown-clickable px-3 py-25 bgc-h-secondary-l3 border-b-1 brc-secondary-l2">
                                    <!-- online/offline toggle -->
                                    <div class="d-flex justify-content-center align-items-center tex1t-600">
                                        <label for="id-user-online" class="text-grey-d1 pt-2 px-2">offline</label>
                                        <input type="checkbox" class="ace-switch ace-switch-sm text-grey-l1 brc-green-d1" id="id-user-online" />
                                        <label for="id-user-online" class="text-green-d1 text-600 pt-2 px-2">online</label>
                                    </div>
                                </div>

                                <a href="{{ route('miCuenta.edit',[Crypt::encrypt(session()->get("id_usuario"))]) }}" class="mt-1 dropdown-item btn btn-outline-grey bgc-h-primary-l3 btn-h-light-primary btn-a-light-primary" >
                                    <i class="fa fa-user text-primary-m1 text-105 mr-1"></i>
                                    {{ __('Mi cuenta') }}
                                </a>

                                <a class="dropdown-item btn btn-outline-grey bgc-h-success-l3 btn-h-light-success btn-a-light-success" href="#" data-toggle="modal" data-target="#id-ace-settings-modal">
                                    <i class="fa fa-cog text-success-m1 text-105 mr-1"></i>
                                    Settings
                                </a>

                                <div class="dropdown-divider brc-primary-l2"></div>

                                <a class="dropdown-item btn btn-outline-grey bgc-h-secondary-l3 btn-h-light-secondary btn-a-light-secondary" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off text-warning-d1 text-105 mr-1"></i>
                                    {{ __('Cerrar Sesion') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li><!-- /.nav-item:last -->

                    </ul><!-- /.navbar-nav menu -->
                </div><!-- /.navbar-nav -->

            </div><!-- /#navbarMenu -->


        </div><!-- /.navbar-inner -->
    </nav>
    <div class="main-container bgc-white">

        <div id="sidebar" class="sidebar sidebar-fixed expandable sidebar-light">
            <div class="sidebar-inner">

                <div class="ace-scroll flex-grow-1" data-ace-scroll="{}">

                    <ul class="nav has-active-border">


                        <li class="nav-item-caption">
                            <span class="fadeable pl-3">{{ __('Menú') }}</span>
                            <span class="fadeinable mt-n2 text-125">&hellip;</span>
                        </li>


                        <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">

                            <a href="{{ url('/home') }}" class="nav-link">
                                <i class="nav-icon fa fa-tachometer-alt"></i>
                                <span class="nav-text fadeable"> <span>Inicio </span></span>
                            </a>

                            <b class="sub-arrow"></b>

                        </li>

                        <li class="nav-item {{ starts_with(Route::currentRouteName(), 'colaborador')  ? 'active' : '' }}">

                            <a href="{{ url('/colaboradores') }}" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <span class="nav-text fadeable"> <span>Colaboradores</span></span>
                            </a>

                            <b class="sub-arrow"></b>

                        </li>


                        @if(starts_with(Route::currentRouteName(), 'departamentos') || starts_with(Route::currentRouteName(), 'calendario')
                            ||starts_with(Route::currentRouteName(), 'noticias') ||starts_with(Route::currentRouteName(), 'vacaciones') || starts_with(Route::currentRouteName(), 'reclutamiento')
                            ||starts_with(Route::currentRouteName(), 'politicaEmpresarial') || starts_with(Route::currentRouteName(), 'rh_configuracion'))
                            @php
                                $active = 1;
                            @endphp
                        @else
                            @php
                                $active = 0;
                            @endphp
                        @endif

                        <li class="nav-item {{ $active == 1 ? 'active open' :  '' }} ">

                            <a href="#" class="nav-link dropdown-toggle {{ $active == 0 ? 'collapsed' :  '' }}">
                                <i class="nav-icon fa fa-people-arrows"></i>
                                <span class="nav-text fadeable">
                                    <span>Recursos Humanos</span>
                                </span>

                                <b class="caret fa fa-angle-left rt-n90"></b>
                            </a>

                            <div class="hideable submenu collapse {{ $active == 1 ? 'show' :  '' }} ">
                                <ul class="submenu-inner">

                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'departamentos') ? 'active' : '' }}">
                                        <a href="{{ url('/departamentos') }}" class="nav-link">
                                            <i class="nav-icon fa fa-id-card pr-2"></i>
                                            <span class="nav-text">
                                                  <span>Departamentos</span>
                                              </span>
                                        </a>
                                    </li>


                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'calendario') ? 'active' : '' }}">
                                        <a href="{{ url('/calendario') }}" class="nav-link">
                                            <i class="nav-icon fa fa-calendar-days pr-2"></i>

                                            <span class="nav-text">
                                                  <span>Calendario</span>
                                              </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'noticias') ? 'active' : '' }}">
                                        <a href="{{ url('/noticias') }}" class="nav-link">
                                            <i class="nav-icon fa fa-circle-exclamation pr-2"></i>

                                            <span class="nav-text">
                                                <span>Noticias</span>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'vacaciones') ? 'active' : '' }}">
                                        <a href="{{ url('/vacaciones') }}" class="nav-link">
                                            <i class="nav-icon fa-solid fa-map-location-dot pr-2"></i>

                                            <span class="nav-text">
                                                <span>Vacaciones</span>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'reclutamiento') ? 'active' : '' }}">
                                        <a href="{{ url('/reclutamiento') }}" class="nav-link">
                                            <i class="nav-icon fa fa-clipboard-question pr-2"></i>

                                            <span class="nav-text">
                                                <span>Reclutamiento</span>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'politicaEmpresarial') ? 'active' : '' }}">
                                        <a href="{{ url('/politicaEmpresarial') }}" class="nav-link">
                                            <i class="nav-icon fa fa-clipboard-list pr-2"></i>

                                            <span class="nav-text">
                                                <span>Pol&iacute;ticas Empresa</span>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'rh_configuracion') ? 'active' : '' }}">
                                        <a href="{{ url('/rh_configuracion') }}" class="nav-link">
                                            <i class="nav-icon fa fa-gears pr-2"></i>

                                            <span class="nav-text">
                                                <span>Configuraciones</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <b class="sub-arrow"></b>

                        </li>

                        <li class="nav-item {{ starts_with(Route::currentRouteName(), 'reportes') ? 'active' : '' }}">
                            <a href="{{ url('/reportes') }}" class="nav-link">
                                <i class="nav-icon fa fa-bar-chart"></i>

                                <span class="nav-text fadeable"><span>Reportes</span></span>
                            </a>

                            <b class="sub-arrow"></b>
                        </li>

                        <li class="nav-item {{ starts_with(Route::currentRouteName(), 'facturacion') ? 'active' : '' }}">
                            <a href="{{ route('facturacion.edit',[Crypt::encrypt(session()->get("id_cliente"))]) }}" class="nav-link">
                                <i class="nav-icon fa fa-money-check-alt"></i>

                                <span class="nav-text fadeable"><span>Facturación</span></span>
                            </a>

                            <b class="sub-arrow"></b>
                        </li>

                        @if(starts_with(Route::currentRouteName(), 'generarPlanilla') || starts_with(Route::currentRouteName(), 'historialPlanillas')
                           ||starts_with(Route::currentRouteName(), 'calculadoraPlanilla') ||starts_with(Route::currentRouteName(), 'generarAdelantoPlanilla'))
                            @php
                                $active = 1;
                            @endphp
                        @else
                            @php
                                $active = 0;
                            @endphp
                        @endif

                        <li class="nav-item {{ $active == 1 ? 'active open' :  '' }} ">

                            <a href="#" class="nav-link dropdown-toggle {{ $active == 0 ? 'collapsed' :  '' }}">
                              <i class="nav-icon fa-solid fa-hands-holding"></i>
                                <span class="nav-text fadeable">
                                    <span>Gestión de Planilla</span>
                                </span>

                                <b class="caret fa fa-angle-left rt-n90"></b>
                            </a>

                            <div class="hideable submenu collapse {{ $active == 1 ? 'show' :  '' }} ">
                                <ul class="submenu-inner">

                                     <li class="nav-item {{ starts_with(Route::currentRouteName(), 'generarPlanilla') ||
                                                starts_with(Route::currentRouteName(), 'generarAdelantoPlanilla')? 'active' : '' }}">
                                        <a href="{{ url('/generarPlanilla') }}" class="nav-link">

                                            <i class="nav-icon fa-sharp fa-solid fa-file-excel pr-2"></i>
                                            <span class="nav-text">
                                                  <span>Hacer la Planilla</span>
                                              </span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('historialPlanillas') }}" class="nav-link">
                                            <i class="nav-icon fa-solid fa-clock-rotate-left pr-2"></i>

                                            <span class="nav-text">
                                                  <span>Historial de Planillas</span>
                                              </span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('calculadoraPlanilla') }}" class="nav-link">
                                            <i class="nav-icon fa-solid fa-calculator pr-2"></i>

                                            <span class="nav-text">
                                                  <span>Calculadora salarial</span>
                                              </span>
                                        </a>
                                    </li>

                                     <li class="nav-item">
                                        <a href="{{ url('/') }}" class="nav-link">
                                            <i class="nav-icon fa-solid fa-pen-to-square pr-2"></i>

                                            <span class="nav-text">
                                                  <span>Reportes Planilla</span>
                                              </span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/') }}" class="nav-link">
                                            <i class="nav-icon fa fa-broom pr-2"></i>
                                            <span class="nav-text">
                                                  <span>Misceláneos</span>
                                              </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <b class="sub-arrow"></b>

                        </li>

                        <li class="nav-item {{ starts_with(Route::currentRouteName(), 'marketPlace') ? 'active' : '' }}">
                            <a href="{{ route('marketPlace.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-store"></i>

                                <span class="nav-text fadeable"><span>MarketPlace</span></span>
                            </a>

                            <b class="sub-arrow"></b>
                        </li>

                        <li class="nav-item {{ starts_with(Route::currentRouteName(), 'impersonalizacion') ? 'active' : '' }}">
                            <a href="{{ route('impersonalizacion.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-wrench"></i>

                                <span class="nav-text fadeable"><span>Impersonalización</span></span>
                            </a>

                            <b class="sub-arrow"></b>
                        </li>

                        @if(starts_with(Route::currentRouteName(), 'region') || starts_with(Route::currentRouteName(), 'administracionEmpresa')
                            ||starts_with(Route::currentRouteName(), 'tiposPlanilla') || starts_with(Route::currentRouteName(), 'controlHorario')
                            ||starts_with(Route::currentRouteName(), 'usuario') || starts_with(Route::currentRouteName(), 'miscelaneos'))
                            @php
                                $active = 1;
                            @endphp
                        @else
                            @php
                                $active = 0;
                            @endphp
                        @endif

                        <li class="nav-item {{ $active == 1 ? 'active open' :  '' }} ">

                            <a href="#" class="nav-link dropdown-toggle {{ $active == 0 ? 'collapsed' :  '' }}">
                                <i class="nav-icon fa fa-cog"></i>
                                <span class="nav-text fadeable">
                                    <span>Configuración</span>
                                </span>

                                <b class="caret fa fa-angle-left rt-n90"></b>
                            </a>

                            <div class="hideable submenu collapse {{ $active == 1 ? 'show' :  '' }} ">
                                <ul class="submenu-inner">
                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'administracionEmpresa') ? 'active' : '' }}">
                                        <a href="{{ route('administracionEmpresa') }}" class="nav-link">
                                            <i class="nav-icon fa fa-business-time pr-2"></i>
                                            <span class="nav-text">
                                                  <span>Administración de <br>empresa</span>
                                              </span>
                                        </a>
                                    </li>
{{--                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'administracionEmpresa') ? 'active' : '' }}">--}}
{{--                                        <a href="{{ route('administracionEmpresa.edit',[Crypt::encrypt(session()->get("id_cliente"))]) }}" class="nav-link">--}}
{{--                                            <i class="nav-icon fa fa-business-time pr-2"></i>--}}
{{--                                            <span class="nav-text">--}}
{{--                                                  <span>Administración de <br>empresa</span>--}}
{{--                                              </span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}

                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'usuario') ? 'active' : '' }}">
                                        <a href="{{ url('/usuario') }}" class="nav-link">
                                            <i class="nav-icon fa fa-user-plus pr-2"></i>
                                            <span class="nav-text">
                                                  <span>Usuarios</span>
                                              </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ starts_with(Route::currentRouteName(), 'miscelaneos') ? 'active' : '' }}">
                                        <a href="{{ url('/miscelaneos') }}" class="nav-link">
                                            <i class="nav-icon fa fa-broom pr-2"></i>
                                            <span class="nav-text">
                                                  <span>Misceláneos</span>
                                              </span>
                                        </a>
                                    </li>

                                      <li class="nav-item {{ starts_with(Route::currentRouteName(), 'chequeo') ? 'active' : '' }}">
                                        <a href="{{ url('/chequeo') }}" class="nav-link">
                                            <i class="nav-icon fa fa-pen pr-2"></i>
                                            <span class="nav-text">
                                                  <span>Chequeo</span>
                                              </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <b class="sub-arrow"></b>

                        </li>

                    </ul>

                </div><!-- /.sidebar scroll -->


                <div class="sidebar-section">
                    <div class="sidebar-section-item fadeable-bottom">
                        <div class="fadeinable">
                            <!-- shows this when collapsed -->
                            <div class="pos-rel">
                                @if(session()->get('foto_user_existe'))
                                    <img alt="Alexa's Photo" src="{{ route('image.show', ['dir_group' =>'usuarios' ,'filename' => session()->get('foto_user_name')]) }}" width="42" class="px-1px radius-round mx-2 border-2 brc-default-m2" />
                                    <span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-1 mt-2px"></span>
                                @else
                                    <img alt="Alexa's Photo" src="{{ asset('estilos/assets/image/avatar/default-usuario.png') }}" width="42" class="px-1px radius-round mx-2 border-2 brc-default-m2" />
                                    <span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-1 mt-2px"></span>
                                @endif
                            </div>
                        </div>

                        <div class="fadeable hideable w-100 bg-transparent shadow-none border-0">
                            <!-- shows this when full-width -->
                            <div id="sidebar-footer-bg" class="d-flex align-items-center bgc-white shadow-sm mx-2 mt-2px py-2 radius-t-1 border-x-1 border-t-2 brc-primary-m3">
                                <div class="d-flex mr-auto py-1">
                                    <div class="pos-rel">
                                        @if(session()->get('foto_user_existe'))
                                            <img alt="Alexa's Photo" src="{{ route('image.show', ['dir_group' =>'usuarios' ,'filename' => session()->get('foto_user_name')]) }}" width="42" class="px-1px radius-round mx-2 border-2 brc-default-m2" />
                                            <span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-1 mt-2px"></span>
                                        @else
                                            <img alt="Alexa's Photo" src="{{ asset('estilos/assets/image/avatar/default-usuario.png') }}" width="42" class="px-1px radius-round mx-2 border-2 brc-default-m2" />
                                            <span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-1 mt-2px"></span>
                                        @endif
                                    </div>

                                    <div>
                                        <span class="text-blue-d1 font-bolder texto-desbordado" data-toggle="tooltip" data-placement="top" title="{{ session()->get('name') }}">{{ session()->get('name') }}</span>
                                        <div class="text-80 text-grey">
                                            Admin
                                        </div>
                                    </div>
                                </div>

                                <a href="#" class="d-style btn btn-outline-primary btn-h-light-primary btn-a-light-primary border-0 p-2 mr-2px ml-1" title="Settings" data-toggle="modal" data-target="#id-ace-settings-modal">
                                    <i class="fa fa-cog text-125 text-blue-d2 f-n-hover"></i>
                                </a>


                                <a href="{{ route('logout') }}" class="d-style btn btn-outline-orange btn-h-light-orange btn-a-light-orange border-0 p-2 mr-1" title="Logout"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt text-125 text-orange-d2 f-n-hover"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div role="main" class="main-content">
            <!-- unused breadcrumbs example, see  -->
            <div class="d-none content-nav mb-1 bgc-secondary-l3 mx-5">

                <div class="d-flex justify-content-between align-items-center">
                    <ol class="breadcrumb pl-2 breadcrumb-nosep">
                        <li class="breadcrumb-item active text-grey">
                            <i class="fa fa-home text-dark-m3 mr-1 mt-1"></i>
                            <a class="text-blue" href="#">
                                Home
                            </a>
                        </li>
                        <li class="mx-15 text-grey-l2">/</li>

                        <li class="breadcrumb-item"><a class="text-blue-d2" href="#">Layouts</a></li>
                        <li class="mx-15 text-grey-l2">/</li>
                        <li class="breadcrumb-item active text-grey-d1">Dashboard 3</li>
                    </ol>

                    <div class="nav-search">
                        <form class="form-search">
                            <span class="d-inline-flex align-items-center">
                                <input type="text" placeholder="Search ..." class="form-control pr-4 form-control-sm radius-1 brc-blue-m2 text-grey" autocomplete="off" />
                                <i class="fa fa-search text-info-m1 ml-n4"></i>
                            </span>
                        </form>
                    </div><!-- /.nav-search -->
                </div>

            </div><!-- breadcrumbs -->
            <div class="page-content container container-plus">
                @php
                    $titulo = Route::is('home') ? 'Inicio' :
                            (starts_with(Route::currentRouteName(), 'colaboradoresConfiguracion')? 'Colaboradores: Configuración' :
                            (starts_with(Route::currentRouteName(), 'colaboradoresPerfil')? 'Colaboradores: Perfil' :
                            (starts_with(Route::currentRouteName(), 'colaboradoresConstanciaSalarial')? 'Colaboradores: Constancia Salarial' :
                            (starts_with(Route::currentRouteName(), 'colaboradoresPrestamos')? 'Colaboradores: Préstamos' :
                            (starts_with(Route::currentRouteName(), 'colaboradoresEmbargos')? 'Colaboradores: Embargos' :
                            (starts_with(Route::currentRouteName(), 'colaboradoresCurriculum')? 'Colaboradores: Currículum' :
                            (starts_with(Route::currentRouteName(), 'colaboradoresDocumentosDigitales')? 'Colaboradores: Expedientes digitales' :
                            (starts_with(Route::currentRouteName(), 'colaboradoresAmonestaciones')? 'Colaboradores: Amonestaciones' :
                            (starts_with(Route::currentRouteName(), 'colaboradorAccionPersonal')? 'Colaboradores: Acción de Personal' :
                            (starts_with(Route::currentRouteName(), 'colaboradores')? 'Colaboradores' :
                            (starts_with(Route::currentRouteName(), 'procesoContable') ? 'Proceso Contable' :
                            (starts_with(Route::currentRouteName(), 'departamentos') ? 'Recursos Humanos : Departamentos' :
                            (starts_with(Route::currentRouteName(), 'calendario') ? 'Recursos Humanos : Calendario' :
                            (starts_with(Route::currentRouteName(), 'noticias') ? 'Recursos Humanos : Noticias' :
                            (starts_with(Route::currentRouteName(), 'vacaciones') ? 'Recursos Humanos : Vacaciones' :
                            (starts_with(Route::currentRouteName(), 'reclutamiento') ? 'Recursos Humanos : Reclutamiento' :
                            (starts_with(Route::currentRouteName(), 'politicaEmpresarial') ? 'Recursos Humanos : Políticas Empresa' :
                            (starts_with(Route::currentRouteName(), 'reportes') ? 'Reportes' :
                            (starts_with(Route::currentRouteName(), 'rh_configuracion') ? 'Recursos Humanos : Configuraciones' :
                            (starts_with(Route::currentRouteName(), 'facturacion') ? 'Facturación' :
                            (starts_with(Route::currentRouteName(), 'generarPlanilla') ? 'Generar Planilla' :
                            (starts_with(Route::currentRouteName(), 'generarAdelantoPlanilla') ? 'Generar Adelanto Planilla' :
                            (starts_with(Route::currentRouteName(), 'detalleHistorialPlanilla') ? 'Historial Planilla' :
                            (starts_with(Route::currentRouteName(), 'calculadoraPlanilla') ? 'Calculadora Salarial' :
                            (starts_with(Route::currentRouteName(), 'adelantoPlanilla') ? 'Adelantar Planilla' :
                            (starts_with(Route::currentRouteName(), 'marketPlace') ? 'MarketPlace' :
                            (starts_with(Route::currentRouteName(), 'impersonalizacion') ? 'Impersonalizacion' :
                            (starts_with(Route::currentRouteName(), 'administracionEmpresa') ? 'Configuración : Administración de empresa' :
                            (starts_with(Route::currentRouteName(), 'usuario') ? 'Configuración : Usuarios' :
                            (starts_with(Route::currentRouteName(), 'miscelaneosNotificacionesEmail') ? 'Configuración : Misceláneos : Notificaciones Email' :
                            (starts_with(Route::currentRouteName(), 'miscelaneos') ? 'Configuración : Misceláneos' :
                            (starts_with(Route::currentRouteName(), 'miCuenta') ? 'Mi Cuenta' :
                            (starts_with(Route::currentRouteName(), 'reporte_INS')? 'Reportes para el Instituto Nacional de Seguros' :'')))))))))))))))))))))))))))))))));


                    $iconoTitulo = Route::is('home') ? 'tachometer-alt' :
                            (starts_with(Route::currentRouteName(), 'colaboradores') ? 'users' :
                            (starts_with(Route::currentRouteName(), 'procesoContable')? 'money-bill-alt' :
                            (starts_with(Route::currentRouteName(), 'departamentos') ? 'id-card' :
                            (starts_with(Route::currentRouteName(), 'calendario') ? 'calendar-days' :
                            (starts_with(Route::currentRouteName(), 'noticias') ? 'circle-exclamation' :
                            (starts_with(Route::currentRouteName(), 'vacaciones') ? 'fa-solid fa-map-location-dot' :
                            (starts_with(Route::currentRouteName(), 'reclutamiento') ? 'clipboard-question' :
                            (starts_with(Route::currentRouteName(), 'politicaEmpresarial') ? 'clipboard-list' :
                            (starts_with(Route::currentRouteName(), 'reportes') ? 'bar-chart' :
                            (starts_with(Route::currentRouteName(), 'rh_configuracion') ? 'gears' :
                            (starts_with(Route::currentRouteName(), 'facturacion') ? 'money-check-alt' :
                            (starts_with(Route::currentRouteName(), 'generarPlanilla') ? 'hand-holding-dollar' :
                            (starts_with(Route::currentRouteName(), 'generarAdelantoPlanilla') ? 'hand-holding-dollar' :
                            (starts_with(Route::currentRouteName(), 'detalleHistorialPlanilla') ? 'hand-holding-dollar' :
                            (starts_with(Route::currentRouteName(), 'calculadoraPlanilla') ? 'fas fa-calculator' :
                            (starts_with(Route::currentRouteName(), 'adelantoPlanilla') ? 'hand-holding-dollar' :
                            (starts_with(Route::currentRouteName(), 'marketPlace') ? 'store' :
                            (starts_with(Route::currentRouteName(), 'impersonalizacion') ? 'wrench' :
                            (starts_with(Route::currentRouteName(), 'region') ? 'map' :
                            (starts_with(Route::currentRouteName(), 'administracionEmpresa') ? 'business-time' :
                            (starts_with(Route::currentRouteName(), 'usuario') ? 'user-plus' :
                            (starts_with(Route::currentRouteName(), 'miscelaneos') ? 'broom' :
                            (starts_with(Route::currentRouteName(), 'reporte_INS')? 'file-text-o' :
                            (starts_with(Route::currentRouteName(), 'miCuenta') ? 'user' : ''))))))))))))))))))))))));


                    if(isset($resultadoColaborador))
                    {
                        $titulo .= ": ".$resultadoColaborador->primer_nombre." ".$resultadoColaborador->primer_apellido." ".$resultadoColaborador->segundo_apellido;
                    }
                    if(isset($fechaPlanilla))
                    {
                        $titulo .= ": ".$fechaPlanilla;
                        //$titulo .= ": ".$resultadoColaborador->primer_nombre." ".$resultadoColaborador->primer_apellido." ".$resultadoColaborador->segundo_apellido;
                    }
                @endphp

                <div class="card bcard">
                    <div class="card-header align-items-center">
                        <h3 class="card-title text-125">
                            <i class="nav-icon fa fa-{{$iconoTitulo}}"></i>
                            {{$titulo}}
                        </h3>


                            <div class="d-inline-flex align-items-center ml-sm-0 mb-1">
                                @if(Request::is('colaboradores'))
                                    <div class="mr-4">
                                   <span type="button" data-toggle="modal" data-target="#staticBackdrop" class="d-inline-block radius-round bgc-primary-d1 py-2 px-1 text-center border-3 brc-white-tp1 shadow-sm">
                                     <i class="fa fa-info w-4 text-105 text-white-tp1"></i>
                                   </span>
                                    </div>
                                  <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header bgc-blue-tp1">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Información de Página</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi dolor culpa explicabo. Veritatis voluptate tempore dolorem consequatur provident illum distinctio, repellat inventore sunt, obcaecati, eligendi accusantium eaque laborum minus similique.</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                                @endif



                                <!-- Modal -->



                                <button type="button" onclick="window.history.go(-1); return false;" href="" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-long-arrow-alt-left mr-1 text-white text-120 mt-3px"></i>
                                </span>
                                    Volver
                                </button>
                            </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="pt-4 px-4">
                            <!--if(isset($errors) && $errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        foreach($errors->all() as $error)
                                            <li>{ $error }}</li>
                                        endforeach
                                    </ul>
                                </div>
                            endif-->
                            @yield('page-content')
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>

            <footer class="footer d-none d-sm-block">
                <div class="footer-inner bgc-white-tp1">
                    <div class="pt-3 border-none border-t-3 brc-grey-l2 border-double">
                        <span class="text-primary-m1 font-bolder text-120">CyberFuel</span>
                        <span class="text-grey">- Planilla Profesional &copy; {{ now()->year }}</span>
                    </div>
                </div><!-- .footer-inner -->

                <!-- `scroll to top` button inside footer (for example when in boxed layout) -->
                <div class="footer-tools">
                    <a id="btn-scroll-up" href="#" class="btn-scroll-up btn btn-dark mb-2 mr-2">
                        <i class="fa fa-angle-double-up mx-2px text-95"></i>
                    </a>
                </div>
            </footer>



            <!-- footer toolbox for mobile view -->
            <footer class="d-sm-none footer footer-sm footer-fixed">
                <div class="footer-inner">
                    <div class="btn-group d-flex h-100 mx-2 border-x-1 border-t-2 brc-primary-m3 bgc-white-tp1 radius-t-1 shadow">
                        <button class="btn btn-outline-primary btn-h-lighter-primary btn-a-lighter-primary border-0" data-toggle="modal" data-target="#id-ace-settings-modal">
                            <i class="fas fa-sliders-h text-blue-m1 text-120"></i>
                        </button>

                        <button class="btn btn-outline-primary btn-h-lighter-primary btn-a-lighter-primary border-0">
                            <i class="fa fa-plus-circle text-green-m1 text-120"></i>
                        </button>

                        <button class="btn btn-outline-primary btn-h-lighter-primary btn-a-lighter-primary border-0" data-toggle="collapse" data-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle navbar search">
                            <i class="fa fa-search text-orange text-120"></i>
                        </button>

                        <button class="btn btn-outline-primary btn-h-lighter-primary btn-a-lighter-primary border-0 mr-0">
                          <span class="pos-rel">
                              <i class="fa fa-bell text-purple-m1 text-120"></i>
                              <span class="badge badge-dot bgc-red position-tr mt-n1 mr-n2px"></span>
                          </span>
                        </button>
                    </div>
                </div>
            </footer>
        </div>

        <div id="id-ace-settings-modal" class="my-1 my-lg-2 modal modal-nb ace-aside aside-right aside-offset aside-below-nav" data-backdrop="false" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content w-auto flex-grow-1 pb-1px radius-0 radius-l-2 border-y-2 border-l-1 brc-default-m3 bgc-white-tp1 shadow">

                    <div class="modal-header p-0 radius-0 mx-3">
                        <h4 class="modal-title text-primary-d1 text-140 pt-2 pl-1">Demo Settings</h4>

                        <button type="button" class="close m-0 mr-n2" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times text-70" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div class="modal-body mx-md-2" data-ace-scroll='{"smooth": true, "lock": true}'>
                        <form autocomplete="off">
                            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                                <h5 class="text-default-d2">
                                    Zoom
                                </h5>

                                <div class="btn-group btn-group-toggle align-self-end" data-toggle="buttons">
                                    <label class="btn btn-sm btn-lighter-grey btn-h-light-primary btn-a-primary">
                                        90%
                                        <input type="radio" name="zoom-level" value="90" />
                                    </label>

                                    <label class="btn btn-sm btn-lighter-grey btn-h-light-primary btn-a-primary active">
                                        100%
                                        <input type="radio" name="zoom-level" value="none" checked />
                                    </label>

                                    <label class="btn btn-sm btn-lighter-grey btn-h-light-primary btn-a-primary">
                                        110%
                                        <input type="radio" name="zoom-level" value="110" />
                                    </label>

                                    <label class="btn btn-sm btn-lighter-grey btn-h-light-primary btn-a-primary">
                                        120%
                                        <input type="radio" name="zoom-level" value="120" />
                                    </label>
                                </div>
                            </div>


                            <hr class="border-double my-md-3" />


                            <h5 class="text-purple-d1">
                                Themes
                            </h5>




                            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3">
                                <h6 class="text-95 pl-1 text-grey-d1">Sidebar</h6>

                                <div class="btn-group btn-group-toggle align-self-end flex-wrap px-0  col-10 col-sm-7" data-toggle="buttons">
                                    <label class="btn btn-sm btn-light-default btn-text-default btn-bgc-white btn-a-default btn-h-default">
                                        Dark
                                        <input type="radio" name="sidebar-theme" value="dark" />
                                    </label>

                                    <label class="btn btn-sm btn-light-default btn-text-default btn-bgc-white btn-a-default btn-h-default">
                                        Light
                                        <input type="radio" name="sidebar-theme" value="light" />
                                    </label>
                                </div>
                            </div>



                            <div>
                                <div class="d-none bgc-secondary-l1 radius-1 px-1 mb-3 mt-1 text-center" id="id-sidebar-themes-dark">
                                    <div class="btn-group btn-group-toggle align-self-end flex-wrap justify-content-center w-75 mx-auto align-items-center my-2 flex-equal-sm" data-toggle="buttons">
                                        <label class="btn btn-xs sidebar-color border-0 sidebar-dark d-style active m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="dark" checked />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-dark2 d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="dark2" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-darkblue d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="darkblue" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-darkslategrey d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="darkslategrey" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-cadetblue d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="cadetblue" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-plum d-style my-1px m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="plum" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-darkslateblue d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="darkslateblue" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-purple d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="purple" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-steelblue d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="steelblue" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-blue d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="blue" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-teal d-style m-1px d-none">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="teal" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-green d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="green" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-darkcrimson d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="darkcrimson" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-gradient1 d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="gradient1" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-gradient2 d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="gradient2" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-gradient3 d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="gradient3" />
                                        </label>

                                        <label class="btn btn-xs sidebar-color border-0 sidebar-gradient4 d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="sidebar-dark" value="gradient4" />
                                        </label>
                                    </div>
                                </div><!-- #id-sidebar-themes-dark -->


                                <div class="d-none" id="id-sidebar-themes-light">
                                    <div class="bgc-secondary-tp2 radius-1 py-1 px-1 mb-3 mt-1 text-center">
                                        <div class="d-flex btn-group btn-group-toggle align-self-end flex-wrap justify-content-center mx-auto align-items-center my-2 flex-equal-sm" data-toggle="buttons">

                                            <label class="active btn btn-xs border-0 sidebar-white2 d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="sidebar-light" value="white" checked />
                                            </label>

                                            <label class="btn btn-xs border-0 sidebar-white2 d-style m-1px d-none">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="sidebar-light" value="white2" />
                                            </label>

                                            <label class="btn btn-xs border-0 sidebar-white3 d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="sidebar-light" value="white3" />
                                            </label>

                                            <label class="btn btn-xs border-0 sidebar-white4 d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="sidebar-light" value="white4" />
                                            </label>

                                            <label class="btn btn-xs border-0 sidebar-light d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="sidebar-light" value="light" />
                                            </label>

                                            <label class="btn btn-xs border-0 sidebar-lightblue d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="sidebar-light" value="lightblue" />
                                            </label>

                                            <label class="btn btn-xs border-0 sidebar-lightblue2 d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="sidebar-light" value="lightblue2" />
                                            </label>

                                            <label class="btn btn-xs border-0 sidebar-lightpurple d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="sidebar-light" value="lightpurple" />
                                            </label>


                                        </div>
                                    </div>
                                </div><!-- #id-sidebar-themes-light -->

                            </div>

                            <hr class="border-dotted" />

                            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                                <h6 class="text-95 pl-1 text-grey-d1">Navbar</h6>

                                <div id="navbar-themes-show" class="d-none btn-group btn-group-toggle align-self-end flex-wrap px-0 col-10 col-sm-7" data-toggle="buttons">
                                    <label class="btn btn-sm btn-light-green btn-text-green btn-bgc-white btn-a-green btn-h-green">
                                        Light
                                        <input type="radio" name="navbar-theme" value="light" />
                                    </label>

                                    <label class="btn btn-sm btn-light-green btn-text-green btn-bgc-white btn-a-green btn-h-green">
                                        Dark
                                        <input type="radio" name="navbar-theme" value="dark" />
                                    </label>
                                </div>

                                <div id="navbar-themes-show-msg" class="text-95 px-3 py-15 bgc-secondary-l3 border-1 brc-secondary-m4 border-dotted ml-3 radius-1">
                                    Navbar themes can be viewed in<br /> <span>Dashboard <a class="btn-h-dark no-underline px-2px" href="html/dashboard-3.html">3</a> & <a class="btn-h-dark no-underline px-2px" href="html/dashboard-4.html">4</a></span>
                                </div>

                            </div>

                            <div>
                                <div class="d-none bgc-secondary-l1 radius-1 px-1 mb-3 mt-1 text-center" id="id-navbar-themes-dark">
                                    <div class="btn-group btn-group-toggle align-self-end flex-wrap justify-content-center w-75 mx-auto align-items-center my-2 flex-equal-sm" data-toggle="buttons">

                                        <label class="btn btn-xs border-0 navbar-blue d-style active m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="blue" checked />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-darkblue d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="darkblue" />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-teal d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="teal" />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-green d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="green" />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-cadetblue d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="cadetblue" />
                                        </label>



                                        <label class="btn btn-xs border-0 navbar-plum d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="plum" />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-purple d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="purple" />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-orange d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="orange" />
                                        </label>


                                        <label class="btn btn-xs border-0 navbar-brown d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="brown" />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-darkgreen d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="darkgreen" />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-skyblue d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="skyblue" />
                                        </label>

                                        <label class="btn btn-xs border-0 navbar-secondary d-style m-1px">
                                            <i class="fa fa-check text-white v-active"></i>
                                            <input type="radio" name="navbar-dark" value="secondary" />
                                        </label>

                                    </div>
                                </div><!-- #id-navbar-themes-dark -->

                                <div class="d-none" id="id-navbar-themes-light">
                                    <div class="bgc-secondary-tp2 radius-1 py-1 px-1 mb-3 mt-1 text-center">
                                        <div class="btn-group btn-group-toggle align-self-end flex-wrap justify-content-center w-75 mx-auto align-items-center my-2 flex-equal-sm" data-toggle="buttons">

                                            <label class="active btn btn-xs border-0 navbar-white d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="navbar-light" value="white" checked />
                                            </label>

                                            <label class="btn btn-xs border-0 navbar-white2 d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="navbar-light" value="white2" />
                                            </label>

                                            <label class="btn btn-xs border-0 navbar-lightblue d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="navbar-light" value="lightblue" />
                                            </label>

                                            <label class="btn btn-xs border-0 navbar-lightpurple d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="navbar-light" value="lightpurple" />
                                            </label>

                                            <label class="btn btn-xs border-0 navbar-lightgreen d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="navbar-light" value="lightgreen" />
                                            </label>

                                            <label class="btn btn-xs border-0 navbar-lightgrey d-style m-1px">
                                                <i class="fa fa-check text-muted v-active"></i>
                                                <input type="radio" name="navbar-light" value="lightgrey" />
                                            </label>


                                        </div>
                                    </div>

                                </div><!-- #id-navbar-themes-light -->

                            </div>

                            <hr class="border-double my-md-4" />

                            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                                <h5 class="text-info">Font</h5>

                                <div class="align-self-end w-75">
                                    <select id="id-change-font" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                        <option value="lato">Lato</option>
                                        <option value="manrope">Manrope</option>
                                        <option value="montserrat">Montserrat</option>
                                        <option value="noto-sans">Noto Sans</option>
                                        <option value="open-sans" selected>Open Sans</option>
                                        <option value="poppins">Poppins</option>
                                        <option value="raleway">Raleway</option>
                                        <option value="roboto" class="text-primary-d2 text-600">Roboto (popular)</option>
                                        <option value="">----</option>
                                        <option value="markazi">Markazi (for RTL languages)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="my-1"></div>
                        </form>
                    </div>

                    <div class="modal-footer d-none justify-content-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-times mr-1"></i>
                            Close
                        </button>
                        <button type="button" class="btn btn-info">
                            <i class="fa fa-check mr-1"></i>
                            Keep changes
                        </button>
                    </div>

                </div><!-- .modal-content -->

                <div class="aside-header align-self-start mt-1 mt-lg-5 text-right d-style">
                    <button type="button" class="btn btn-orange btn-lg shadow-sm pl-2 radius-l-2 f-n-hover py-1 py-md-2" data-toggle="modal" data-target="#id-ace-settings-modal">
                        <i class="fa fa-cog text-110 ml-1"></i>
                    </button>
                </div>
            </div><!-- .modal-dialog -->
        </div><!-- .modal-aside -->
    </div>
</div>
<!-- AQUI SE INCLUYEN LOS JS-->
@include('common.admin_scripts')
</body>
</html>
