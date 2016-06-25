<div class="row">
   <div class="col-xs-12">
       <ul>
         @foreach($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
       </ul>
   </div>
</div>
@if(Session::has('message'))
   <div class="row">
      <div class="col-xs-12">
         {{ Session::get('message') }}
      </div>
   </div>
@endif
