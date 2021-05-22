<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Admin Authentication Routes

Route::group(['prefix'=>'admin','namespace'=>'Auth'],function(){

    Route::get('/login','AdminLoginController@getLogin')->name('admin.getlogin');
    Route::post('/login','AdminLoginController@login')->name('admin.login');
});


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

    Route::get('/','DashboardController@index')->name('admin.index');
    Route::get('/profile','DashboardController@profile')->name('admin.profile');
    Route::post('/profile','DashboardController@updateProfile')->name('admin.updateprofile');
    Route::post('/photo','DashboardController@updatePhoto')->name('admin.updatephoto');
    Route::post('/password','DashboardController@updatePassword')->name('admin.updatepassword');


    Route::group(['prefix'=>'banks'],function(){

        Route::get('/','BankController@index')->name('admin.banks.index');
        Route::get('create','BankController@create')->name('admin.banks.create');
        Route::post('create','BankController@store')->name('admin.banks.store');
        Route::get('edit/{id}','BankController@edit')->name('admin.banks.edit');
        Route::post('update/','BankController@update')->name('admin.banks.update');
        Route::post('delete/','BankController@delete')->name('admin.banks.delete');
        Route::post('changestatus/','BankController@changeStatus')->name('admin.banks.changestatus');
        Route::post('details/','BankController@details')->name('admin.banks.details');

    });

    Route::get('/contact','Website\ContactController@index')->name('admin.contact.show');

    Route::group(['prefix'=>'customers'],function(){

        Route::get('/','CustomerController@index')->name('admin.customers.index');
        Route::post('delete/','CustomerController@delete')->name('admin.customers.delete');
        Route::post('changestatus/','CustomerController@changeStatus')->name('admin.customers.changestatus');
        Route::post('details/','CustomerController@details')->name('admin.customers.details');

    });

    Route::group(['prefix'=>'transactions'],function(){

        Route::get('/','TransactionController@index')->name('admin.transactions.index');
        Route::get('/transactionsbyid/{id}','TransactionController@getTransactionsById')->name('admin.transactions.transactionsbyid');


    });


    Route::group(['prefix'=>'admins'],function(){

        Route::get('/','AdminController@index')->name('admin.admins.index');
        Route::get('create','AdminController@create')->name('admin.admins.create');
        Route::post('create','AdminController@store')->name('admin.admins.store');
        Route::get('edit/{id}','AdminController@edit')->name('admin.admins.edit');
        Route::post('update/','AdminController@update')->name('admin.admins.update');
        Route::post('delete/','AdminController@delete')->name('admin.admins.delete');
        Route::post('changestatus/','AdminController@changeStatus')->name('admin.admins.changestatus');
        Route::post('details/','AdminController@details')->name('admin.admins.details');

    });


    Route::group(['prefix'=>'website','namespace'=>'Website',['middleware'=>'blockednobalance']],function (){

        Route::group(['prefix'=>'header'],function (){

            Route::get('/','HeaderController@index')->name('admin.header.index');
            Route::get('/create','HeaderController@create')->name('admin.header.create');
            Route::post('/create','HeaderController@store')->name('admin.header.store');
            Route::get('/edit{id}','HeaderController@edit')->name('admin.header.edit');
            Route::post('/update','HeaderController@update')->name('admin.header.update');
            Route::post('/delate','HeaderController@delete')->name('admin.header.delete');
            Route::post('/changestatus','HeaderController@changeStatus')->name('admin.header.changestatus');


        });
        Route::group(['prefix'=>'aboutusheader'],function (){

            Route::get('/','AboutusHeaderController@index')->name('admin.aboutusheader.index');
            Route::get('/create','AboutusHeaderController@create')->name('admin.aboutusheader.create');
            Route::post('/create','AboutusHeaderController@store')->name('admin.aboutusheader.store');
            Route::get('/edit{id}','AboutusHeaderController@edit')->name('admin.aboutusheader.edit');
            Route::post('/update','AboutusHeaderController@update')->name('admin.aboutusheader.update');
            Route::post('/delate','AboutusHeaderController@delete')->name('admin.aboutusheader.delete');
            Route::post('/changestatus','AboutusHeaderController@changeStatus')->name('admin.aboutusheader.changestatus');


        });

        Route::group(['prefix'=>'aboutusshortcut'],function (){

            Route::get('/','AboutusShortcutController@index')->name('admin.aboutusshortcut.index');
            Route::get('/create','AboutusShortcutController@create')->name('admin.aboutusshortcut.create');
            Route::post('/create','AboutusShortcutController@store')->name('admin.aboutusshortcut.store');
            Route::get('/edit{id}','AboutusShortcutController@edit')->name('admin.aboutusshortcut.edit');
            Route::post('/update','AboutusShortcutController@update')->name('admin.aboutusshortcut.update');
            Route::post('/delate','AboutusShortcutController@delete')->name('admin.aboutusshortcut.delete');
            Route::post('/changestatus','AboutusShortcutController@changeStatus')->name('admin.aboutusshortcut.changestatus');


        });

        Route::group(['prefix'=>'gallery'],function (){

            Route::get('/','GalleryController@index')->name('admin.gallery.index');
            Route::get('/create','GalleryController@create')->name('admin.gallery.create');
            Route::post('/create','GalleryController@store')->name('admin.gallery.store');
            Route::get('/edit{id}','GalleryController@edit')->name('admin.gallery.edit');
            Route::post('/update','GalleryController@update')->name('admin.gallery.update');
            Route::post('/delate','GalleryController@delete')->name('admin.gallery.delete');
            Route::post('/changestatus','GalleryController@changeStatus')->name('admin.gallery.changestatus');


        });

        Route::group(['prefix'=>'howitworks'],function (){

            Route::get('/','HowItWorksController@index')->name('admin.howitworks.index');
            Route::get('/create','HowItWorksController@create')->name('admin.howitworks.create');
            Route::post('/create','HowItWorksController@store')->name('admin.howitworks.store');
            Route::get('/edit{id}','HowItWorksController@edit')->name('admin.howitworks.edit');
            Route::post('/update','HowItWorksController@update')->name('admin.howitworks.update');
            Route::post('/delate','HowItWorksController@delete')->name('admin.howitworks.delete');
            Route::post('/changestatus','HowItWorksController@changeStatus')->name('admin.howitworks.changestatus');


        });

        Route::group(['prefix'=>'ourservices'],function (){

            Route::get('/','OurServicesController@index')->name('admin.ourservices.index');
            Route::get('/create','OurServicesController@create')->name('admin.ourservices.create');
            Route::post('/create','OurServicesController@store')->name('admin.ourservices.store');
            Route::get('/edit{id}','OurServicesController@edit')->name('admin.ourservices.edit');
            Route::post('/update','OurServicesController@update')->name('admin.ourservices.update');
            Route::post('/delate','OurServicesController@delete')->name('admin.ourservices.delete');
            Route::post('/changestatus','OurServicesController@changeStatus')->name('admin.ourservices.changestatus');


        });

        Route::group(['prefix'=>'testimonials'],function (){

            Route::get('/','TestimonialController@index')->name('admin.testimonials.index');
            Route::post('/delate','TestimonialController@delete')->name('admin.testimonials.delete');
            Route::post('/changestatus','TestimonialController@changeStatus')->name('admin.testimonials.changestatus');


        });


        Route::group(['prefix'=>'contactusmanage'],function (){

            Route::get('/','ContactUsManageController@index')->name('admin.contactusmanage.index');
            Route::get('/edit','ContactUsManageController@edit')->name('admin.contactusmanage.edit');
            Route::post('/update','ContactUsManageController@update')->name('admin.contactusmanage.update');
            Route::post('/changestatus','ContactUsManageController@changeStatus')->name('admin.contactusmanage.changestatus');


        });
    });



});











Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


