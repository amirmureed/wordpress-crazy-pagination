<?php

function wp_crazy_pagination($pages = '', $range = 2)
{  
    $showitems = ($range * 2)+1;  

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }   

    if(1 != $pages)
    {
        echo "<ul class='pagination'>";
        // Add previous icon
        echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link($paged - 1)."' aria-label='Previous'><i class='fas fa-angle-double-left'></i></a></li>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
        if($paged > 1 && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<li class='page-item active'><a href='".get_pagenum_link($i)."' class='page-link' >".$i."</a></li>":"<li class='page-item'><a href='".get_pagenum_link($i)."' class='page-link' >".$i."</a></li>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
        // Add next icon
        if ($paged == $pages) {
            echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link($paged)."' aria-label='Next'><i class='fas fa-angle-double-right'></i></a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link($paged + 1)."' aria-label='Next'><i class='fas fa-angle-double-right'></i></a></li>";
        }
        echo "</ul>\n";
    }
}

?>