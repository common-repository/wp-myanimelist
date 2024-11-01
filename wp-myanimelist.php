<?php
/*
Plugin Name: WP-MyAnimeList
Plugin URI: http://voiceoflogic.co.il/wp-myanimelist-plugin
Description: A highly customizable widget that display your anime and manga from MyAnimeList.net
Version: 1.0
Author: KeeperOfLogic
Author URI: http://voiceoflogic.co.il/
*/
$DEFAULT_TITLE = 'WP-MyAnimeList';
$kol_mal_sort_by = get_option('kol_mal_sort_by');
$kol_mal_sort_direction = get_option('kol_mal_sort_direction');
$mal_htmlstore_path = plugin_dir_path(__FILE__).'htmlstore.html';

register_activation_hook( __FILE__, 'kol_mal_activate' );
register_deactivation_hook( __FILE__, 'kol_mal_deactivate' );
register_sidebar_widget($DEFAULT_TITLE, 'kol_mal_widget');
register_widget_control($DEFAULT_TITLE, 'kol_mal_widget_control'); 

/* Widget Activate */
function kol_mal_activate(){
    update_option('kol_mal_widget_title','WP-MyAnimeList');
    update_option('kol_mal_items_in_row','3');
    update_option('kol_mal_imagewidth','95');
    update_option('kol_mal_last_update','01-01-2010');
    update_option('kol_mal_max_items','12');
    update_option('kol_mal_filter','($my_status == 2) && ($my_score >= 5)');
    update_option('kol_mal_sort_by','series_title');
    update_option('kol_mal_sort_direction','asc');
    update_option('kol_mal_cache_method','file');
    update_option('kol_mal_update_interval','day');
    update_option('kol_mal_show_image','checked="checked"');
    update_option('kol_mal_htmlstore','');
    update_option('kol_mal_connection_method','file');
    update_option('kol_mal_show_title','checked="checked"');
    update_option('kol_mal_more_link_visible','checked="checked"');
    update_option('kol_mal_more_link_text','> More Anime');
    update_option('kol_mal_widget_username','Xinil'); //(MAL Developer)
    update_option('kol_mal_widget_css','.kol_mal {direction: ltr;} .kol_mal_anime{} .kol_mal_anime img{margin:7px 5px 2px 0px;} .kol_mal_anime_title {text-align: center;} .kol_mal_more_container {text-align: left;}');
}

/* Widget Deactivate */
function kol_mal_deactivate(){
    delete_option('kol_mal_widget_title');
    delete_option('kol_mal_widget_username');
    delete_option('kol_mal_widget_css');
    delete_option('kol_mal_last_update');
    delete_option('kol_mal_htmlstore');
    delete_option('kol_mal_connection_method');
    delete_option('kol_mal_items_in_row');
    delete_option('kol_mal_imagewidth');
    delete_option('kol_mal_max_items');
    delete_option('kol_mal_filter');
    delete_option('kol_mal_sort_by');
    delete_option('kol_mal_sort_direction');
    delete_option('kol_mal_show_image');
    delete_option('kol_mal_show_title');
    delete_option('kol_mal_cache_method');
    delete_option('kol_mal_update_interval');
    delete_option('kol_mal_more_link_visible');
    delete_option('kol_mal_more_link_text');
}


