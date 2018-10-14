    @if(count($errors) > 0)
        <div class="row"  >
            <div class="col-md-12 ">
                <ul type="none">
                    @foreach($errors->all() as $error)
                        <li class="alert-danger " style="color: #ff1016">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    @if(Session::has('message'))
        <div class="row"  >
            <div class="col-md-12">
                <ul type="none">
                    <li class="alert-success" style="color: #2ab27b" >{{ Session::get('message') }}</li>
                </ul>
            </div>
        </div>
    @endif


    @if(Session::has('pm'))
        <div class="row"  >
            <div class="col-md-12">
                <ul type="none">
                    <li class="alert-danger" style="color: #ff070a" >{{ Session::get('pm') }}</li>
                </ul>
            </div>
        </div>
    @endif