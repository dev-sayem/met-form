<?php 

if(!function_exists('d')){
    function d($input, $collapse=true) {
        $recursive = function($data, $level=0) use (&$recursive, $collapse) {
            global $argv;

            $isTerminal = isset($argv);

            if (!$isTerminal && $level == 0 && !defined("DUMP_DEBUG_SCRIPT")) {
                define("DUMP_DEBUG_SCRIPT", true);

                echo '<script language="Javascript">function toggleDisplay(id) {';
                echo 'var state = document.getElementById("container"+id).style.display;';
                echo 'document.getElementById("container"+id).style.display = state == "inline" ? "none" : "inline";';
                echo 'document.getElementById("minus"+id).style.display = state == "inline" ? "none" : "inline";';
                echo 'document.getElementById("plus"+id).style.display = state == "inline" ? "inline" : "none";';
                echo '}</script>'."\n";
            }

            $type = !is_string($data) && is_callable($data) ? "callable" : strtolower(gettype($data));
            $type_data = null;
            $type_color = null;
            $type_length = null;

            switch ($type) {
                case "string": 
                    $type_color = "green";
                    $type_length = strlen($data);
                    $type_data = "\"" . htmlentities($data) . "\""; break;

                case "double": 
                case "float": 
                    $type = "float";
                    $type_color = "#0099c5";
                    $type_length = strlen($data);
                    $type_data = htmlentities($data); break;

                case "integer": 
                    $type_color = "red";
                    $type_length = strlen($data);
                    $type_data = htmlentities($data); break;

                case "boolean": 
                    $type_color = "#92008d";
                    $type_length = strlen($data);
                    $type_data = $data ? "true" : "false"; break;

                case "null": 
                    $type_length = 0; break;

                case "array": 
                    $type_length = count($data);
            }
            
            

            if (in_array($type, array("object", "array"))) {
                $notEmpty = false;

                foreach($data as $key => $value) {
                    if (!$notEmpty) {
                        $notEmpty = true;

                        if ($isTerminal) {
                            echo $type . ($type_length !== null ? "(" . $type_length . ")" : "")."\n";

                        } else {
                            $id = substr(md5(rand().":".$key.":".$level), 0, 8);

                            echo "<a href=\"javascript:toggleDisplay('". $id ."');\" style=\"text-decoration:none\">";
                            echo "<span style='color:#666666'>" . $type . ($type_length !== null ? ":" . $type_length : "") . "</span>";
                            echo "</a>";
                            echo "<span id=\"plus". $id ."\" style=\"display: " . ($collapse ? "none" : "inline") . ";\"> +</span>";
                            echo "<span id=\"minus". $id ."\" style=\"display: " . ($collapse ? "inline" : "none") . ";\"> -</span>";
                            echo "<div id=\"container". $id ."\" style=\"display: " . ($collapse ? "inline" : "none") . ";\">";

                        }

                        for ($i=0; $i <= $level; $i++) {
                            echo $isTerminal ? "|    " : " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                        echo $isTerminal ? "\n" : "<br />";

                    }

                    for ($i=0; $i <= $level; $i++) {
                        echo $isTerminal ? "|    " : " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }

                    echo $isTerminal ? "[" . $key . "] => " : "<span style='color:black'>[" . $key . "]&nbsp;=>&nbsp;</span>";

                    call_user_func($recursive, $value, $level+1);
                }

                if ($notEmpty) {
                    for ($i=0; $i <= $level; $i++) {
                        echo $isTerminal ? "|    " : " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }

                    if (!$isTerminal) {
                        echo "</div>";
                    }

                } else {
                    echo $isTerminal ? 
                            $type . ($type_length !== null ? ":" . $type_length : "") . "  " : 
                            "<span style='color:#666666'>" . $type . ($type_length !== null ? ":" . $type_length : "") . "</span>&nbsp;&nbsp;";
                }

            } else {
                echo $isTerminal ? 
                        $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "  " : 
                        "<span style='color:#666666'>" . $type . ($type_length !== null ? ":" . $type_length : "") . "</span>&nbsp;&nbsp;";

                if ($type_data != null) {
                    echo $isTerminal ? $type_data : "<span style='color:" . $type_color . "'>" . $type_data . "</span>";
                }
            }

            echo $isTerminal ? "\n" : "<br />";
        };

        call_user_func($recursive, $input);
    }
}
if(!function_exists('dd')){
    function dd($v){
        d($v); exit;
    }
}