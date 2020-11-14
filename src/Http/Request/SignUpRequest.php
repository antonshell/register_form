<?php

namespace App\Http\Request;

use JMS\Serializer\Annotation as Serializer;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordStrength;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints as Assert;

class SignUpRequest
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $fullname;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @PasswordStrength(minLength=8, minStrength=3)
     */
    private $password;

    public function getFullname(): string
    {
        return $this->fullname;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}