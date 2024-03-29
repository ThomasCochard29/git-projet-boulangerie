<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditUserController extends AbstractController
{
    /**
     * This controller allow us to edit user's profile
     *
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/profil/edit/{id}', name: 'edit_profil', methods: ['GET', 'POST'])]
    public function Edit(User $user, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('accueil');
        }

        if($this->getUser() !== $user) {
            return $this->redirectToRoute('profil');
        }

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('image')->getData();

            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo("Erreur lors du chargement de limage");
                }
                
                $user->setImage($newFilename);
            }

            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Les informations de votre compte ont bien été modifiées.'
            );

            return $this->redirectToRoute('profil');
        }

        return $this->render('edit_profil/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profil/edit_password/{id}', name: 'edit_password', methods: ['GET', 'POST'])]
    public function editPassword(User $user, Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $manager) : Response
    {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($hasher->isPasswordValid($user, $form->getData()['password'])) {
                $user->setPassword(
                    $hasher->hashPassword($user, $form->getData()['newPassword']
                    )
                );
            }

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Le mot de passe à bien été modifiées.'
            );

            return $this->redirectToRoute('profil');
        } else {
            $this->addFlash(
                'warning',
                'Le mot de passe renseigné est incorrect.'
            );
        }

        return $this->render('edit_profil/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
