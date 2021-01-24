<?php

namespace App\Models;

use MercadoPago;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMercadoPago extends Model
{
    const TOKEN = 'TEST-2258135264899031-112100-6dd8301e50db089345c52f4b09002ea7-627662436';

    use HasFactory;

    protected $fillable = [
        'payment_id',
        'payment_type_id',
        'user_id',
        'customer_id',
        'status_pago_mp',
        'status'
    ];

    public function store($request)
    {
        $payment = new  MercadoPago\Payment();
        $payment->transaction_amount = $request->transactionAmount;
        $payment->token = $request->token;
        $payment->description = $request->description;
        $payment->installments = 1;
        $payment->payment_method_id = $request->paymentMethodId;
        $payment->payer = array(
          "email" => $request->email
        );
        $payment->save();

        if ($payment->status == 'approved') {

            self::create([
                'payment_id' => $payment->id,
                'payment_type_id' => $payment->payment_type_id,
                'user_id' => auth()->user()->id,
                'customer_id' => auth()->user()->customer->id,
                'status_pago_mp' => $payment->status,
            ]);

            $pagoSystem = Payment::create([
                'order_number' => $payment->id,
                'user_id' => auth()->user()->id,
                'servicio_id' => $request->servicio_id,
                'ciclo_id' => $request->ciclo_id,
                'ticket_id' => $request->ticket_id,
                'monto' => session('amount'),
                'producto_id' => $request->producto_id,
                'plataform_payment' => 'ml',
                'status' => 1
            ]);
            
            if ($request->producto_id == null) {
                if ($pagoSystem) {
                    Subscriptions::storeSubscription($request);
                }
            }else{
                ProductoUser::create([
                    'user_id' => auth()->user()->id,
                    'producto_id' => $request->producto_id,
                    'status' => 1
                ]);
            }
            
        }else{
            Payment::create([
                'order_number' => $payment->id,
                'user_id' => auth()->user()->id,
                'servicio_id' => $request->servicio_id,
                'ciclo_id' => $request->ciclo_id,
                'ticket_id' => $request->ticket_id,
                'monto' => session('amount'),
                'producto_id' => $request->producto_id,
                'plataform_payment' => 'ml',
                'status' => 2
            ]);
        }

        return $payment;
    }

    public function store_free($request)
    {
        $pagoSystem = Payment::create([
            'user_id' => auth()->user()->id,
            'servicio_id' => $request->servicio_id,
            'ciclo_id' => $request->ciclo_id,
            'ticket_id' => $request->ticket_id,
            'monto' => session('amount'),
            'producto_id' => $request->producto_id
        ]);
        
        if ($request->producto_id == null) {
            if ($pagoSystem) {
                Subscriptions::storeSubscription($request);
            }
        }else{
            ProductoUser::create([
                'user_id' => auth()->user()->id,
                'producto_id' => $request->producto_id,
                'status' => 1
            ]);
        }
            

        return true;
    }


    public function message($status)
    {
        switch ($status) {
            case 'pending_contingency':
                return 'Estamos procesando tu pago. No te preocupes, menos de 2 días hábiles te avisaremos por e-mail si se acreditó.';
                break;
            case 'pending_review_manual':
                return 'Estamos procesando tu pago. No te preocupes, menos de 2 días hábiles te avisaremos por e-mail si se acreditó o si necesitamos más información.';
                break;
            case 'cc_rejected_bad_filled_card_number':
                return 'Revisa el número de tarjeta.';
                break;
            case 'cc_rejected_bad_filled_date':
                return 'Revisa la fecha de vencimiento.';
                break;
            case 'cc_rejected_bad_filled_other':
                return 'Revisa los datos.';
                break;
            case 'cc_rejected_bad_filled_security_code':
                return 'Revisa el código de seguridad de la tarjeta.';
                break;
            case 'cc_rejected_max_attempts':
                return 'Llegaste al límite de intentos permitidos. Elige otra tarjeta.';
                break;
            default:
                return 'No se puede procesar tu pago.';
                break;
        }
    }
}
