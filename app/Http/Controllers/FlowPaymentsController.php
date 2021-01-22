<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\FlowPayment;
use Illuminate\Http\Request;

class FlowPaymentsController extends Controller
{
    public function payments_store(Request $request)
    {
        dd($request->all());
        //Para datos opcionales campo "optional" prepara un arreglo JSON
        $optional = array(
            "rut" => $request->rut,
            "servicio" => $request->servicio_id,
            "ciclo" => $request->ciclo_id,
            "ticket" => $request->ticket_id,
            "renovated" => $request->renovated,
            "producto" => $request->producto_id
        );
        $optional = json_encode($optional);

        //Prepara el arreglo de datos
        $params = array(
            "commerceOrder" => rand(1100,2000),
            "subject" => $request->subject,
            "currency" => "CLP",
            "amount" => round($request->transactionAmount),
            "email" => auth()->user()->email,
            "paymentMethod" => 9,
            "urlConfirmation" => route('redirect-success-flow'),
            "urlReturn" => route("confirmation-flow"),
            "optional" => $optional
        );

       
        //Define el metodo a usar
        $serviceName = "payment/create";

        try {
            // Instancia la clase FlowApi
            $flowApi = new FlowPayment();
            // Ejecuta el servicio
            $response = $flowApi->send($serviceName, $params,"POST");
            //Prepara url para redireccionar el browser del pagador
            $redirect = $response["url"] . "?token=" . $response["token"];
            return redirect($redirect);
        } catch (\Exception $e) {
            // dd($params);
            return redirect()->back()->with('message', 'Error: '.$e->getCode().' - '.$e->getMessage());
        }
    }

    public function redirect_payment(Request $request)
    {
         //dd($request->all());
        try {
            if(!isset($request->token)) {
                throw new \Exception("No se recibio el token", 1);
            }
            $token = filter_input(INPUT_POST, 'token');
            $params = array(
                "token" => $token
            );
            $serviceName = "payment/getStatus";
            $flowApi = new FlowPayment();
            $response = $flowApi->send($serviceName, $params, "GET");

            dd($response);
            
            //Actualiza los datos en su sistema
            /* status
            1 pendiente de pago
            2 pagada
            3 rechazada
            4 anulada
            */

            // Payment::create([
            //     'order_number' => $response->flowOrder,
            //     'user_id' => auth()->user()->id,
            //     'servicio_id' => $request->servicio_id,
            //     'ciclo_id' => $request->ciclo_id,
            //     'ticket_id' => $request->ticket_id,
            //     'monto' => session('amount'),
            //     'producto_id' => $request->producto_id,
            //     'plataform_payment' => 'ml',
            //     'status' => 1
            // ]);
            
            
        } catch (\Exception $e) {
            echo "Error: " . $e->getCode() . " - " . $e->getMessage();
        }
    }

    public function redirect_succes(Request $request)
    {
        dd("llegue");
        try {
            if(!isset($request->token)) {
                throw new \Exception("No se recibio el token", 1);
            }
            $token = filter_input(INPUT_POST, 'token');
            $params = array(
                "token" => $token
            );
            $serviceName = "payment/getStatus";
            $flowApi = new FlowPayment();
            $response = $flowApi->send($serviceName, $params, "GET");
            
            //Actualiza los datos en su sistema
            
            dd("fuuu");
            
            
        } catch (\Exception $e) {
            echo "Error: " . $e->getCode() . " - " . $e->getMessage();
        }
    }
}
