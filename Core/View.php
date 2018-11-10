<?php
namespace Core;
class View
{
    //extract function convert assoc array into normal variable and value
    //B.S newbie tip because require is under $arg in the same scope so we pass any thing above into it
    public function renderViews($view ,$arg = [])
    {
        extract($arg,EXTR_SKIP);
        $file = "../App/Views/$view";
        if (file_exists($file)) {
            require($file);
        }else{
            echo "$view is not found !";
        }
    }
}
