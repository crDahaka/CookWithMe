<?php
/**
 * Created by PhpStorm.
 * User: CR
 * Date: 12/14/2016
 * Time: 11:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class RecipeController
 * @package AppBundle\Controller
 */
class RecipeController extends Controller
{
    /**
     * @Route("/", name="recipes")
     * @Method("GET")
     * @param $request
     * @return FormView
     */
    public function index(Request $request){

        $recipes = $this->getDoctrine()
            ->getRepository('AppBundle:Recipe')
            ->findBy(array(), array('createdAt' => 'DESC'), 6);


        return $this->render('::index.html.twig', array(
            'recipes' => $recipes
        ));
    }

    /**
     * @Route("/recipe/create", name="recipe_create")
     * @Method({"GET", "POST"})
     * @param $request
     * @return RedirectResponse
     */
    public function createAction(Request $request){

        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $file = $recipe->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('uploads_directory'),
                $fileName
            );

            $recipe->setImage($fileName);

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $recipe->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return $this->redirect($this->generateUrl('recipes'));
        }

        return $this->render('recipes/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/recipe/details/{id}", name="recipe_details")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param int $id
     * @return FormView
     */
    public function detailsAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $recipe = $em->getRepository('AppBundle:Recipe')->find($id);

        return $this->render('recipes/details.html.twig', array(
            'recipe' => $recipe
        ));

    }

}