<?php

class Savant3_Plugin_stylesheet extends Savant3_Plugin {

    /**
    * Output a <link ... /> to a CSS stylesheet.
    * @access public
    * @param object &$savant A reference to the calling Savant3 object.
    * @param string $href The HREF leading to the stylesheet file.
    * @return string
    */
    
    public function stylesheet($href) {
        return '<link rel="stylesheet" type="text/css" href="' . htmlspecialchars($href) . '" />' . "\n";
    }

}

?>