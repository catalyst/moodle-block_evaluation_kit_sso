<?php
    require_once('../../config.php');
    require_once('EvalKitOAuthConsumer.php');
    global $CFG, $USER;
    require_login();
    $config = get_config('blocks/evaluation_kit_sso');

    //$accountId = $config->EvalKitaccountid;
    
	$basestring = '';

	$popup = optional_param('isPopup', null, PARAM_INT);
	$cid = optional_param('cid', null, PARAM_INT);
	$pid = optional_param('pid', null, PARAM_INT);
	$roles = optional_param('roles', null, PARAM_TEXT);
		if (is_null($config->EvalKitaccounturl) || is_null($config->EvalKitconsumerkey) || is_null($config->EvalKitsharedsecretkey) 
		|| empty($config->EvalKitaccounturl) || empty($config->EvalKitconsumerkey) || empty($config->EvalKitsharedsecretkey)) 
		{
			// do nothing leave off widget, they can edit in edit mode
		}
		else
		{
			$accounturl = $config->EvalKitaccounturl;
			$consumerkey = $config->EvalKitconsumerkey;
			$sharedsecretkey = $config->EvalKitsharedsecretkey;
	
			try
			{
				$provider = new EvalKitOAuthConsumer($USER->username, $consumerkey, $sharedsecretkey, $accounturl.'/Login/OAuth1', 'GET');
if($cid != null) {
        		$provider->addParameter('evalkit_course_id', $cid);
		}
if($pid != null) {
        		        		$provider->addParameter('evalkit_project_id', $pid);
		}
if($roles != null) {
        		$provider->addParameter("roles", urlencode($roles));
		}
		//32=OAuth Moodle, 33=popup
if ($popup!= null) {
		$provider->addParameter("evalkit_source", "33");
}
else {
		$provider->addParameter("evalkit_source", "32");
}

				$provider->sign();
				$basestring = $provider->getbasestring();
			}
			catch(OAuthException2 $e)
			{
				$ret = '</script><!--EvaluationKIT Error: '.$e.'-->'; // funny tag trickery
				$ret .= '<script>alert("'.$e.'");'; // debug only
			}
		}
		if (empty($basestring)) {
			echo '<p>There was a problem with the setup of the block.</p>';
		}
		else {
			$ekurl = $accounturl.'/Login/OAuth1?'.$basestring;
			header("Location: ".$ekurl);
			die();
		}
