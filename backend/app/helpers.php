<?php

if (! function_exists('join_path')) {
    function join_path()
    {
        foreach (func_get_args() as $arg) {
            if ($arg !== '') { $paths[] = $arg; }
        }
        return preg_replace('#/+#','/',join('/', $paths));
    }
}
