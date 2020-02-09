<?php

declare(strict_types=1);

namespace App\Application\Ui\Request\Cart;

use App\Application\Form\AddToCartFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class AddToCartRequestParser
{
    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function getData(Request $request): ?array {
        $form = $this->formFactory->create(AddToCartFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            return $form->getData();
        }

        return null;
    }
}