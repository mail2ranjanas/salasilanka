@extends('layouts.app')
<?php

 // Show all information, defaults to INFO_ALL
phpinfo();

?>
@section('content')
    <h1><?php echo $title; ?></h1>
    <p>This is the about page</p>

    
@endsection