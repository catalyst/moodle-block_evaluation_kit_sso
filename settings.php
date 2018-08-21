<?php
if ($ADMIN->fulltree) {
    $config = get_config('blocks/evaluation_kit_sso');

    $configs = array();
    $configs[] = new admin_setting_configtext('EvalKitaccounturl', 'EvaluationKIT Account URL', '', '', PARAM_TEXT);
    $configs[] = new admin_setting_configtext('EvalKitconsumerkey', 'Consumer Key', '', '', PARAM_TEXT);
    $configs[] = new admin_setting_configtext('EvalKitsharedsecretkey', 'Shared Secret Key', '', '', PARAM_TEXT);

    foreach ($configs as $config) {
        $config->plugin = 'blocks/evaluation_kit_sso';
        $settings->add($config);
    }
}

?>