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
            <div class="info-container">
		  		<?php echo $content;?>
      		</div>
		</div>
       
        </div><!-- end of bds columns -->
        <div id="categories" class="column br">
            <div class="d_vertical br">
                <img class="linxgo_bv" src="https://linxgo.com/<?php echo $lang_tag;?>/contents?name=<?php echo $api_key.'_1';?>" />
            </div>
            <div class="fb-like-box" data-href="https://www.facebook.com/Linxgo" data-height="385" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
        </div><!-- end of categories column -->
        <div class="thcolumn">
        <div id="enters" class="column br">
        	<a href="<?php echo $companies_url; ?>">
                <div class="company_button br">
                    <div class="table_cell pub_btnB">Publica tu Empresa &nbsp;&nbsp; <i class="icon-briefcase"></i></div>
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
        </div>	
    </div><!-- end of companies column -->
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
    </div><!-- end of content -->
    <i id="cookie_info" style="display:none !important;" cookie-info-text="<?php echo $cookie_info_text;?>" data-cookie-close-title="<?php echo $cookie_info_close_title;?>" data-cookie_info_text_link_text="<?php echo $cookie_info_text_link_text?>" data-cookie-info-url="<?php echo $url_cookies;?>"></i>
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
