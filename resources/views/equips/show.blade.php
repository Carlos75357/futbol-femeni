@extends('layouts.futbolFemeni')
@section('title', "Pàgina equip Femení" )
@section('content')
<x-equip
   :id="$equip->id"
   :nom="$equip->nom"
   :estadi="$equip->estadi->nom"
   :titols="$equip->titols"
   :escut="$equip->escut"
   :descripcio="$descripcio"
   :partits="$equip->partits"
   :edadMedia="$equip->edadMedia"
/>
@endsection