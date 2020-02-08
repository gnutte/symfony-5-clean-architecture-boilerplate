<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\User;
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
        $cartId = $this->session->get('cart');

        $form = $this->formFactory->create(AddToCartFormType::class);
        $form->handleRequest($request);

        if(null == $cartId) {
            $cart = new Cart();
        }else{
            $cart = $this->cartRepository->find($cartId);
            if(null == $cart) {
                $cart = new Cart();
            }
        }

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $item = $this->cartItemRepository->getItemByProduct($data['product']);
            if(null == $item) {
                $item = new CartItem();
                $item->setCart($cart);
                $item->setProduct($data['product']);
            }

            $item->setQuantity($item->getQuantity() + intval($data['quantity']));

            $this->entityManager->persist($item);
            $this->entityManager->flush();

            $this->session->set('cart', $cart->getId());
        }

        $total = 0;
        foreach ($cart->getItems() as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }

        return new Response(
            $this->twig->render(
                'pages/cart/show.html.twig',
                [
                    'form' => $form->createView(),
                    'items' => $cart->getItems(),
                    'total' => $total
                ]
            )
        );
    }
}