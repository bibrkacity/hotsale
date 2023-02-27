<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Registration of new user
 */
class RegisterService
{
    /**
     * Registration of new user
     * @param Request $request
     * @return array
     */
    public static function register(Request $request): array
    {
        try{
            $http_code = 200;
            $data = [];

            $rules = [
                'name'      =>'required|string',
                'email'     =>'required|email', /* можно было тут уникальность проверить: unique:App\Models\User*/
                'password'  =>'required|confirmed|min:8',
            ];

            $validator = Validator::make($request->all() , $rules);

            if( $validator->fails() ){
                throw new ValidationException($validator);
            }

            $users = self::exists_emails();
            foreach($users as $user){
                if($user['email'] == $request->email)
                    \Log::info('Dub: '.$request->email . ' id='.$user['id'] . ' name='.$user['name'] );
            }

            User::create([
                'name'      => $request->name,
                'last_name' => $request->last_name,
                'password'  => Hash::make($request->password),
                'email'     => $request->email
            ]);

            $data['message']='Ok';

        } catch(ValidationException $e){
            $http_code = 422;
            $errors = $e->validator->errors();
            $messages = $errors->messages();
            $data['message'] = $messages;
        }
        catch(\Exception $e){
            $http_code = 500;
            $data['message'] = $e->getMessage();
        }

        return [$data, $http_code];
    }


    private static function exists_emails(): array
    {
        return [
            [
                'id'    =>1,
                'name'  =>'John',
                'email' => 'john@doe.com',
            ]
        ];
    }
}
