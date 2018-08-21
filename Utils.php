<?php

class EvalKitUtils {

    function isUserStudent($user_id) {
        global $DB;
        if (!empty($_SESSION['ekiamstudent']) && $_SESSION['ekiamstudent'] == 'TRUE') {
            return true;
        }

        $role = $DB->get_record('role', array('shortname' => 'student'));
        if (user_has_role_assignment($user_id, $role->id)) {
            $_SESSION['ekiamstudent'] = 'TRUE';
            return true;
        }
        $SESSION['ekiamstudent'] = 'FALSE';
        return false;
    }
}
