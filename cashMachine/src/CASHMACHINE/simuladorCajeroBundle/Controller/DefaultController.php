<?php

namespace CASHMACHINE\simuladorCajeroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
	#Nombre hardcodeado simulando una lectura a una tabla de usuarios en la base de datos
	private $nombreUsuario = "Divani David Fuentes Marcos";

    public function indexAction()
    {
        return $this->render('CASHMACHINEsimuladorCajeroBundle:Default:index.html.twig', array('name' => $this->nombreUsuario));
    }


    public function retiroEfectivoAction()
    {	
        return $this->render('CASHMACHINEsimuladorCajeroBundle:Default:retiroEfectivo.html.twig', array('name' => $this->nombreUsuario));
    }

    public function disposicionEfectivoAction(Request $peticion)
    {
    	$cantidad = $peticion->get('cantidad');
    	
    	#Se hacen calculos correspondientes
    	$data = $this->calculaBilletes($cantidad);
    	
    	#Se genera la respuesta del calculo en formato JSON
    	$response = new JsonResponse();
		return $response->setData($data);
    }

    #Funcion para realizar calculo de billetes
    public function calculaBilletes($cantidad)
    {
    	$cienes = 0;
    	$cincuentas = 0;
    	$veintes = 0;
    	$diez = 0;

    	do
    	{
    		if($cantidad >= 100)
	    	{
	    		list($cienes,$cantidad) = $this->divideCantidades($cantidad,100);
	    	}
	    	elseif ($cantidad >= 50) 
	    	{
	    		list($cincuentas,$cantidad) = $this->divideCantidades($cantidad,50);
	    	}
	    	elseif ($cantidad >= 20) 
	    	{
	    		list($veintes,$cantidad) = $this->divideCantidades($cantidad,20);
	    	}
	    	elseif ($cantidad >= 10) 
	    	{
	    		list($diez,$cantidad) = $this->divideCantidades($cantidad,10);
	    	}
	    	else
	    	{
	    		$cantidad = 0;
	    	}
    	} while ($cantidad !== 0);

    	$response = array
    	(
    		'billetesCien' 		=> $cienes,
    		'billetesCincuenta' => $cincuentas,
    		'billetesVeinte'	=> $veintes,
    		'billetesDiez' 		=> $diez
    	);
    	
   		return $response;
    }

    public function divideCantidades($cantidad,$denominacion)
    {
    	$residuo = $cantidad % $denominacion;
    	$division = $cantidad / $denominacion;
    	
    	if($residuo === 0)
    	{
    		$numeroBilletes = $division;
    		$cantidadRestante = 0;
    	}
    	else
    	{
    		$numeroBilletes = floor($division);
    		$cantidadRestante 	= $residuo;
    	} 

    	return array($numeroBilletes,$cantidadRestante);
    }

}
