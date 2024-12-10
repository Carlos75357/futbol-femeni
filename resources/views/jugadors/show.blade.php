@extends('layouts.app')
@section('title', " Jugadors de Futbol Femení" )
@section('content')
<x-jugador
   :nom="$jugador['nom']"
   :equip="$jugador['equip']"
   :posicio="$jugador['posicio']"
   :foto="$jugador['foto']"
/>
@endsection 