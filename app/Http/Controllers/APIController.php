<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;

use Log;

use App\User;

use App\Helpers\AESystemJSONValidator as AEValidator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class APIController extends Controller {
	public function postUpdateAESystem(Request $request) {

		$validator = Validator::make($request->only('aeSystem'), [
			'aeSystem' => 'required'
		]);

		if($validator->fails()) {
			//Laravel validator failed
			return response()
			->json(['status' => 'fail', 'reason' => 'Missing data'])
			->setStatusCode(400, 'Bad request');

		}else if(!AEValidator::validateItemList($request->input('aeSystem'))) {
			//JSON completeness validation failed
			return response()
			->json(['status' => 'fail', 'reason' => AEValidator::$lastError])
			->setStatusCode(400, 'Bad request');

		}else if(Auth::once(["name" => $request->username, "password" => $request->password])) {
			//Store data in database
			$user = Auth::user();
			$user->ae_system = utf8_encode($request->input('aeSystem'));
			$user->save();

			//Send response
			return response()
			->json(['status' => 'success'])
			->setStatusCode(200, 'success');

		}else {
			//Authentication failed
			Log::warning("Authentication failed!");
			return response()
			->json(['status' => 'fail'])
			->setStatusCode(401, 'Authentication failed')
			->header('WWW-authenticate', "Basic realm=\"CCDatabase\"");

		}
	}

	public function postSearchUsers(Request $request) {
		if($query = $request->input('search')) {
			$users = User::where('name', 'LIKE', '%' . $request->input('search') . '%')->paginate(15);
		}else {
			$users = User::paginate(15);
		}
		if($users) {
			$names = [];
			foreach($users as $user) {
				array_push($names, array(
					"label" => $user->name,
					"link" => route("ae.view", ["user" => $user])
				));
			}
			return response()
			->json($names);
		}else return response()->json([]);
	}
}
