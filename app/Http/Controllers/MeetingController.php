<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Meeting;
// input validation
// $this->validate($request, [
//     'title' => 'required|max:120',
//     'content' => 'required'
// ]);

// check filetype
// $this->validate($request, [
//     'photo' = 'mimes:jpg,png'
// ]);

class MeetingController extends Controller
{

	public function __construct()
	{
		// $this->middleware...blah blah blah
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$meetings = Meeting::all();

		foreach ($meetings as $meeting) {
			$meeting->view_meeting = [
				'href' => 'api/v1/meeting/' . $meeting->id,
				'method' => 'GET'
			];
		}

		$response = [
			"msg" => "List of all meetings",
			"meetings" => $meetings
		];

		return response()->json($response, 200);
	}
  
	/**
	 * Store a newly created resource in storage. IE create a new meeting
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'description' => 'required',
			'time' => 'required|date_format:YmdHie',
			'user_id' => 'required'
		]);

		$title = $request->input('title');
		$description = $request->input('description');
		$time = $request->input('time');
		$user_id = $request->input('user_id');

		$meeting = new Meeting([
			'time' => Carbon::createFromFormat('YmdHie', $time),
			'title' => $title,
			'description' => $description
		]);

		if ($meeting->save()) {
			$meeting->users()->attach($user_id);
			$meeting->view_meeting = [
				'href' =>'api/v1/meeting/' . $meeting->id,
				'method' => 'GET'
			];

			$message = [
				'msg' => 'Meeting created',
				'meeting' => $meeting
			];
		}

		return response()->json($message, 201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		// firstOrfail response (like a 404) can be adjusted in the .env
		$meeting = Meeting::with('users')->where('id', $id)->firstOrFail();

		$meeting->view_meetings = [
			'href' => 'api/v1/meeting',
			'method' => 'GET'
		];

		$response = [
			'msg' => 'Meeting information',
			'meeting' => $meeting
		];

		return response()->json($response, 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'title' => 'required',
			'description' => 'required',
			'time' => 'required|date_format:YmdHie',
			'user_id' => 'required'
		]);

		$title = $request->input('title');
		$description = $request->input('description');
		$time = $request->input('time');
		$user_id = $request->input('user_id');

		return 'meeting update works';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
	  $response = [
		"msg" => "Meeting deleted",
		"create" => [
			"href" => "api/v1/meeting",
			"method" => "POST",
			"params" => "title, description, time"
		]
	  ];

	  return response()->json($response, 200);
	}
}
