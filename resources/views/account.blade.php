@extends('master')
@section('title')
   {{ Auth::user()->First_Name }}
@endsection
@section('content')
   @include('includes.message')
   @if (Storage::disk('public')->has(Auth::user()->First_Name . '-' . Auth::user()->id . '.jpg'))
   <section class="row new-post">
       <div class="col-md-6 col-md-offset-3" >
           <img src="{{ route('account.image') }}" alt="No_Image_Found" class="img-responsive">
       </div>
   </section>
@endif
   <section class="row new-post">
    <div class="col-md-6 col-md-offset-3">
        <header><h3>Your Account</h3></header>
        <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ Auth::user()->First_Name }}" id="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->Last_Name }}" id="last_name">
            </div>
            <div class="form-group">
                <label for="contact_no">contact Number</label>
                <input type="text" name="contact_no" class="form-control" value="{{ Auth::user()->Contact_No }}" id="contact_no">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" id="email">
            </div>
            <div class="form-group">
                <label for="image">Image (only .jpg)</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Save Account</button>
            <input type="hidden" value="{{ Session::token() }}" name="_token">
        </form>
    </div>
</section>
  <!--  @if (count($errors) > 0)

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>
    @endif

    {!! Form::open(array('route' => 'fileUpload','enctype' => 'multipart/form-data')) !!}

    <div class="row col-md-6 col-md-offset-3">

    <div class="form-group">
        {!! Form::label('First_Name','First Name :') !!}
        {!! Form::text('First_Name', '{{Auth::user()->First_Name}}',array('class' => 'form-control')) !!}
    
    </div>

    <div class="form-group">

        {!! Form::file('image', array('class' => 'form-control')) !!}

    </div>

    <div class="col-md-4">

        <button type="submit" class="btn btn-success">Create</button>

    </div>

</div>
{!! Form::close() !!} -->
@endsection