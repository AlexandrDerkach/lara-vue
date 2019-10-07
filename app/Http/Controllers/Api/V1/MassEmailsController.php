<?php

namespace App\Http\Controllers\Api\V1;

use App\Company;
use App\Mail\CheckUserEmail;
use App\SingleEmailsSending;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MassEmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getEmails(Request $request)
    {
	    $emails = Company::all('email');
	
	    $user = $request->user();
	    $msgData = [
		    'email' => $request->name,
		    'subject' => $request->subject,
		    'msg' => $request->msg,
		    'author_id' => $user->id
	    ];
	
	    try{
	    	foreach($emails as $email){
			    Mail::to($email)
				    ->send(new CheckUserEmail($msgData['msg'],$msgData['subject'], $user));
			    SingleEmailsSending::create($msgData);
		    }
		    return response('Ok', 200);
	    }catch (Exception $e){
		    return response($e, 500);
	    }
	    
	    return $emails;
    }
    
    public function getEmailsCount(Request $request)
    {
    	return $request;
	    return Company::count();
    }
    
    public function index()
    {
        //
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
        //
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
