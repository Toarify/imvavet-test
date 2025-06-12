<?php

namespace App\Controller\Admin;

use App\Entity\ArticleDetails;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArticleDetails::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('article'),
            TextField::new('authors'),
            DateField::new('publicationDate'),
        ];
    }   
}
