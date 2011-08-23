<?php

elgg_register_event_handler('init', 'system', 'socialwiki_init');

function socialwiki_init() {
	// add a site navigation item
	$item = new ElggMenuItem('wikis', 'Wikis', 'socialwiki/wikis/all');
	elgg_register_menu_item('site', $item);
	
	//registering actions
	elgg_register_action("wikis/save", dirname(__FILE__) . "/actions/wikis/save.php");
	elgg_register_action("wikis/delete", dirname(__FILE__) . "/actions/wikis/delete.php");
	elgg_register_action("wikiusers/save", dirname(__FILE__) . "/actions/wikiusers/save.php");
	
	//registering libs
	elgg_register_library('elgg:socialwiki', elgg_get_plugins_path() . 'socialwiki/lib/socialwiki.php');
	elgg_register_library('elgg:wikimate', elgg_get_plugins_path() . 'socialwiki/lib/wikimate/globals.php');
	
	elgg_load_library("elgg:socialwiki");
	elgg_register_plugin_hook_handler('cron', 'minute', 'sw_update_all_changes');
	elgg_register_page_handler('socialwiki', 'socialwiki_page_handler');
} 
 
function socialwiki_page_handler($segments) {

	//wiki management pages
    if ($segments[0] == 'wikis') {
		switch($segments[1]) {
			case 'add':
				include (dirname(__FILE__) . '/pages/wikis/add.php');
				break;
				
			case 'manage':			
				include (dirname(__FILE__) . '/pages/wikis/manage.php');
				break;
				
			case 'all':
				include (dirname(__FILE__) . '/pages/wikis/all.php');				
				break;
			case 'recentchanges':
				$wiki_guid		= $segments[2];
				$wiki_context	= $segments[3];
				$wiki			= get_entity($wiki_guid);
				include (dirname(__FILE__) . '/pages/wikis/recentchanges.php');
				break;
			default: //then we have a wiki name
				$wikiname = $segments[1];
				$type = $segments[2];
				$wikipage = $segments[3];
				$wiki = get_entity($wikiname);					
				
				switch ($type){
					case "view":
						//connecting with MediaWiki API
						$_GET["api"] = $wiki->api;
						$_SERVER['REQUEST_METHOD']="GET";
						include ('wikimate/globals.php');
						$requester = new Wikimate();
						$page = $requester->getPage($wikipage);
						include (dirname(__FILE__) . '/pages/wikis/view.php');				
						break;

					case "edit":
						break;
						
					case "recentchanges":
						$wiki_context = $wikipage;
						include (dirname(__FILE__) . '/pages/wikis/recentchanges.php');			
						break;
				}				
				
				break;
			}
		}
	elseif ($segments[0] == 'wikiusers'){
		include (dirname(__FILE__) . '/pages/wikiusers/add.php');
	}
	
	//view page
	else {
	
	}
	
}

?>
