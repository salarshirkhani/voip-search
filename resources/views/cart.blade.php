@extends('layouts.content')
@section('index')
<div class="container"  style="margin-top: 120px;">
    <div class="row">
      <div class="col-3">
        <h3 style="margin-top: 80px;text-align: center;">شماره انتخاب شده</h3>
        <h3 class="yournum"><?php echo $number; ?></h3>
      </div>
    </div>
  </div>
  <div class="container">
    
    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-12">
        <img src="{{asset('img/undraw_sign_in_e6hj.png')}}" alt="" width="100%">
      </div>
      <div class="col-md-6 col-lg-6 col-sm-12">
        <div class="userdet" style="display: block; margin-left: auto; margin-right: auto;">
          <h4>مشخصات خود را وارد کنید</h4>
          <form class="sform" action="{{ route('pay') }}" method="POST">
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="last_name">نام خانوادگی</label><br>
                <input type="text" name="last_name" maxlength="100" class=" input100" placeholder="نام خانوادگی" required=""
                id="id_last_name" value="{{ old('last_name') ?? '' }}">
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="first_name" style="text-align: right;">نام</label><br>
                <input type="text" name="first_name" maxlength="100" class=" input100" placeholder="نام" required=""
                id="id_first_name" value="{{ old('first_name') ?? '' }}">
             </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="father_name">نام پدر</label><br>
                <input type="text" name="father_name" maxlength="100" class=" input100" placeholder="نام پدر" required=""
                id="id_father_name" value="{{ old('father_name') ?? '' }}">
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="national_code" style="text-align: right;">کدملی</label><br>
                <input type="text" name="national_code" maxlength="100" class=" input100" placeholder="کد ملی" required=""
                id="id_national_code" value="{{ old('national_code') ?? '' }}">
             </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="id_code">شماره شناسنامه</label><br>
                <input type="text" name="id_code" maxlength="100" class=" input100" placeholder="شماره شناسنامه" required=""
                id="id_id_code" value="{{ old('id_code') ?? '' }}">
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="national_code" style="text-align: right;">تارخ تولد</label><br>
                <input type="text" name="birthday" maxlength="100" class=" input100" placeholder="تاریخ تولد" required=""
                id="id_birthday" value="{{ old('birthday') ?? '' }}">
             </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="location">شهرمحل اقامت</label><br>
                <input type="text" name="location" maxlength="100" class=" input100" placeholder="شهر محل اقامت" required=""
                id="id_location" value="{{ old('location') ?? '' }}">
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="national_code" style="text-align: right;">جنسیت</label><br>
                <select class=" input100"  name="gender" id="gender" required="">
                  <option value="male">مرد</option>
                  <option value="female">زن</option>
                  <option value="other">غیره</option>
              </select>
             </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="password">رمز عبور</label><br>
                <input type="password" name="password" class=" input100" placeholder="کلمه‌عبور" id="id_password"
                style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: left center;">
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="password_confirmation" style="text-align: right;">تکرار رمز عبور اجباریست</label><br>
                <input type="password" name="password_confirmation" class=" input100" placeholder="تکرار کلمه‌عبور"
                id="id_password_confirmation"
                style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: left center;">
             </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="phonenum">تلفن همراه</label><br>
                <input type="tel" name="mobile" class=" input100" placeholder="موبایل" required=""
                id="id_mobile" value="{{ old('mobile') ?? '' }}">
                </div>
              <div class="col-md-6 col-sm-12 col-lg-6">
                <label for="email">ایمیل</label><br>
                <input type="email" name="email" class=" input100" placeholder="ایمیل" required=""
                id="id_email" value="{{ old('email') ?? '' }}">
              </div>
              <input type="hidden" name="numberh" value="{{$number}}">
              <input type="hidden" name="benumh" value="{{ $benum }}">
              <input type="hidden" name="cityh" value="{{ $city }}">
              <input type="submit" value="پرداخت">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection