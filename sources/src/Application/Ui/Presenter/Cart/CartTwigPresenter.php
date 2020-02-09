<?php

declare(strict_types=1);

namespace App\Application\Ui\Presenter\Cart;

use App\Application\Form\AddToCartFormType;
use App\Application\Ui\Presenter\PresenterInterface;
use App\Application\Ui\View\Cart\CartViewInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class CartTwigPresenter implements PresenterInterface
{
    private Environment $twig;
    private FormFactoryInterface $formFactory;

    public function __construct(Environment $twig, FormFactoryInterface $formFactory)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
    }

    public function render(CartViewInterface $view): Response
    {
        $form = $this->formFactory->create(AddToCartFormType::class);

        foreach($view->getErrors() as $error) {
            $form->addError(new FormError($error));
        }

        return new Response(
            $this->twig->render(
                'pages/cart/show.html.twig',
                [ 'view' => $view, 'form' => $form->createView() ]
            )
        );
    }
}