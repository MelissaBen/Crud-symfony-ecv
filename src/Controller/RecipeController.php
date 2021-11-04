<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipe", name="recipe")
     */
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Recipe::class)->findAll();
         return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
            'data' => $data

        ]);
    }

     /**
     * @Route("/createRecipe", name="createRecipe")
     */
    public function create(Request $request)
    {
       $recipe = new Recipe();
       $form = $this->createForm(RecipeType::class , $recipe);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            $this->addFlash('success', 'Votre ingrédient a bien été créé');

            return $this->redirectToRoute('recipe');
        }
       return $this->render('recipe/create.html.twig',[
           'form' => $form -> createView()
       ]);
    }

    /**
     * @Route("/update{id}", name="updateRecipe")
     */

      public function update(Request $request , $id)
    {
       $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id) ;
       $form = $this->createForm(RecipeType::class , $recipe);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            $this->addFlash('sucess','Update successfully!');

            return $this->redirectToRoute('recipe');
        }
       return $this->render('recipe/update.html.twig',[
           'form' => $form -> createView()
       ]);
    }

        /**
     * @Route("/delete{id}", name="deleteRecipe")
     */

      public function delete($id)
    {

       $data= $this->getDoctrine()->getRepository(Recipe::class)->find($id);
      
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();

        $this->addFlash('success','Remove successfully!');

        return $this->redirectToRoute('recipe');
        
     
    }
}
