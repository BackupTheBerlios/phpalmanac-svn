<?php

class Savant3_Plugin_qbuild extends Savant3_Plugin {
    
    public function qbuild() {

        $args = func_get_args();

        if (3 != func_num_args()) {
            $args = explode(' ', $args[0]);
        }

        list($tmp['y'], $tmp['m'], $tmp['d']) = $args;
        return http_build_query($tmp);

    }

}

?>