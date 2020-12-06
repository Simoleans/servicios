<?php

use App\Models\Configuration;

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

function nameApp()
{
    if (Configuration::latest()->first() != null) {
        return Configuration::latest()->first()->nombre;
    }else{
        return 'Aplicación';
    }
    
}

function faviconApp()
{
    if (Configuration::latest()->first() != null) {
        return 'storage/'.Configuration::latest()->first()->favicon;
    }else{
        return '';
    }
}

function logoApp()
{
    if (Configuration::latest()->first() != null) {
        return 'storage/'.Configuration::latest()->first()->logo;
    }else{
        return 'img/logo.png';
    }
}


?>