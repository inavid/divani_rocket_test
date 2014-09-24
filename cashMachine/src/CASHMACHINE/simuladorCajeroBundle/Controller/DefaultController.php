<?php

namespace CASHMACHINE\simuladorCajeroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CASHMACHINEsimuladorCajeroBundle:Default:index.html.twig', array('name' => $name));
    }

    public function retiroEfectivoAction()
    {
    	$nombreUsuario = "Divani David Fuentes Marcos";

        return $this->render('CASHMACHINEsimuladorCajeroBundle:Default:retiroEfectivo.html.twig', array('name' => $nombreUsuario));
    }
}
