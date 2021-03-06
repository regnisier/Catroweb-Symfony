<?php

namespace App\Catrobat\Requests;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LoginUserRequest
 * @package App\Catrobat\Requests
 */
class LoginUserRequest
{
  /**
   * LoginUserRequest constructor.
   *
   * @param Request $request
   */
  public function __construct(Request $request)
  {
    $this->username = $request->request->get('registrationUsername');
    $this->password = $request->request->get('registrationPassword');
  }

  /**
   * @Assert\NotBlank(message = "errors.username.blank")
   * @Assert\Regex(pattern="/^[\w@_\-\.]+$/")
   */
  public $username;

  /**
   * @Assert\NotBlank(message = "errors.password.blank")
   * @Assert\Length(min = "6", minMessage = "errors.password.short")
   */
  public $password;

}
