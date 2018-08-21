<?php
namespace block_evaluation_kit_sso\privacy;
 
use core_privacy\local\metadata\collection;
 
class provider implements 
        // This plugin does store personal user data.
        \core_privacy\local\metadata\provider {
 
    public static function get_metadata(collection $collection) : collection {
 
        $collection->add_external_location_link('lti_client', [
            'username' => 'privacy:metadata:lti_client:username',
        ], 'privacy:metadata:lti_client');
 
        return $collection;
    }
}
