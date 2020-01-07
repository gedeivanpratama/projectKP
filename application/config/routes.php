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

$route['dasboardSeller'] = 'seller/dasboardSeller';

$route['denah/(:any)'] = 'Denah/denah/$1';
$route['denah/tambah/(:any)'] = 'Denah/tambahDenah/$1';
$route['denah/edit/(:any)/(:any)'] = 'Denah/editDenah/$1/$1';
$route['denah/delete/(:any)/(:any)'] = 'Denah/deleteDenah/$1/$1';

$route['hotelLists'] = 'Hotel/hotelLists';
$route['addHotel'] = 'Hotel/addHotel';
$route['editHotel/(:any)'] = 'Hotel/editHotel/$1';
$route['deleteHotel/(:any)'] = 'Hotel/deleteHotel/$1';

$route['manageHotelFacility'] ='HotelFacility/ManageHotelFacility';
$route['addHotelFacility'] = 'HotelFacility/addHotelFacility';
$route['editHotelFacility/(:any)'] = 'hotelFacility/editHotelFacility/$1';
$route['deleteHotelFacility/(:any)'] = 'HotelFacility/deleteHotelFacility/$1';

$route['manageHotelPayment'] = 'payment/manageHotelPayment';
$route['editPayment/(:any)'] = 'payment/editPayment/$1';
$route['addHotelPayment'] = 'payment/addHotelPayment';
$route['deletePayment/(:any)'] = 'payment/deletePayment/$1';

$route['roomTypeLists/(:any)'] = 'RoomType/roomTypeLists/$1';
$route['addType/(:any)'] = 'RoomType/addType/$1';
$route['editType/(:any)/(:any)'] = 'RoomType/editType/$1/$1';
$route['deleteType/(:any)/(:any)'] = 'RoomType/deleteType/$1/$1';

$route['addRoomFacilityType/(:any)'] = 'RoomTypeFacility/addRoomFacilityType/$1';
$route['manageRoomFacilityType/(:any)'] = 'RoomTypeFacility/manageRoomFacilityType/$1';
$route['editRoomTypeFacility/(:any)/(:any)'] = 'RoomTypeFacility/editRoomTypeFacility/$1/$1';
$route['deleteRoomTypeFacility/(:any)/(:any)'] = 'RoomTypeFacility/deleteRoomTypeFacility/$1/$1';

$route['manageEvents/(:any)'] = 'Event/manageEvents/$1';
$route['addEvent/(:any)'] = 'Event/addEvent/$1';
$route['editEvent/(:any)/(:any)'] = 'Event/editEvent/$1/$1';
$route['deleteEvent/(:any)/(:any)'] = 'Event/deleteEvent/$1/$1';

$route['myCustomerReservation'] = 'seller/myCustomerReservation';
$route['deleteRequest/(:any)/(:any)'] ='seller/deleteRequest/$1/$1';
$route['reservationConfirm'] = 'seller/reservationConfirm';

$route['reservation'] = 'seller/reservation';
$route['check/reservation/details/(:any)'] = 'seller/requestDetail/$1';
$route['check/reservation/aprove/(:any)'] = 'seller/aprovePayment/$1';
$route['check/reservation/delete/(:any)/(:any)'] = 'seller/deleteRequest/$1/$1';
$route['check/reservation/(:any)'] = 'seller/checkReservationDetail/$1';

$route['addProfile'] = 'Account/addProfile';
$route['manageAccount'] = 'Account/manageAccount';
$route['editAccount'] = 'Account/editAccount';

$route['viewRoom/(:any)/(:any)'] = 'Room/viewRoom/$1/$1';
$route['addRoom/(:any)/(:any)'] = 'Room/addRoom/$1/$1';
$route['editRoom/(:any)/(:any)/(:any)'] = 'Room/editRoom/$1/$1/$1';
$route['deleteRoom/(:any)/(:any)/(:any)'] = 'Room/deleteRoom/$1/$1/$1';

//route customer
$route['dasboardCustomer'] = 'customer/dasboardCustomer';
$route['myReservation'] = 'customer/myReservation';
$route['myReservDetail/(:any)/(:any)/(:any)/(:any)'] = 'customer/myReservDetail/$1/$1/$1/$1';
$route['myConfirmation/(:any)/(:any)'] = 'customer/myConfirmation/$1/$1';
$route['getPDF/(:any)/(:any)'] = 'customer/getPDF/$1/$1';
$route['cancelMyReserv/(:any)'] = 'customer/cancelMyReserv/$1';
$route['deleteMyReserv/(:any)'] = 'customer/deleteMyReserv/$1';
$route['myBookingCancel'] = 'customer/myBookingCancel';
$route['manageAccountCus'] = 'customer/manageAccountCus';
$route['editAccountCus/(:any)'] = 'customer/editAccountCus/$1';
$route['addPhoto'] = 'customer/addPhoto';

// route web 
$route['hotelDetails/(:any)'] = 'web/hotelDetails/$1';
$route['verify/(:any)/(:any)?(:any)'] = 'web/verify/$1/$1/$1';
$route['Search/(:any)'] = 'web/hotelList/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;