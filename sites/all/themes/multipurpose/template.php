<?php
/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
function multipurpose_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Insert themed breadcrumb page navigation at top of the node content.
 */
function multipurpose_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Use CSS to hide titile .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // comment below line to hide current page to breadcrumb
$breadcrumb[] = drupal_get_title();
    $output .= '<nav class="breadcrumb">' . implode(' » ', $breadcrumb) . '</nav>';
    return $output;
  }
}

/**
 * Override or insert variables into the page template.
 */
function multipurpose_preprocess_page(&$vars) {
    
  drupal_add_css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array('type' => 'external'));
    
  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'main-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'secondary-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function multipurpose_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

function multipurpose_get_gal($link) {
    
    if ($link!=''){
        if($cached = cache_get($link, 'cache'))  {
          $img_arr = $cached->data;
        }
        if(empty($img_arr)) {
            $p_url = parse_url ($link);
            
            $id = explode('/',$p_url['path']);
        
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
            
            $ch = curl_init('http://galeria.webseta.hu/'.$id[1]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            $content = curl_exec($ch);
            curl_close($ch);
           
            $dom = new DOMDocument();
            
            $dom->recover = true;
            $dom->strictErrorChecking = false;
            
            @$dom->loadHTML($content);
            $dom->saveHTML();
            
            $xpath = new DOMXPath($dom);
        
            $classname="imgs";
            $nodes = $xpath->query("//*[@id='t_galeria']/div/img/@src");
            
            foreach ($nodes as $node){
                $img_arr[]=$node->nodeValue;
            }
            
        }
        cache_set($link, $img_arr, 'cache', time()+60*60*2);
    
        $base_path_img  = "http://galeria.webseta.hu";
        $base_path_link = "http://webseta.hu";
        
        foreach($img_arr as $img){

            $tmp = substr($img,(strrpos($img,'/')+1));
            $tmp = str_replace ( ".jpg" , "" , $tmp );
            $tmp = str_replace ( "," , "/" , $tmp );
            $tmp = str_replace ( "." , "," , $tmp );
            $link = $base_path_link.'/'.$tmp;
            echo '<a href="'.$link.'" target="_blank" class="gallery fancybox.iframe">';
                print theme('imagecache_external', array(
                    'path' => $base_path_img.$img,
                    'style_name'=> 'gal_thumb',
                    'attributes' => array('class' => 'lazy'),
                )); 
		  echo '<div class="gal-img-over"></div>';
            echo '</a>';
        } 
    }
}

/**
 * Override or insert variables into the node template.
 */
function multipurpose_preprocess_node(&$variables) {
  $node = $variables['node'];
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  $variables['date'] = t('!datetime', array('!datetime' =>  date('j F Y', $variables['created'])));
}

function multipurpose_page_alter($page) {
  // <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
    'name' =>  'viewport',
    'content' =>  'width=device-width, initial-scale=1, maximum-scale=1'
    )
  );
  drupal_add_html_head($viewport, 'viewport');
}