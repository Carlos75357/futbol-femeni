@extends('layouts.futbolFemeni')
@section('title', " Estadis de Futbol Femení" )
@section('content')
{{-- @dd($estadi) --}}
<x-estadi
   :nom="$estadi['nom']"
   :ciutat="$estadi['ciutat']"
   :capacitat="$estadi['capacitat']"
   :equips="$estadi['equips']"
/>
@endsection 
