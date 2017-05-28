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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1) {
            // se  declara una excepción NotFoundHttpException que muestra una pág.404
            throw new NotFoundHttpException('Page "'.$page.'" inexistente.');

            // ahora recuperaremos la lista de anuncios a mostrar . . .

            // pero por ahora sólo llamamos a la template
        }
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'page'=>$page
        ));
    }

    public function viewAction($id)
    {
        // aquí recuperamos el anuncio correspondiente a $id
        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'id' => $id
        ));
        //return $this->redirectToRoute('oc_platform_home');
    }

    public function addAction(Request $request)
    {
        //utilizando mensajes  flashbag y motsrándolos en  view
//        $session = $request->getSession();
//        $session->getFlashBag()->add('info', 'Anuncio bien registrado');
//        $session->getFlashBag()->add('info', 'Si, Si, Anuncio bien registrado');
//        return $this->redirectToRoute('oc_platform_view', array('id' => 5));

        if($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Anuncio bien registrado');
            return $this->redirectToRoute('oc_platform_view', array(
                'id' => 5
            ));
        }
        return $this->render('OCPlatformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        if($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Anuncio bien modificado');
            return $this->redirectToRoute('oc_platform_view', array(
                'id' => 5
            ));
        }
        return $this->render('OCPlatformBundle:Advert:edit.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }

    public function viewSlugAction($slug, $year, $_format)
    {
        return new Response("Mostrará el anuncio correspondiente a
        slug '".$slug."', creado el año ".$year." con el formato ".$_format.".");
    }

    public function novale($page)
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
}