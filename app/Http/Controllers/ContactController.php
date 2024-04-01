<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contacts()
    {
        $contacts = Contact::all();
        return response()->json([
            'contacts' => $contacts,
            'message' => 'Contact Listing',
            'code' => 200
        ]);
    }

    public function getContact($id){
        $contact = Contact::find($id);
        if($contact){
            return response()->json([
                'contact' => $contact,
                'message' => 'View Contact',
                'code' => 200
            ]);
        }else{
            return response()->json([
                'message' => "Invalid contact ID: $id."
            ]);
        }
    }

    public function saveContact(Request $request){
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->contact_no = $request->contact_no;
        $contact->save();
        return response()->json([
            'message' => 'Contact saved!',
            'code' => 200
        ]);
    }

    public function updateContact($id, Request $request){
        $contact = Contact::where('id', $id)->first();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->contact_no = $request->contact_no;
        $contact->save();
        return response()->json([
            'message' => 'Contact updated!',
            'code' => 200
        ]);
    }

    public function deleteContact($id){
        $contact = Contact::find($id);
        if($contact){
            $contact->delete();
            return response()->json([
                'message'=> 'Contact deleted!',
                'code' => 200
            ]);
        }else{
            return response()->json([
                'message' => "Invalid contact ID: $id."
            ]);
        }
    }
}
