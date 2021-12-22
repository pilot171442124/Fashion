<header id="sticky-header" class="header style-1">
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 ">
                    <div class="logo">
                        <a href="{{ url('/') }}">

                            <!-- 
                        
                        <img src="{{ asset('public/images/indexlogo.png') }}" alt="logo" />
-->
                        </a>
                    </div>
                </div>

                <div class="col-lg-10 ">
                    <!-- Main Menu -->
                    <div class="menu-area ">
                        <nav>
                            <ul class="main-menu pull-right clearfix">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                @if(Auth::check())

                                @if(Auth::user()->userrole =='Admin')



                                <li><a href="{{ url('/dashboard') }}">Dashboard</a>




                                </li>






                                <li><a href="{{ url('/') }}">Product</a>

                                    <ul class="submenu">
                                        <li><a href="{{ url('/prouductcgeneration') }}">Product Generation</a></li>

                                        <li><a href="{{ url('/prouductcategory') }}">Product Category</a></li>
                                        <li><a href="{{ url('/productsizeentry') }}">Product Size</a></li>
                                        <li><a href="{{ url('/prouductentry') }}">Product Entry</a></li>
                                        <li><a href="{{ url('/productview') }}">Product View</a></li>

                                    </ul>



                                </li>

                                <li><a href="{{ url('/') }}">Admin</a>

                                    <ul class="submenu">
                                        <li><a href="{{ url('createuser') }}">Create User Account</a></li>

                                    </ul>



                                </li>



                                <li><a href="{{ url('/') }}">Product Offer</a>

                                    <ul class="submenu">
                                        <li><a href="{{ url('/createoffer') }}">Create Offer</a></li>

                                        <li><a href="{{ url('/prouductofferview') }}">Product Offer view</a></li>
                                        <li><a href="{{ url('/productview') }}">Product View</a></li>

                                    </ul>



                                </li>


                                <li><a href="{{ url('/') }}">Payment</a>

                                    <ul class="submenu">
                                        <li><a href="{{ url('/checkpayment') }}">Check payment</a></li>


                                    </ul>



                                </li>




                                @endif

                                @if(Auth::user()->userrole =='Salesman' )
                                <li><a href="{{ url('/') }}">Product</a>

                                    <ul class="submenu">
                                        <li><a href="{{ url('/prouductcategory') }}">Product Category</a></li>

                                        <li><a href="{{ url('/prouductentry') }}">Product Entry</a></li>
                                        <li><a href="{{ url('/productview') }}">Product View</a></li>

                                    </ul>



                                </li>


                                <li><a href="{{ url('/') }}">Product Offer</a>

                                    <ul class="submenu">
                                        <li><a href="{{ url('/createoffer') }}">Create Offer</a></li>

                                        <li><a href="{{ url('/prouductofferview') }}">Product Offer view</a></li>
                                        <li><a href="{{ url('/productview') }}">Product View</a></li>

                                    </ul>



                                </li>


                                <li><a href="{{ url('/') }}">Payment</a>

                                    <ul class="submenu">
                                        <li><a href="{{ url('/checkpayment') }}">Check payment</a></li>


                                    </ul>



                                </li>

                                @endif


                                @if(Auth::user()->userrole =='Customer')

                                <li><a href="{{ url('/addtocart') }}">Add To Cart</a></li>
                                <li><a href="{{ url('/payment') }}">Payment</a></li>



                                @endif



                                @endif






                                <li><a href="{{ url('contract') }}">Contact</a></li>


                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>


</header>