<?php

namespace Views;


class LoginForm extends View
{
    public function __construct()
    {
        $this->content = <<<LOGIN_FORM
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="POST" action="/auth">
        <input class="texts" type="text" name="username" size="15" placeholder="username" required="required"/><br />
        <input class="texts" type="password" name="password" size="15" placeholder="password" required="required"/><br />
        <input id="btn" type="submit" value="login" />
    </form>
</body>
</html>
LOGIN_FORM;
    }
}
