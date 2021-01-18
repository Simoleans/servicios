<?php

namespace App\Http\Controllers;

use App\Models\FlowPayment;
use Illuminate\Http\Request;

class FlowPaymentsController extends Controller
{
    public function payments_store(Request $request)
    {
        // dd($request->all());
        //Para datos opcionales campo "optional" prepara un arreglo JSON
        $optional = array(
            "rut" => "9999999-9",
            "otroDato" => "otroDato"
        );
        $optional = json_encode($optional);

        //Prepara el arreglo de datos
        $params = array(
            "commerceOrder" => rand(1100,2000),
            "subject" => "Pago de prueba",
            "currency" => "CLP",
            "amount" => 5000,
            "email" => auth()->user()->email,
            "paymentMethod" => 9,
            "urlConfirmation" => route("confirmation-flow"),
            "urlReturn" => FlowPayment::get("BASEURL") ."/examples/payments/result.php",
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
            echo $e->getCode() . " - " . $e->getMessage();
        }
    }

    public function redirect_payment($token)
    {
        // dd($token);
        try {
            if(!isset($_POST["token"])) {
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
            
            print_r($response);
            
            
        } catch (\Exception $e) {
            echo "Error: " . $e->getCode() . " - " . $e->getMessage();
        }
    }
}
