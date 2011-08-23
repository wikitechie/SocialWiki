<?php

	$icon = elgg_view_entity_icon($vars['entity'], 'medium');
	
	$metadata = elgg_view_menu('entity', array(
		'entity' => $vars['entity'],
		'handler' => 'groups',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
	
	$params = array(
		'entity' => $vars['entity'],
		'metadata' => $metadata,
		'content' => $vars['entity']->description
	);
	$list_body = elgg_view('object/elements/summary', $params);
	echo elgg_view_image_block($icon, $list_body);

	//we need to merge these items into the metadata above!
    /*
    echo elgg_view('output/url', array('text' => 'visit this wiki', 'href'=>$vars['entity']->url)); 	echo "<br>";
	
	$site = get_entity($vars['entity']->site_guid);
	echo elgg_view('output/url', array('text' => 'permalink', 'href'=>$vars['entity']->getURL())); 	echo "<br>";
    echo elgg_view('output/url', array('text' => 'manage this wiki', 'href'=>$site->url."socialwiki/wikis/manage/".$vars['entity']->guid)); echo "<br>";     
    echo elgg_view('output/url', array('text' => 'social view', 'href'=>$site->url."socialwiki/wikis/".($vars['entity']->guid)."/view/الصفحة الرئيسية", 'encode_text'=>true)); echo "<br>";
    echo elgg_view('output/url', array('text' => 'recent changes', 'href'=>$site->url."socialwiki/wikis/".($vars['entity']->guid)."/recentchanges", 'encode_text'=>true)); echo "<br>";*/
    ?>