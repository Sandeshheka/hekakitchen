  @include('landing.includes.landingHeader')
  @php

  $setting = DB::table('sitesetting')->first();
  @endphp
  <!-- Page Preloder -->
  <div id="preloder">
      <div class="loader"></div>
  </div>

  <!-- Header Section Begin -->
  <header class="header-section">
      <div class="header-top">
          <div class="container">
              <div class="ht-left">
                  <div class="mail-service">
                      <i class=" fa fa-envelope"></i>
                      {{$setting->email}}
                  </div>
                  <div class="phone-service">
                      <i class=" fa fa-phone"></i>
                      {{$setting->phone_one}}
                  </div>
              </div>
              <div class="ht-right">
                  <a href="#" class="login-panel"><i class="fa fa-user"></i>Login</a>
                  <div class="lan-selector">
                      <select class="language_drop" name="countries" id="countries" style="width:300px;">
                          <option value='yt' data-image="{{ asset('frontend/new/img/flag-1.jpg')}}"
                              data-imagecss="flag yt" data-title="English">English</option>
                          <option value='yu' data-image="{{ asset('frontend/new/img/flag-2.jpg')}}"
                              data-imagecss="flag yu" data-title="Bangladesh">German </option>
                      </select>
                  </div>
                  <div class="top-social">
                      <a href="#"><i class="ti-facebook"></i></a>
                      <a href="#"><i class="ti-twitter-alt"></i></a>
                      <a href="#"><i class="ti-linkedin"></i></a>
                      <a href="#"><i class="ti-pinterest"></i></a>
                  </div>
              </div>
          </div>
      </div>
      <div class="container">
          <div class="inner-header">
              <div class="row">
                  <div class="col-lg-2 col-md-2">
                      <div class="logo">
                          <a href="./index.html">
                              <img src="{{ asset('frontend/new/img/logo.png')}}" alt="">
                          </a>
                      </div>
                  </div>
                  @php
                  $category = DB::table('categories')->get();

                  @endphp
                  <div class="col-lg-7 col-md-7">
                      <div class="advanced-search">
                          <form action="{{route('product.search')}}" method="post" class="header_search_form clearfix">
                              @csrf
                              <button type="button" class="category-btn">All Categories</button>
                              <div class="input-group">
                                  <input type="text" placeholder="What do you need?">
                                  <button type="button"><i class="ti-search"></i></button>
                          </form>
                      </div>
                  </div>
              </div>
              @guest


              @else
              @php
              $wishlist = DB::table('wishlists')->where('user_id', Auth::id())->get();
              @endphp
              <div class="col-lg-3 text-right col-md-3">
                  <ul class="nav-right">
                      <li class="heart-icon">
                          <a href="#">
                              <i class="icon_heart_alt"></i>
                              <span>{{count($wishlist)}}</span>
                          </a>
                      </li>

                      @endguest

                      @php
                      $cart = Cart::content();

                      @endphp
                      <ul class="nav-right">

                          <li class="cart-icon">
                              <a href="#">
                                  <i class="icon_bag_alt"></i>
                                  <span>{{Cart::count()}}</span>
                              </a>
                              <div class="cart-hover">
                                  <div class="select-items">
                                      <table>
                                          <tbody>
                                              @foreach($cart as $c)
                                              <tr>
                                                  <td class="si-pic"><img src="{{ asset($c->options->image)}}"
                                                          height="80px" alt=""></td>
                                                  <td class="si-text">
                                                      <div class="product-selected">
                                                          <p>{{ $c->qty }}*{{$c->price}}</p>
                                                          <h6>{{$c->name}}</h6>
                                                      </div>
                                                  </td>
                                                  <td class="si-close">
                                                      <a href="{{ url('removeCart/'.$c->rowId ) }}"><i
                                                              class="ti-close"></i></a>
                                                  </td>
                                              </tr>
                                              @endforeach

                                          </tbody>
                                      </table>
                                  </div>
                                  <div class="select-total">
                                      <span>total:</span>
                                      <h5>Rs.{{Cart::subtotal()}}</h5>
                                  </div>
                                  <div class="select-button">
                                      <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                      <a href="{{route('user.checkout')}}" class="primary-btn checkout-btn">CHECK
                                          OUT</a>
                                  </div>
                              </div>
                          </li>
                          <li class="cart-price">Rs.{{Cart::subtotal()}}</li>
                      </ul>
              </div>
          </div>
      </div>
      </div>
      @php
      $category = DB::table('categories')->get();

      @endphp
      <div class="nav-item">
          <div class="container">
              <div class="nav-depart">
                  <div class="depart-btn">
                      <i class="ti-menu"></i>
                      <span>All Categories</span>
                      <ul class="depart-hover">
                  
                          @foreach($category as $cat)
                          <li><a href="{{URL::to('/allCategory/'.$cat->id)}}">{{$cat->category_name}}<i
                                      class="fas fa-chevron-right"></i></a>
                          
                          </li>

                          @endforeach
                      </ul>
                  </div>
              </div>
              <nav class="nav-menu mobile-menu">
                  <ul>
                      <li class="active"><a href="./index.html">Home</a></li>
                      <li><a href="./shop.html">Shop</a></li>
                      <li><a href="#">Categories</a>
                          <ul class="dropdown">
                          @foreach($category as $cat)
                                <li><a href="{{URL::to('/allCategory/'.$cat->id)}}">{{$cat->category_name}}</a>
                                
                                </li>

                                @endforeach
                          </ul>
                      </li>
                      <li><a href="./blog.html">Blog</a></li>
                      <li><a href="./contact.html">Contact</a></li>
                      <li><a href="#">Pages</a>
                          <ul class="dropdown">
                              <li><a href="./blog-details.html">Blog Details</a></li>
                              <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                              <li><a href="./check-out.html">Checkout</a></li>
                              <li><a href="./faq.html">Faq</a></li>
                              <li><a href="./register.html">Register</a></li>
                              <li><a href="./login.html">Login</a></li>
                          </ul>
                      </li>
                  </ul>
              </nav>
              <div id="mobile-menu-wrap"></div>
          </div>
      </div>
  </header>
  <!-- Header End -->

  <!-- Hero Section Begin -->
  
