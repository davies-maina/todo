@isAdmin

	<div class="form-group">
      <label for="sel1">Assign to:</label>
      <select class="form-control" id="sel1" name="assignTo">
        <option value="{{ Auth::user()->id }}">Myself</option>

        @foreach($coworkers as $coworker)

        @if($coworker->worker->id==$task->user->id)

        <option value="{{ $coworker->worker->id }}" selected="">{{ $coworker->worker->name }}</option>
        @else

        <option value="{{ $coworker->worker->id }}" >{{ $coworker->worker->name }}</option>
        @endif

        
        
        @endforeach
      </select>
      </div>


@endisAdmin