@extends('layouts-fe.app')

@section('style-fe')

@endsection

@section('content-fe')
@include('sweetalert::alert')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          {{-- <h2 data-aos="fade-up">Sistem Informasi Management Document!</h2>
          <p data-aos="fade-up" data-aos-delay="100">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit ex est soluta consequatur reiciendis, aliquid fugiat esse beatae, ad repellat inventore numquam quibusdam at veniam harum, vel voluptatibus totam placeat omnis eligendi quidem? Possimus cumque dolorem adipisci quos, a id maiores facilis expedita neque quas aliquid ullam aliquam eum nam.
          </p> --}}

          {!! $info->informasi !!}
        </div>

        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <img src="https://bootstrapmade.com/demo/templates/Logis/assets/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0" alt="">
        </div>

      </div>
    </div>
  </section>
  <!-- End Hero Section -->
@endsection

@section('script-fe')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

</script>

@endsection