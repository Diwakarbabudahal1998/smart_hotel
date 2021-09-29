<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function () {
 Route::post('/login', 'LoginController@login');
 Route::post('/register', 'UserController@register');
 Route::post('/sendVerificationCode', 'UserController@sendVerificationCode');
 Route::post('/checkVerificationCode', 'UserController@checkVerificationCode');

 Route::group(['middleware' => 'auth:api'], function () {
  Route::get('/logout', 'LoginController@logout');
  Route::post('/update', 'UserController@updateProfile');
  Route::post('/changepassword', 'UserController@changePassword');
 });
});

Route::group(['middleware' => 'auth:api'], function () {
 //Tax APIs
 Route::get('/tax/get', 'TaxController@getTax');
 Route::post('/tax/add', 'TaxController@store');
 Route::post('/tax/update', 'TaxController@update');
 Route::post('/tax/delete/{id}', 'TaxController@destroy');
 Route::post('/tax/deleteMass', 'TaxController@deleteMass');

 //Table APIs
 Route::get('/table/get', 'TableController@getTable');
 Route::post('/table/add', 'TableController@store');
 Route::post('/table/update', 'TableController@update');
 Route::post('/table/delete/{id}', 'TableController@destroy');
 Route::post('/table/deleteMass', 'TableController@deleteMass');

 //Printer APIS
 Route::post('/printer/add', 'PrinterController@store');
 Route::post('/printer/update', 'PrinterController@update');
 Route::get('/printer/singleView/{id}', 'PrinterController@singleView');
 Route::get('/printer/viewAll', 'PrinterController@viewAll');

 //Extra Apis
 Route::post('/extra/add', 'ExtraController@store');
 Route::post('/extra/update', 'ExtraController@update');
 Route::post('/extra/delete/{id}', 'ExtraController@delete');
 Route::get('/extra/viewAll', 'ExtraController@viewAll');
 Route::post('/extra/deleteMass', 'ExtraController@deleteMass');

 //Guest APIs
 Route::get('/guest/getall', 'GuestController@getGuests');
 Route::get('/guest/getSingleGuest/{id}', 'GuestController@getSingleGuestDetail');
 Route::post('/guest/add', 'GuestController@store');
 Route::post('/guest/update', 'GuestController@update');
 Route::post('/guest/delete/{id}', 'GuestController@destroy');
 Route::post('/guest/deleteMass', 'GuestController@deleteMass');

 //Room Type APIs
 Route::get('/roomtype/getall', 'RoomTypeController@getRoomTypes');
 Route::post('/roomtype/add', 'RoomTypeController@store');
 Route::post('/roomtype/update', 'RoomTypeController@update');
 Route::post('/roomtype/delete/{id}', 'RoomTypeController@destroy');
 Route::post('/roomtype/deleteMass', 'RoomTypeController@deleteMass');

 //Room APIs
 Route::get('/room/getall', 'RoomController@getRooms');
 Route::post('/room/add', 'RoomController@store');
 Route::post('/room/update', 'RoomController@update');
 Route::post('/room/delete/{id}', 'RoomController@destroy');
 Route::post('/room/deleteMass', 'RoomController@deleteMass');

 //Category APIs
 Route::get('/category/getall', 'CategoryController@getCategories');
 Route::post('/category/add', 'CategoryController@store');
 Route::post('/category/update', 'CategoryController@update');
 Route::post('/category/delete/{id}', 'CategoryController@destroy');
 Route::post('/category/deleteMass', 'CategoryController@deleteMass');

 //Menu APIs
 Route::get('/menu/getall', 'MenuController@getMenus');
 Route::post('/menu/add', 'MenuController@store');
 Route::post('/menu/update', 'MenuController@update');
 Route::post('/menu/delete/{id}', 'MenuController@destroy');
 Route::post('/menu/deleteMass', 'MenuController@deleteMass');

 //Booking APIs
 Route::get('/booking/getall', 'BookingController@getAllBookings');
 Route::get('/booking/arrivingToday', 'BookingController@getAllArrivingBookings');
 Route::post('/booking/add', 'BookingController@store');
 Route::post('/booking/update', 'BookingController@update');
 Route::get('/booking/getSingleBooking/{id}', 'BookingController@getSingleBooking');
 Route::get('/booking/checkin/{id}', 'BookingController@checked_In');
 Route::get('/booking/checkout/{id}', 'BookingController@checked_Out');
 Route::post('/booking/filter', 'BookingController@filter');

 //Booking Payment Api

 Route::post('/bookingpayment/add', 'BookingPaymentController@addPayment');

 //Home APIs
 Route::post('/home/getall', 'HomeController@getBookingDetails');

 //Discount Apis
 Route::post('/discount/add', 'DiscountController@store');
 Route::post('/discount/update', 'DiscountController@update');
 Route::post('/discount/delete/{id}', 'DiscountController@delete');
 Route::get('/discount/viewAll', 'DiscountController@viewAll');
 Route::post('/discount/deleteMass', 'DiscountController@deleteMass');
 //Guest APIs
 Route::get('/guest/getall', 'GuestController@getGuests');
 Route::get('/guest/getSingleGuest/{id}', 'GuestController@getSingleGuestDetail');
 Route::post('/guest/add', 'GuestController@store');
 Route::post('/guest/update', 'GuestController@update');
 Route::post('/guest/delete/{id}', 'GuestController@destroy');
 Route::post('/guest/deleteMass', 'GuestController@deleteMass');

 //Room Type APIs
 Route::get('/roomtype/getall', 'RoomTypeController@getRoomTypes');
 Route::post('/roomtype/add', 'RoomTypeController@store');
 Route::post('/roomtype/update', 'RoomTypeController@update');
 Route::post('/roomtype/delete/{id}', 'RoomTypeController@destroy');
 Route::post('/roomtype/deleteMass', 'RoomTypeController@deleteMass');

 //Room APIs
 Route::get('/room/getall', 'RoomController@getRooms');
 Route::post('/room/add', 'RoomController@store');
 Route::post('/room/update', 'RoomController@update');
 Route::post('/room/delete/{id}', 'RoomController@destroy');
 Route::post('/room/deleteMass', 'RoomController@deleteMass');

 //Category APIs
 Route::get('/category/getall', 'CategoryController@getCategories');
 Route::post('/category/add', 'CategoryController@store');
 Route::post('/category/update', 'CategoryController@update');
 Route::post('/category/delete/{id}', 'CategoryController@destroy');
 Route::post('/category/deleteMass', 'CategoryController@deleteMass');

 //Menu APIs
 Route::get('/menu/getall', 'MenuController@getMenus');
 Route::post('/menu/add', 'MenuController@store');
 Route::post('/menu/update', 'MenuController@update');
 Route::post('/menu/delete/{id}', 'MenuController@destroy');
 Route::post('/menu/deleteMass', 'MenuController@deleteMass');

 //Booking APIs
 Route::get('/booking/getall', 'BookingController@getAllBookings');
 Route::post('/booking/add', 'BookingController@store');
 Route::post('/booking/update', 'BookingController@update');
 Route::get('/booking/getSingleBooking/{id}', 'BookingController@getSingleBooking');
 //Route::post('/booking/delete/{id}','BookingController@destroy');
 //Route::post('/booking/deleteMass','BookingController@deleteMass');

 //Home APIs
 Route::post('/home/getall', 'HomeController@getBookingDetails');

 //Discount Apis
 Route::post('/discount/add', 'DiscountController@store');
 Route::post('/discount/update', 'DiscountController@update');
 Route::post('/discount/delete/{id}', 'DiscountController@delete');
 Route::get('/discount/viewAll', 'DiscountController@viewAll');
 Route::post('/discount/deleteMass', 'DiscountController@deleteMass');
 //Guest APIs
 Route::get('/guest/getall', 'GuestController@getGuests');
 Route::get('/guest/getSingleGuest/{id}', 'GuestController@getSingleGuestDetail');
 Route::post('/guest/add', 'GuestController@store');
 Route::post('/guest/update', 'GuestController@update');
 Route::post('/guest/delete/{id}', 'GuestController@destroy');
 Route::post('/guest/deleteMass', 'GuestController@deleteMass');

 //Room Type APIs
 Route::get('/roomtype/getall', 'RoomTypeController@getRoomTypes');
 Route::post('/roomtype/add', 'RoomTypeController@store');
 Route::post('/roomtype/update', 'RoomTypeController@update');
 Route::post('/roomtype/delete/{id}', 'RoomTypeController@destroy');
 Route::post('/roomtype/deleteMass', 'RoomTypeController@deleteMass');

 //Room APIs
 Route::get('/room/getall', 'RoomController@getRooms');
 Route::post('/room/add', 'RoomController@store');
 Route::post('/room/update', 'RoomController@update');
 Route::post('/room/delete/{id}', 'RoomController@destroy');
 Route::post('/room/deleteMass', 'RoomController@deleteMass');

 //Category APIs
 Route::get('/category/getall', 'CategoryController@getCategories');
 Route::post('/category/add', 'CategoryController@store');
 Route::post('/category/update', 'CategoryController@update');
 Route::post('/category/delete/{id}', 'CategoryController@destroy');
 Route::post('/category/deleteMass', 'CategoryController@deleteMass');

 //Discount Apis
 Route::post('/discount/add', 'DiscountController@store');
 Route::post('/discount/update', 'DiscountController@update');
 Route::post('/discount/delete/{id}', 'DiscountController@delete');
 Route::get('/discount/viewAll', 'DiscountController@viewAll');
 Route::post('/discount/deleteMass', 'DiscountController@deleteMass');

 //Booking Apis
 Route::get('/booking/get', 'BookingHeadingController@getHeading');
 Route::post('/booking/update', 'BookingHeadingController@update');

 //Guest APIs
 Route::get('/guest/getall', 'GuestController@getGuests');
 Route::get('/guest/getSingleGuest', 'GuestController@getSingleGuestDetail');
 Route::post('/guest/add', 'GuestController@store');
 Route::post('/guest/update', 'GuestController@update');
 Route::post('guest/delete/{id}', 'GuestController@destroy');
 Route::post('/guest/deleteMass', 'GuestController@deleteMass');
 //Discount Apis
 Route::post('/discount/add', 'DiscountController@store');
 Route::post('/discount/update', 'DiscountController@update');
 Route::post('/discount/delete/{id}', 'DiscountController@delete');
 Route::get('/discount/viewAll', 'DiscountController@viewAll');
 Route::post('/discount/deleteMass', 'DiscountController@deleteMass');

 //Charge Apis
 Route::post('/charge/add', 'ChargeController@store');
 Route::post('/charge/update', 'ChargeController@update');
 Route::post('/charge/delete/{id}', 'ChargeController@delete');
 Route::get('/charge/viewAll', 'ChargeController@viewAll');
 Route::post('/charge/deleteMass', 'ChargeController@deleteMass');

 //Subscription APIS
 Route::post('/subscription/add', 'SubscriptionController@store');
 Route::post('/subscription/update', 'SubscriptionController@update');
 Route::post('/subscription/delete/{id}', 'SubscriptionController@delete');
 Route::get('/subscription/viewAll', 'SubscriptionController@viewAll');
 Route::get('/subscription/singleView/{id}', 'SubscriptionController@singleView');
 Route::post('/subscription/deleteMass', 'SubscriptionController@deleteMass');

 // Billing APIS
 Route::post('/billing/add', 'BillingController@store');
 Route::post('/billing/update', 'BillingController@update');
 Route::get('/billing/viewAll', 'BillingController@viewAll');
 Route::get('/billing/singleView/{id}', 'BillingController@singleView');

//Employee Apis
 Route::post('/employee/add', 'EmployeeController@store');
 Route::post('/employee/update', 'EmployeeController@update');
 Route::post('/employee/delete/{id}', 'EmployeeController@delete');
 Route::get('/employee/viewAll', 'EmployeeController@viewAll');
 Route::get('/employee/singleView/{id}', 'EmployeeController@singleView');
 Route::post('/employee/deleteMass', 'EmployeeController@deleteMass');

 //Payment APIs
 Route::post('/payment/add', 'PaymentController@store');
 Route::post('/payment/update', 'PaymentController@update');
 Route::get('/payment/viewAll', 'PaymentController@viewAll');
 Route::get('/payment/singleView/{id}', 'PaymentController@singleView');
 Route::post('/payment/delete/{id}', 'PaymentController@delete');
 Route::post('/payment/deleteMass', 'PaymentController@deleteMass');

 //Table Order APIs
 Route::post('/table/order', 'OrderController@tableOrderstore');
 Route::post('/order/complete', 'OrderController@completeTableOrder');
 Route::get('/order/getTableOrder', 'OrderController@getOrderByTable');

//guestOrder
 Route::post('/order/guestorder', 'OrderController@guestOrder');
 Route::post('/roomorder/complete', 'OrderController@completeRoomOrder');
 Route::get('/order/getTableRoomOrder', 'OrderController@getOrderByRoom');
 //Addons APIs
 Route::post('/addon/add', 'AddonController@store');
 Route::post('/addon/update', 'AddonController@update');
 Route::post('/addon/delete/{id}', 'AddonController@delete');
 Route::get('/addon/viewAll', 'AddonController@viewAll');
 Route::post('/addon/deleteMass', 'AddonController@deleteMass');
 //Expense APIs
 Route::post('/expense/add', 'ExpenseController@store');
 Route::post('/expense/update', 'ExpenseController@update');
 Route::post('/expense/delete/{id}', 'ExpenseController@delete');
 Route::get('/expense/viewAll', 'ExpenseController@viewAll');
 Route::post('/expense/deleteMass', 'ExpenseController@deleteMass');

});

Route::group(['middleware' => 'auth:api'], function () {
 Route::get('/test', 'TestController@test');
});