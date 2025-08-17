<?php


namespace App\Http\Controllers;
use App\Models\Cuadro;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;

class CuadroController extends Controller
{



    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 2);

            $cuadro = Cuadro::paginate($perPage)->makeHidden(['id', 'created_at', 'updated_at']);
            return response()->json(['message' => '✅ Peticion correcta ','data'=>$cuadro] , 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener cuadros', 'details' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {

        try {
            $cuadro = Cuadro::findOrFail($id)->makeHidden(['id', 'created_at', 'updated_at']);
            return response()->json(['message' => '✅ Cuadro creado  correctamente','data'=>$cuadro], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Cuadro no encontrado', 'details' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request): JsonResponse
{
   $request->validate([
        'name' => 'required|string|max:255',
        'monto_individual' => 'required|numeric|min:0',
        'total_participantes' => 'required|integer|min:1|max:15',
        'frecuencia_pago' => 'required|in:semanal,quincenal,mensual',
        'duracion' => 'required|integer|min:1',
        'duracion_dias' => 'required|integer|min:0',
        'fondo_respaldo' => 'required|numeric|min:0',
        'organizador_id' => 'required|exists:users,id',
        'activo' => 'boolean',
    ]);

        try {
            $cuadro = Cuadro::create($request->all());
            return response()->json($cuadro, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear cuadro', 'details' => $e->getMessage()], 500);
        }
}


    public function update (Request $resquest, $id): JsonResponse

    {
        $resquest->validate([
            'name' => 'string|max:255',
            'monto_individual' => 'numeric|min:0',
            'total_participantes' => 'integer|min:1|max:15',
            'frecuencia_pago' => 'in:semanal,quincenal,mensual',
            'duracion' => 'integer|min:1',
            'duracion_dias' => 'integer|min:0',
            'fondo_respaldo' => 'numeric|min:0',
            'organizador_id' => 'exists:users,id',
        ]);
        try {
            $cuadro = Cuadro::findOrFail($id);
            $cuadro ->update($resquest->all());
            return response()->json(['message' => '✅ Cuadro Actualizado correctamente','data'=>$cuadro], 200);
        }
        catch (Exception $e){
            return response()->json(['error' => 'Error al actualizar cuadro', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse

    {
        try{
            $cuadro = Cuadro::findOrFail($id);
            $cuadro ->delete();
            return response()->json(['message' => 'Cuadro eliminado correctamente'], 200);

        }
        catch (Exception $e){
            return response()->json(['error' => 'Error al eliminar cuadro', 'details' => $e->getMessage()], 500);
        }

    }




}
