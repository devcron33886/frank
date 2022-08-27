<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li>
                    <a href="tel:{{$settings->whatsapp ?? '' }}">
                        <i class="fa fa-whatsapp"></i>{{$settings->whatsapp ?? '' }}
                    </a>
                </li>
                <li>
                    <a href="tel:{{$settings->phoneNumber1 ?? '' }}">
                        <i class="fa fa-mobile-phone"></i>{{$settings->phoneNumber1 ?? '' }}
                    </a>
                </li>
                <li>
                    <a href="tel:{{$settings->phoneNumber2 ?? '' }}">
                        <i class="fa fa-phone"></i>{{$settings->phoneNumber2 ?? '' }}
                    </a>
                </li>
                <li>

                    <a href="mailto:{{ $setting->email1 ?? '' }}">
                        <i class="fa fa-envelope-o"></i>
                        {{ $setting->email1 ?? '' }}
                    </a>
                </li>
                <li>

                    <a href="mailto:{{ $settings->email2 ?? '' }}">
                        <i class="fa fa-envelope-o"></i>
                        {{ $settings->email2 ?? '' }}
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-map-marker"></i>
                        {{ $settings->address ?? '' }}
                    </a>
                </li>
                <li><a href="{{ route('home') }}" target="_blank">ADMIN</a></li>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->
    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-sm-3 hidden-xs">
                    <div class="header-logo">
                        <a href="{{ route('home') }}" class="logo" style="color: #F0FFDF;">
                            <img src="{{ asset('img/GARDEN_LOGO.png') }}" class="img-responsive flat"
                                 alt="Garden Of Eden Produce"
                                 style="width: 80px;background-color: whitesmoke">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-sm-6">
                    <div class="header-search">
                        <form action="{{ route('buy.products') }}" class="form-inline" autocomplete="off">
                            <div class="input-group input-group-lg w-100">
                                <input type="search" autocomplete="off"
                                       value="{{ request('search') }}"
                                       class="form-control flat" name="search"
                                       placeholder="What are your looking for?">
                                <span class="input-group-btn">
                                <button class="btn btn-danger flat" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                              </span>
                            </div><!-- /input-group -->
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-sm-3 clearfix">
                    <livewire:cart-counter/>
                </div>

                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
