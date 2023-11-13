<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('uid');
        $roles = ['ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_MODERATOR', 'ROLE_USER'];
        yield ChoiceField::new('roles')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges();
        
        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield TextField::new('mailperso', 'Courriel Personnel');
        yield TextField::new('mail', 'Courriel UM3');
        yield TextField::new('codEtu', 'N étudiant');
        yield TextField::new('tel');
        yield TextField::new('datenais', 'Date de naissance');
        yield TextField::new('genre');
        yield TextField::new('nationalite');
        yield TextField::new('statut');
        yield TextField::new('diplomePrepare', 'Diplôme préparé')->hideOnIndex();
        yield TextField::new('derniereDiplome', 'Dernier Diplôme obtenu')->hideOnIndex();
        yield TextField::new('adresseFixe')->hideOnIndex();
        yield TextField::new('adresseActu', 'Adresse Actuelle')->hideOnIndex();
        yield TextField::new('pratiqueArt', 'Pratique artistique culturelle')->hideOnIndex();
        yield TextField::new('otherComments', 'Commentaires')->hideOnIndex();
        yield BooleanField::new('isVerified');
        yield TextField::new('derniereFiliereHors', 'Dernière filière hors UM3')->hideOnIndex();
        yield TextField::new('echangeInter', 'Echange International')->hideOnIndex();
        yield DateTimeField::new('createdAtU', 'Créé à');
        
    }

}


