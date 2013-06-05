@layout('content.auth.page')

@section('content')
<style>
  #image_wrapper img {
    width:50%;
  }
</style>

<div style="text-align: center ; " id="image_wrapper">
    {{ HTML::image ('img/login.jpg') }}
</div>

{{ Form::open ('/json/auth/login') }}
  <div data-role="fieldcontain" align="center" style="width: 30%; text-align: center">
    {{ Form::label ('email', 'E-Mail Address') }}
    {{ Form::text ('email') }}
  </div>
  <div data-role="fieldcontain" align="center" style="width: 30%; text-align: center">
    {{ Form::label ('password', 'Password') }}
    {{ Form::password ('password') }}
  </div>
  
  <span></span>
  
  <div data-role="fieldcontain" style="width: 30%" align="right">
    <input id="login" name="" value="Login" data-theme="b" type="submit" align="right">
    <a href="{{ URL::to_route('signup', 'Register') }}">
      <input id="register" name="" value="Register" type="submit" align="right">
    </a>
  </div>
{{ Form::close () }}

<script>
  $(document).ready(function() {
    $('form').ajaxForm({
      complete: function (xhr) {
        alert (xhr.responseText);
      }
    });
  });
</script>
@endsection