/* Widget Edit Mode */
function kol_mal_widget_control() {
    if (isset($_REQUEST['kol_mal_widget_username'])) { 
            update_option('kol_mal_widget_username', $_REQUEST['kol_mal_widget_username']);
    		update_option('kol_mal_last_update','01-01-2010');
    }

    if (isset($_REQUEST['kol_mal_update_interval'])) { 
            update_option('kol_mal_update_interval', $_REQUEST['kol_mal_update_interval']);
    }

    if (isset($_REQUEST['kol_mal_widget_css'])) { 
            update_option('kol_mal_widget_css', $_REQUEST['kol_mal_widget_css']);
    }

    if (isset($_REQUEST['kol_mal_widget_imagewidth'])) { 
            update_option('kol_mal_imagewidth', $_REQUEST['kol_mal_widget_imagewidth']);
    }

    if (isset($_REQUEST['kol_mal_widget_title'])) { 
            update_option('kol_mal_widget_title', $_REQUEST['kol_mal_widget_title']);
    }

    if (isset($_REQUEST['kol_mal_cache_method'])) { 
            update_option('kol_mal_cache_method', $_REQUEST['kol_mal_cache_method']);
    }

    if (isset($_REQUEST['kol_mal_widget_itemsinrow'])) { 
            update_option('kol_mal_items_in_row', $_REQUEST['kol_mal_widget_itemsinrow']);
    }

    if (isset($_REQUEST['kol_mal_max_items'])) { 
            update_option('kol_mal_max_items', $_REQUEST['kol_mal_max_items']);
    }

    if (isset($_REQUEST['kol_mal_filter'])) { 
            update_option('kol_mal_filter', $_REQUEST['kol_mal_filter']);
    }

    if (isset($_REQUEST['kol_mal_sort_by'])) { 
            update_option('kol_mal_sort_by', $_REQUEST['kol_mal_sort_by']);
    }

    if (isset($_REQUEST['kol_mal_sort_direction'])) { 
            update_option('kol_mal_sort_direction', $_REQUEST['kol_mal_sort_direction']);
    }

    if (isset($_REQUEST['kol_mal_show_title'])) { 
            update_option('kol_mal_show_title', 'checked="checked"');
    }
    elseif (!empty($_REQUEST)) {
            update_option('kol_mal_show_title', '');
    }

    if (isset($_REQUEST['kol_mal_more_link_visible'])) { 
            update_option('kol_mal_more_link_visible', 'checked="checked"');
    }
    elseif (!empty($_REQUEST)) {
            update_option('kol_mal_more_link_visible', '');
    }

    if (isset($_REQUEST['kol_mal_more_link_text'])) { 
            update_option('kol_mal_more_link_text', $_REQUEST['kol_mal_more_link_text']);
    }

    if (isset($_REQUEST['kol_mal_connection_method'])) { 
            update_option('kol_mal_connection_method', $_REQUEST['kol_mal_connection_method']);
    }

    if (isset($_REQUEST['kol_mal_show_image'])) { 
            update_option('kol_mal_show_image', 'checked="checked"');
    }
    elseif (!empty($_REQUEST)) {
            update_option('kol_mal_show_image', '');
    }
    ?>

    <div style="direction: ltr; text-align: left;">
        
        <h3>Data Retrieval</h3>
    
        <label for="kol_mal_widget_username">MAL username:</label>
        <input style="width:132px;" type="text" name="kol_mal_widget_username" id="kol_mal_widget_username" value="<?= get_option('kol_mal_widget_username'); ?>" />
        <br /><br />
    
        <label for="kol_mal_connection_method">Connection method:</label> 
        <select style="width:110px;" name="kol_mal_connection_method">
            <? $vmalc = get_option('kol_mal_connection_method'); ?>
            <option value="curl"<? if($vmalc == 'curl') echo ' selected'; ?>>Curl</option>
            <option value="file"<? if($vmalc == 'file') echo ' selected'; ?>>File_get_content</option>
            <? unset($vmalc); ?>
        </select>
        <br /><br />

        <label for="kol_mal_cache_method">Cache:</label><br />
        <select style="width:100%;" name="kol_mal_cache_method" id="kol_mal_cache_method" onchange="CacheMethodChanged(event);">
            <? $vmalp1 = get_option('kol_mal_cache_method'); ?>
            <option value="file"<? if($vmalp1 == 'file') echo ' selected'; ?>>In server file</option>
            <option value="db"<? if($vmalp1 == 'db') echo ' selected'; ?>>In Wordpress database</option>
            <option value="none"<? if($vmalp1 == 'none') echo ' selected'; ?>>No cache (not recommended)</option>
            <?  ?>
        </select>
        <select style="width:100%;visibility: <?= ($vmalp1 == 'none'?'hidden':'visible')?>;" name="kol_mal_update_interval" id="kol_mal_update_interval">
            <? $vmalp2 = get_option('kol_mal_update_interval'); ?>
            <option value="week"<? if($vmalp2 == 'week') echo ' selected'; ?>>Update every week</option>
            <option value="day"<? if($vmalp2 == 'day') echo ' selected'; ?>>Update every day</option>
            <option value="hour"<? if($vmalp2 == 'hour') echo ' selected'; ?>>Update every hour</option>
            <? unset($vmalp2); unset($vmalp1); ?>
        </select>
        <br /><br />
    
        <h3>Sort and Filter</h3>
        
        <label for="kol_mal_sort_by">Sort by:</label><br />
        <select style="width:118px;" name="kol_mal_sort_by">
            <? $vmalsb = get_option('kol_mal_sort_by'); ?>
            <option value="series_animedb_id"<? if($vmalsb == 'series_animedb_id') echo ' selected'; ?>>ID</option>
            <option value="series_title"<? if($vmalsb == 'series_title') echo ' selected'; ?>>Title</option>
            <option value="series_type"<? if($vmalsb == 'series_type') echo ' selected'; ?>>Type</option>
            <option value="series_episodes"<? if($vmalsb == 'series_episodes') echo ' selected'; ?>>Number of episodes</option>
            <option value="series_status"<? if($vmalsb == 'series_status') echo ' selected'; ?>>Status</option>
            <option value="series_start"<? if($vmalsb == 'series_start') echo ' selected'; ?>>Start date</option>
            <option value="series_end"<? if($vmalsb == 'series_end') echo ' selected'; ?>>End date</option>
            <option value="my_watched_episodes"<? if($vmalsb == 'my_watched_episodes') echo ' selected'; ?>>Watched episodes</option>
            <option value="my_start_date"<? if($vmalsb == 'my_start_date') echo ' selected'; ?>>Watch start date</option>
            <option value="my_finish_date"<? if($vmalsb == 'my_finish_date') echo ' selected'; ?>>Watch finish date</option>
            <option value="my_score"<? if($vmalsb == 'my_score') echo ' selected'; ?>>Score</option>
            <option value="my_status"<? if($vmalsb == 'my_status') echo ' selected'; ?>>Watch status</option>
            <option value="my_last_updated"<? if($vmalsb == 'my_last_updated') echo ' selected'; ?>>Updated date</option>
            <option value="my_tags"<? if($vmalsb == 'my_tags') echo ' selected'; ?>>Tags</option>
            <option value="random"<? if($vmalsb == 'random') echo ' selected'; ?>>Random</option>
            <? unset($vmalsb); ?>
        </select>
        <select style="width:100px;" name="kol_mal_sort_direction">
            <? $vmalsd = get_option('kol_mal_sort_direction'); ?>
            <option value="asc"<? if($vmalsd == 'asc') echo ' selected'; ?>>Low to high</option>
            <option value="desc"<? if($vmalsd == 'desc') echo ' selected'; ?>>High to low</option>
            <? unset($vmalsd); ?>
        </select>
        <br /><br />
    
        <label for="kol_mal_filter">Filter expression:</label><br />
        <input style="width:100%;" type="text" name="kol_mal_filter" value="<?= get_option('kol_mal_filter'); ?>" /><br /><br />

        <h3>Appearance</h3>
        
        <label for="kol_mal_widget_title">Widget title:</label>
        <input style="width:150px;" type="text" name="kol_mal_widget_title" value="<?= get_option('kol_mal_widget_title'); ?>" />
        <br /><br />

        <label for="kol_mal_widget_itemsinrow">Number of columns:</label>
        <input style="width:30px;" type="text" name="kol_mal_widget_itemsinrow" value="<?= get_option('kol_mal_items_in_row'); ?>" />
        <br /><br />
    
        <label for="kol_mal_widget_imagewidth">Image width:</label>
        <input style="width:30px;" type="text" name="kol_mal_widget_imagewidth" value="<?= get_option('kol_mal_imagewidth'); ?>" /> px
        <br /><br />
    
        <label for="kol_mal_max_items">Maximum items:</label>
        <input style="width:30px;" type="text" name="kol_mal_max_items" value="<?= get_option('kol_mal_max_items'); ?>" />
        <br /><br />
    
        <input type="checkbox" id="kol_mal_show_image" name="kol_mal_show_image" <?= get_option('kol_mal_show_image') ?>  />
        <label for="kol_mal_show_image">Show image</label> 
        &nbsp;&nbsp;&nbsp;&nbsp;  
        <input type="checkbox" id="kol_mal_show_title" name="kol_mal_show_title" <?= get_option('kol_mal_show_title'); ?> />
        <label for="kol_mal_show_title">Show title</label>
        <br /><br />
        
        <input type="checkbox" id="kol_mal_more_link_visible" name="kol_mal_more_link_visible" <?= get_option('kol_mal_more_link_visible') ?>  />
        <label for="kol_mal_more_link_visible">More link:</label>
        <input style="width:150px;" type="text" name="kol_mal_more_link_text" id="kol_mal_more_link_text" value="<?= get_option('kol_mal_more_link_text'); ?>" />
        <br /><br />

        <label for="kol_mal_widget_css">Widget CSS:</label><br />
        <textarea style="width:100%;" name="kol_mal_widget_css"><?= get_option('kol_mal_widget_css'); ?></textarea><br />

    </div>
    <script type="text/javascript">
     function CacheMethodChanged(event)
     {
        var intervalSelectBox = event.target.form.elements["kol_mal_update_interval"];
        if (typeof intervalSelectBox === 'undefined') 
            return;

        event.target.form.setAttribute("autocomplete", "off" ); 

        var selIndex = event.target.selectedIndex;
        if (selIndex == 2)
        {
            intervalSelectBox.style.visibility = 'hidden';    
        }
        else
        {
            intervalSelectBox.style.visibility = 'visible';    
        }
     }
    </script>
    <?
}

