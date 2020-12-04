<?php
class Session {
    public static function is_admin() {
    return (isset($_SESSION['projet_user_connected']) && $_SESSION['projet_user_connected']->getAttr('role') == "admin");
    }
}
    
?>