<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Model\Cart;
use App\Domain\Model\CartItem;
use App\Domain\Model\User;
use App\Entity\CartImpl;
use App\Entity\CartItemImpl;
use App\Form\AddToCartFormType;
use App\Repository\CartItemRepository;
use App\Repository\CartRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Environment;

class CartController
{
    private CartRepository $cartRepository;
    private UserRepository $userRepository;
    private FormFactoryInterface $formFactory;
    private Environment $twig;
    private EntityManagerInterface $entityManager;
    private CartItemRepository $cartItemRepository;
    private SessionInterface $session;

    public function __construct(
        SessionInterface $session,
        UserRepository $userRepository,
        CartRepository $cartRepository,
        CartItemRepository $cartItemRepository,
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        Environment $twig
    ) {
        $this->cartRepository = $cartRepository;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->session = $session;
    }

    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->userRepository->findOneBy(['username' => 'root']);

        $form = $this->formFactory->create(AddToCartFormType::class);
        $form->handleRequest($request);

        $cart = $this->cartRepository->findOneBy(['user' => $user->getUsername()]);
        if(null == $cart) {
            $cart = new CartImpl($user);
        }

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $cart->add($data['product'], intval($data['quantity']));

            $this->entityManager->persist($cart);
            $this->entityManager->flush();
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