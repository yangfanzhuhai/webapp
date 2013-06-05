@layout('destroyer::content.auth.page')

@section('content')
<h1>New user sign up</h1>

<center>
  <section class="block">
    <h2>Registration details</h2>
    <p>Please complete this form to sign up for your account.</p>
    <p>All fields are required.</p>

    @if (Session::has ('signup_error'))
      <div class="error">
        {{ Session::get ('signup_error') }}
      </div>
    @endif
    <div class="paddingTop">
      {{ Form::open() }}
        <div class="row">
          {{ Form::label('email', 'Email address :') }}
          {{ Form::text('email', Session::get ('signup_email')) }}
        </div>
        <div class="row">
        {{ Form::label('password', 'Password :') }}
        {{ Form::password('password') }}
        </div>
        <div class="row">
        {{ Form::label('password_repeat', 'Repeat password :') }}
        {{ Form::password('password_repeat') }}
        </div>

        <hr/>

        <div class="row">
          {{ Form::label('firstname', 'First name :') }}
          {{ Form::text('firstname', Session::get ('signup_firstname')) }}
        </div>
        <div class="row">
        {{ Form::label('lastname', 'Last name :') }}
        {{ Form::text('lastname', Session::get ('signup_lastname')) }}
        </div>

        <div class="button_wrapper">
          {{ Form::submit('Sign up', array ('class' => 'button')) }}
        </div>
      {{ Form::close() }}
    </div>
  </section>
</center>

@endsection
