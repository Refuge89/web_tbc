<?php

function smarty_block_cache($params, $content, &$smarty, &$repeat)
{
	
	if($content===null)
	{
		if(!isset($smarty->cache)) trigger_error("smarty_block_cache error: \$smarty->cache object not set!", E_USER_ERROR);
		if(!isset($params['file'])) trigger_error("smarty_block_cache error: parameter 'file' not specified!", E_USER_ERROR);
		if(!isset($params['time'])) trigger_error("smarty_block_cache error: parameter 'time' not specified!", E_USER_ERROR);
		
		ob_start();
			$finish = !$smarty->cache->save($params['file'],$params['time']);
		$r = ob_get_contents();
		ob_end_clean();
		
		if($finish)
		{
			$repeat=false;
			echo($r);
		}
	
	}
	else
	{
		echo $content;
		$smarty->cache->save($params['file'],$params['time']);
	}

	return "";

}

?>
