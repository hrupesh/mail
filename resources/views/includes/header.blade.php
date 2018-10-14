<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header ">
            
            <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ URL::to('sclogo.jg') }}" style="height:150%;width:15%;" alt="Hello_JNU"></a>
    </div>
    <!--
    <button class="btn btn-danger navbar-btn"><a href="/about">About</a></button>
    -->
    <div class="collapse navbar-collapse">
      @if(Auth::user())
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('account') }}">Account</a></li>
        <li><a href="{{ route('logout') }}">Logout</a></li>
      </ul>
      @endif
    </div>
  </div>
</nav>
