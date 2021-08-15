<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BooksWorld <!-- <sup>Admin Panel</sup> --> </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
{{--    <div class="sidebar-heading">--}}
{{--         Section--}}
{{--    </div>--}}


    @if(isset($client))
    <!-- Nav Item - Book Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span>Books</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('/create-book')}}">Post New Book</a>
                <a class="collapse-item" href="{{url('/my-book')}}">My Books</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Cart Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCart" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>My Cart</span>
        </a>
        <div id="collapseCart" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if(count(\App\Models\BookCart::where('client_id', $client->id)->get()) !== 0)
                <a class="collapse-item" href="{{url('/cart')}}">View Cart Item</a>
                <a class="collapse-item" href="{{url('/cart-checkout/'.$client->id)}}">Proceed to checkout</a>
                @else
                    <p class="collapse-item">Cart is empty</p>
                @endif
            </div>
        </div>
    </li>

    <!-- Nav Item - Profile Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>My Profile</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('/profile')}}">View Profile</a>
                <a class="collapse-item" href="{{url('/settings-page')}}">Profile Settings</a>
            </div>
        </div>
    </li>

    @if(count(\App\Models\Order::where('client_id', $client->id)->get()) !== 0)
    <!-- Nav Item - Order Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/order/'.$client->id)}}" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-table"></i>
            <span>Orders</span>
        </a>
    </li>
    @endif



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Delivery Section
    </div>

    @if(isset($deliverData))
        <!-- Nav Item - Delivery Boy Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Delivery Manager</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/grab-order-page/'.\App\Models\DeliveryPerson::where('client_id', $client->id)->first()->id)}}">Grab New Order</a>
                        <a class="collapse-item" href="{{url('/delivery-order-page/'.\App\Models\DeliveryPerson::where('client_id', $client->id)->first()->id)}}">Manage Order</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item Delivery Boy about - Charts -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDel" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Carrer Info</span>
                </a>
                <div id="collapseDel" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/delivery-information')}}">Deliver Profile</a>
                    </div>
                </div>
            </li>
    @else
        <!-- Nav Item - Join Delivery Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('/join-as-deliver')}}" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-biking"></i>
                    <span>Join As Delivery Person</span>
                </a>
            </li>
    @endif


    @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('/login')}}" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('/register')}}" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>Register</span>
                </a>
            </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
