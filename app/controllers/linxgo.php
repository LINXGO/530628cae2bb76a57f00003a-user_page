<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Linxgo extends Controller {
	public function index() {
		$this->lang->load('linxgo');
		$this->text_slogan 					= $this->lang->text_slogan;
		$this->text_home 					= $this->lang->home;
		$this->text_backlinks 				= $this->lang->backlinks;
		$this->text_ads 					= $this->lang->ads;		
		$this->text_sem 					= $this->lang->sem;
		$this->text_customers 				= $this->lang->customers;
		$this->text_afiliates 				= $this->lang->afiliates;
		$this->text_seo 					= $this->lang->seo;
		$this->text_tour 					= $this->lang->tour;
		$this->text_linxgo 					= $this->lang->linxgo;
		$this->text_system 					= $this->lang->system;
		$this->text_contact 				= $this->lang->contact;
		$this->more_info					= $this->lang->more_info;
		$this->text_companies_button		= $this->lang->text_companies_button;				
		$this->text_companies_button_tip	= $this->lang->text_companies_button_tip;			
		$this->facebook_url 				= $this->config->facebook_url;
		$this->twitter_url 					= $this->config->twitter_url;
		$this->google_url 					= $this->config->google_url;				
		$this->referral_url 				= 'https://linxgo.com?ref='.$this->config->api_config['rcode'];			
		$this->page_title					= $this->lang->title;
		$this->page_description				= $this->lang->description;
		$this->page_keywords				= $this->lang->keywords;
		$this->content						= $this->lang->content;
		$this->text_article					= $this->lang->article;
		$this->publish_company_url			= $this->lang->publish_company_url;
		$this->publish_article_url			= $this->lang->publish_article_url;
		$this->cookie_info_text 			= $this->lang->cookie_info_text;
		$this->cookie_info_close_title		= $this->lang->cookie_info_close_title;
		$this->cookie_info_text_link_text	= $this->lang->cookie_info_text_link_text;
		$this->cookies						= $this->lang->cookies;		
		$this->url_cookies 					= base_url().'cookies';
		$this->api 					= new linxgo_api($this->config->api_config);
		$this->api->init();
		$this->target 				= 0;			
		$this->contact 				= $this->config->contact;	
		$this->lang_tag				= $this->config->api_config['lang'];	
		$this->api_key 				= $this->config->api_config['api_key'];	
		$this->copyright 			= sprintf ($this->lang->copyright, date('Y'), $_SERVER['HTTP_HOST']);
		$this->companies_url 		= 'https://linxgo.com';
		$this->companies 			= $this->api->get_companies();
		
		$this->render('info');
	}
}