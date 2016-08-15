<?php

namespace LSB\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LSB\UserBundle\Entity\User;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('LSBAppBundle:Admin:home.html.twig');
    }

    public function userManagementAction()
    {
        $adminList = array();
        $memberList = array();
        $visitorList = array();

        $userManager = $this->get('fos_user.user_manager');
        $usersList = $userManager->findUsers();

        foreach ($usersList as $user) {
            if ($user->hasRole('ROLE_ADMIN')) {
                array_push($adminList, $user);
            } elseif ($user->hasRole('ROLE_MEMBER')) {
                array_push($memberList, $user);
            } elseif ($user->hasRole('ROLE_VISITOR')) {
                array_push($visitorList, $user);
            }
        }

        return $this->render('LSBAppBundle:Admin:userManagement.html.twig', array(
            'adminList' => $adminList,
            'memberList' => $memberList,
            'visitorList' => $visitorList
        ));
    }

    public function deleteAction(User $user)
    {
        $userManager = $this->get('fos_user.user_manager');
        $userManager->deleteUser($user);

        $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' a été supprimé.');

        return $this->redirectToRoute('lsb_app_user_management');
    }

    public function promoteAction(User $user)
    {
        $userManager = $this->get('fos_user.user_manager');

        if ($user->hasRole('ROLE_ADMIN')) {
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est déjà au grade maximum.');
        } elseif ($user->hasRole('ROLE_MEMBER')) {
            $user->removeRole('ROLE_MEMBER');
            $user->addRole('ROLE_ADMIN');
            $userManager->updateUser($user);
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est promu admin.');
        } elseif ($user->hasRole('ROLE_VISITOR')) {
            $user->removeRole('ROLE_VISITOR');
            $user->addRole('ROLE_MEMBER');
            $userManager->updateUser($user);
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est promu membre.');
        } else {
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' n\'a pas un rôle valide.');
        }

        return $this->redirectToRoute('lsb_app_user_management');
    }

    public function demoteAction(User $user)
    {
        $userManager = $this->get('fos_user.user_manager');

        if ($user->hasRole('ROLE_ADMIN')) {
            $user->removeRole('ROLE_ADMIN');
            $user->addRole('ROLE_MEMBER');
            $userManager->updateUser($user);
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est rétrogradé membre.');
        } elseif ($user->hasRole('ROLE_MEMBER')) {
            $user->removeRole('ROLE_MEMBER');
            $user->addRole('ROLE_VISITOR');
            $userManager->updateUser($user);
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est rétrogradé utilisateur.');
        } elseif ($user->hasRole('ROLE_VISITOR')) {
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est déjà au grade minimum.');
        } else {
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' n\'a pas un rôle valide.');
        }

        return $this->redirectToRoute('lsb_app_user_management');
    }
}
