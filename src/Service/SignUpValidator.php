<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Request\SignUpRequest;
use App\Repository\UserRepository;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SignUpValidator
{
    private const ERROR_MESSAGE_UNIQUE = 'User with such %s already registered';

    private const FIELD_EMAIL = 'email';
    private const FIELD_USERNAME = 'username';

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    private $errors = [];

    public function __construct(
        UserRepository $userRepository,
        ValidatorInterface $validator
    )
    {
        $this->userRepository = $userRepository;
        $this->validator = $validator;
    }

    public function validate(SignUpRequest $signUpRequest)
    {
        $violations = $this->validator->validate($signUpRequest);
        if ($violations->count() > 0) {
            $this->errors = $this->convertViolations($violations);

            return false;
        }

        $uniqueFields = [self::FIELD_EMAIL => $signUpRequest->getEmail(), self::FIELD_USERNAME => $signUpRequest->getUsername()];
        foreach ($uniqueFields as $field => $value){
            $users = $this->userRepository->findBy([$field => $value]);
            if (count($users)) {
                $this->errors[$field] = sprintf(self::ERROR_MESSAGE_UNIQUE, $field);
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function convertViolations(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $errors;
    }
}
