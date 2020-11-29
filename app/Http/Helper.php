<?php 

/**
 * Función para scaar porcentaje en productos adentro de la tienda de un servicio
 * $subs se inicializa en null para no restarle el porcentaje, si es diferente de null entonces el producto se le restara su procentaje
 */
function porcentSubscriptionProduct($precio,$porcentaje = null)
{
    if($porcentaje != null)
    {
        return $precio - ($precio*$porcentaje/100);
        
    }else{

        return $precio;
    }
    
}


?>