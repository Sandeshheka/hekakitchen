<?php

//social page
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');


Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/userLogout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

//Admin Category Section//
Route::get('/categories', 'Admin\Category\CategoryController@index')->name('categories');
Route::post('/addCategory', 'Admin\Category\CategoryController@storeCategory')->name('category.store');
Route::get('/deleteCategory/{id}', 'Admin\Category\CategoryController@deleteCategory');
Route::get('/editCategory/{id}', 'Admin\Category\CategoryController@editCategory');
Route::post('/updateCategory/{id}', 'Admin\Category\CategoryController@updateCategory');


//Admin Brand Section//
Route::get('/brands', 'Admin\Category\BrandController@index')->name('brands');
Route::post('/addBrand', 'Admin\Category\BrandController@storeBrand')->name('brand.store');
Route::get('/deleteBrand/{id}', 'Admin\Category\BrandController@deleteBrand');
Route::get('/editBrand/{id}', 'Admin\Category\BrandController@editBrand');
Route::post('/updateBrand/{id}', 'Admin\Category\BrandController@updateBrand');


//Admin Subcategories Section//
Route::get('/subCategories', 'Admin\Category\SubCategoryController@index')->name('subCategories');
Route::post('/addSubCategory', 'Admin\Category\SubCategoryController@storeSubCategory')->name('subcategory.store');
Route::get('/deleteSubCategory/{id}', 'Admin\Category\SubCategoryController@deleteSubCategory');
Route::get('/editSubCategory/{id}', 'Admin\Category\SubCategoryController@editSubCategory');
Route::post('/updateSubCategory/{id}', 'Admin\Category\SubCategoryController@updateSubCategory');


//Admin Subcategories Section//
Route::get('/coupons', 'Admin\Category\CouponController@index')->name('coupons');
Route::post('/addCoupon', 'Admin\Category\CouponController@storeCoupon')->name('coupon.store');
Route::get('/deleteCoupon/{id}', 'Admin\Category\CouponController@deleteCoupon');
Route::get('/editCoupon/{id}', 'Admin\Category\CouponController@editCoupon');
Route::post('/updateCoupon/{id}', 'Admin\Category\CouponController@updateCoupon');


//Admin NewsLater Section//
Route::get('/newslater', 'Admin\Category\CouponController@NewsLater')->name('newslater');

Route::get('/deleteNewslater/{id}', 'Admin\Category\CouponController@deleteNewslater');
Route::get('/editNewslater/{id}', 'Admin\Category\CouponController@editNewslater');
Route::post('/updateNewslater/{id}', 'Admin\Category\CouponController@updateNewslater');




//Admin Product Section
Route::get('/viewAllProduct', 'Admin\ProductController@index')->name('all.product');
Route::get('/viewProduct/{id}', 'Admin\ProductController@singleProduct');
Route::get('/addProduct', 'Admin\ProductController@createProduct')->name('add.product');
Route::post('/insert', 'Admin\ProductController@insertProduct')->name('insert.product');
Route::get('/deleteProduct/{id}', 'Admin\ProductController@deleteProduct');
Route::get('/editProduct/{id}', 'Admin\ProductController@editProduct');
Route::post('/updateProduct/{id}', 'Admin\ProductController@updateProduct');
Route::post('/updateProductPhoto/{id}', 'Admin\ProductController@updateProductPhoto');
Route::get('/inactiveProduct/{id}', 'Admin\ProductController@inactiveProduct');
Route::get('/activeProduct/{id}', 'Admin\ProductController@activeProduct');


//For Subcategory Show
Route::get('/get/subcategory/{category_id}', 'Admin\ProductController@getSub');
//Blog Admin
Route::get('/blogCategory', 'Admin\PostController@blogCatList')->name('add.blog');
Route::post('/storeBlogCategory', 'Admin\PostController@blogCatStore')->name('category.storeBlog');
Route::get('/deleteBlogCategory/{id}', 'Admin\PostController@deleteBlogCat');
Route::get('/editBlogCategory/{id}', 'Admin\PostController@editBlogCat');
Route::post('/updateBlogCategory/{id}', 'Admin\PostController@updateBlogCategory');

//For Post 
Route::get('/addBlogPost', 'Admin\PostController@createBlogPost')->name('add.blogPost');
Route::post('/insertBlogPost', 'Admin\PostController@insertBlogPost')->name('insert.blogPost');
Route::get('/viewAllBlogPost', 'Admin\PostController@index')->name('all.blogPost');
Route::get('/editBlogPost/{id}', 'Admin\PostController@editBlogPost');
Route::post('/updateBlogPost/{id}', 'Admin\PostController@updateBlogPost');
Route::get('/deleteBlogPost/{id}', 'Admin\PostController@deleteBlogPost');



//Fornt Controller 
Route::post('/addNewslater', 'FrontController@storeNewslater')->name('newslater.store');

//Add wishlist
Route::get('/addWishlist/{id}', 'WishlistConrtoller@addWishlist');



//Add Cart
Route::get('/addCart/{id}', 'CartController@addToCart');
Route::get('/check', 'CartController@check');
Route::get('/productCart', 'CartController@showCart')->name('show.cart');
Route::get('/removeCart/{rowId}', 'CartController@removeCart');
Route::post('/updateCart', 'CartController@updateCart')->name('update.cartItem');
Route::get('/cartProductView/{id}', 'CartController@viewProduct');
Route::post('/insertCart', 'CartController@insertCart')->name('insert.cart');



