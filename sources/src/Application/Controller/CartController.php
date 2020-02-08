<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Domain\Event\Exceptions\Model\Cart\CartCanNotBeSavedException;
use App\Domain\Gateways\CartGateway;
use App\Domain\Gateways\UserGateway;
use App\Domain\Model\User;
use App\Infrastructure\Entity\CartImpl;
use App\Application\Form\AddToCartFormType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Environment;

class CartController
{
    private CartGateway $cartGateway;
    private UserGateway $userGateway;
    private FormFactoryInterface $formFactory;
    private Environment $twig;
    private SessionInterface $session;

    public function __construct(
        SessionInterface $session,
        UserGateway $userGateway,
        CartGateway $cartRepository,
        FormFactoryInterface $formFactory,
        Environment $twig
    ) {
        $this->cartGateway = $cartRepository;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->userGateway = $userGateway;
        $this->session = $session;
    }

    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->userGateway->retrieve('root');

        $form = $this->formFactory->create(AddToCartFormType::class);
        $form->handleRequest($request);

        $cart = $this->cartGateway->retrieveCartForUser($user);
        if(null == $cart) {
            $cart = new CartImpl($user);
        }

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $cart->add($data['product'], intval($data['quantity']));

            try {
                $this->cartGateway->update($cart);
            } catch (CartCanNotBeSavedException $e) {
                $form->addError(new FormError($e->getMessage()));
            }
        }

        return new Response(
            $this->twig->render(
                'pages/cart/show.html.twig',
                [
                    'form' => $form->createView(),
                    'items' => $cart->getItems(),
                    'total' => $cart->getTotalPrice()
                ]
            )
        );
    }
}