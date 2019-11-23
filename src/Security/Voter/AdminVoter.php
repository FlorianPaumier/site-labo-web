<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminVoter extends Voter
{
    const EDIT= 'edit';
    const VIEW = 'view';

    protected function supports($attribute = null, $subject = null)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::VIEW]);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        dump($attribute, $subject);
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface && in_array("ROLE_USER", $user->gerRoles())) {
            return false;
        }

        if(in_array('ROLE_SUPER_ADMIN', $user->getRoles())){
            return true;
        }


        switch ($attribute){
            case self::VIEW:

                break;
            case self::EDIT:

                break;
        }
        return false;
    }

    private function canView(string $class, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($class,$user)) {
            return true;
        }

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return false;
    }
}