//Website Routes
Route::group(['namespace'=>'Website'],function (){

    Route::get('/','HomeController@home')->name('welcome');
    Route::get('/aboutus','HomeController@aboutUs')->name('aboutus');
    Route::get('/gallery','HomeController@gallery')->name('gallery');
    Route::get('/services','HomeController@services')->name('services');
    Route::get('/testimonials','HomeController@testimonials')->name('testimonials');
    Route::get('/contact','HomeController@contact')->name('contact');
    Route::post('/contact','HomeController@contactUs')->name('contact.us');

});


//Customer Routes
Route::group(['prefix'=>'user','namespace'=>'Customer'],function (){

    Route::group(['prefix'=>'profile','middleware'=>['verified','blocked']],function(){
        Route::get('/','ProfileController@index')->name('customer.profile.index');
        Route::post('/update','ProfileController@updateProfile')->name('customer.profile.update');
        Route::post('/photo','ProfileController@updateImage')->name('customer.profile.photo');
        Route::post('/password','ProfileController@updatePassword')->name('customer.profile.password');
    });
    Route::group(['prefix'=>'transfer','middleware'=>['verified','blocked']],function(){
        Route::get('/','TransferController@index')->name('customer.transfer.index');
        Route::post('/checkemail','TransferController@checkEmail')->name('customer.transfer.checkemail');
        Route::post('/checkamount','TransferController@checkAmount')->name('customer.transfer.checkamount');
        Route::post('/send','TransferController@send')->name('customer.transfer.send');
    });
     Route::group(['prefix'=>'transactions','middleware'=>['verified','blocked']],function(){
            Route::get('/','TransactionsController@index')->name('customer.transactions.index');
        });
     Route::group(['prefix'=>'rate','middleware'=>['verified','blocked']],function(){
            Route::get('/','RateController@index')->name('customer.rate.index');
            Route::post('/','RateController@send')->name('customer.rate.send');
        });
     Route::group(['prefix'=>'accounts','middleware'=>['verified']],function(){
            Route::get('/','AccountsController@index')->name('customer.accounts.index');
            Route::get('/add','AccountsController@add')->name('customer.accounts.add');
            Route::post('/add','AccountsController@addAccount')->name('customer.accounts.addAccount');
            Route::get('/deposit','AccountsController@deposit')->name('customer.accounts.deposit');
            Route::post('/deposit','AccountsController@depositBalance')->name('customer.accounts.depositbalance');
            Route::group(['prefix'=>'accounts','middleware'=>['blocked']],function() {
                Route::get('/delete{id}', 'AccountsController@delete')->name('customer.accounts.delete');
                Route::get('/withdrawal', 'AccountsController@withdrawal')->name('customer.accounts.withdrawal');
                Route::post('/withdrawal', 'AccountsController@withdrawalBalance')->name('customer.accounts.withdrawalbalance');
            });

        });

});

Route::get('/test',function (){
   return view('website.customers.accounts.add');
});

