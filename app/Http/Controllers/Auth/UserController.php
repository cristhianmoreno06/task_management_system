<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class UserController extends Controller
{
    public function profile(int $id)
    {
        try {
            $user = User::whereId($id)->first();
            $tasks = Task::where('user_id', auth()->id())->paginate(10);

            return view('profile.index',compact('user', 'tasks'));
        }catch (Throwable $throwable){
            // Generar un ID único para el error
            $errorId = uniqid('ERR_', true);

            // Formatear la respuesta del log
            $errorMessage = "
            #######################################
            Fecha del error: " . now() . "
            --------------------------------
            error id: {$errorId}
            --------------------------------
            Mensaje de Error: {$throwable->getMessage()}
            ---------------------------------------------------
            codigo: {$throwable->getCode()}
            -----------------------------------
            Archivo: {$throwable->getFile()}
            ----------------------------------
            Linea del error: {$throwable->getLine()}
            ##########################################
            ";

            // Registrar el error en el log junto con el ID
            Log::channel('task_error_log')->error($errorMessage);

            // Redirigir al usuario con el mensaje de error y el ID
            return redirect()->route('profile', $id)
                ->with('error', "Ocurrió un error catastrófico al mostrar la información del usuario. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }

    public function updateProfile(int $id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if ($validator->fails()) {
                return redirect()->route('profile', $id)
                    ->with('error', "Ocurrió un error al guardar el usuario {$validator->errors()}");
            }

            $user = User::whereId($id)->first();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));

            if (!$user->save()) {
                Alert::error('Error de guardado', 'El usuario no fue actualizado correctamente.');
                return redirect()->route('profile', $id);
            }

            Alert::success('Guardado exitoso', 'Usuario actualizado correctamente.');
            return view('profile.index', compact('user'));
        } catch (Throwable $throwable){
            // Generar un ID único para el error
            $errorId = uniqid('ERR_', true);

            // Formatear la respuesta del log
            $errorMessage = "
            #######################################
            Fecha del error: " . now() . "
            --------------------------------
            error id: {$errorId}
            --------------------------------
            Mensaje de Error: {$throwable->getMessage()}
            ---------------------------------------------------
            codigo: {$throwable->getCode()}
            -----------------------------------
            Archivo: {$throwable->getFile()}
            ----------------------------------
            Linea del error: {$throwable->getLine()}
            ##########################################
            ";

            // Registrar el error en el log junto con el ID
            Log::channel('task_error_log')->error($errorMessage);

            // Redirigir al usuario con el mensaje de error y el ID
            return redirect()->route('profile', $id)
                ->with('error', "Ocurrió un error catastrófico al actualizar la usuario. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }
}
