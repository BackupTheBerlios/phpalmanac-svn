<?php

class Savant3_Plugin_javascript extends Savant3_Plugin {

    /**
    * Output a <script></script> link to a JavaScript file.
    * @access public
    * @param string $href The HREF leading to the JavaScript source file.
    * @return string
    */
    
    public function javascript($href) {
        return '<script language="javascript" type="text/javascript" src="' . htmlspecialchars($href) . '"></script>' . "\n";
    }

}
?>