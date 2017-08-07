<?php
if(INCLUDED!==true)exit;

$postnum = 0;
$hl = '';

if(!$site_spesific_config[forum][news_forum_id])output_message('alert','Please define forum id for news (in config.php)');

$alltopics = $DB->select("
    SELECT f_topics.*,f_posts.* 
    FROM f_topics,f_posts 
    WHERE f_topics.forum_id=?d AND f_topics.topic_id=f_posts.topic_id 
    GROUP BY f_topics.topic_id 
    ORDER BY sticky DESC,topic_posted DESC,f_posts.posted  
    LIMIT ?d,?d",$site_spesific_config[forum][news_forum_id],0,$site_spesific_config[news][items_per_page]);

?>
