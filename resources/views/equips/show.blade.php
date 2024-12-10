@extends('layouts.app')
@section('title', " Guia d'Equips" )
@section('content')
<x-equip
   :id="$equip['id']"
   :nom="$equip['nom']"
   :estadi="$equip['estadi']->nom"
   :titols="$equip['titols']"
   :escut="$equip['escut']"
   :jugadors="$equip['jugadors']"
   :partits="$equip['partits']"
/>
@endsection 