Route::get('/productDetails/{id}/{product_name}', 'productController@productDetail');
Route::post('/addCartProduct/{id}', 'productController@addCart');


//checkout
Route::post('/applyCoupon', 'CartController@coupon')->name('apply.coupon');
Route::get('/userCheckout', 'CartController@checkout')->name('user.checkout');
Route::get('/userWishlist', 'CartController@wishlist')->name('user.wishlist');
Route::get('/couponRemove', 'CartController@CouponRemove')->name('coupon.remove');


//blog post rooute
Route::get('/blogPost', 'BlogController@blog')->name('blog.post');
Route::get('/languageEnglish', 'BlogController@English')->name('language.english');
Route::get('/languageNepali', 'BlogController@Nepali')->name('language.nepali');
Route::get('/blogSingle/{id}', 'BlogController@singleBlog');

//payement step

Route::get('/paymentPage', 'CartController@paymentPage')->name('payment.step');
Route::post('/payment', 'PaymentController@paymentProcess')->name('payment.process');


Route::get('/products/{id}', 'ProductController@productView');
Route::get('/allCategory/{id}', 'ProductController@categoryView');

Route::post('/userStripeCharge', 'PaymentController@stripeCharge')->name('stripe.charge');

//admin order route
Route::get('/pendingOrder', 'Admin\OrderController@newOrder')->name('admin.newOrder');
Route::get('/adminViewOrder/{id}', 'Admin\OrderController@viewOrder');
Route::get('/adminPaymentAccept/{id}', 'Admin\OrderController@paymentAccept');
Route::get('/adminPaymentCancel/{id}', 'Admin\OrderController@paymentCancel');
Route::get('/adminDeleveryProcess/{id}', 'Admin\OrderController@deliveryProgress');
Route::get('/adminDeleveryDone/{id}', 'Admin\OrderController@deliveryDone');
Route::get('/adminAcceptPayment', 'Admin\OrderController@acceptPayment')->name('admin.acceptPayment');
Route::get('/adminCancelPayment', 'Admin\OrderController@cancelPayment')->name('admin.cancelPayment');
Route::get('/adminProgressDelivery', 'Admin\OrderController@progressDelivery')->name('admin.progressDelivery');
Route::get('/adminDelivered', 'Admin\OrderController@delivery')->name('admin.delivery');



Route::get('/adminSeo', 'Admin\SeoController@seoView')->name('admin.seo');
Route::post('/seoUpdate', 'Admin\SeoController@seoUpdate')->name('update.seo');


Route::post('/orderTrack', 'FrontController@orderTrack')->name('order.tracking');

//report

Route::get('/adminTodayOrder', 'Admin\ReportController@todayOrder')->name('today.order');
Route::get('/adminTodayDelivery', 'Admin\ReportController@todayDelivery')->name('today.delivery');
Route::get('/adminThisMonth', 'Admin\ReportController@thisMonth')->name('this.month');
Route::get('/adminSearchReport', 'Admin\ReportController@searchReport')->name('search.report');
Route::post('/adminSearchDate', 'Admin\ReportController@SearchByDate')->name('search.by.date');
Route::post('/adminSearchMonth', 'Admin\ReportController@searchByMonth')->name('search.by.month');
Route::post('/adminSearchYear', 'Admin\ReportController@SearchByYear')->name('search.by.year');


//user acl

Route::get('/createUser', 'Admin\UserRoleController@createUser')->name('create.admin');
Route::get('/allUser', 'Admin\UserRoleController@allUser')->name('all.user');
Route::post('/storeUserRole', 'Admin\UserRoleController@storeRole')->name('store.admin');
Route::get('/editUserRole/{id}', 'Admin\UserRoleController@editUserRole');
Route::get('/deleteUserRole/{id}', 'Admin\UserRoleController@deleteUserRole');
Route::post('/updateUserRole', 'Admin\UserRoleController@updateRole')->name('update.admin');


// admin sitesetting
Route::get('/siteSetting', 'Admin\SitesettingController@allSiteSetting')->name('admin.siteSetting');
Route::post('/updateSetting', 'Admin\SitesettingController@updateSetting')->name('update.sitesetting');


//return order
Route::get('/successList', 'PaymentController@successOrder')->name('success.orderList');
Route::get('/requestReturn/{id}', 'PaymentController@requestReturn');

//admin return order
Route::get('/returnRequest', 'Admin\ReturnController@returnRequest')->name('return.request');
Route::get('/allReturnRequest', 'Admin\ReturnController@allReturn')->name('all.request');
Route::get('/adminApproveReturn/{id}', 'Admin\ReturnController@approveReturn');


//order stock
Route::get('/adminProductStock', 'Admin\UserRoleController@productStock')->name('admin.productStock');


//contact page
Route::get('/contactPage', 'ContactController@contact')->name('contact.page');
Route::post('/insertContact', 'ContactController@contactForm')->name('contact.form');
Route::get('/all/Message', 'ContactController@allMessage')->name('all.contact');


Route::post('/productSearch', 'CartController@search')->name('product.search');

