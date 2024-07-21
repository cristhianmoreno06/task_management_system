<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserController extends Controller
{
    public function profile(int $id)
    {
        try {
            $user = User::whereId($id)->first();

            return view('profile.index',compact('user'));
        }catch (Throwable $throwable){
            dd($throwable);
        }
    }

    public function updateProfile(int $id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages($validator->errors()->toArray());
            }

            $userUpdate = User::whereId($id)->first();
            $userUpdate->name = $request->get('name');
            $userUpdate->email = $request->get('email');
            $userUpdate->password = Hash::make($request->get('password'));
            $userUpdate->save();

            return view('profile.index', compact('id'));
        } catch (ValidationException $e) {
            // Aquí manejas los errores de validación
            $errors = $e->validator->getMessageBag()->toArray();
            // Puedes hacer lo que quieras con los errores, como mostrarlos en la vista, por ejemplo
            return throw ValidationException::withMessages($validator->errors()->toArray());
        } catch (Throwable $e) {
            dd($e);
        }
    }
}
