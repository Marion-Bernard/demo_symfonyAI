<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextType::class, [
                'label' => 'Votre question',
                'attr' => ['placeholder' => 'Combien de bancs dans une montgolfière ?']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider'
            ]);
    }
}
