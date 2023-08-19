<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\User\CredentialResource;
use App\Http\Controllers\Controller;
use App\Enums\Message\MessageSuccess;
use App\Enums\Message\MessageError;
use App\Libraries\Response;
use App\Libraries\Validation;
use App\Traits\CanRegisterUser;

class RegisterController extends Controller
{
    use CanRegisterUser;

    public function index(Request $request)
    {
        //  Set validation rules
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
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

        //  Register new user
        $newUser = $this->registerUser($request);

        //  Set resource data
        $resource = new CredentialResource($newUser);

        //  Response as success
        $success = (object) MessageSuccess::REGISTERED;
        return Response::success($success->code, $resource, trans($success->message));
    }
}
