<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TaskApiController extends Controller
{
    public function listTask(): JsonResponse
    {
        try {
            $task = Task::all();

            return $this->setResponse(
                'Listado de tareas',
                'tareas listadas satisfactoriamente',
                $task,
                Response::HTTP_OK
            );
        } catch (Throwable $throwable) {
            return $this->setResponse(
                'Listado de tareas',
                'No se listaron las tareas correctamente',
                $throwable->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function storeTask(Request $request)
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

                return $this->setResponse(
                    'Creación de tarea',
                    'No se creo la tarea correctamente',
                    'Hubo un error al crear la tarea en base de datos',
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }

            return $this->setResponse(
                'Creación de tarea',
                'tarea creada satisfactoriamente',
                $task,
                Response::HTTP_CREATED
            );
        }catch (Throwable $throwable) {
            return $this->setResponse(
                'Creación de tarea',
                'No se creo la tarea correctamente',
                $throwable->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function updateTask(Request $request, int $taskId)
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

                return $this->setResponse(
                    'Edición de tarea',
                    'No se edito la tarea correctamente',
                    'Hubo un error al editar la tarea en base de datos',
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }

            return $this->setResponse(
                'Edición de tarea',
                'tarea editada satisfactoriamente',
                $task,
                Response::HTTP_CREATED
            );
        }catch (Throwable $throwable) {
            return $this->setResponse(
                'Edición de tarea',
                'No se edito la tarea correctamente',
                $throwable->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function deleteTask(int $task_id)
    {
        try {
            $task = Task::findOrFail($task_id);

            if (!$task->delete()) {

                return $this->setResponse(
                    'Eliminación de tarea',
                    'No se elimino la tarea correctamente',
                    'Hubo un error al eliminar la tarea en base de datos',
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }

            return $this->setResponse(
                'Eliminación de tarea',
                'tarea eliminada satisfactoriamente',
                $task,
                Response::HTTP_CREATED
            );
        }catch (Throwable $throwable) {
            return $this->setResponse(
                'Eliminación de tarea',
                'No se elimino la tarea correctamente',
                $throwable->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    /**
     * Método para el mapeo de respuesta tipo Json
     * @param string $title
     * @param string $text
     * @param mixed $detail
     * @param int $status
     * @return JsonResponse
     */
    public function setResponse(string $title, string $text, $detail, int $status): JsonResponse
    {
        return response()->json([
            'title' => $title,
            'text' => $text,
            'detail' => $detail
        ], $status);
    }
}
