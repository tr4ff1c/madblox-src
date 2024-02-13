<?php
$_THEMECSS = "
body{
    background: url(/images/bg_nightsky.jpg) scroll center top, black url(/images/bg_darkgradient.jpg) repeat-x;
    color: white;
}
#Header .Navigation{
    background-color: #222;
}
#Banner #Alerts #AlertSpace{
    background-color: #222;
}
";
if($_SERVER["PHP_SELF"] === "/My/Character/.php") {
    $_THEMECSS .= "
    #Body table{
        border: 1px #CCCCCC solid !important;
    }
    ";
}
if(str_starts_with($_SERVER["PHP_SELF"], "/Forum")) {
    $_THEMECSS .= "
    ";
}