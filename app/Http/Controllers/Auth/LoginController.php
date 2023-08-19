<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\CredentialResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Enums\RegisterType;
use App\Enums\Message\MessageSuccess;
use App\Enums\Message\MessageError;
use App\Libraries\Response;
use App\Libraries\Validation;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        // Set validation rules
        $rules = [
            'register_type' => ['required'],
        ];

        //  Validate rules
        $validator = Validator::make($request->all(), $rules);

        //  Check if validator is failed
        if ($validator->fails()) {
            //  Get validation summary
            $validation = Validation::summarize($validator);

            //  Response as error
            $error = (object) MessageError::INVALID_FORM;
            return Response::error($error->code, $validation, trans($error->message));
        }

        $register_type = $request->input('register_type');

        // REGISTER_TYPE : PHONE
        if ($register_type == RegisterType::phone) {

            // Set validation rules
            $rules = [
                'phone' => ['required', 'exists:users,phone'],
            ];

            // Validate rules
            $validator = Validator::make($request->all(), $rules);

            // Check if validator is failed
            if ($validator->stopOnFirstFailure()->fails()) {
                // Get validation summary
                $validation = Validation::summarize($validator);

                // Response as error
                $error = (object) MessageError::ACCOUNT_NOT_FOUND;
                return Response::error($error->code, $validation, trans($error->message));
            }

            $phone = $request->input('phone');

            $user = User::where('phone', $phone)->first();

            // Set resource data
            $resource = new CredentialResource($user);

            // Response as success
            $success = (object) MessageSuccess::LOGGED_IN;
            return Response::success($success->code, $resource, trans($success->message));
        }
    }
}
