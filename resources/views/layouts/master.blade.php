<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ToDo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    {{-- NAVBAR --}}
       
<div class="container">
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Todo App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
 


<form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf

                                         <div class="collapse navbar-collapse" id="navbarText">
    
    <span class="navbar-text">
      Logged in as <b>{{ Auth::user()->name }}</b>
      <button class="btn btn-outline-success " type="submit">Logout</button>
    </span>
                                    </form>


  </div>
</nav>

{{-- ACCORDION
 --}}


<div class="container-fluid">
    
    @isAdmin
  <a class="icon-prev" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="">
    Invitations <i class="fa fa-user-plus" aria-hidden="true"></i>
    <p class=" offset-md-4 badge badge-primary" style="">{{ $invitations->count() }}</p>
  </a>
  
</p>

<div class="collapse" id="collapseExample">
  <div class="card card-body">
    @if($invitations->count()>0)
    <ul class="list-group">
      @foreach($invitations as $invitation)


  <li class="list-group-item">{{ $invitation->worker->name }}<span class=""> <a href="{{ route('acceptInvitation',['id'=>$invitation->id]) }}">Accept</a> | <a href="{{ route('rejectInvitation',['id'=>$invitation->id]) }}">Deny</a></span></li>
  @endforeach
  @else
  no invitations to work from workers
</ul>
@endif
@endisAdmin
  </div>
</div>
</div>

{{-- TABLE --}}
<h2 class="display-4 text-center mx-5">To Do's</h2>

        @yield('content')


    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    
</html>