/* Widget View Mode */
function kol_mal_widget($args) {
    $title = get_option('kol_mal_widget_title');  
    
    echo $args['before_widget']; 
     echo '<style>'.get_option('kol_mal_widget_css').'</style>';
     if (!empty($title))
     {
         echo $args['before_title'];
         echo $title;
         echo $args['after_title'];
     }
     echo '<div id="kol_mal">'.GetWidgetHtml().'</div>';	
    echo $after_widget;
}

////////////////////////////////////////////////////////////////////////////////////////////

function GetWidgetHtml()
{
    $html = TryGetCachedHtml();
    
    if(CheckNeedUpdate() || empty($html)) {
        $html = GetLiveHtml();
        CacheHtml($html);
    }

    $more_link_visible = get_option('kol_mal_more_link_visible');
    $more_link_text = get_option('kol_mal_more_link_text');
    $username = get_option('kol_mal_widget_username'); if (empty($username)) { $username = 'Xinil';}    //(MAL Developer)
    $myAnimeListUrl = 'http://myanimelist.net/animelist/' . $username;
    if ($more_link_visible)
        $html .= "<div class='kol_mal_more_container'><a href='$myAnimeListUrl' class='kol_mal_more_link' target='_blank'>$more_link_text</a><div>";
    
    return $html;
}

