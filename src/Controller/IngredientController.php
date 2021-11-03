<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    /**
     * @Route("/ingredient", name="ingredient")
     */
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Ingredient::class)->findAll();
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
             'data' => $data

        ]);
    }


    /**
     * @Route("/createIngredient", name="createIngredient")
     */
    public function create(Request $request)
    {
       $ingredient = new Ingredient();
       $form = $this->createForm(IngredientType::class , $ingredient);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredient);
            $em->flush();

            $this->addFlash('success', 'Votre ingrédient a bien été créé');

            return $this->redirectToRoute('ingredient');
        }
       return $this->render('ingredient/create.html.twig',[
           'form' => $form -> createView()
       ]);
    }

    /**
     * @Route("/update{id}", name="updateIngredient")
     */

      public function update(Request $request , $id)
    {
       $ingredient = $this->getDoctrine()->getRepository(Ingredient::class)->find($id) ;
       $form = $this->createForm(IngredientType::class , $ingredient);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredient);
            $em->flush();

            $this->addFlash('sucess','Update successfully!');

            return $this->redirectToRoute('ingredient');
        }
       return $this->render('ingredient/update.html.twig',[
           'form' => $form -> createView()
       ]);
    }

        /**
     * @Route("/delete{id}", name="deleteIngredient")
     */

      public function delete($id)
    {

       $data= $this->getDoctrine()->getRepository(Ingredient::class)->find($id);
      
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();

        $this->addFlash('sucess','Remove successfully!');

        return $this->redirectToRoute('ingredient');
        
     
    }
}
