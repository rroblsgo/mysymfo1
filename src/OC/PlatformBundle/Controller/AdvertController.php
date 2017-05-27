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

class AdvertController extends Controller
{
    public function indexAction()
    {
        $content = $this
            ->get('templating')
            ->render('OCPlatformBundle:Advert:index.html.twig',
                array('nom' => 'winzou')
            );
        return new Response($content);
    }
}