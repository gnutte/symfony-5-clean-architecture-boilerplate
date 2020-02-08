<?php

declare(strict_types=1);

namespace App\Domain\Event\Exceptions\Model;

use App\Domain\Model\ModelInterface;
use Exception;

class BadModelDataException extends Exception
{
    private ModelInterface $model;
    private string $fieldName;

    public function __construct(ModelInterface $model, string $fieldName, string $message)
    {
        parent::__construct($message);
        $this->model = $model;
        $this->fieldName = $fieldName;
    }

    public function getModel(): ModelInterface
    {
        return $this->model;
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }
}