function CheckNeedUpdate()
{
    if(get_option('kol_mal_cache_method') == 'none')
        return true;
    
    $lastupdate = date_create_from_format('Y-m-d H:i',get_option('kol_mal_last_update'));
    if (empty($lastupdate))
        return true;
        
    switch (get_option('kol_mal_update_interval'))
    {
        case 'week':
            return ( $lastupdate->format('W') != date('W'));
            break;
        case 'day':
            return ( $lastupdate->format('Y-m-d') != date('Y-m-d'));
            break;
        case 'hour':
            return ( $lastupdate->format('Y-m-d H') != date('Y-m-d H'));
            break;
    }

    return true;    
}

function GetLiveHtml()
{
    global $kol_mal_sort_by,$kol_mal_sort_direction;

    $kol_mal_sort_by = get_option('kol_mal_sort_by');
    $kol_mal_sort_direction = get_option('kol_mal_sort_direction');
    $show_title = get_option('kol_mal_show_title');
    $show_image = get_option('kol_mal_show_image');
    $items_per_row = get_option('kol_mal_items_in_row'); if (empty($items_per_row)) { $items_per_row = 3;}
    $image_width = get_option('kol_mal_imagewidth'); if (empty($image_width)) { $image_width = 95; }
    $image_height = (int)($image_width * 1.33);
    $max_items = get_option('kol_mal_max_items');
    $items_filter = get_option('kol_mal_filter'); if (!empty($items_filter) && $items_filter != '') {$items_filter = 'return( ' . str_replace('$','$anime->',$items_filter) . ');';}
    $username = get_option('kol_mal_widget_username'); if (empty($username)) { $username = 'Xinil';}    //(MAL Developer)
    $apiUrl = "http://myanimelist.net/malappinfo.php?u=$username&status=all&type=anime";

    // Get the anime list
    if(get_option('kol_mal_connection_method') == 'file'){
        $data = file_get_contents($apiUrl);
    }
    else //(curl)
    {
        $chandler = curl_init();
        curl_setopt($chandler, CURLOPT_URL, $apiUrl);
        curl_setopt($chandler, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($chandler);
        curl_close($chandler);
    }
    $xmlData = new SimpleXMLElement($data);

    // Apply Filter if exists
    $animearray = array();
    foreach ($xmlData->anime as $anime) {
       if (($items_filter != '') && !eval($items_filter))  
            continue; 

       $animearray[] = $anime;
    }
    
    // Apply Sort
    if ($kol_mal_sort_by == 'random')
        $animearray = shuffle_assoc($animearray);
    else
        usort($animearray, "ComapreAnime");

    // Apply item cap
    if ( !empty($max_items) && is_numeric($max_items) && $max_items > 0)
        $animearray = array_slice($animearray,0,$max_items);

    // Generate the HTML        
    $i = 1;
    $html = '<div class="kol_mal"><table cellspacing="0" cellpadding="0" border="0"><tr>';
    foreach ($animearray as $anime) {
       $html .= "<td class='kol_mal_anime' style='width:{$image_width}px;vertical-align: top;'>";
       $html .= "  <a href='http://myanimelist.net/anime/$anime->series_animedb_id' target='_blank'>";
       if ($show_image != '')
           $html .= "   <img style='width:{$image_width}px;height:{$image_height}px' src='$anime->series_image' alt='$anime->series_title' title='$anime->series_title'/>" ;
       if ($show_title != '')
           $html .= '   <div class="kol_mal_anime_title">' . $anime->series_title . '</div>';
       $html .= '  </a>';
       $html .= '</td>';
       
       if (($i % $items_per_row) == 0)
        { $html .= '</tr><tr>';}
       $i++; 
    }
    $html .= '</tr></table></div>';

    unset($data);
    unset($xmlData);
    unset($animearray);

    return $html;
}

function CacheHtml($html)
{
    global $mal_htmlstore_path;
    
    $now = new DateTime(); $nowst = $now->format('Y-m-d H:i');
    
    switch (get_option('kol_mal_cache_method'))
    {
        case 'file':
            unlink($mal_htmlstore_path);
            $store = fopen($mal_htmlstore_path,"w");
            fwrite($store,$html);
            fclose($store);
            update_option('kol_mal_last_update', $nowst);
            break;
        case 'db':
            update_option('kol_mal_htmlstore', $html);
            update_option('kol_mal_last_update', $nowst);
            break;
    }
}

function TryGetCachedHtml()
{
    global $mal_htmlstore_path;
    
    $html = '';
    switch(get_option('kol_mal_cache_method'))
    {
        case 'file':
            $html = file_get_contents($mal_htmlstore_path);
            break;
        case 'db':
            $html = get_option('kol_mal_htmlstore');
            break;
    }

    return $html;
}

////////////////////////////////////////////////////////////////////////////////////////////
//                                       Util Functions
////////////////////////////////////////////////////////////////////////////////////////////

function ComapreAnime($oa, $ob)
{
    global $kol_mal_sort_by,$kol_mal_sort_direction;

    $a = strtolower($oa->$kol_mal_sort_by); 
    $b = strtolower($ob->$kol_mal_sort_by); 

    if ($a == $b) { 
        return 0; 
    } else if (($a > $b && $kol_mal_sort_direction == "asc") || ($a < $b && $kol_mal_sort_direction == "desc")) { 
        return 1; 
    } else { 
        return -1; 
    } 
}

function shuffle_assoc($list) { 
  if (!is_array($list)) return $list; 

  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array(); 
  foreach ($keys as $key) 
    $random[$key] = $list[$key]; 

  return $random; 
} 
?>