@extends('layouts.content')
@section('index')
<div class="container-fluid">
    <?php $i=100; ?>
        <div class="row w3-animate-top" style="animation-delay: <?php echo $i; ?>ms;">
        <div class="col-md-3 col-lg-3">

        </div>
        <div class="col-md-6 col-lg-6 col-sm-12" style="text-align: center;">
          <div class="numpl" style="margin-top: 120px; box-shadow: none; background: #80808033;">
            <ul style="list-style: none; text-align:right;">
              <li>
                <div class="cityname" style=" margin: 15px 15px;">
                    <p style="margin-left: 10px;color: black;">پیش شماره </p>
                    <hr style="display: none;">
                </div>
              </li>
              <li>
                <div class="pishnum" style="margin: 15px 15px;">
                  <p style="margin-left: 10px;">شماره تلفن</p>
                  <hr style="display: none;">
                </div>
              </li>
              <li>
                <div class="num4" style="margin: 15px 15px;">
                  <p style="margin-left: 10px">قیمت</p>
                  <hr style="display: none;">
                </div>
              </li>

            </ul>
          </div>
        </div>
        <div class="col-md-3 col-lg-3">
            
        </div>
    </div>
    @foreach($numbers as $numbers)
    <?php $i=$i+100; ?>
    <div class="row w3-animate-top" style="animation-delay: <?php echo $i; ?>ms;">
        <div class="col-md-3 col-lg-3">

        </div>
        <div class="col-md-6 col-lg-6 col-sm-12" style="text-align: center;">
          <div class="numpl" style="margin-top: 10px;">
            <ul style="list-style: none;">
              <li>
                <div class="cityname" style=" margin: 15px 15px;">
                    <p style="margin-left: 10px;color: black;">{{ $numbers->city }}</p>
                    <hr style="display: none;">
                </div>
              </li>
              <li>
                <div class="pishnum" style="margin: 15px 15px;">
                  <p style="margin-left: 10px;">{{ $numbers->number }}  {{ $numbers->benum }}</p>
                  <hr style="display: none;">
                </div>
              </li>
              <li>
                <div class="num4" style="margin: 15px 15px;">
                  <p style="margin-left: 10px; color:green;">{{ $numbers->price }}تومان</p>
                  <hr style="display: none;">
                </div>
              </li>
              <li>
                <div class="enroll" style="margin: 15px 15px;">
                <form action="{{ route('cart') }}" method="GET" id="form_search">
                    <input type="hidden" name="number" value="{{ $numbers->number }}">
                    <input type="hidden" name="id" value="{{ $numbers->id }}">
                    <input type="hidden" name="benum" value="{{ $numbers->benum }}">
                    <input type="hidden" name="city" value="{{ $numbers->city }}">
                    <input class="sabt animated animatedFadeInUp fadeInUp"  style="animation-delay: 800ms;" type="submit" value="انتخاب">
                </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-lg-3">
            
        </div>
    </div>
    @endforeach 
    
</div>
      
@endsection