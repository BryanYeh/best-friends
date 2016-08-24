<div class="row">
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <strong>Error!</strong> {{ $error }}
        </div>
    @endforeach
</div>
@if(Session::has('message'))
   <div class="row">
       <div class="alert alert-success">
           <strong>Success!</strong> {{ Session::get('message') }}
       </div>
   </div>
@endif
