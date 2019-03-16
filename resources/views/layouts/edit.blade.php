
@extends('layouts.master')
@section('content')


<form method="POST" action="{{ route('update',['id'=>$task->id]) }}">
<div class="form-group">
    <label for="formGroupExampleInput" class="lead">Edit task</label>
    <input type="text" class="form-control" id="task" placeholder="Edit task" value="{{ $task->content }}" name="task">
  </div>


  @include('partials.coworkers')
  
  <div class="form-group">
      
      <button type="submit" class="btn btn-primary mt-3">Edit Task</button>
      @csrf
  </div>

</form>

@endsection
