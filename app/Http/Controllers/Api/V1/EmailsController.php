<?php

namespace App\Http\Controllers\Api\V1;

use App\Mail\CheckUserEmail;
use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\Http\Controllers\Controller;
use App\EmailsSending;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    return EmailsSending::where('author_id', '=', $request->user()->id)->orderby('id', 'desc')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $msgData = [
            'email' => $request->name,
            'subject' => $request->subject,
            'msg' => $request->msg,
            'author_id' => $user->id
        ];
        //dd($data, $user->name);
	    //dd(env('MAIL_DRIVER'));
	    
	    try{
		    Mail::to($msgData['email'])
			    ->send(new CheckUserEmail($msgData['msg'],$msgData['subject'], $user));
		    EmailsSending::create($msgData);
		    return response('Ok', 200);
	    }catch (Exception $e){
		    return response($e, 500);
	    }
    }
    
    public function repeatLast(Request $request)
    {
    	return EmailsSending::select('email as name','subject','msg')->where('author_id', $request->user()->id)->orderby('id', 'desc')->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
