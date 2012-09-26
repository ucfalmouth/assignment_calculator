<?php
function phase_list($section, $steps = array(), $date, $num_id, $class = NULL) {
    // generate a block of html to represent the essay phase
    ob_start();
    ?>
    <li>
    <div class='acinfo <?php echo $class; ?>'>
        <span><?php echo $section; ?></span>to be completed on: <b><?php echo $date ?><br></b>
        <a id="displayText<?php echo $num_id; ?>" href="javascript:showMore(<?php echo $num_id; ?>);">View Work Breakdown +</a>
        <div id="toggleText<?php echo $num_id; ?>" style="display: none;" >
            <ul>
            <?php foreach($steps as $step) { ?>
            <div class="accordionButton"><li><strong><?php echo $step['title']; ?></strong> +</li></div>
            <div class="accordionContent" >
                <li><?php echo $step['description']; ?></li>
                <?php foreach($step['links'] as $link) { ?>
                    <li><?php echo html_link($link['title'],$link['url']); ?></li>
                <?php } ?>
            </div>              
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