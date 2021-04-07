<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="shortcut icon" href="{{ asset('website/icon.png') }}">
   <link href="{{ asset('template/back-office/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link href="{{ asset('template/back-office/css/sb-admin-2.min.css') }}" rel="stylesheet">
   <link href="{{ asset('template/back-office/custom.css') }}" rel="stylesheet">
   <link href="{{ asset('template/back-office/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
   <script src="{{ asset('template/back-office/vendor/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('template/back-office/vendor/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('template/back-office/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
   <title>{{ $title }}</title>
</head>