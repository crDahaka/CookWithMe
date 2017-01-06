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
     */
    public function listAction(){

        $recipes = $this->getDoctrine()
            ->getRepository('AppBundle:Recipe')
            ->findBy(array(), array('createdAt' => 'DESC'), 6);

        $response =  $this->render('::index.html.twig', array(
            'recipes' => $recipes
        ));

        $response->setSharedMaxAge(3600);
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }

    /**
     * @Route("/user/recipes", name="user_recipes")
     * @Method("GET")
     */
    public function showUserRecipesAction(){

        $entityManager = $this->getDoctrine()->getManager();
        $recipes = $entityManager->getRepository('AppBundle:Recipe')->findAll();

        $response = $this->render('recipes/user_recipes.html.twig', array(
            'recipes' => $recipes,
        ));

        $response->setSharedMaxAge(3600);
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;

    }

    /**
     * @Route("/recipe/create", name="recipe_create")
     * @Method({"GET", "POST"})
     * @param $request
     * @return RedirectResponse
     */
    public function createAction(Request $request){

        $entityManager = $this->getDoctrine()->getManager();

        $recipe = new Recipe();
        $createForm = $this->createForm(RecipeType::class, $recipe);
        $createForm->handleRequest($request);

        if ($createForm->isSubmitted() && $createForm->isValid()){

            $image = $createForm->getData()->getImage();
            $imageName = $this->get('app.image_uploader')->upload($image);

            $recipe->setImage($imageName);

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $recipe->setUser($user);

            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('recipes'));
        }

        return $this->render('recipes/create.html.twig', array(
            'createForm' => $createForm->createView()
        ));
    }

    /**
     * @Route("/recipe/details/{id}", name="recipe_details")
     * @Method({"GET", "POST"})
     * @param int $id
     * @return FormView
     */
    public function detailsAction($id){

        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $entityManager->getRepository('AppBundle:Recipe')->find($id);

        if (!$recipe){
            throw $this->createNotFoundException('Recipe not found with id '. $id);
        }

        return $this->render('recipes/details.html.twig', array(
            'recipe' => $recipe
        ));

    }

    /**
     * @Route("/recipe/edit/{id}", name="recipe_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function editAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $entityManager->getRepository('AppBundle:Recipe')->find($id);

        if (!$recipe){
            throw $this->createNotFoundException('Recipe not found with id '. $id);
        }

        $editForm = $this->createForm(RecipeType::class, $recipe);
        $editForm->handleRequest($request);

        $image = $recipe->getImage();

        if ($editForm->isSubmitted() && $editForm->isValid()){

            if ($editForm->get('image')->getData() !== null){

                $imageName = $this->get('app.image_uploader')->upload($image);
                $recipe->setImage($imageName);

            }

            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('recipes'));
        }

        return $this->render('recipes/edit.html.twig', array(
            "recipe" => $recipe,
            "editForm" => $editForm->createView(),
        ));
    }

}