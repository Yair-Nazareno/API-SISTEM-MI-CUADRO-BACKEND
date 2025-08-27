<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Exception;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        try {
            $perPage = $request->get('per_page',5);

            $payment = Payment::paginate($perPage)->makeHidden([ 'created_at', 'updated_at']);
            return response()->json(['message' => '✅ Peticion correcta ','data'=>$payment] , 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener pagos', 'details' => $e->getMessage()], 500);

        }



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        $request->validate([
            'participante_id' => 'required|integer|exists:participants,id',
            'monto' => 'required|numeric',
            'fecha_pago' => 'required|date',


        ]);
            $existe= Payment::where ('participante_id ',$request->participante_id)
            ->where('monto',$request->monto)
            ->where('fecha_pago',$request->fecha_pago)
            ->first();



        try {

            if ($existe) {
                return response()->json(['error' => 'El pago ya existe'], 400);
            }

            $payment = Payment::create($request->all());
            return response()->json($payment, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear pago', 'details' => $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pagos = Payment::findOrFail($id)->makeHidden(['created_at', 'updated_at']);

            if (!$pagos) {
                return response()->json(['error' => 'Pago no encontrado'], 404);
            }


        }
        catch (Exception $e) {
            return response()->json(['error' => 'Pago no encontrado', 'details' => $e->getMessage()], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'participante_id' => 'integer|exists:participants,id',
            'monto' => 'numeric',
            'fecha_pago' => 'date',
            'comprobante' => 'string',

            'estado' => 'in:pendiente,verificado,rechazado',
        ]);

        try {
            $payment = Payment::findOrFail($id);
            $payment->update($request->all());
            return response()->json($payment, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar pago', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $payment = Payment::findOrFail($id);

           if (!$payment) {
                return response()->json(['error' => 'Pago no encontrado'], 404);
            }
            $payment->delete();
            return response()->json(['message' => 'Pago eliminado correctamente'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar pago', 'details' => $e->getMessage()], 500);
        }
    }


}

