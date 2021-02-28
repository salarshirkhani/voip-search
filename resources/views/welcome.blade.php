@extends('layouts.content')
@section('index')
<!-- end-navigation -->    
<div class="container-fluid">
    <h2 style="padding-top: 8%;
    text-align: center;
    font-weight: 800;">جست و جوی شماره تلفن</h2>
        <div class="selectnum">
          <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
              <div class="selection">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <form class="sform" action="{{ route('search') }}" method="GET" id="form_search">
              <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <select id="city" name="city" class=" animated animatedFadeInUp fadeInUp" style="animation-delay: 200ms;">
                      <option value="021">تهران (021)</option>
                      <option value="051">خراسان رضوی (051)</option>
                      <option value="035">یزد (035)</option>
                      <option value="076">هرمزگان (076)</option>
                      <option value="031">اصفهان (031)</option>
                      <option value="071">فارس (071)</option>
                    </select>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <select id="benum" name="benum" class=" animated animatedFadeInUp fadeInUp" style="animation-delay: 400ms;">
                      <option value="9109">9109</option>
                      <option value="9101">9101</option>
                      <option value="9130">9130</option>
                      <option value="9108">9108</option>
                    </select>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <input name="number" class=" animated animatedFadeInUp fadeInUp" style="animation-delay: 400ms;" type="number" min="0" max="9999" placeholder="چهار رقم انتخابی شما">
                </div> 
              </div>
              <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <input class=" animated animatedFadeInUp fadeInUp"  style="animation-delay: 600ms;" type="number" placeholder="شماره تماس شما">
                </div> 
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                  @csrf
                    <input class=" animated animatedFadeInUp fadeInUp"  style="animation-delay: 800ms;" type="submit" value="ثبت درخواست">
                </div>
              </div>
            </form>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                <img src="img/2829247.jpg" alt="" width="100%">
            </div>
          </div>
        </div>
        </div>
      </div>
@endsection