<?php

namespace Login\LoginBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LoginLoginBundle extends Bundle
{
	
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
