<?php

namespace LSB\AppBundle\UserManagement;


class LSBSortUsers
{
    public function sortUsers($usersList)
    {
        $adminList = array();
        $memberList = array();
        $visitorList = array();

        foreach ($usersList as $user) {
            if ($user->hasRole('ROLE_ADMIN')) {
                array_push($adminList, $user);
            } elseif ($user->hasRole('ROLE_MEMBER')) {
                array_push($memberList, $user);
            } elseif ($user->hasRole('ROLE_VISITOR')) {
                array_push($visitorList, $user);
            }
        }

        return array($adminList, $memberList, $visitorList);
    }
}