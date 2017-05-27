<?php
/**
 * Created by PhpStorm.
 * User: rrobles
 * Date: 27/5/17
 * Time: 13:42
 */
// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        //genera url ruta relativa para         /platform/advert/5
        $url1 = $this->get('router')->generate(     //abreviado:  generateUrl(
            'oc_platform_home',
            array ('id' => 5)
        );

        //genera url2 ruta absoluta para        http://localhost:8000/platform/advert/5
        $url2 = $this->get('router')->generate(      //abreviado:  enerateUrl(
            'oc_platform_home',
            array('id' => 5),
            UrlGeneratorInterface::ABSOLUTE_URL);

        //return new Response("La URL del anuncio de id 5 es : ".$url2);

        // para usar path y url desde twig
        $id = $page;
        $content = $this
            ->get('templating')
            ->render('OCPlatformBundle:Advert:index.html.twig',
                array('nom' => 'winzou', 'id' => $id)
            );
        return new Response($content);

    }

    public function viewAction($id)
    {
        return new Response("Muestra del anuncio de id : ".$id);
    }

    public function viewSlugAction($slug, $year, $_format)
    {
        return new Response("Mostrará el anuncio correspondiente a
        slug '".$slug."', creado el año ".$year." con el formato ".$_format.".");
    }
}