<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\FlowPayment;
use App\Models\ProductoUser;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use Illuminate\Support\Collection;

class FlowPaymentsController extends Controller
{
    public function payments_store(Request $request)
    {
        if($request->transactionAmount < 1)
        {
            $pagoSystem = Payment::create([
                'user_id' => auth()->user()->id,
                'servicio_id' => $request->servicio_id,
                'ciclo_id' => $request->ciclo_id,
                'ticket_id' => $request->ticket_id,
                'monto' => $request->transactionAmount,
                'producto_id' => $request->producto_id
            ]);
            
            if ($request->producto_id == null) {
                if ($pagoSystem) {
                    Subscriptions::storeSubscription($request);
                }
            }else{
                ProductoUser::create([
                    'user_id' => auth()->user()->id,
                    'producto_id' => $request->producto_id
                ]);
            }

            return redirect()->route('my-subscriptions')->with('message', 'Su pago ha sido procesado.');
            
        }
        //Para datos opcionales campo "optional" prepara un arreglo JSON
        $optional = array(
            // "rut" => $request->rut,
            "servicio" => $request->servicio_id,
            "ciclo" => $request->ciclo_id,
            "ticket" => $request->ticket_id,
            "renovated" => $request->renovated,
            "producto" => $request->producto_id,
            'user' => auth()->user()->id,
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
             //dd($response);
            //Prepara url para redireccionar el browser del pagador
            $redirect = $response["url"] . "?token=" . $response["token"];
            //dd($response,$redirect);
            return redirect($redirect);
        } catch (\Exception $e) {
             //dd($e,'1');
            return redirect()->back()->with('message', 'Error: '.$e->getCode().' - '.$e->getMessage());
        }
    }

    public function redirect_payment(Request $request)
    {
        
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

            
            if($response['status'] = 2){
                
                //Actualiza los datos en su sistema
                /* status
                1 pendiente de pago
                2 pagada
                3 rechazada
                4 anulada
                */
                
                $pagoSystem = Payment::create([
                    'order_number' => $response['flowOrder'],
                    'user_id' => $response['optional']['user'],
                    'servicio_id' => $response['optional']['servicio'],
                    'ciclo_id' => $response['optional']['ciclo'],
                    'ticket_id' => $response['optional']['ticket'],
                    'monto' => $response['paymentData']['amount'],
                    'producto_id' => $response['optional']['producto'],
                    'plataform_payment' => 'flow',
                    'status' => 1
                ]);
                
                $request = collect([
                    'order_number' => $response['flowOrder'],
                    'user_id' => $response['optional']['user'],
                    'servicio_id' => $response['optional']['servicio'],
                    'ciclo_id' => $response['optional']['ciclo'],
                    'renovated' => $response['optional']['renovated'],
                    'ticket_id' => $response['optional']['ticket'],
                    'monto' => $response['paymentData']['amount'],
                    'producto_id' => $response['optional']['producto'],
                    'plataform_payment' => 'flow',
                    'status' => 1
                ]);


                if ($pagoSystem->producto_id == null) {
                    if ($pagoSystem) {
                        Subscriptions::storeSubscriptionFlow($request);
                    }
                }else{
                    ProductoUser::create([
                        'user_id' => $response['optional']['user'],
                        'producto_id' => $response['optional']['producto'],
                        'status' => 1
                    ]);
                }

                return $this->redirect_confirm($response);

            }elseif($response['status'] = 1){
                $pagoSystem = Payment::create([
                    'order_number' => $response['flowOrder'],
                    'user_id' => $response['optional']['user'],
                    'servicio_id' => $response['optional']['servicio'],
                    'ciclo_id' => $response['optional']['ciclo'],
                    'ticket_id' => $response['optional']['ticket'],
                    'monto' => $response['paymentData']['amount'],
                    'producto_id' => $response['optional']['producto'],
                    'plataform_payment' => 'flow',
                    'status' => 1
                ]);
                
                $request = collect([
                    'order_number' => $response['flowOrder'],
                    'user_id' => $response['optional']['user'],
                    'servicio_id' => $response['optional']['servicio'],
                    'ciclo_id' => $response['optional']['ciclo'],
                    'renovated' => $response['optional']['renovated'],
                    'ticket_id' => $response['optional']['ticket'],
                    'monto' => $response['paymentData']['amount'],
                    'producto_id' => $response['optional']['producto'],
                    'plataform_payment' => 'flow',
                    'status' => 2
                ]);


                if ($pagoSystem->producto_id == null) {
                    if ($pagoSystem) {
                        Subscriptions::storeSubscriptionFlow($request);
                    }
                }else{
                    ProductoUser::create([
                        'user_id' => $response['optional']['user'],
                        'producto_id' => $response['optional']['producto'],
                        'status' => 2
                    ]);
                }
            }
            
            
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error_payment', 'Error: '.$e->getCode().' - '.$e->getMessage());
        }
    }

    public function search_flow_order($flow)
    {
        try {
            $params = array(
                "flowOrder" => $flow
            );
            $serviceName = "payment/getStatusByFlowOrder";
            $flowApi = new FlowPayment();
            $response = $flowApi->send($serviceName, $params, "GET");
            
            print_r($response);
            
            
        } catch (\Exception $e) {
            echo "Error: " . $e->getCode() . " - " . $e->getMessage();
        }
    }

    public function redirect_confirm($response)
    {
        return view('servicios.confirm',['data' => $response]);
    }

    public function redirect_app(Request $request)
    {
        return redirect()->route('my-subscriptions');
    }
}