@php
     $slider = DB::table('products')
                        ->join('brands','products.brand_id','brands.id')
                        ->select('products.*','brands.brand_name')
                        ->where('main_slider',1)->orderBy('id','DESC')->first();

    @endphp
  <section class="hero-section">
      <div class="hero-items owl-carousel">
          <div class="single-hero-items set-bg" data-setbg="{{ asset( $slider->image_one  )}}">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-5">
                          <span>Bag,kids</span>
                          <h1>{{ $slider->product_name }}</h1>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                              incididunt ut labore et dolore</p>
                          <a href="#" class="primary-btn">Shop Now</a>
                      </div>
                  </div>
                  <div class="off-card">
                

                      <h2>Sale <span>{{ $slider->selling_price }}</span></h2>
                  </div>
              </div>
          </div>
        
      </div>
  </section>
  <!-- Hero Section End -->

  <!-- Banner Section Begin -->
  <div class="banner-section spad">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-4">
                  <div class="single-banner">
                      <img src="{{ asset('frontend/new/img/banner-1.jpg')}}" alt="">
                      <div class="inner-text">
                          <h4>Men’s</h4>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="single-banner">
                      <img src="{{ asset('frontend/new/img/banner-2.jpg')}}" alt="">
                      <div class="inner-text">
                          <h4>Women’s</h4>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="single-banner">
                      <img src="{{ asset('frontend/new/img/banner-3.jpg')}}" alt="">
                      <div class="inner-text">
                          <h4>Kid’s</h4>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Banner Section End -->

  <!-- Women Banner Section Begin -->
  <section class="women-banner spad">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-3">
                  <div class="product-large set-bg"
                      data-setbg="{{ asset('frontend/new/img/products/women-large.jpg')}}">
                      <h2>Women’s</h2>
                      <a href="#">Discover More</a>
                  </div>
              </div>
              <div class="col-lg-8 offset-lg-1">
                  <div class="filter-control">
                      <ul>
                          <li class="active">Clothings</li>
                          <li>HandBag</li>
                          <li>Shoes</li>
                          <li>Accessories</li>
                      </ul>
                  </div>
                  <div class="product-slider owl-carousel">
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="{{ asset('frontend/new/img/products/women-1.jpg')}}" alt="">
                              <div class="sale">Sale</div>
                              <div class="icon">
                                  <i class="icon_heart_alt"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name">Coat</div>
                              <a href="#">
                                  <h5>Pure Pineapple</h5>
                              </a>
                              <div class="product-price">
                                  $14.00
                                  <span>$35.00</span>
                              </div>
                          </div>
                      </div>
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="{{ asset('frontend/new/img/products/women-2.jpg')}}" alt="">
                              <div class="icon">
                                  <i class="icon_heart_alt"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name">Shoes</div>
                              <a href="#">
                                  <h5>Guangzhou sweater</h5>
                              </a>
                              <div class="product-price">
                                  $13.00
                              </div>
                          </div>
                      </div>
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="{{ asset('frontend/new/img/products/women-3.jpg')}}" alt="">
                              <div class="icon">
                                  <i class="icon_heart_alt"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name">Towel</div>
                              <a href="#">
                                  <h5>Pure Pineapple</h5>
                              </a>
                              <div class="product-price">
                                  $34.00
                              </div>
                          </div>
                      </div>
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="{{ asset('frontend/new/img/products/women-4.jpg')}}" alt="">
                              <div class="icon">
                                  <i class="icon_heart_alt"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name">Towel</div>
                              <a href="#">
                                  <h5>Converse Shoes</h5>
                              </a>
                              <div class="product-price">
                                  $34.00
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Women Banner Section End -->

  <!-- Deal Of The Week Section Begin-->
  <section class="deal-of-week set-bg spad" data-setbg="{{ asset('frontend/new/img/time-bg.jpg')}}">
      <div class="container">
          <div class="col-lg-6 text-center">
              <div class="section-title">
                  <h2>Deal Of The Week</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                      consectetur adipisicing elit </p>
                  <div class="product-price">
                      $35.00
                      <span>/ HanBag</span>
                  </div>
              </div>
              <div class="countdown-timer" id="countdown">
                  <div class="cd-item">
                      <span>56</span>
                      <p>Days</p>
                  </div>
                  <div class="cd-item">
                      <span>12</span>
                      <p>Hrs</p>
                  </div>
                  <div class="cd-item">
                      <span>40</span>
                      <p>Mins</p>
                  </div>
                  <div class="cd-item">
                      <span>52</span>
                      <p>Secs</p>
                  </div>
              </div>
              <a href="#" class="primary-btn">Shop Now</a>
          </div>
      </div>
  </section>
  <!-- Deal Of The Week Section End -->

  <!-- Man Banner Section Begin -->
  <section class="man-banner spad">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-8">
                  <div class="filter-control">
                      <ul>
                          <li class="active">Clothings</li>
                          <li>HandBag</li>
                          <li>Shoes</li>
                          <li>Accessories</li>
                      </ul>
                  </div>
                  <div class="product-slider owl-carousel">
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="{{ asset('frontend/new/img/products/man-1.jpg')}}" alt="">
                              <div class="sale">Sale</div>
                              <div class="icon">
                                  <i class="icon_heart_alt"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name">Coat</div>
                              <a href="#">
                                  <h5>Pure Pineapple</h5>
                              </a>
                              <div class="product-price">
                                  $14.00
                                  <span>$35.00</span>
                              </div>
                          </div>
                      </div>
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="{{ asset('frontend/new/img/products/man-2.jpg')}}" alt="">
                              <div class="icon">
                                  <i class="icon_heart_alt"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name">Shoes</div>
                              <a href="#">
                                  <h5>Guangzhou sweater</h5>
                              </a>
                              <div class="product-price">
                                  $13.00
                              </div>
                          </div>
                      </div>
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="{{ asset('frontend/new/img/products/man-3.jpg')}}" alt="">
                              <div class="icon">
                                  <i class="icon_heart_alt"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name">Towel</div>
                              <a href="#">
                                  <h5>Pure Pineapple</h5>
                              </a>
                              <div class="product-price">
                                  $34.00
                              </div>
                          </div>
                      </div>
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="{{ asset('frontend/new/img/products/man-4.jpg')}}" alt="">
                              <div class="icon">
                                  <i class="icon_heart_alt"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name">Towel</div>
                              <a href="#">
                                  <h5>Converse Shoes</h5>
                              </a>
                              <div class="product-price">
                                  $34.00
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 offset-lg-1">
                  <div class="product-large set-bg m-large"
                      data-setbg="{{ asset('frontend/new/img/products/man-large.jpg')}}">
                      <h2>Men’s</h2>
                      <a href="#">Discover More</a>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Man Banner Section End -->

  <!-- Instagram Section Begin -->
  <div class="instagram-photo">
      <div class="insta-item set-bg" data-setbg="{{ asset('frontend/new/img/insta-1.jpg')}}">
          <div class="inside-text">
              <i class="ti-instagram"></i>
              <h5><a href="#">colorlib_Collection</a></h5>
          </div>
      </div>
      <div class="insta-item set-bg" data-setbg="{{ asset('frontend/new/img/insta-2.jpg')}}">
          <div class="inside-text">
              <i class="ti-instagram"></i>
              <h5><a href="#">colorlib_Collection</a></h5>
          </div>
      </div>
      <div class="insta-item set-bg" data-setbg="{{ asset('frontend/new/img/insta-3.jpg')}}">
          <div class="inside-text">
              <i class="ti-instagram"></i>
              <h5><a href="#">colorlib_Collection</a></h5>
          </div>
      </div>
      <div class="insta-item set-bg" data-setbg="{{ asset('frontend/new/img/insta-4.jpg')}}">
          <div class="inside-text">
              <i class="ti-instagram"></i>
              <h5><a href="#">colorlib_Collection</a></h5>
          </div>
      </div>
      <div class="insta-item set-bg" data-setbg="{{ asset('frontend/new/img/insta-5.jpg')}}">
          <div class="inside-text">
              <i class="ti-instagram"></i>
              <h5><a href="#">colorlib_Collection</a></h5>
          </div>
      </div>
      <div class="insta-item set-bg" data-setbg="{{ asset('frontend/new/img/insta-6.jpg')}}">
          <div class="inside-text">
              <i class="ti-instagram"></i>
              <h5><a href="#">colorlib_Collection</a></h5>
          </div>
      </div>
  </div>
  <!-- Instagram Section End -->

  <!-- Latest Blog Section Begin -->
  <section class="latest-blog spad">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="section-title">
                      <h2>From The Blog</h2>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-4 col-md-6">
                  <div class="single-latest-blog">
                      <img src="{{ asset('frontend/new/img/latest-1.jpg')}}" alt="">
                      <div class="latest-text">
                          <div class="tag-list">
                              <div class="tag-item">
                                  <i class="fa fa-calendar-o"></i>
                                  May 4,2019
                              </div>
                              <div class="tag-item">
                                  <i class="fa fa-comment-o"></i>
                                  5
                              </div>
                          </div>
                          <a href="#">
                              <h4>The Best Street Style From London Fashion Week</h4>
                          </a>
                          <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="single-latest-blog">
                      <img src="{{ asset('frontend/new/img/latest-2.jpg')}}" alt="">
                      <div class="latest-text">
                          <div class="tag-list">
                              <div class="tag-item">
                                  <i class="fa fa-calendar-o"></i>
                                  May 4,2019
                              </div>
                              <div class="tag-item">
                                  <i class="fa fa-comment-o"></i>
                                  5
                              </div>
                          </div>
                          <a href="#">
                              <h4>Vogue's Ultimate Guide To Autumn/Winter 2019 Shoes</h4>
                          </a>
                          <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="single-latest-blog">
                      <img src="{{ asset('frontend/new/img/latest-3.jpg')}}" alt="">
                      <div class="latest-text">
                          <div class="tag-list">
                              <div class="tag-item">
                                  <i class="fa fa-calendar-o"></i>
                                  May 4,2019
                              </div>
                              <div class="tag-item">
                                  <i class="fa fa-comment-o"></i>
                                  5
                              </div>
                          </div>
                          <a href="#">
                              <h4>How To Brighten Your Wardrobe With A Dash Of Lime</h4>
                          </a>
                          <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="benefit-items">
              <div class="row">
                  <div class="col-lg-4">
                      <div class="single-benefit">
                          <div class="sb-icon">
                              <img src="{{ asset('frontend/new/img/icon-1.png')}}" alt="">
                          </div>
                          <div class="sb-text">
                              <h6>Free Shipping</h6>
                              <p>For all order over 99$</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <div class="single-benefit">
                          <div class="sb-icon">
                              <img src="{{ asset('frontend/new/img/icon-2.png')}}" alt="">
                          </div>
                          <div class="sb-text">
                              <h6>Delivery On Time</h6>
                              <p>If good have prolems</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <div class="single-benefit">
                          <div class="sb-icon">
                              <img src="{{ asset('frontend/new/img/icon-1.png')}}" alt="">
                          </div>
                          <div class="sb-text">
                              <h6>Secure Payment</h6>
                              <p>100% secure payment</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Latest Blog Section End -->

  <!-- Partner Logo Section Begin -->
  <div class="partner-logo">
      <div class="container">
          <div class="logo-carousel owl-carousel">
              <div class="logo-item">
                  <div class="tablecell-inner">
                      <img src="{{ asset('frontend/new/img/logo-carousel/logo-1.png')}}" alt="">
                  </div>
              </div>
              <div class="logo-item">
                  <div class="tablecell-inner">
                      <img src="{{ asset('frontend/new/img/logo-carousel/logo-2.png')}}" alt="">
                  </div>
              </div>
              <div class="logo-item">
                  <div class="tablecell-inner">
                      <img src="{{ asset('frontend/new/img/logo-carousel/logo-3.png')}}" alt="">
                  </div>
              </div>
              <div class="logo-item">
                  <div class="tablecell-inner">
                      <img src="{{ asset('frontend/new/img/logo-carousel/logo-4.png')}}" alt="">
                  </div>
              </div>
              <div class="logo-item">
                  <div class="tablecell-inner">
                      <img src="{{ asset('frontend/new/img/logo-carousel/logo-5.png')}}" alt="">
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Partner Logo Section End -->
  @include('landing.includes.landingFooter')
