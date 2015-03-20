<?php
/**
 * File name: AuthController.php
 *
 * Project: Project1
 *
 * PHP version 5
 *
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Controllers;

use Common\Authentication\FileAuth;
use Common\Authentication\MemoryAuth;
use Common\Authentication\MySQLAuth;
// use common\Authentication\SQLLiteAuth;

/**
 * Class AuthController
 */
class AuthController extends Controller
{
    protected $postData;
 

    protected function output($auth)
    {
        if ($auth->Authenticate($this->postData->username, $this->postData->password)) {
            return 'welcome, '.$this->postData->username.PHP_EOL;
        }
        return 'no one has permission'.PHP_EOL;
    }
    /**
     * Function execute
     *
     * @access public
     */
    public function action()
    {
        $this->postData = $this->request->getPost(); 
        $authMemory = new MemoryAuth();
        $fileAuth = new FileAuth();
        $authMySQL = new MySQLAuth();

        // echo 'Authenticate the above two different ways' . var_dump($postData) . '<br/>';

        $memAuth = 'Memory Auth: '.$this->output($authMemory).'<br/>';
        $authFile = 'File Auth: '.$this->output($fileAuth).'<br/>';
        $databaseAuth = 'Database Auth: '.$this->output($authMySQL).'<br/>';

        $return_btn = <<<return_btn
        <html>
        <head>
        <style>
            #container{
                width: 400px;
                padding-top:100px;
                margin: 0 auto;
            }
            p{
                text-align:center;
            }
            .button {
                margin: 0 auto;
                display: block;
                width: 100px;
                background: #C0C0C0;
                text-align: center;
                font-family: helvetica;
                color: #111111;
                font-weight:100;
                font-size:13px;
            }
            a.button {
                text-decoration: none;
                padding: 3px 0;
            }
            .button:hover{
                background: #aaa;
            }
        </style>
        </head>
        <body>
            <div id='container'>
                <p>$memAuth</p>
                <p>$authFile</p>
                <p>$databaseAuth</p>
                <a href="http://localhost:8080" class="button">return to login</a>
            </div>
        </body>
        </html>
return_btn;
        echo $return_btn;
    }
}
