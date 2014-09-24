<?php

namespace CASHMACHINE\simuladorCajeroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	#No needed 
    public function indexAction($name)
    {
        return $this->render('CASHMACHINEsimuladorCajeroBundle:Default:retiroEfectivo.html.twig', array('name' => $nombreUsuario));
    }


    public function retiroEfectivoAction()
    {	
    	#Nombre hardcodeado siulando una lectura a una tabla de usuarios en la base de datos
    	$nombreUsuario = "Divani David Fuentes Marcos";

        return $this->render('CASHMACHINEsimuladorCajeroBundle:Default:retiroEfectivo.html.twig', array('name' => $nombreUsuario));
    }

    public function disposicionEfectivoAction(Request $peticion)
    {
    	$cantidad = $peticion->get('cantidad');
    	
    	#Se hacen calculos correspondientes
    	$response = $this->calculaBilletes($cantidad);
    	#Se convierte a JSON la respuesta del calculo
    	$response = json_encode($response);

        return $this->render('CASHMACHINEsimuladorCajeroBundle:Default:disposicionEfectivo.html.twig', array('response' => $response));
    }

    #Funcion para realizar calculo de billetes
    public function calculaBilletes($cantidad)
    {
    	$response = array
    	(
    		'billetesCien' 		=> 4,
    		'billetesCincuenta' => 3,
    		'billetesVeinte'  	=> 2,
    		'billetesDiez' 		=> 1,
    	);

   		return $response;
    }
}
