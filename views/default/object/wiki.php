<?php      echo elgg_view_title($vars['entity']->title);     echo elgg_view('output/longtext', array('value' => $vars['entity']->description));    echo elgg_view('output/url', array('text' => 'visit this wiki', 'href'=>$vars['entity']->url)); 	echo "<br>";		$site = get_entity($vars['entity']->site_guid);	echo elgg_view('output/url', array('text' => 'permalink', 'href'=>$vars['entity']->wikiurl)); 	echo "<br>";    echo elgg_view('output/url', array('text' => 'manage this wiki', 'href'=>$site->url."socialwiki/wikis/manage/".$vars['entity']->guid));     ?>