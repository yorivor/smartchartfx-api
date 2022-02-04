<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactList;
use Illuminate\Http\Request;
use StdClass;

class ContactListController extends Controller
{
    
    public function index()
    {
        $all = ContactList::all();

        $contacts = new StdClass();
        $contacts->data = [];
        if (!empty($all)) {
            foreach ($all as $contactList) {
                $contacts->data[] = (object) [
                    'id' => $contactList->id,
                    'name' => $contactList->name,
                    'address' => $contactList->address,
                    'phone_number' => $contactList->phone_number,
                    'fb_username' => $contactList->fb_username,
                ];
            }
        }

        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        if (!$request->has('name') || $request->name == "") {
            return response()->json(['message' => 'Name is required'], 500);
        }
        if (!$request->has('address') || $request->address == "") {
            return response()->json(['message' => 'Address is required'], 500);
        }
        if (!$request->has('phone_number') || $request->phone_number == "") {
            return response()->json(['message' => 'Phone Number is required'], 500);
        }
        try {
            $contactList = new ContactList();
            $contactList->name = $request->name;
            $contactList->address = $request->address;
            $contactList->phone_number = $request->phone_number;
            $contactList->fb_username = $request->fb_username;
            $contactList->save();
            return response()->json(['message' => 'Succesfully Created Contact info'], 200);
        } catch (Throwable $exception) {
            return response()->json(['message' => 'Something went wrong. Please contact the Administrator.'], 500);
        }
    }

    public function show($contactList)
    {
        $getInforamtion = ContactList::where('id', $contactList)->first();

        return response()->json(['message' => 'Succesfully fetch data', 'information' => $getInforamtion], 200);
    }

    public function update(Request $request, $contactList)
    {
        if (!$request->has('name') || $request->name == "") {
            return response()->json(['message' => 'Name is required'], 500);
        }
        if (!$request->has('address') || $request->address == "") {
            return response()->json(['message' => 'Address is required'], 500);
        }
        if (!$request->has('phone_number') || $request->phone_number == "") {
            return response()->json(['message' => 'Phone Number is required'], 500);
        }

        $updateInfromation = ContactList::where('id', $contactList)->first();
        if(empty($updateInfromation)) {
            return response()->json(['message' => "Contact information doesn't exist"], 500);
        }
        
        try {
            $updateInfromation->name = $request->name;
            $updateInfromation->address = $request->address;
            $updateInfromation->phone_number = $request->phone_number;
            $updateInfromation->fb_username = $request->fb_username;
            $updateInfromation->save();
            return response()->json(['message' => 'Succesfully Updated Contact info'], 200);
        } catch (Throwable $exception) {
            return response()->json(['message' => 'Something went wrong. Please contact the Administrator.'], 500);
        }
    }

    public function destroy(Request $request, $contactList)
    {
        try {
            ContactList::where('id', $contactList)->delete();
            return response()->json(['message' => 'Contact is succsefully deleted'], 200);
        } catch (Throwable $exception) {
            return response()->json(['message' => 'Something went wrong. Please contact the Administrator.'], 500);
        }
    }


}
