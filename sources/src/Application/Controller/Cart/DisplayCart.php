<?php

declare(strict_types=1);

namespace App\Application\Controller\Cart;

use App\Application\Ui\Presenter\Cart\CartTwigPresenter;
use App\Application\Ui\View\Cart\CartView;
use App\BusinessRules\UseCase\Cart\GetCartForUSer;
use App\BusinessRules\UseCase\Cart\GetCartForUSerInput;
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

class DisplayCart
{
    private GetCartForUSer $useCase;
    private CartTwigPresenter $presenter;

    public function __construct(
        GetCartForUSer $useCase,
        CartTwigPresenter $presenter
    ) {
        $this->presenter = $presenter;
        $this->useCase = $useCase;
    }

    public function __invoke(Request $request): Response
    {
        $view = new CartView();

        try{
            $output = $this->useCase->execute((new GetCartForUSerInput())->setUsername('root'));
            $view->buildFromOutput($output);
        }catch (CartCanNotBeSavedException $e) {
            $view->addError($e->getMessage());
        }

        return $this->presenter->render($view);
    }
}