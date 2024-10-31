<?php
/*
 * Plugin Name: Performable Connect
 * Version: 1.4
 * Plugin URI: http://wordpress.org/extend/plugins/performable-connect-wordpress/
 * Description: Adds the necessary JavaScript code to enable <a href="http://www.performable.com/?src=performable-connect-wordpress">Performable Connect</a> Analytics. After enabling this plugin visit <a href="options-general.php?page=performable-connect.php">the options page</a> and enter your Performable code and enable logging.
 * Author: David Cancel
 * Author URI: http://davidcancel.com/
 */

// Constants for enabled/disabled state
define("perf_enabled", "enabled", true);
define("perf_disabled", "disabled", true);

// Defaults, etc.
define("key_perf_status", "perf_status", true);
define("key_perf_admin", "perf_admin_status", true);
define("key_perf_site_id", "perf_site_id", true);
define("key_perf_footer", "perf_footer", true);

define("perf_status_default", perf_disabled, true);
define("perf_admin_default", perf_enabled, true);
define("perf_extra_default", "", true);
define("perf_footer_default", perf_disabled, true);

// Create the default key and status
add_option(key_perf_status, perf_status_default, 'If Performable Connect logging in turned on or off.');
add_option(key_perf_admin, perf_admin_default, 'If WordPress admins are counted in Performable Connect.');
add_option(key_perf_site_id, perf_extra_default, 'Additional Performable Connect tracking options');
add_option(key_perf_footer, perf_footer_default, 'If Performable Connect is outputting in the footer');

// Create a option page for settings
add_action('admin_menu', 'add_perf_option_page');

// Hook in the options page function
function add_perf_option_page() {
    add_options_page('Performable Connect Options', 'Performable Connect', 8, basename(__FILE__), 'perf_options_page');
}

function perf_options_page() {
    // If we are a postback, store the options
    if (isset($_POST['info_update'])) {
        // Update the status
        $perf_status = $_POST[key_perf_status];
        if (($perf_status != perf_enabled) && ($perf_status != perf_disabled))
            $perf_status = perf_status_default;
        update_option(key_perf_status, $perf_status);

        // Update the admin logging
        $perf_admin = $_POST[key_perf_admin];
        if (($perf_admin != perf_enabled) && ($perf_admin != perf_disabled))
            $perf_admin = perf_admin_default;
        update_option(key_perf_admin, $perf_admin);

        // Update the extra tracking code
        $perf_site_id = $_POST[key_perf_site_id];
        update_option(key_perf_site_id, $perf_site_id);

        // Update the footer
        $perf_footer = $_POST[key_perf_footer];
        if (($perf_footer != perf_enabled) && ($perf_footer != perf_disabled))
            $perf_footer = perf_footer_default;
        update_option(key_perf_footer, $perf_footer);

        // Give an updated message
        echo "<div class='updated fade'><p><strong>Performable Connect settings saved.</strong></p></div>";
    }
    // Output the options page
    ?>

        <div class="wrap">
        <form method="post" action="options-general.php?page=performable-connect.php">
        <?php //ga_nonce_field(); ?>
            <h2>Performable Connect Options</h2>
            <h3>Basic Options</h3>
            <?php if (get_option(key_perf_status) == perf_disabled) { ?>
                <div style="margin:10px auto; border:3px #f00 solid; background-color:#fdd; color:#000; padding:10px; text-align:center;">
                Performable Connect integration is currently <strong>DISABLED</strong>.
                </div>
            <?php } ?>
            <table class="form-table" cellspacing="2" cellpadding="5" width="100%">
                <tr>
                    <th width="30%" valign="top" style="padding-top: 10px;">
                        <label for="<?php echo key_perf_status ?>">Performable Connect is:</label>
                    </th>
                    <td>
                        <?php
                        echo "<select name='".key_perf_status."' id='".key_perf_status."'>\n";
                        
                        echo "<option value='".perf_enabled."'";
                        if(get_option(key_perf_status) == perf_enabled)
                            echo " selected='selected'";
                        echo ">Enabled</option>\n";
                        
                        echo "<option value='".perf_disabled."'";
                        if(get_option(key_perf_status) == perf_disabled)
                            echo" selected='selected'";
                        echo ">Disabled</option>\n";
                        
                        echo "</select>\n";
                        ?>
                    </td>
                </tr>
            </table>
            <h3>Advanced Options</h3>
                <table class="form-table" cellspacing="2" cellpadding="5" width="100%">
                <tr>
                    <th width="30%" valign="top" style="padding-top: 10px;">
                        <label for="<?php echo key_perf_admin ?>">WordPress admin logging:</label>
                    </th>
                    <td>
                        <?php
                        echo "<select name='".key_perf_admin."' id='".key_perf_admin."'>\n";
                        
                        echo "<option value='".perf_enabled."'";
                        if(get_option(key_perf_admin) == perf_enabled)
                            echo " selected='selected'";
                        echo ">Enabled</option>\n";
                        
                        echo "<option value='".perf_disabled."'";
                        if(get_option(key_perf_admin) == perf_disabled)
                            echo" selected='selected'";
                        echo ">Disabled</option>\n";
                        
                        echo "</select>\n";
                        ?>
                        <p style="margin: 5px 10px;">Disabling this option will prevent all logged in WordPress admins from showing up on your Performable Connect reports. A WordPress admin is defined as a user with a level 8 or higher. Your user level <?php if ( current_user_can('level_8') ) echo 'is at least 8'; else echo 'is less than 8'; ?>.</p>
                    </td>
                </tr>
                <tr>
                    <th width="30%" valign="top" style="padding-top: 10px;">
                        <label for="<?php echo key_perf_footer ?>">Footer tracking code:</label>
                    </th>
                    <td>
                        <?php
                        echo "<select name='".key_perf_footer."' id='".key_perf_footer."'>\n";
                        
                        echo "<option value='".perf_enabled."'";
                        if(get_option(key_perf_footer) == perf_enabled)
                            echo " selected='selected'";
                        echo ">Enabled</option>\n";
                        
                        echo "<option value='".perf_disabled."'";
                        if(get_option(key_perf_footer) == perf_disabled)
                            echo" selected='selected'";
                        echo ">Disabled</option>\n";
                        
                        echo "</select>\n";
                        ?>
                        <p style="margin: 5px 10px;">Enabling this option will insert the Performable Connect tracking code in your site's footer instead of your header. This will speed up your page loading if turned on. Not all themes support code in the footer, so if you turn this option on, be sure to check the Performable Connect code is still displayed on your site.</p>
                    </td>
                </tr>
                <tr>
                    <th valign="top" style="padding-top: 10px;">
                        <label for="<?php echo key_perf_site_id; ?>">Site ID:</label>
                    </th>
                    <td>
                        <?php
                        echo "<input type='text' name='".key_perf_site_id."' ";
                        echo "id='".key_perf_site_id."' ";
                        echo "value='".stripslashes(get_option(key_perf_site_id))."' />\n";
                        ?>



                        <p style="margin: 5px 10px;">Enter your Performable Site ID.  You can find your <a href="http://www.performable.com/owner/sites/" target="_blank" title="Open Performable site">Performable Site ID  here</a>. A Performable account is required to use this plugin.</p>
                    </td>
                </tr>
                </table>
            <p class="submit">
                <input type='submit' name='info_update' value='Save Changes' />
            </p>
        </div>
        </form>

<?php
}

