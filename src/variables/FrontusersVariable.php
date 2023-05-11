<?php
namespace kr37\frontusers\variables;

use Craft;
use kr37\frontusers\Frontusers as Plugin;

class FrontusersVariable
{

    public function is_frontuser() {
        return false;
    }

    public function login_form() {
        return "<form action=''>Username <input name='username' type='text'> PW <input name='password' type='password'><input type='submit' value='Login'></form>";
    }
}
