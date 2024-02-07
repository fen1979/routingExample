<?php

class Routing
{
    private array $pages = array();

    /**
     * @param $url
     * @param $path
     * @return void
     */
    public function addRout($url, $path)
    {
        $this->pages[$url] = $path;
    }

    /**
     * @param $url
     * @return void
     */
    public function route($url)
    {
        $path = $this->pages[$url];

        if (empty($path)) {
            require 'public/404.php';
            die();
        }

        if ($url == '/sign-out') {
            $this->logOut();
        }

        $fileDir = $path;
        if (file_exists($fileDir)) {
            require $fileDir;
        } else {
            require 'public/404.php';
            die();
        }
    }

    /**
     * @return void
     */
    private function logOut()
    {
        // clear the data
        $_SESSION = array();

        // clear the cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        // destroing the session
        session_destroy();
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        $arr = explode('?', $_SERVER['REQUEST_URI']);
        $url = $val = '';
        if (empty($arr)) {
            $url = (count_chars($_SERVER['REQUEST_URI'], 1)[47] > 1) ?
                rtrim($_SERVER['REQUEST_URI'], '/') : $_SERVER['REQUEST_URI'];
        } else {
            $url = (count_chars($arr[0], 1)[47] > 1) ?
                rtrim($arr[0], '/') : $arr[0];
        }
        return $url;
    }
}