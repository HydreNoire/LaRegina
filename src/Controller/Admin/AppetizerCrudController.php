<?php

namespace App\Controller\Admin;

use App\Entity\Appetizer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AppetizerCrudController extends AbstractCrudController
{
    public const ACTION_DUPLICATE = 'duplicate';

    public static function getEntityFqcn(): string
    {
        return Appetizer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $pictureDir = $this->getParameter('image_directory');
        $uploadDir = $this->getParameter('upload_directory');
        return [
            FormField::addPanel('Appetizer info')
                ->setColumns(6)
                ->setIcon('fas fa-info')
                ->collapsible(),
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextareaField::new('description'),

            FormField::addPanel('Price & Image')
                ->setIcon('fas fa-barcode'),
            NumberField::new('price')
                ->setColumns(3),
            ImageField::new('picture')
                ->setColumns(9)
                ->setBasePath($uploadDir)
                ->setUploadDir($pictureDir)
                ->setUploadedFileNamePattern('[uuid]-laregina.[extension]')
                ->setCssClass('menu-img')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
        ->linkToCrudAction('duplicatePost');
        return $actions->add(Crud::PAGE_EDIT, $duplicate);
    }
}
