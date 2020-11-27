<?php


namespace vendor\core\base;


class View
{
    /**
     * @var array
     */
    public array $route;
    /**
     * @var string
     */
    public string $view;
    /**
     * @var array|string
     */
    public string $layout;

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    public function render($vars)
    {
        if (is_array($vars)) extract($vars);
        $file_view = APP . sprintf('/views/%s/%s.php', $this->route['controller'], $this->view);
        ob_start();
        if (is_file($file_view)) {
            require $file_view;
        } else {
            printf('View not found %s', $file_view);
        }
        $content = ob_get_contents();
        ob_end_clean();
        if (false !== $this->layout) {
            $file_layout = APP . sprintf('/views/layouts/%s.php', $this->layout);
            if (is_file($file_layout)) {
                require $file_layout;
            } else {
                printf('Layout not found %s', $file_layout);
            }
        }


    }
}