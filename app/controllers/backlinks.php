<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backlinks extends Controller {
	private $api;
	private $_search;
	
	public function index() {
		$this->helper->load('country');
		$this->text_slogan 						= $this->lang->text_slogan;		
		$this->text_home 						= $this->lang->home;
		$this->text_backlinks 					= $this->lang->backlinks;
		$this->text_ads 						= $this->lang->ads;		
		$this->text_sem 						= $this->lang->sem;
		$this->text_customers 					= $this->lang->customers;
		$this->text_afiliates 					= $this->lang->afiliates;
		$this->text_seo 						= $this->lang->seo;
		$this->text_tour 						= $this->lang->tour;
		$this->text_linxgo 						= $this->lang->linxgo;
		$this->text_system 						= $this->lang->system;
		$this->text_search 						= $this->lang->search;
		$this->text_search_place 				= $this->lang->search_place;
		$this->search_header 					= $this->lang->search_header;
		$this->text_next 						= $this->lang->next;
		$this->text_prev 						= $this->lang->prev;
		$this->text_contact 					= $this->lang->contact;
		$this->more_info						= $this->lang->more_info;
		$this->text_categories_menu				= $this->lang->text_categories_menu;		
		$this->text_backlinks_button			= $this->lang->text_backlinks_button;
		$this->text_backlinks_button_tip		= $this->lang->text_backlinks_button_tip;
		$this->text_companies_button			= $this->lang->text_companies_button;				
		$this->text_companies_button_tip		= $this->lang->text_companies_button_tip;		
		$this->text_pagerank					= $this->lang->text_pagerank;	
		$this->text_directories_availables_tip	= $this->lang->text_directories_availables_tip;		
		$this->facebook_url 					= $this->config->facebook_url;
		$this->twitter_url 						= $this->config->twitter_url;
		$this->google_url 						= $this->config->google_url;	
		$this->text_webs						= $this->lang->text_webs;
		$this->text_no_results					= $this->lang->text_no_results;						
		$this->referral_url 					= 'https://linxgo.com?ref='.$this->config->api_config['rcode'];		
		$this->text_article						= $this->lang->article;
		$this->publish_article_url				= $this->lang->publish_article_url;
		$this->cookie_info_text 				= $this->lang->cookie_info_text;
		$this->cookie_info_close_title			= $this->lang->cookie_info_close_title;
		$this->cookie_info_text_link_text		= $this->lang->cookie_info_text_link_text;
		$this->cookies							= $this->lang->cookies;		
		$this->url_cookies 						= base_url().'cookies';
		
		$this->api = new linxgo_api($this->config->api_config);
		$this->api->init();
		$this->_search 				= '';
		$this->target 				= 0;
		$this->page_title			= $this->config->page_title;
		$this->page_description		= $this->config->page_description;
		$this->page_keywords		= $this->config->page_keywords;
		$this->availables_domains 	= $this->api->get_availables_domains();		
		
		$query_search = array();
		
		$this->countries 	= getCountryList();
		$this->countries 	= array_merge(array($this->lang->text_all => $this->lang->text_all ), $this->countries);
		$_countries 		= $this->countries;
		$_current_country = $this->input->post('state');
		if (!$_current_country) {$this->input->get('state');}
		if ($_current_country) 	{
			$this->current_country		= $_current_country;
			if ($_current_country!==$this->lang->text_all) {
				$query_search['country'] 	= $_current_country;
			}
		} else {
			$this->current_country= current($_countries );
		}
		
		$_state_country = $this->input->post('state_country');
		if (!$_state_country) {$this->input->get('state_country');}
		if ($_state_country) 	{
			$this->state_country = $_state_country;
		} else {
			$this->state_country = $this->lang->text_all;
		}		
		$_regions = getCountryRegions($this->current_country);
		$_regions = array_merge(array($this->lang->text_all => $this->lang->text_all ), $_regions);
		$this->regions 		= $this->generate_regions_list($_regions);
		
		$cat_search 		= $this->input->post('cat');
		if (!$cat_search) {$this->input->get('cat');}

		$cat_search 		= $this->input->post('cat');
		if (!$cat_search) {$this->input->get('cat');}

		if ($cat_search) 	{ 
			$this->current_cat	= (int)$cat_search; 
		} 
		else { 
			$this->current_cat= -1; 
		}

		$subcat_search 		= $this->input->post('subcat');
		if (!$subcat_search) {$this->input->get('subcat');}
		
		if ($cat_search) 	{
			$this->current_subcat	= (int)$subcat_search;
		}
		else {
			$this->current_subcat= -1;
		}
		

		$current_search 		=  $this->input->post('s');
		if (!$current_search) 	{ $current_search = $this->input->get('s'); }
		if ($current_search) 	{ $this->_search = $current_search; }
		else 					{ $this->_search = ''; }
		if ($this->input->get('p') && $this->input->get('p')!=='') 	{ $this->current_page = (int)$this->input->get('p'); }
		else 														{ $this->current_page = 1; }		
		$current_page 			= $this->current_page;
		$current_search 		= encode($this->_search);
		if ($current_search!=='') {
			$query_search['text'] = $current_search;
		}
		if ($_current_country!==$this->lang->text_all) {
			$query_search['country'] 	= $_current_country;
		}
		if ($_state_country!==$this->lang->text_all) {
			$query_search['state_country'] 	= $_state_country;
		}

		$this->backlinks		= $this->get_page($current_page, $this->api->get_backlinks($current_page, $query_search));
		$this->companies 		= $this->api->get_companies();
		$this->companies_url 	= $this->lang->publish_company_url;	
		$this->ads_url 			= $this->lang->publish_ad_url;
		$this->backlinks_url 	= $this->lang->publish_backlinks_url;
		$this->action_url 		= base_url().'backlinks';
		$this->search_value 	= $current_search;		
		$this->pagination 		= $this->build_pagination();
		$this->contact 			= $this->config->contact;
		$this->lang_tag			= $this->config->api_config['lang'];
		$this->api_key 			= $this->config->api_config['api_key'];	
		$this->copyright 		= sprintf ($this->lang->copyright, date('Y'), $_SERVER['HTTP_HOST']);
		$this->categories  		= $this->api->get_categories();
		
 		$this->render('backlinks');
	}
	
	private function generate_regions_list($regions_list = array(), $selected ='') {
		if (!$regions_list || count($regions_list)==0) { return '';}
		$html = '';
		foreach ($regions_list as $index=>$region) {
			$html .= '<option value="'.$region.'"';
			$html .= (($region===$selected)?' selected':'');
			$html .= '>'.$region.'</option>'."\n";
		}
		return $html;
	}
	
	private function get_page($current_page, $page_data) {
		$target 		= $this->target;
		$links 			= ((isset($page_data['links']) && $page_data['links'])?$page_data['links']:array());
		$preferences 	= (isset($page_data['preferences'])?$page_data['preferences']:NULL);
		$pagination 	= (isset($backlinks['pagination'])?$page_data['pagination']:0);
		$total_pages 	= $page_data['total_pages'];
		$total_records 	= $page_data['total_records'];
		$page_records 	= $page_data['page_records'];
		if (isset($preferences)) {
			$title_color = $preferences['title_color'];
			$text_color = $preferences['text_color'];
			$background_color = $preferences['background_color'];
			$link_color = $preferences['link_color'];
		} else {
			$title_color 		= '#3f789c';
			$text_color 		= '#000000';
			$background_color 	= '#FFFFFF';
			$link_color 		= '#048526';
		}
		$backlinks=array();
		foreach ($links as $link) {
			$_link_title = array(
					'class'		=> 'title',
					'href'		=> $link['url'],
					'alt'		=> $link['short_url'],
					'title'		=> $link['url'],
					'target' 	=> (($target)?'_blank':'_self'),
				);
			$_link_title_text = array(
				'style' =>  (isset($title_color)?'color:'.$title_color.';':FALSE),
				'text'	=> 	$link['title']
			);
			$_link_description = array(
				'style' 		=> (isset($text_color)?'color:'.$text_color.';':FALSE),
				'description'	=> $link['description'],
				'keywords'		=> $link['keywords']
			);
			$_link_url = array(
				'href'	=> $link['url'],
				'style' => (isset($link_color)?'color:'.$link_color.';':FALSE),
				'text'	=> $link['url']
			);
			$_link_region_info = array(
					'country_code' 	=> strtolower($link['country_code']),
					'country'		=> $link['country']
			);
			$_backlink = array (
				'container_style'	=> (isset($background_color)?'background-color:'.$background_color.';':FALSEs),
				'title'				=> array('link'=>$_link_title, 'text'=>$_link_title_text),
				'description' 		=> $_link_description,
				'link'		  		=> $_link_url,
				'location_info'		=> $_link_region_info,
				'published_at'		=> date('F d, Y', $link['creation_date']),
				'page_rank'			=> $link['page_rank']				
			);
			$backlinks[] = $_backlink;
		}
		$this->total_pages 		= $total_pages;
		$this->total_records 	= $total_records;
		return (count($backlinks)>0)?$backlinks:FALSE;
	}
	
	private function build_pagination() {
		if ($this->total_pages<2) return FALSE;
		$num_links = $this->total_records;
		$total_pages = ceil($num_links/10);
		
		if ($total_pages<2) {
			return FALSE;
		}
		$pagination = array();
		$current_page = $this->current_page;
		$base_pagination_url = base_url().'backlinks';
		
		$pagination['current'] 	= $current_page;
		
		$page = ($current_page < 1)?1:$current_page;
		$limit = 5;
		$num_pages = $total_pages;
		if ($this->search_value !== ''  && $this->search_value) {
			$_extra_query = '&s='.$this->search_value;
		} else {
			$_extra_query = '';
		}
		
		if ($page > 1) {
			$pagination['prev_page'] = $base_pagination_url;
			if (($page - 1)>1) {
				$pagination['prev_page'] = $pagination['prev_page'].'&p='.($page - 1);
			}
		} else {
			$pagination['prev_page'] = FALSE;
		}
		
		$pages = array();
		
		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);
					
				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}
		
				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}
		
			for ($i = $start; $i <= $end; $i++) {
				$pages[$i] = $base_pagination_url;
					$pages[$i] = $base_pagination_url.'?p='.$i.$_extra_query;
			}
		
			if ($page<$end) {
				$pagination['next_page'] = $base_pagination_url.'?p='.($current_page+1).$_extra_query;
			} else {
				$pagination['next_page'] = FALSE;
			}
		}
		
		$pagination['pages'] = $pages;
		
		// calculating the number of block pages		
		if($total_pages > MAX_PAGES_PER_BLOCK) {
			$num_blocks = floor($total_pages / MAX_PAGES_PER_BLOCK);
			if(($total_pages % MAX_PAGES_PER_BLOCK) != 0) {
				$num_blocks += 1;
			}
			
			$pagination['num_blocks'] = $num_blocks;
			
			// calculating current page block location
			$current_page_loc = floor($current_page / MAX_PAGES_PER_BLOCK);
			if(($current_page % MAX_PAGES_PER_BLOCK) != 0) {
				$current_page_loc += 1;
			}
			$pagination['current_page_loc'] = $current_page_loc;
			
			$pagination['current_block_ini'] = (MAX_PAGES_PER_BLOCK * $current_page_loc) - MAX_PAGES_PER_BLOCK + 1;
			$pagination['current_block_end'] = (MAX_PAGES_PER_BLOCK * $current_page_loc);
			
		} else {
			$pagination['num_blocks'] = 1;
			$pagination['current_page_loc'] = 1;
			$pagination['current_block_ini'] = 1;
		}
		// end of block calculations
		
		$pagination['pages'] = array_slice($pagination['pages'], $pagination['current_block_ini']-1, MAX_PAGES_PER_BLOCK, TRUE);
		return $pagination;	
	}
}