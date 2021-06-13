<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>
        <div id="menu-wrapper" class="clr">
            <div id="menu-inner-wrapper" class="container" >
              <div id="sidr-close"><a href="#sidr-close" class="toggle-sidr-close"></a></div>
              <div id="site-navigation-wrap">
                <a href="#sidr-main" id="navigation-toggle"><span class="fa fa-bars"></span>Menu</a>
                
                <nav id="site-navigation" class="navigation main-navigation clr" role="navigation">
                  <div id="main-menu" class="menu-main-container">
                    <div class="menu-logo">
                        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                            <svg class="menu-icon" version="1.0" xmlns="http://www.w3.org/2000/svg" style="shape-rendering:crispEdges;" width="40px" height="40px" viewBox="0 0 165.000000 165.000000" preserveAspectRatio="xMidYMid meet">
                                <g fill="#fff" stroke="none">
                                    <polygon points="35.6,93.8 0,93.8 0,165 71.2,165 71.2,129.4 35.6,129.4"/>
                                    <polygon points="93.8,129.4 93.8,165 165,165 165,93.8 129.4,93.8 129.4,129.4"/>
                                    <polygon points="129.4,71.2 165,71.2 165,0 93.8,0 93.8,35.6 129.4,35.6"/>
                                    <polygon points="71.2,35.6 71.2,0 0,0 0,71.2 35.6,71.2 35.6,35.6"/>
                                </g>  
                            </svg>
                        </a>
                    </div>
                    <div class="user-menu">
                      <ul>
                          <li><a href="#"><i class="fa fa-globe fa-2x"></i></a>
                              <ul class="language-switcher-locale-session">
                                <li class="hu first active"><a href="/?lang=hu" class="language-link session-active" xml:lang="hu"><img class="language-icon" typeof="foaf:Image" src="/sites/all/modules/languageicons/flags/hu.png" width="70" height="47" alt="Magyar" title="Magyar"></a></li>
                                <li class="en"><a href="/?lang=en" class="language-link" xml:lang="en"><img class="language-icon" typeof="foaf:Image" src="/sites/all/modules/languageicons/flags/en.png" width="70" height="47" alt="English" title="English"></a></li>
                                <li class="de last"><a href="/?lang=de" class="language-link" xml:lang="de"><img class="language-icon" typeof="foaf:Image" src="/sites/all/modules/languageicons/flags/de.png" width="70" height="47" alt="Deutsch" title="Deutsch"></a></li>
                              </ul>
                          </li>
                      </ul>
                    </div>  
                    <?php 
                      global $language;

                      if (($language->language=='hu')){
                         $main_menu_tree = menu_tree('main-menu');  
                      }else if (($language->language=='en')){
                         $main_menu_tree = menu_tree('menu-main-menu---en');  
                      }else if (($language->language=='de')){
                         $main_menu_tree = menu_tree('menu-main-menu---de');  
                      }else{
                         $main_menu_tree = menu_tree('main-menu');
                      }

                      print drupal_render($main_menu_tree);
                    ?>
                  </div>
                </nav>
                
                <nav id="mobile-navigation" class="navigation main-navigation clr" role="navigation">
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                        <h1><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></h1>
                    </a>                
                  <div id="main-menu" class="menu-main-container">
                    <?php            
                      $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
                      print drupal_render($main_menu_tree);
                    ?>

                   <?php if ($page['mobile_menu']): ?>
                        <?php print render($page['mobile_menu']); ?>
                    <?php endif; ?>        
                  </div>
                </nav>
                
              </div>
            </div>
        </div>
  <?php if ($is_front){ ?>
  
  <section id="intro">
        <div class="header-vid" style="width: 100%; height: 100vh;"
            data-vide-bg="
                mp4: /<?php echo path_to_theme(); ?>/images/front_vid_3.mp4,
                webm: /<?php echo path_to_theme(); ?>/images/front_vid_3.webm,
                ogg: /<?php echo path_to_theme(); ?>/images/front_vid_3.ogg,
                poster: /<?php echo path_to_theme(); ?>/images/front_poster_1.jpg
                "
            data-vide-options="posterType: jpg, loop: true, muted: true, position: 0% 0%">
        </div>     

    <?php if ($page['lang']): ?>
        <?php print render($page['lang']); ?>
    <?php endif; ?>
    <div class="intro-title">
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
            <h1><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></h1>
        </a>
    </div>
        <div class="intro-add-text">
            <?php echo t('Beautiful natural surroundings, you can relax in a very calm atmosphere in the heart of the county.'); ?>
        </div>    
    <div class="section-content">
        <a href="#prog" class="ghost-button"><?php echo t('Explore the area around the apartment'); ?></a>
        <a href="#booking" class="ghost-button"><?php echo t('Make reservation and spend your holiday'); ?></a>
    </div>
  </section>        

  <section id="prog">
    <?php
                echo '<div class="section-title"><h2>'.t('The Doboskút Vendégház and surroundings').'</h2><h3>H-3179 Nógrádsipek, Dózsa György út 49.</h3></div>'; 
                echo '<div class="down-tri"></div>';
                echo views_embed_view('programlehetesegek', $display_id = 'block');    
                echo '</div>';
    ?>
    <div class="mini-map">
        <img src="/<?php echo path_to_theme();?>/images/blind_map_s.png"/>
    </div>
  </section>  
  
  <section id="3dv">
    <div class="section-title">
        <h2><?php echo t('Images from the apartment'); ?></h2>
        <h3><?php echo t('Choose apartment'); ?></h3>
    </div>
    <div class="down-tri"></div>
    <div class="section-content-wide">
        <div class="qicon-wrapper">
        <?php echo t('street'); ?>
	 <br/>
            <svg  version="1.0" xmlns="http://www.w3.org/2000/svg" style="shape-rendering:crispEdges;" width="165.000000pt" height="165.000000pt" viewBox="0 0 165.000000 165.000000" preserveAspectRatio="xMidYMid meet">
                <g fill="#000000" stroke="none">
                    <polygon onclick="show_view( 4 );" id="qi-4" class="qicon qi-4" points="71.2,35.6 71.2,0 0,0 0,71.2 35.6,71.2 35.6,35.6"/>
                    <polygon onclick="show_view( 1 );" id="qi-1" class="qicon qi-1" points="129.4,71.2 165,71.2 165,0 93.8,0 93.8,35.6 129.4,35.6"/>
                    <polygon onclick="show_view( 2 );" id="qi-2" class="qicon qi-2" points="93.8,129.4 93.8,165 165,165 165,93.8 129.4,93.8 129.4,129.4"/>
                    <polygon onclick="show_view( 3 );" id="qi-3" class="qicon qi-3" points="35.6,93.8 0,93.8 0,165 71.2,165 71.2,129.4 35.6,129.4"/>
                    <rect onclick="show_view( 0 );" id="qi-0" class="qicon qi-0" x="53.8" y="52.9" width="58.1" height="58.1"/>
                </g>  
            </svg>
        </div>
        <div class="qicon-help">
		<center><?php echo t('click on the illustration for pictures');?><center>
	 </div>
        <div id="seta-gallery">

<div id="seta-gallery">
      <?php
         //multipurpose_get_gal('http://webseta.hu/r141817');
      ?>

      <?php
        global $language;
        
        $node = node_load(62);
        $translations = translation_node_get_translations($node->tnid);
        if (isset($translations)){
	     $info_url = drupal_get_path_alias( 'node/'.$translations[$language->language]->nid );
        }
      ?>

        <div id="apt-1" class="apt-view">
            <h3>Apartman 1 - <?php echo t('north'); ?></h3>
	     <center><?php echo t('click on the picture for 3D walk');?><center>
            <a href="http://webseta.hu/r141817/1_apartman_halo_22/-289,27/10,98/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/bc9bbe38d4ca412def3820461e78b3c4.jpg?itok=cKTaB2C3" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/1_apartman_nappali_21/42,92/4,30/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/e1b4bbe096723169b3b9f000a56e31dd.jpg?itok=2cyTWuTA" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/1_apartman_tea_konyha_23/-274,88/8,80/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/5b31c579c139c7137918f02d66ee550e.jpg?itok=nsqXiOw2" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
	     <a href="http://webseta.hu/r141817/_1_apartman_zuhanyzo_24/48,72/18,20/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/d55a84e0617c5895cee98cda8d646c78.jpg?itok=xOHIlQj9" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <div class="center"><a href="http://suncalc.net/#/48.0018,19.5091,17/<?php echo date('Y.m.d/H:i'); ?>" class="gallery fancybox.iframe"><?php echo t('Check out which direction the sun is shining.');?></a></div>
            <div class="center"><a href="<?php echo $info_url; ?>"><h3><?php echo t('more images and information'); ?></h3></a></div>
        </div>
        <div id="apt-2" class="apt-view">            
            <h3>Apartman 2 - <?php echo t('west'); ?></h3>    
	     <center><?php echo t('click on the picture for 3D walk');?><center>
            <a href="http://webseta.hu/r141817/2__apartman_nappali_8/-106,05/12,85/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/aac459aff52ef8aa8b75abced0553e52.jpg?itok=vxxyYn3z" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/2__apartman_nappali_8/-210,24/10,31/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/c151e82cf5e9ebbb812ae1ec209a9230.jpg?itok=etKXtGnS" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/2__apartman_nappali_8/-48,04/5,82/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/e626f33d05733a1d6ed0033550227255.jpg?itok=Ww_8yYQU" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/2__apartman_nappali_9/-293,97/15,08/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/febf0c8e898ba0ba999b1e4a7f235ae5.jpg?itok=VS_3WzYK" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/2__apartman_nappali_9/-313,31/-1,14/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="http://doboskutvendeghaz.hu/sites/default/files/styles/gal_thumb/public/externals/ea91d7dcca29330fde044ad6f5d33faf.jpg?itok=p4LW7SJp" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/2__apartman_nappali_9/-394,88/12,93/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/eb4f9831c3ef0c48386e037a15011c59.jpg?itok=35KUahmB" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/2__apartman_tea_konyha_7/13,92/6,25/121,67" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/685d6c38c243b2018431eff795e6a77a.jpg?itok=8sVFMXYv" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/2__apartman_zuhanyzo_11/-320,51/12,33/122,89" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/a140fdd7670eec78b6451e7ee5ec67c5.jpg?itok=Ux422QSL" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/2_apartman_halo_10/-192,64/18,34/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/4476ccdf0b8b29cea8c9d6c71e6fba6d.jpg?itok=7sSJqDuv" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <div class="center"><a href="http://suncalc.net/#/48.0018,19.5091,17/<?php echo date('Y.m.d/H:i'); ?>" class="gallery fancybox.iframe"><?php echo t('Check out which direction the sun is shining.');?></a></div>
            <div class="center"><a href="<?php echo $info_url; ?>"><h3><?php echo t('more images and information'); ?></h3></a></div>
        </div>
        <div id="apt-3" class="apt-view">
        <h3>Apartman 3 - <?php echo t('south'); ?></h3>    
	     <center><?php echo t('click on the picture for 3D walk');?><center>
            <a href="http://webseta.hu/r141817/3_apartman_halo14/-210,09/16,44/111,41" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/98460b6b9f1e9946241ff5d8a9eafdf3.jpg?itok=v0TS6HjJ" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/3_apartman_nappali_12/-321,00/3,97/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/3fc870dd0d174a64115f0c309092e741.jpg?itok=TRJAlFf7" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/3_apartman_tarolo_15/-359,31/4,28/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/8b323878bdf5e40e7855a46409cc18e3.jpg?itok=bmjiur3_" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/3_apartman_zuhanyzo16/40,20/3,70/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/7c62766e3710df663a014d92be25a6af.jpg?itok=f26kv8xZ" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <div class="center"><a href="http://suncalc.net/#/48.0018,19.5091,17/<?php echo date('Y.m.d/H:i'); ?>" class="gallery fancybox.iframe"><?php echo t('Check out which direction the sun is shining.');?></a></div>
	     <div class="center"><a href="<?php echo $info_url; ?>"><h3><?php echo t('more images and information'); ?></h3></a></div>
        </div>
        <div id="apt-4" class="apt-view">
        <h3>Apartman 4 - <?php echo t('east'); ?></h3>    
	     <center><?php echo t('click on the picture for 3D walk');?><center>
            <a href="http://webseta.hu/r141817/4__apartman_nappali_4/-119,37/12,89/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/28fcbff602d9cd7f432054ea4e9aa8c1.jpg?itok=xDbMEl54" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/4__apartman_nappali_4/-19,86/10,97/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/87236533f7bd95ea9b5b7648ff7f8b7e.jpg?itok=3qbN5gEo" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/4_apartman_halo_5/-97,35/24,17/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/6987bf9a26e54d2004e35cb0de407941.jpg?itok=R-e6PzoD" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/4_apartman_halo_5/73,77/14,09/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/f7bf235d663b82ed3efba3966ec06a39.jpg?itok=nwnkjxqg" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/4_apartman_nappali1/223,74/3,89/121,67" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/0415cd7fd58dd38390ebf3f688aa902c.jpg?itok=YeBEbsdj" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/4_apartman_nappali1/6,47/7,94/121,67" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/418bc6126a1e52bae630b293c63bd1b7.jpg?itok=pHSulh5E" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/4_apartman_zuhanyzo_3/43,68/7,88/120,80" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/a4de9601a9607cb3af1589d7f08058fc.jpg?itok=UEHmZ7q2" width="300" height="200" alt=""><div class="gal-img-over"></div></a>        
            <div class="center"><a href="http://suncalc.net/#/48.0018,19.5091,17/<?php echo date('Y.m.d/H:i'); ?>" class="gallery fancybox.iframe"><?php echo t('Check out which direction the sun is shining.');?></a></div>
	     <div class="center"><a href="<?php echo $info_url; ?>"><h3><?php echo t('more images and information'); ?></h3></a></div>
        </div>
        <div id="apt-0" class="apt-view">
        <h3><?php echo t('Public places'); ?></h3>    
	     <center><?php echo t('click on the picture for 3D walk');?><center>
            <a href="http://webseta.hu/r141817/bejarat_19/-276,94/-36,82/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/c81cf7378f3ace15b96d0d652a158620.jpg?itok=5L5ZSVp5" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/bejarat_20/0,03/4,11/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/943a1aa4f1cf7a3719bc246d56313584.jpg?itok=l_EsVW0T" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/belso_udvar_13/-380,75/-13,46/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/0d49fbf1f5a26f31da931459e28ee172.jpg?itok=wVscgW7L" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/etkezo_25/-151,63/7,58/122,97" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/b60f3c18817449927edb27a78d11bd82.jpg?itok=6Hv7f81z" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/konyha_26/60,34/8,95/100,00" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/c6b0a8829d1d123fdd02e25f61eb9c4a.jpg?itok=0J2JTZU-" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/tuzrako_18/-341,99/4,95/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/1907f568390f82f50235958ba555c6e5.jpg?itok=8lgmgKOg" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
            <a href="http://webseta.hu/r141817/udvar_17/-53,83/0,70/110,35" target="_blank" class="gallery fancybox.iframe"><img class="lazy" typeof="foaf:Image" src="/sites/default/files/styles/gal_thumb/public/externals/0178b237c44e3f4f0e6644a29c0c70ed.jpg?itok=221806Nm" width="300" height="200" alt=""><div class="gal-img-over"></div></a>
	     <div class="center"><a href="http://suncalc.net/#/48.0018,19.5091,17/<?php echo date('Y.m.d/H:i'); ?>" class="gallery fancybox.iframe"><?php echo t('Nézze meg merről süt a nap.');?></a></div>
            <div class="center"><a href="<?php echo $info_url; ?>"><h3><?php echo t('more images and information'); ?></h3></a></div>
	 </div>
        <style>
            .gal-img-over {
                <?php 
                      global $language;
                      echo "background: url('images/img_over_".$language->language.".png');";
                ?>
            }        
        </style>
  </section>  

  <section id="booking">  
    
    <div class="section-title">
        <h2><?php echo t('Reservation'); ?></h2>
        <h3><?php echo t('Choose a date'); ?></h3>
    </div>
    
    <div class="down-tri"></div>
    <div class="section-content">
        <?php print render($page['booking']); ?>
        
        <?php
            global $language;
        
            $node = node_load(65);
            $translations = translation_node_get_translations($node->tnid);
            if (isset($translations)){
                $node = node_load($translations[$language->language]->nid);
                if ($node){
                    echo '<div class="ff-toggle"><a href="#booking" onclick="ff_toggle(\''.$node->title.'\');">'.$node->title.'</a></div>'; 
                    echo '<div class="ff-content">'.$node->body['und'][0]['value'].'</div>';
                }
            }
        ?>
    </div>
  </section>

  <section id="prices">
    <?php
        global $language;
        
        $node = node_load(3);
        $translations = translation_node_get_translations($node->tnid);
        if (isset($translations)){
            $node = node_load($translations[$language->language]->nid);
            if ($node){
                echo '<div class="section-title"><h2>'.$node->title.'</h2></div>'; 
                echo '<div class="down-tri"></div>';
                echo '<div class="section-content">'.$node->body['und'][0]['value'].'</div>';
            }
        }
   ?>
  </section>  
  <section id="promotions">
    <?php
        global $language;
        
        $node = node_load(22);
        $translations = translation_node_get_translations($node->tnid);
        if (isset($translations)){
            $node = node_load($translations[$language->language]->nid);
            if ($node){
                echo '<div class="section-title"><h2>'.$node->title.'</h2></div>'; 
                echo '<div class="down-tri"></div>';
                echo '<div class="section-content">'.$node->body['und'][0]['value'].'</div>';
            }
        }
   ?>
  </section>  


  <section id="opinions">
    <div class="section-title">
        <h2><?php echo t('Our guests experiences'); ?></h2>
    </div>
    <div class="down-tri"></div>
    <div class="section-content">
      <?php
            echo views_embed_view('vedegeink_velemenyek', $display_id = 'block');    
      ?>
    </div>      
  </section> 
  <?php }else{ ?>
  
  <?php if ($page['content_top']): ?><div id="content_top"><?php print render($page['content_top']); ?></div><?php endif; ?>
  <div id="wrap" class="clr container">
      <div id="main" class="site-main clr">
        <?php $sidebarclass = ""; if($page['sidebar_first']) { $sidebarclass="left-content"; } ?>
        <div id="primary" class="content-area clr">
          <section id="content" role="main" class="site-content <?php print $sidebarclass; ?> clr">
            <?php if (theme_get_setting('breadcrumbs')): ?><?php if ($breadcrumb): ?><div id="breadcrumbs"><?php print $breadcrumb; ?></div><?php endif;?><?php endif; ?>
            <?php print $messages; ?>
            
            <div id="content-wrap">
              <?php print render($title_prefix); ?>
              <?php if ($title): ?><h1 class="page-title"><?php print $title; ?></h1><?php endif; ?>
              <?php print render($title_suffix); ?>
              <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clr"><?php print render($tabs); ?></div><?php endif; ?>
              <?php print render($page['help']); ?>
              <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
              <?php print render($page['content']); ?>
            </div>
          </section>
        </div>
      </div>
  </div>  
  <?php } ?>
  <section id="contact">
    <div class="section-title"><h2><?php echo t('Contact'); ?></h2><h3><?php echo t('Feel free to ask questions or post your opinions'); ?></h3></div>
    <div class="down-tri"></div>
    <div class="section-content">
        <div id="contact-data-wrapper">
            <div class="contact-data contact-data-left">
                <table>
                    <tr>
                        <td><i class="fa fa-home"></i></td>
                        <td>
                        <strong>Doboskút Vendégház</strong><br />
                        H-3179 Nógrádsipek,<br />Dózsa György út 49.</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-phone"></i></td>
                        <td><strong><?php echo t('Phone'); ?></strong><br />
                        +36-1/433-5165<br />+36-20/929-9615<br />+36-20/922-1685<br /></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-fax"></i></td>
                        <td><strong><?php echo t('Fax'); ?></strong><br />
                        +36-1-262-5331</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-envelope-o"></i></td>
                        <td><strong><?php echo t('E-mail'); ?></strong><br />
                        szallas@doboskutvendeghaz.hu</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-clock-o"></i></td>
                        <td><strong><?php echo t('Open'); ?></strong><br />
                        <?php echo t('all year'); ?></td>
                    </tr>
                </table>
            </div>
            <div class="contact-data contact-data-right">
            <?php
                $block = module_invoke('webform', 'block_view', 'client-block-19');
                print render($block['content']);
            ?>
            </div>
        </div>    
    </div>
  </section>   
  <?php if ($page['footer']): ?>
      <footer class="clear">
          <div id="footer-wrap" class="site-footer clr">
            <div id="footer" class="clr">
              <?php if ($page['footer']): ?>
                <div class="span_1_of_1 col col-1">
                  <?php print render($page['footer']); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
      </footer>
  <?php endif; ?>
  