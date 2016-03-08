<?php
namespace Login\LoginBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Login\LoginBundle\Entity\Categories;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_categorie',TextType::class,array('label'=>'Nom de la categorie'))
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Login\LoginBundle\Entity\Categories'
        ));
    }
}