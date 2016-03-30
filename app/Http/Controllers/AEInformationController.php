<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Config;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AEInformationController extends Controller {
    public function getViewAESystem(User $user) {
        //Check for user existance
    	if(!$user) return view('errors.404')->with('error', 'noUserFound');

        //Check if item list is valid: if JSON checks out and if it contains the required parameters
    	if($user->item_list_valid) {
            //Count interesting metrics
            $total = 0;
            $types = 0;
            foreach($user->item_list as $item) {
                $total += $item->size;
                $types++;
            }

            $timezone = Config::get('app.timezone');

            //Generate view
    		    return view('ae.view')
    					   ->with('user', $user)
    					   ->with('aesystem', $user->item_list)
                 ->with('total', $total)
                 ->with('types', $types)
                 ->with('timezone', "UTC");
    	}else {
            //Item list is invalid, generate proper message
    		return view('errors.404', ['error' => \App\Helpers\AESystemJSONValidator::$lastError]);
    	}
    }

    /**
     * Currently not implemented
     * Handle search query for certain username
     *
     * @param request
     * @return response
     */
    public function postSearch(Request $request) {
        if($query = $request->input('search')) {
            $users = User::where('name', 'LIKE', '%' . $request->input('search') . '%')->paginate(15);
        }else {
            $users = User::paginate(15);
        }
        if($users) {
            return view('ae.searchresults', ['users' => $users]);
        }else return view('errors.404', ['error' => 'No users found!']);
        //TODO:
        /*
         * Search DB
         * Check existance
         * Handle pagination
         * Create links
         */
    }
}
