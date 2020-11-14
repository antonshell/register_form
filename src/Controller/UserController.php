<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Request\SignUpRequest;
use App\Service\SignUpValidator;
use App\Service\UserCreator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * @var ValidatorInterface
     */
    private $signUpValidator;

    /**
     * @var SignUpValidator
     */
    private $userCreator;

    public function __construct(
        SignUpValidator $signUpValidator,
        UserCreator $userCreator
    )
    {
        $this->userCreator = $userCreator;
        $this->signUpValidator = $signUpValidator;
    }

    public function signUp(Request $request): Response
    {
        return $this->render('profile/sign-up.html.twig');
    }

    /**
     * @ParamConverter(
     *      "signUpRequest",
     *      converter="fos_rest.request_body",
     *      class="App\Http\Request\SignUpRequest"
     * )
     *
     * @param SignUpRequest $signUpRequest
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function signUpHandler(SignUpRequest $signUpRequest): JsonResponse
    {
        if(!$this->signUpValidator->validate($signUpRequest)){
            return new JsonResponse([
                'status' => Response::HTTP_BAD_REQUEST,
                'errors' => $this->signUpValidator->getErrors()
            ]);
        }

        $user = $this->userCreator->createUser($signUpRequest);

        return new JsonResponse([
            'status' => Response::HTTP_OK,
            'entity' => $user->getId()
        ]);
    }
}
