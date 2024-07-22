<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $search = $request->get('search');
            $completed = $request->get('completed');
            $notCompleted = $request->get('not_completed');
            $userId = $request->get('user_id');

            $query = Task::query();

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            }

            if ($completed && !$notCompleted) {
                $query->where('completed', true);
            } elseif ($notCompleted && !$completed) {
                $query->where('completed', false);
            }

            if ($userId) {
                $query->where('user_id', $userId);
            }

            $tasks = $query->with('user')->paginate(10);

            $users = User::all();

            return view('tasks.index', compact('tasks', 'users', 'search', 'completed', 'notCompleted'));
        }catch (Throwable $throwable) {
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
            return redirect()->route('tasks.index')
                ->with('error', "Ocurrió un error catastrófico al crear la tarea. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }

    public function show(int $taskId)
    {
        try {
            $task = Task::whereId($taskId)->with('user')->first();

            return view('tasks.show', compact('task'));
        }catch (Throwable $throwable) {
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
            return redirect()->route('tasks.index')
                ->with('error', "Ocurrió un error catastrófico al crear la tarea. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }

    public function create()
    {
        $users = User::all();

        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'user_id' => 'required|integer',
                'expiration_date' => 'required|date',
            ]);

            $task = new Task();
            $task->user_id = $request->get('user_id');
            $task->title = $request->get('title');
            $task->description = $request->get('description');
            $task->expiration_date = $request->get('expiration_date');

            if (!$task->save()) {

                Alert::error('Error de guardado', 'La tarea no fue creada correctamente.');
                return redirect()->route('tasks.index');
            }

            Alert::success('Guardado exitoso', 'Tarea creada correctamente.');
            return redirect()->route('tasks.index');
        } catch (Throwable $throwable) {
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
            return redirect()->route('tasks.index')
                ->with('error', "Ocurrió un error catastrófico al crear la tarea. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }

    public function edit(int $taskId)
    {
        try {
            $task = Task::whereId($taskId)->with('user')->first();
            $users = User::all();

            return view('tasks.edit', compact('task', 'users'));
        }catch (Throwable $throwable) {
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
            return redirect()->route('tasks.index')
                ->with('error', "Ocurrió un error catastrófico al crear la tarea. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }

    public function update(Request $request, int $taskId)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'user_id' => 'required|integer',
                'expiration_date' => 'required|date',
            ]);

            $task = Task::whereId($taskId)->first();
            $task->user_id = $request->get('user_id');
            $task->title = $request->get('title');
            $task->description = $request->get('description');
            $task->expiration_date = $request->get('expiration_date');

            if (!$task->save()) {

                Alert::error('Error de guardado', 'La tarea no fue actualizada correctamente.');
                return redirect()->route('tasks.index');
            }

            Alert::success('Guardado exitoso', 'Tarea actualizada correctamente.');
            return redirect()->route('tasks.index');
        }catch (Throwable $throwable) {
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
            return redirect()->route('tasks.index')
                ->with('error', "Ocurrió un error catastrófico al crear la tarea. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }

    public function destroy(int $task_id)
    {
        try {
            $user = Auth::user();

            if (!$user->hasRole('admin')) {
                return redirect()->route('tasks.index')->withErrors('No tienes permiso para eliminar tareas.');
            }

            $task = Task::findOrFail($task_id);
            $task->delete();

            Alert::success('Eliminación exitosa', 'Tarea eliminada correctamente.');

            return redirect()->route('tasks.index');
        }catch (Throwable $throwable) {
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
            return redirect()->route('tasks.index')
                ->with('error', "Ocurrió un error catastrófico al crear la tarea. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }

    public function changeStatus(Request $request, $taskId)
    {
        try {
            // Validar los datos recibidos si es necesario
            $request->validate([
                'completed' => 'required'
            ]);

            // Buscar la tarea por su ID
            $task = Task::findOrFail($taskId);

            // Cambiar el estado de la tarea
            $task->completed = $request->completed;
            $task->save();
            // Retornar una respuesta adecuada
            return response()->json(['message' => 'Estado de la tarea cambiado con éxito.'], 200);
        }catch (Throwable $throwable) {
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
            return redirect()->route('tasks.index')
                ->with('error', "Ocurrió un error catastrófico al crear la tarea. Por favor, contacte con el administrador del sistema y proporcione este código de error: {$errorId}");
        }
    }
}
