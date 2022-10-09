@extends('frontend/layouts.master')
@section('title','Dashboard')
@section('content')
<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">PLATFORM KAMI</h3>
    <p class="w3-center w3-large">Kalian dapat mengunjungi untuk info lebih lanjut</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
      @foreach ($data as $datanya)
      <div class="w3-col l3 m6 w3-margin-bottom">
        <div class="w3-card">
          <!-- <img src="/w3images/team2.jpg" alt="John" style="width:100%"> -->
          <div class="w3-container">
            <h3 id="txt_judul">{{$datanya->judul}}</h3>
            {{-- <p class="w3-opacity">@teknopintar</p> --}}
            <p id="txt_deskripsi">{{$datanya->deskripsi}}</p>
            <p><button class="w3-button w3-light-grey w3-block"><i></i>KLIK DISINI</button></p>
          </div>
        </div>
      </div>
      @endforeach
  </div>
  
  @endsection