<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    @if(collect(request()->segments())->last() == '')
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="searchBox form-control bg-gradient-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            </div>
        </form>
    @endif

<!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        @if(isset($client))
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-shopping-cart fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{count(\App\Models\BookCart::where('client_id',$client->id)->get())}}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Cart Item
                </h6>
                @if($myCart = \App\Models\BookCart::where('client_id',$client->id)->get())
                    @foreach($myCart as $book)
                        <a class="dropdown-item d-flex align-items-center" href="{{url('/view-book/'.$book->book_id)}}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-book text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{$book->quantity}} unit of</div>
                                <span class="font-weight-bold">{{ \App\Models\Book::where('id', $book->book_id)->first()->title }}</span>
                            </div>
                        </a>
                    @endforeach
                        @if(count($myCart) != 0)
                            <a class="dropdown-item text-center small text-danger-500" href="{{url('/cart-checkout/'.$client->id)}}"><strong>Checkout</strong></a>
                        @else
                            <a class="dropdown-item text-center small text-danger-500" href="{{url('/')}}"><strong>Add item</strong></a>
                        @endif
                @endif
            </div>
        </li>
        @endif

        <!-- Nav Item - User Information -->
        @if($client)
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$client->name}}</span>
                <img class="img-profile rounded-circle" src="{{asset('uploads/client-dp/'.$client->dp)}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{url('/profile')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="{{url('/settings-page')}}">
                    <i class="fas fa-prescription-bottle fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
        @else
            <li class="nav-item dropdown no-arrow">
                <a style="color: #1b788a" class="nav-link" href="{{url('/login')}}" role="button">
                    Login Now
                </a>
            </li>
        @endif

    </ul>

</nav>
