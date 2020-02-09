<?php

namespace App\Application\Ui\Presenter;

use App\Application\Ui\View\Cart\CartViewInterface;
use Symfony\Component\HttpFoundation\Response;

interface PresenterInterface
{
    public function render(CartViewInterface $view): Response;
}