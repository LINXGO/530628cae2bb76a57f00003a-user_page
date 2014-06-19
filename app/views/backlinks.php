<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="<?php echo $lang_tag;?>">
<head>
	<title><?php echo html_entity_decode($page_title);?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo html_entity_decode($page_description);?>">
	<meta name="keywords" content="<?php echo html_entity_decode($page_keywords);?>">
	<meta name="viewport" content="width=device-width">	
	<link href="<?php echo $base_url;?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo $base_url;?>assets/css/flags.css" rel="stylesheet">	
	<link href="<?php echo $base_url;?>assets/plugins/jquery.qtip/jquery.qtip.min.css" rel="stylesheet">	    	
	<link href="<?php echo $base_url;?>assets/css/font-awesome/css/icons-awesome.min.css" rel="stylesheet">	
</head>
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <div id="header">
    	<div class="logo">
			<a href="<?php echo $base_url;?>"><img class="img_logo" src="<?php echo $base_url;?>images/logo.png" alt="linxgo" /></a><br />
		</div>
        <div class="slogan">
            -  <?php echo $text_slogan;?>
        </div>
        <div class="search">
			<form class="form-wrapper cf" id="search_form" action="<?php echo $action_url; ?>" method="post">	
                <div class="input-group">
                    <input type="text" class="form-control" name="s" id="search_text" value="<?php echo (isset($search_value)?$search_value:'');?>" />
                    <span class="input-group-btn">
                        <button class="btn" type="submit"><?php echo $text_search;?></button>
                    </span>
                </div>
                <input type="hidden" name="state" id="state" value="<?php echo $current_country;?>" />
                <input type="hidden" name="state_country" id="state_country" value="<?php echo $state_country;?>" />
                <input type="hidden" name="subcat" id="subcat" value="<?php echo $current_subcat;?>" />
                <input type="hidden" name="cat" id="cat" value="<?php echo $current_cat;?>" />
			</form>
		</div>
	</div>
    
    <div id="menu" class="br">
    	<div class="menu_center">
        	<div class="menu_parte menu_parte1">
                <a href="<?php echo $base_url;?>"><div class="menu_celda_osc2 menu_celda_osc br"><p><?php echo $text_home;?></p></div></a>
                <a href="<?php echo $base_url;?>"><div class="menu_celda"><p><?php echo $text_ads;?></p></div></a>
                <a href="<?php echo $base_url;?>backlinks"><div class="menu_celda"><p><?php echo $text_backlinks;?></p></div></a>
                <a href="<?php echo $publish_article_url;?>"><div class="menu_celda"><p><?php echo $text_article;?></p></div></a>
            </div>
            <div class="menu_parte menu_parte2">    
                <div class="menu_celda_osc br"><p><?php echo $text_sem;?></p></div>
                <a href="<?php echo $base_url;?>advertisers"><div class="menu_celda"><p><?php echo $text_customers;?></p></div></a>
                <a href="<?php echo $base_url;?>afiliates"><div class="menu_celda"><p><?php echo $text_afiliates;?></p></div></a>
                <a href="<?php echo $referral_url;?>"><div class="menu_celda"><p><?php echo $more_info;?></p></div></a>
            </div>
            <div class="menu_parte menu_parte3">                                                       
                <div class="menu_celda_osc br"><p><?php echo $text_seo;?></p></div>
                <a href="<?php echo $base_url;?>tour"><div class="menu_celda"><p><?php echo $text_tour;?></p></div></a>
                <a href="<?php echo $base_url;?>linxgo"><div class="menu_celda"><p><?php echo $text_linxgo;?></p></div></a>
                <a href="<?php echo $base_url;?>system"><div class="menu_celda"><p><?php echo $text_system;?></p></div></a>
            </div>
        </div> 
    </div><!-- end of menu row -->
    
    <div id="content">
        <div class="central-column">
            <div class="d_horizontal br">
                <img class="br linxgo_bh hidden" src="https://linxgo.com/<?php echo $lang_tag;?>/contents?name=<?php echo $api_key.'_0';?>" />
            </div>
		<?php
			$size_back = count($backlinks)/2;
			$counter1=0;
			
			if ($backlinks) { 
				foreach ($backlinks as $backlink) {
					if ($counter1==0){ ?>
						<div class='bds bds1'>	
                        <a href="<?php echo $backlinks_url; ?>">
                            	<div class="bds_button br" rel="tooltip" data-tip="<?php echo $text_backlinks_button_tip; ?>">
                            		<div class="table_cell pub_btn"><?php echo $text_backlinks_button;?> &nbsp;&nbsp; <i class="icon-ok"></i></div>
                                </div>
                       	</a>
                    <?php    
					}
					if ($counter1==$size_back) {
						?>
						</div>
                        <div class='bds bds2'>
                    <?php 
					}
					$counter1=$counter1+1;			
        ?>
            <div class="results_container br">
            	<div class="up_backlink">
                    <div class="backlinks-title">
                        <a class="mlb-<?php echo $backlink['title']['link']['class'];?>" href="<?php echo $backlink['title']['link']['href'];?>" 
                            alt="<?php echo $backlink['title']['link']['alt'];?>" target="_BLANK">
                                <span<?php echo (($backlink['title']['text']['style'])?' style ="'.$backlink['title']['text']['style'].'"':'');?>>
                                    <?php echo ($backlink['title']['text']['text']); ?>
                               </span>
                        </a>
                    </div>
                    <div class="backlink-country-info">
                        <a class="country-selector" href="<?php echo $backlink['location_info']['country'];?>">
                            <i class="flag <?php echo $backlink['location_info']['country_code'];?>" rel="tooltip" data-tip="<?php echo $backlink['location_info']['country'];?>"></i>
                        </a>
                    </div>
               </div>
                <div class="description_backlinks">
                    <p <?php echo (($backlink['description']['style'])?' style="'.$backlink['description']['style'].'"':'');?>>
                        <?php echo $backlink['description']['description'];?>&nbsp<i class="backlink-keywords"><?php echo $backlink['description']['keywords'];?></i>
                    </p>
                </div>
                <div class="backlinks_link">
                    <a href="<?php echo $backlink['link']['href'];?>"<?php echo (($backlink['link']['style'])?' style="'.$backlink['link']['style'].'"':'');?>><?php echo  $backlink['link']['text'];?></a>
                </div>
                <div class="down_backlink">
                    <div class="baklinks-pagerank google-pr">
                        <span class="google"><?php echo $text_pagerank?></span>						
                        <div class="progress">
                            <div class="bar" style="width: <?php echo ($backlink['page_rank']*10);?>%;"></div>
                        </div>
                        <span class="google-scor"><?php echo $backlink['page_rank'];?>/10</span>	
                    </div>
                    <div class=" backlinks-published-info">
                        <span class="backlinks-published-date"><i class="glyphicon glyphicon-time"></i>&nbsp;<?php echo $backlink['published_at'];?></span>
                    </div>
                </div>
            </div>
            <?php }} else { ?>
            <div class='bds bds1'>
                <div class="results_container">
                    <p class="no-results"><?php echo $text_no_results; ?></p>
                </div>
			<?php 
			} ?>
    	
        </div> 
        
        <?php if ($pagination) { ?>
            <div class="searchPag">
            	<ul class="pagination">
					<?php if ($pagination['prev_page']) { ?>
                    <li<?php echo (!empty($pagination['at_first'])?' class="disabled"':'');?>><a href="<?php echo $pagination['prev_page'];?>"><img class="flecha" src="<?php echo $base_url;?>images/flechader.png" alt="<?php echo $text_prev;?>"></a></li>
                    <?php } ?>
                    <?php foreach ($pagination['pages'] as $page_number=>$page_url) {?>
                    <?php if ($page_number==$pagination['current']) { ?>
                    <li><span><?php echo $page_number;?></span></li>
                    <?php } else { ?>
                    <li><a href="<?php echo $page_url;?>"><?php echo $page_number;?></a></li>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($pagination['next_page']) { ?>
                    <li<?php echo (!empty($pagination['at_last'])?' class="disabled"':'');?>><a href="<?php echo $pagination['next_page'];?>"><img class="flecha" src="<?php echo $base_url;?>images/flechaizq.png" alt="<?php echo $text_next;?>"></a></li>
                    <?php } ?>
                </ul>
            </div> 
        <?php }?> 
       
        </div><!-- end of backlinks columns -->
        <div id="categories" class="column br">
            <div class="domainsHeader br">
                <div><?php echo $availables_domains;?>&nbsp;<?php echo $text_webs; ?>&nbsp;<div class="info_circle" data-tip="<?php echo $text_directories_availables_tip; ?>">i</div></div>
            </div>
            <div class="country-filter br">
            	<div class="text_country">Filtro por países:</div>
                <select name="country" id="country" value="<?php echo $current_country; ?>">
                <?php foreach ($countries as $country_code=>$country_name) {?>
                    <option id="<?php echo $country_name;?>"<?php echo (($country_name==$current_country)?' selected':''); ?>><?php echo $country_name;?></option>
                <?php } ?>
                </select>
                <select name="region" id="region"><?php echo $regions;?></select>							
            </div>	
            <div class="categories-menu br">
                <div class="menu-header">
                    <span class="menu-title"><?php echo $text_categories_menu; ?></span>
                </div>
                <div class="menu-list">
                    <div class="categories-list">
                    <?php foreach ($categories as $category_id=>$category) {?>
                        <?php if ($category_id==$current_cat) { ?>
                        <div class="category selected br">
                        	<div class="triang"></div>
                            <div class="cat-selec"><a class="cat-selector" href="<?php echo $category_id;?>"data-cat="<?php echo $category_id;?>"><?php echo $category['name']?></a></div>
                            <?php if (isset($category['subcats'])) { ?>
                            <select size="10" class="br subcat_list inactive">
                                <?php foreach ($category['subcats'] as $subcat_index => $subcat) {?>
                                <option value="<?php echo $subcat_index?>"<?php echo (($subcat_index==$current_subcat)?' selected':'');?>><?php echo $subcat['name'];?></option>
                                <?php } ?>		
                            </select>
                            <?php } ?>
                        </div>
                        <?php } else { ?>
                        <div class="category br">
                        	<div class="triang"></div>
                            <div class="cat-selec"><a class="cat-selector" href="<?php echo $category_id;?>" data-cat="<?php echo $category_id;?>"><?php echo $category['name']?></a></div>								
                            <?php if (isset($category['subcats'])) { ?>
                            <select size="10" class="br subcat_list inactive">
                                <?php foreach ($category['subcats'] as $subcat_index => $subcat) {?>
                                <option value="<?php echo $subcat_index?>"<?php echo (($subcat_index==$current_subcat)?' selected':'');?>><?php echo $subcat['name'];?></option>
                                <?php } ?>		
                            </select>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <div class="d_vertical br">
                <img class="linxgo_bv" src="https://linxgo.com/<?php echo $lang_tag;?>/contents?name=<?php echo $api_key.'_1';?>" />
            </div>
        </div><!-- end of categories column -->
        <div class="thcolumn">
        <div id="enters" class="column br">
        	<a href="<?php echo $companies_url; ?>">
                <div class="company_button br" rel="tooltip" data-tip="<?php echo $text_companies_button_tip;?>">
                    <div class="table_cell pub_btnB"><?php echo $text_companies_button;?> &nbsp;&nbsp; <i class="icon-briefcase"></i></div>
                </div>
            </a>
            <?php foreach ($companies as $index=>$company) {?>
            <div class="company br">
                <div class="company_title"><?php echo $company['name']; ?></div>
                <div class="company_description"><?php echo $company['description']; ?></div>
                <div class="company_link"><a href="<?php echo $company['link']; ?>" target="_blank"><?php echo $company['link_text']; ?></a></div>
            </div>
            <?php } ?>		 
            </div>
           <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/LinxGo"  data-widget-id="448865408045445120">Tweets por @LinxGo</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <div class="fb-like-box" data-href="https://www.facebook.com/Linxgo" data-height="385" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>	
        </div>
        
    </div><!-- end of companies column -->
     
    </div><!-- end of content -->
    <div class="footer">	
        <div class="footerPadding">
            <a href="<?php echo $base_url;?>"><?php echo $text_home;?></a>
            <img src="<?php echo $base_url;?>images/cerc.png"> 
            <a href="mailto:<?php echo $contact;?>"><?php echo $text_contact;?></a>
            <img src="<?php echo $base_url;?>images/cerc.png"> 
            <a href="<?php echo $url_cookies;?>"><?php echo $cookies;?></a>
        </div>
        <div class="footerPaddingRight"><?php echo $copyright;?></div>	
	</div><!-- end of footer -->
    <i id="cookie_info" style="display:none !important;" cookie-info-text="<?php echo $cookie_info_text;?>" data-cookie-close-title="<?php echo $cookie_info_close_title;?>" data-cookie_info_text_link_text="<?php echo $cookie_info_text_link_text?>" data-cookie-info-url="<?php echo $url_cookies;?>"></i><!-- INFO COOKIES -->
    <script type="text/javascript" src="<?php echo $base_url;?>assets/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/jquery.qtip/jquery.qtip.min.js"></script>    
	<script type="text/javascript" src="<?php echo $base_url;?>assets/js/linxgo.min.js"></script>	
	<script type="text/javascript" src="<?php echo $base_url;?>assets/js/app.js"></script> 
    <script>
		
		$("div.triang").click(function(){
			$(this).parent().find(".subcat_list").toggle(300);
		});
		
	</script>
</body>
</html>

