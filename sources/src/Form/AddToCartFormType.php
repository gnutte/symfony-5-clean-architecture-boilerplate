<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\CartItem;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddToCartFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('product', EntityType::class, [
            'class' => Product::class,
            'choice_label' => 'title'
        ]);
        $builder->add('quantity', NumberType::class);
        $builder->add('submit', SubmitType::class);
    }
}