
@extends('layouts.master')

@section('content')





<div class="container-fluid">
    
    <table class="table">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Task</th>

      @isAdmin
      <th scope="col">Assigned to</th>
      @endisAdmin
      <th scope="col">Edit </th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

    @foreach($tasks as $task)

    <tr>
      
      <td><a href="{{ route('updateStatus', $task->id) }}"> 

        @if(!$task->status)

        {{ $task->content }}

        @else

        <del style="color: green;">{{ $task->content }}</del>

        @endif
      </a>
      </td>
      @isAdmin
      <td>{{ $task->user->name }}</td>
      @endisAdmin
      
      <td><i class="fa fa-edit"><a href="{{ route('edit',$task->id) }}">Edit</a></i></td>
      <td><i class="fa fa-trash"><a href=" {{ route('remove',$task->id) }} " onclick="return confirm('sure to delete this task?');">Delete</a></i></td>
      @endforeach
    </tr>
    
    
      
      {{-- <td>Watch WWE Raw</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>  --}}
  </tbody>
  {{$tasks->links()}}
</table>


{{-- FORM --}}


<div class="container-fluid">
    
    <form class="mt-5" method="POST" action="{{ route('store') }}">
  <div class="form-group">
    <label for="formGroupExampleInput" class="lead">Add new task</label>
    <input type="text" class="form-control" id="task" placeholder="Add task" name="task">
  </div>



  @include('partials.coworkers')



  <div class="form-group">
      
      <button type="submit" class="btn btn-primary mt-3">Add Task</button>
  </div>

  @csrf
  
</form>
@isWorker
<form method="POST" action="{{ route('sendInvitation') }}">
<div class="form-group">
      <label for="sel1">send invitation to:</label>
      <select class="form-control" id="sel1" name="admin">
        <option>Send to</option>
        @foreach($coworkers as $coworker)

        <option value="{{ $coworker->id }}">{{ $coworker->name }}</option>
        @endforeach
        
      </select>
      <button type="submit" class="btn btn-primary mt-3">Send invite</button>
      </div>
      @csrf
    </form>
      @endisWorker
</div>
@isAdmin
<div class="container-fluid">
    
<p class="lead">My coworkers</p>

<ul class="list-group">
  @foreach($coworkers as $coworker)
  <li class="list-group-item">{{ $coworker->worker->name }}<span class="offset-md-7 lead"><a href="{{ route('deleteWorker', $coworker->id) }}"> Delete</a></span></li>
  @endforeach
  
</ul>


</div>
@endisAdmin

</div>

</div>



@endsection



