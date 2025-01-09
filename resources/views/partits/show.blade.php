@extends('layouts.futbolFemeni')
@section('title', " Partits de Futbol Femení" )
@section('content')
<x-partit
   :local="$local->nom"
   :visitant="$visitant->nom"
   :fecha="$partit['data_partit']"
   :resultat="$partit['gols_local'] . ' - ' . $partit['gols_visitant']"
/>
@endsection