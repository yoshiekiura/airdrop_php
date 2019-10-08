@extends('layout')
<h2> dumy text </h2>
@section('string', 'aaa')

@section('number', 'bvvvvvvvv')

<img src="/asset/img/logo.png" alt="logo" class="dark-logo">

<img src={{base_url()."asset/img/logo.png"}}>
<img src="{{base_url()}}asset/img/logo.png">
<h2> from temp</h2>
