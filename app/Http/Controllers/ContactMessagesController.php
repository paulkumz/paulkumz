<?php

namespace Paulkumz\Http\Controllers;

use Illuminate\Http\Request;
use Paulkumz\ContactMessage;
use Paulkumz\Http\Requests;

class ContactMessagesController extends Controller
{
    public function getContactIndex()
    {
    	return view('mail.contact');
    }

    public function postSendMessage(Request $request )
    {
    	$this->validate($request, [
          'email' => 'required|email',
          'name' => 'required|max:100',
          'title' => 'required|max:140',
          'message' => 'required|min:10'
    		]);
    	$message = new ContactMessage();
    	$message->email = $request['email'];
    	$message->sender = $request['name'];
    	$message->subject = $request['title'];
    	$message->body = $request['message'];
    	$message->save();
    	return redirect()->route('mail.contact')->with(['success' => 'Message sent']);
    }
}
