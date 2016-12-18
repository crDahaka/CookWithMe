<?php
/**
 * Created by PhpStorm.
 * User: CR
 * Date: 12/14/2016
 * Time: 11:45
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Ingredient;
use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RecipeController extends Controller
{
    /**
     * @Route("/", name="recipes")
     */
    public function index(Request $request){

        $recipes = $this->getDoctrine()
            ->getRepository('AppBundle:Recipe')
            ->findAll();

        return $this->render('::index.html.twig', array(
            'recipes' => $recipes
        ));
    }

    /**
     * @Route("/recipe/create", name="recipe_create")
     */
    public function createAction(Request $request){

        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $file = $recipe->getImage();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('images'),
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

}