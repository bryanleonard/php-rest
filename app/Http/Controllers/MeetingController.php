<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

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
        $meeting = [
            "title" => "My Meeting",
            "description" => "The meeting has a great description. The best.",
            "time" => "Meeting time!",
            "view_meeting" => [
                "href" => "api/v1/meeting/1",
                "method" => "GET"
            ]
        ];

        $response = [
            "msg" => "List of all meetings",
            "meetings" => [
                $meeting,
                $meeting
            ]
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
        $title = $request->input('title');
        $description = $request->input('description');
        $time = $request->input('time');
        $user_id = $request->input('user_id');

        $meeting = [
            "title" => $title,
            "description" => $description,
            "time" => $time,
            "view_meeting" => "api/v1/meeting/1",
            "method" => "GET"
        ];

        $response = [
            "msg" => "Meeting created",
            "meeting" => $meeting
        ];

        return response()->json($response, 201);

        // return "it still works";
        // return response()->json([
        //     'title' => 'post created'
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meeting = [
            'title' => 'Title',
            'description' => 'Description',
            'time' => 'Time',
            'view_meeting' => [
                'href' => 'api/v1/meeting/1',
                'method' => 'GET'
            ]
        ];

        $user = [
            'name' => 'Name'
        ];

        $response = [
            'msg' => 'User registered for meeting',
            'meeting' => $meeting,
            'user' => $user,
            'unregister' => [
                'href' => 'api/v1/meeting/registration/1',
                'method' => 'DELETE'
            ]
        ];

        return response()->json($response, 201);
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
