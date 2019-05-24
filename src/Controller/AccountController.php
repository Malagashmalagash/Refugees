<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Form\AccountType;
use App\Form\PasswordUpdateType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AccountController extends AbstractController
{
    /**
     * @Route("/register", name="account_register")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return Response
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('account/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     *  login
     * @Route("/login", name="account_login")
     *
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'lastUsername' => $lastUsername,
        ]);
    }

    /**
     * logout
     *
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout()
    {

    }


    /**
     * display and modify a user profile
     *
     * @Route("/account/profile", name="account_profile")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function profile(Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Les modifications ont bien été prises en compte'
                );
        }

        return $this->render('account/profile.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/account/password/update", name="account_password")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     *
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    public function updatePassword(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            if(!password_verify($passwordUpdate->getOldPassword(), $user->getHash())) {

                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez renseigné n'est pas votre mot de passe actuel"));

            } else {

                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setHash($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Votre mot de passe a été modifié avec succes !'
                );

                return $this->redirectToRoute('home');
            }

        }

        return $this->render('account/password.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]);
    }

    /**
     * display current user's information
     *
     * @route("/account", name="account_index")
     *
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    public function account()
    {
        $user = $this->getUser();

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
