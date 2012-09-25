<?php
function phase_list($section, $steps = array(), $date, $class = NULL) {
    krumo($steps);
    ob_start();
    ?>
    <li>
    <div class='acinfo <?php echo $class; ?>'>
        <span><?php echo $section; ?></span>to be completed on: <b><?php echo date('d-m-y', $date) ?><br></b>
        <a id="displayText" href="javascript:showMore2();">View Work Breakdown +</a>
        <div id="toggleText" >
            <ul>
            <div class="accordionButton"><li>Understand The Assignment +</li></div>
            <div class="accordionContent">
                <?php  echo $introduction; 
                foreach($steps as $step => $content) { ?>
                    <li><?php echo $step; ?></li>               
                <?php } ?>
            </ul> 
        </div>
    </div>
    </li>
    <?php
    $phase = ob_get_contents();
    ob_end_clean();
    return $phase;
}

function html_link($title, $url) {
    return "<a href=\"$url\">$title</a>";
}

?>