<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['check/reservation'] = 'Crontjob/checkStatusReservation';
$route['check/booking'] = 'Crontjob/checkStatusBooking';

$route['default_controller'] = 'web';

//route for authentication
$route['loginSeller'] = 'auth/loginSeller';
$route['registerSeller'] = 'auth/registerSeller';
$route['logoutSeller'] = 'auth/logoutSeller';
$route['loginCustomer'] = 'auth/loginCustomer';
$route['loginCustomer/(:any)/(:any)/(:any)'] ='auth/loginCUstomer/$1/$1/$1';
$route['logoutCustomer'] = 'auth/logoutCustomer';
$route['registerCustomer'] = 'auth/registerCustomer';

//route for user seller

$route['denah/(:any)'] = 'seller/denah/$1';
$route['denah/tambah/(:any)'] = 'seller/tambahDenah/$1';
$route['denah/edit/(:any)/(:any)'] = 'seller/editDenah/$1/$1';
$route['denah/delete/(:any)/(:any)'] = 'seller/deleteDenah/$1/$1';
$route['dasboardSeller'] = 'seller/dasboardSeller';
$route['hotelLists'] = 'seller/hotelLists';
$route['addHotel'] = 'seller/addHotel';
$route['editHotel/(:any)'] = 'seller/editHotel/$1';
$route['deleteHotel/(:any)'] = 'seller/deleteHotel/$1';
$route['manageHotelFacility'] ='seller/ManageHotelFacility';
$route['manageHotelPayment'] = 'seller/manageHotelPayment';
$route['editPayment/(:any)'] = 'seller/editPayment/$1';
$route['addHotelPayment'] = 'seller/addHotelPayment';
$route['deletePayment/(:any)'] = 'seller/deletePayment/$1';
$route['editHotelFacility/(:any)'] = 'seller/editHotelFacility/$1';
$route['addHotelFacility'] = 'seller/addHotelFacility';
$route['deleteHotelFacility/(:any)'] = 'seller/deleteHotelFacility/$1';
$route['roomTypeLists/(:any)'] = 'seller/roomTypeLists/$1';
$route['manageRoomFacilityType/(:any)'] = 'seller/manageRoomFacilityType/$1';
$route['editRoomTypeFacility/(:any)/(:any)'] = 'seller/editRoomTypeFacility/$1/$1';
$route['deleteRoomTypeFacility/(:any)/(:any)'] = 'seller/deleteRoomTypeFacility/$1/$1';
$route['manageEvents/(:any)'] = 'seller/manageEvents/$1';
$route['addEvent/(:any)'] = 'seller/addEvent/$1';
$route['editEvent/(:any)/(:any)'] = 'seller/editEvent/$1/$1';
$route['deleteEvent/(:any)/(:any)'] = 'seller/deleteEvent/$1/$1';
$route['myCustomerReservation'] = 'seller/myCustomerReservation';
$route['check/reservation/details/(:any)'] = 'seller/requestDetail/$1';
$route['deleteRequest/(:any)/(:any)'] ='seller/deleteRequest/$1/$1';
$route['reservationConfirm'] = 'seller/reservationConfirm';
$route['check/reservation/aprove/(:any)'] = 'seller/aprovePayment/$1';
$route['check/reservation/delete/(:any)/(:any)'] = 'seller/deleteRequest/$1/$1';
$route['manageAccount'] = 'seller/manageAccount';
$route['editAccount'] = 'seller/editAccount';
$route['addPhotoSeller'] = 'seller/addPhotoSeller';
$route['addRoomFacilityType/(:any)'] = 'seller/addRoomFacilityType/$1';
$route['addType/(:any)'] = 'seller/addType/$1';
$route['editType/(:any)/(:any)'] = 'seller/editType/$1/$1';
$route['deleteType/(:any)/(:any)'] = 'seller/deleteType/$1/$1';
$route['viewRoom/(:any)/(:any)'] = 'seller/viewRoom/$1/$1';
$route['addRoom/(:any)/(:any)'] = 'seller/addRoom/$1/$1';
$route['editRoom/(:any)/(:any)/(:any)'] = 'seller/editRoom/$1/$1/$1';
$route['deleteRoom/(:any)/(:any)/(:any)'] = 'seller/deleteRoom/$1/$1/$1';
$route['reservation'] = 'seller/reservation';
$route['check/reservation/(:any)'] = 'seller/checkReservationDetail/$1';
// $route['check/reservation/api/(:any)'] = 'seller/checkReservationDetailApi/$1';

//route customer
$route['dasboardCustomer'] = 'customer/dasboardCustomer';
$route['myReservation'] = 'customer/myReservation';
$route['myReservDetail/(:any)/(:any)/(:any)/(:any)'] = 'customer/myReservDetail/$1/$1/$1/$1';
$route['myConfirmation/(:any)/(:any)'] = 'customer/myConfirmation/$1/$1';
$route['getPDF/(:any)/(:any)'] = 'customer/getPDF/$1/$1';
$route['cancelMyReserv/(:any)/(:any)'] = 'customer/cancelMyReserv/$1/$1';
$route['deleteMyReserv/(:any)'] = 'customer/deleteMyReserv/$1';
$route['myBookingCancel'] = 'customer/myBookingCancel';
$route['manageAccountCus'] = 'customer/manageAccountCus';
$route['editAccountCus/(:any)'] = 'customer/editAccountCus/$1';
$route['addPhoto'] = 'customer/addPhoto';

// route web 
$route['hotelDetails/(:any)'] = 'web/hotelDetails/$1';
$route['verify/(:any)/(:any)?(:any)'] = 'web/verify/$1/$1/$1';
$route['Search/(:any)'] = 'web/hotelList/$1';

// API
// $route['API/Request/(:any)/(:any)/(:any)/(:any)'] = 'Api/request/$1/$1/$1/$1';
$route['API/Request/(:any)'] = 'Api/request/$1';
$route['API/Response/(:any)'] = 'Api/response/$1';

$route['API/room/(:any)'] = 'Api/getData/$1';
$route['API/room'] = 'Api/getData';
$route['API/create'] = 'Api/createApi';

// $route['API/List'] = 'Api/list';
$route['API/List'] = 'Api/hotelListByDate';
$route['API/List/delete/(:any)'] = 'Api/deleteApi/$1';
$route['API/List/Request/(:any)'] = 'Api/requestConnect/$1';
$route['API/List/Detail/(:any)'] = 'Api/requestDetail/$1';
$route['API/List/connect/(:any)/(:any)'] = 'Api/connect/$1/$1';
$route['API/get/endpoint'] = 'Api/getEndpoint';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;