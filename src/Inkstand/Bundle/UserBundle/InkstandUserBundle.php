<?php

namespace Inkstand\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class InkstandUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
