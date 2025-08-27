<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Participants;
use Exception;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function index(Request $request) : JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 2);

            $participante = Participant::paginate($perPage)->makeHidden([ 'created_at', 'updated_at']);
            return response()->json(['message' => '✅ Peticion correcta ','data'=>$participante] , 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener participantes', 'details' => $e->getMessage()], 500);

        }

    }

    public function show ($id) : JsonResponse
    {
        try {
            $participante = Participant::findOrFail($id)->makeHidden(['id', 'created_at', 'updated_at']);
            return response()->json(['message' => '✅ Participante encontrado  correctamente','data'=>$participante], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Participante no encontrado', 'details' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request) : JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cuadro_id' => 'required|exists:cuadros,id',
            'fecha_inicio' => 'required|date',
            'numero_turno' => 'required|integer',
            'estado' => 'in:activo,retirado,pagado',
        ]);

        $existe =Participant::where('user_id',$request->user_id)
            ->where('cuadro_id',$request->cuadro_id)
            ->first();


        try {
            if ($existe) {
                return response()->json(['error' => 'El participante ya existe en este cuadro'], 400);
            }

            $participante = Participant::create($request->all());
            return response()->json($participante, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear participante', 'details' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $id) : JsonResponse
    {
        $request->validate([

            'fecha_inicio' => 'date',
            'numero_turno' => 'integer',
            'estado' => 'in:activo,retirado,pagado',


        ]);

        try {
            $participante = Participant::findOrFail($id);
            $participante->update($request->all());
            return response()->json( ['message' => '✅ Participante actualizado correctamente', 'data' => $participante],200);

        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar participante', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id) : JsonResponse
    {
        try {
            $participante = Participant::findOrFail($id);
            $participante->delete();
            return response()->json(['message' => '✅ Participante eliminado correctamente'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar participante', 'details' => $e->getMessage()], 500);
        }
    }



    public function getByCuadro($cuadro_id): JsonResponse
    {
        try {
            $participantes = Participant::where('cuadro_id', $cuadro_id)->paginate(10);

            return response()->json([
                'message' => '✅ Participantes del cuadro obtenidos correctamente',
                'data' => $participantes
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => '❌ Error al obtener participantes del cuadro',
                'details' => $e->getMessage()
            ], 500);
        }


    }


}
