<?php

namespace Catrobat\AppBundle\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class TutorialController extends Controller
{
  /**
   * @Route("/help", name="catrobat_web_help")
   * @Method({"GET"})
   */
  public function helpAction()
  {
    return $this->get("templating")->renderResponse(':help:help.html.twig');
  }

  /**
   * @Route("/hour-of-code/{page}", name="catrobat_web_hour_of_code", defaults={"page" = 0}, requirements={"page":"\d+"})
   * @Route("/hourOfCode/{page}", name="catrobat_web_hourOfCode", defaults={"page" = 0}, requirements={"page":"\d+"})
   * @Method({"GET"})
   */
  public function hourOfCodeAction($page)
  {
    $max_page = 21;

    $paginator = $this->get('knp_paginator');
    $images = array();

    for ($i = 0; $i < $max_page; $i++) {
      $images[] = $i;
    }


    $pagination = $paginator->paginate(
      $images,
      $page, //current page
      1/*limit per page*/
    );

    $pagination->setTemplate(':help:paginationStart0.html.twig');

    if($page > $max_page) {
      throw $this->createNotFoundException('Unable to find step.');
    }

    $containers = 3;
    $class = "col-3";

    if($page == 4 || $page == 7 || $page == 8 || $page == 11 || $page == 14) {
      $containers = 4;
      $class = "col-4";
    }
    else if($page == $max_page) {
      $containers = 5;
      $class = "col-5";
    }

    return $this->get("templating")->renderResponse(':help:hourOfCode.html.twig', array("page" => $page, "containers" => $containers, "class" => $class, 'pagination' => $pagination));
  }

  /**
   * @Route("/step-by-step/{page}", name="catrobat_web_step_by_step", defaults={"page" = 1}, requirements={"page":"\d+"})
   * @Route("/stepByStep/{page}", name="catrobat_web_stepByStep", defaults={"page" = 1}, requirements={"page":"\d+"})
   * @Method({"GET"})
   */
  public function stepByStepAction($page)
  {
    $max_page = 11;

    if($page > $max_page) {
      throw $this->createNotFoundException('Unable to find step.');
    }

    $paginator = $this->get('knp_paginator');
    $steps = array();

    for ($i = 1; $i <= $max_page; $i++) {
      $steps[] = $i;
    }

    $pagination = $paginator->paginate(
      $steps,
      $page, //current page
      1/*limit per page*/
    );

    $pagination->setTemplate(':help:paginationStart1.html.twig');

    return $this->get("templating")->renderResponse(':help:stepByStep.html.twig', array("page" => $page, 'pagination' => $pagination));
  }

  /**
   * @Route("/tutorialcards/{page}", name="catrobat_web_tutorialcards", defaults={"page" = -1}, requirements={"page":"\d+"})
   * @Method({"GET"})
   */
  public function tutorialcardsAction($page)
  {
    $max_page = 9;

    if($page > $max_page) {
      throw $this->createNotFoundException('Unable to find tutorialcard.');
    }

    if($page == -1) {
      return $this->get("templating")->renderResponse(':help:tutorialcards.html.twig', array("count" => $max_page));
    }

    else {

      $count = array(
        "get_ready" => 1,
        "try_code" => 1,
        "extra_tip" => 0
      );

      if($page == 2 || $page == 3 || $page == 5) {
        $count['get_ready'] = 2;
      }

      if($page == 5) {
        $count['extra_tip'] = 3;
      }

      if($page == 7) {
        $count['extra_tip'] = 1;
      }

      return $this->get("templating")->renderResponse(':help:tutorialcard.html.twig', array("page" => $page, "count" => $count));
    }
  }

  /**
   * @Route("/starter-programs", name="catrobat_web_starter")
   * @Method({"GET"})
   */
  public function starterProgramsAction()
  {
    return $this->get("templating")->renderResponse(':help:starterPrograms.html.twig');
  }
}
