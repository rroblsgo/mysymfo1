<?php
/**
 * Created by PhpStorm.
 * User: rrobles
 * Date: 27/5/17
 * Time: 13:42
 */
// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        $listAdverts = array(
          array(
              'title'=>"Búsqueda desarrollador Symfony",
              'id'=>1,
              'author'=>'Alexandre',
              'content'=>'Buscamos un desarrollador Symfony principiante, de Lyon. blabla...',
              'date'=>new \DateTime()
          ),
            array(
                'title'=>"Misión de Webmaster",
                'id'=>2,
                'author'=>'Hugo',
                'content'=>'Buscamos un webmaster capaz de mantener nuestro sitio web. blabla...',
                'date'=>new \DateTime()
            ),
            array(
                'title'=>"Oferta del puesto Webdesigner",
                'id'=>3,
                'author'=>'Mathieu',
                'content'=>'proponemos un puesto de webdesigner. blabla...',
                'date'=>new \DateTime()
            )
        );

        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts'=>$listAdverts
        ));
    }

    public function viewAction($id)
    {
        $repository=$this->getDoctrine()->getManager()
            ->getRepository('OCPlatformBundle:Advert');

        $advert=$repository->find($id);

        if(null==$advert) {
            throw new NotFoundHttpException("El anuncio ".$id. " no existe");
        }

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert
        ));
    }

    public function addAction(Request $request)
    {
        $advert = new Advert();
        $advert->setTitle('Búsqueda de un Desarrollador Symfony');
        $advert->setAuthor('Alexandre');
        $advert->setContent('Buscamos un Desarrollador Symfony principiante de la zona de Lyon. Bla Bla...');

        $em = $this->getDoctrine()->getManager();

        // Etapa 1
        $em->persist($advert);

        // Etapa 2
        $em->flush();

        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Anuncio bien registrado');
            return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));
        }
        return $this->render('OCPlatformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        $advert = array(
            'title'=>"Búsqueda desarrollador Symfony",
            'id'=>$id,
            'author'=>'Alexandre',
            'content'=>'Buscamos un desarrollador Symfony principiante, de Lyon. blabla...',
            'date'=>new \DateTime()
        );

        return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
            'advert' => $advert
        ));
    }

    public function deleteAction($id)
    {
        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }

    public function menuAction($limit)
    {
        $listAdverts = array(
            array('id'=>1, 'title'=>'Búsqueda desarrollador Symfony'),
            array('id'=>2, 'title'=>'Misión de Webmaster'),
            array('id'=>3, 'title'=>'Oferta del puesto Webdesigner')
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            'listAdverts'=>$listAdverts
        ));
    }

}