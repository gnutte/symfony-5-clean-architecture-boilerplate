<?php

declare(strict_types=1);

namespace App\Application\Controller\Cart;

use App\Application\Ui\Presenter\Cart\CartTwigPresenter;
use App\Application\Ui\Request\Cart\AddToCartRequestParser;
use App\Application\Ui\View\Cart\CartView;
use App\BusinessRules\UseCase\Cart\AddItemToCart as AddItemToCartUseCase;
use App\BusinessRules\UseCase\Cart\AddItemToCartInput;
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

class AddItemToCart
{
    private AddToCartRequestParser $parser;
    private AddItemToCartUseCase $useCase;
    private CartTwigPresenter $presenter;

    public function __construct(
        AddToCartRequestParser $parser,
        AddItemToCartUseCase $useCase,
        CartTwigPresenter $presenter
    ) {
        $this->parser = $parser;
        $this->useCase = $useCase;
        $this->presenter = $presenter;
    }

    public function __invoke(Request $request): Response
    {
        $view = new CartView();

        $data = $this->parser->getData($request);
        if(null !== $data) {
            try {
                $output = $this->useCase->execute(
                    (new AddItemToCartInput())
                        ->setData($data)
                        ->setUsername('root')
                );
                $view->buildFromOutput($output);
            }catch (CartCanNotBeSavedException $e) {
                $view->addError($e->getMessage());
            }

        }

        return $this->presenter->render($view);
    }
}