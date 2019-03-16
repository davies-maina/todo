<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Invitation;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    




	public function index (){


		if (Auth::user()->isAdmin) {
			$coworkers=Invitation::where('admin_id',Auth::user()->id)->where('accepted',1)->get();
			$invitations=Invitation::where('admin_id',Auth::user()->id)->where('accepted',0)->get();
			$tasks=Task::where('user_id',Auth::user()->id)->orWhere('admin_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(4);

			}


		else{

			$invitations=[];

			$tasks=Task::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(4);

			$coworkers=User::where('isAdmin',1)->get();

		}

		

		return view('layouts.index', compact('tasks','coworkers','invitations'));
	}
    


    public function edit ($id){
    	$task=Task::find($id);


    	if (Auth::user()->isAdmin) {
    		
			$coworkers=Invitation::where('admin_id',Auth::user()->id)->where('accepted',1)->get();
			$invitations=Invitation::where('admin_id',Auth::user()->id)->where('accepted',0)->get();
    	}
    	else
    	{


			$coworkers=[];
			$invitations=[];
    	}


		return view('layouts.edit',['task'=>$task,'coworkers'=>$coworkers,'invitations'=>$invitations]);
	}


	public function store(Request $request){

		if ($request->input('task')) {
			
			$task=new Task;

			$task->content=$request->input('task');

			if (Auth::user()->isAdmin) {
				if ($request->input('assignTo')==Auth::user()->id) {
					Auth::User()->tasks()->save($task);
				}

				elseif ($request->input('assignTo')==!null) {
					$task->user_id=$request->input('assignTo');
					$task->admin_id=Auth::user()->id;
					$task->save();
				}
			}

			else{

					Auth::User()->tasks()->save($task);

			}


			
		}


		return redirect()->back();

	}


	public function remove($id){


		$task=Task::find($id);
		$task->delete();
		return redirect()->back(); 
	}


	public function update($id, Request $request){


		if ($request->input('task')) {
			$task=Task::find($id);
			$task->content=$request->input('task');


			if (Auth::user()->isAdmin) {
				if ($request->input('assignTo')==Auth::user()->id) {
					Auth::User()->tasks()->save($task);
				}

				elseif ($request->input('assignTo')==!null) {
					$task->user_id=$request->input('assignTo');
					$task->admin_id=Auth::user()->id;
					$task->save();
				}
			}

			else

			{
				$task->save();

			}
			
		}
		return redirect('/');
	}


	public function updateStatus($id){


		$task=Task::find($id);
		$task->status=! $task->status;
		$task->save();
		return redirect()->back(); 
	}

	public function sendInvitation(Request $request){

		if ((int) $request->input('admin') >0 && ! Invitation::where('worker_id',Auth::user()->id)->where('admin_id',$request->input('admin'))->exists()) {
			

			$invitation=new Invitation;
			$invitation->worker_id=Auth::user()->id;
			$invitation->admin_id=(int) $request->input('admin');
			$invitation->save();
		}

		return redirect()->back();	
	}


	public function acceptInvitation($id){


		$invitation=Invitation::find($id);
		$invitation->accepted=true;
		$invitation->save();
		return redirect()->back();
	}



	public function rejectInvitation($id){

		$invitation=Invitation::find($id);
		
		$invitation->delete();

		return redirect()->back();

	}


	public function deleteWorker($id){

		$invitation=Invitation::find($id);
		
		$invitation->delete();

		return redirect()->back();

	}
}