// Add the script
if (get_option(key_perf_footer) == perf_enabled) {
    add_action('wp_footer', 'add_performable_connect');
} else {
    add_action('wp_head', 'add_performable_connect');
}

// If we can indentify the current user output
function get_performable_connect_identify() {
    global $current_user;
    get_currentuserinfo();
    if ($current_user->user_email) {
        echo "_paq.push([\"identify\", {\n";
        echo "\"email\" : \"".$current_user->user_email."\",\n";
        echo "\"name\" : \"".$current_user->user_login."\",\n";
        echo "\"__id\" : \"".md5($current_user->user_email)."\"\n";
        echo "}]);\n";
    } else {
        // See if current user is a commenter
        $commenter = wp_get_current_commenter();
        if ($commenter['comment_author_email']) {
            echo "_paq.push([\"identify\", {\n";
            echo "\"email\" : \"".$commenter['comment_author_email']."\",\n";
            echo "\"name\" : \"".$commenter['comment_author']."\",\n";
            echo "\"__id\" : \"".md5($commenter['comment_author_email'])."\"\n";
            echo "}]);\n";
        }
    } 
}


// The guts of the Performable Connect script
function add_performable_connect() {
    global $current_user;
    get_currentuserinfo();
    $site_id = stripslashes(get_option(key_perf_site_id));
    
    // If GA is enabled and has a valid key
    if (get_option(key_perf_status) != perf_disabled) {
        
        // Track if admin tracking is enabled or disabled and less than user level 8
        if ((get_option(key_perf_admin) == perf_enabled) || ((get_option(key_perf_admin) == perf_disabled) && ( !current_user_can('level_8') ))) {
            
            // Insert tracker code
            if ( '' != $site_id ) {
                echo "<!-- Start Performable By WP-Plugin: Performable-Connect -->\n";
                echo "<script type=\"text/javascript\">\n";
                echo "var _paq = _paq || [];\n";
                echo "_paq.push([\"setAccount\", \"".$site_id."\"]);\n";

                // Optional
                get_performable_connect_identify();

                echo "_paq.push([\"trackPageView\"]);\n";
                echo "(function() {\n";
                echo "   var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;\n";
                echo "   pa.src = '//analytics.performable.com/pax.js';\n";
                echo "   var s = document.getElementsByTagName('script')[0];\n";
                echo "   s.parentNode.insertBefore(pa, s);\n";
                echo "})();\n";
                echo "</script>\n";
                echo"<!-- end: Performable Connect Code. -->\n";
            }
        }
    }
}

?>