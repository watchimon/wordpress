<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       Author URI
 * @since      1.0.0
 *
 * @package    Watchimon
 * @subpackage Watchimon/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h1>Einstellungen › Watchimon</h1>

    <form method="post" name="cleanup_options" action="options.php">

        <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        // Cleanup
        $project_id = (isset($options['project_id']) ? $options['project_id'] : '');
        $project_secret = (isset($options['project_secret']) ? $options['project_secret'] : '');
        ?>

        <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
        ?>
        <h2 class="title">Basis Konfiguration</h2>
        <p>Um Watchimon nutzen zu können, werden Projektschlüssel und Projektnummer benötigt. Je System kann nur ein Projektschlüssel/-nummer genutzt werden. Diese Daten werden benötigt, um die Anfragen zu verifizieren und dem Konto zuzuordnen.</p>
        <!-- ProjectId -->
        <fieldset>
            <p><?php esc_attr_e('Project Key', $this->plugin_name); ?></p>
            <legend class="screen-reader-text">
                <span>Projektnummer</span>
            </legend>
            <label for="<?php echo $this->plugin_name; ?>-project_id">
                <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-project_id" name="<?php echo $this->plugin_name; ?>[project_id]" value="<?php if(!empty($project_id)) echo $project_id; ?>"/>
            </label>
        </fieldset>

        <!-- ProjectKey -->
        <fieldset>
            <p><?php esc_attr_e('Project secret', $this->plugin_name); ?></p>
            <legend class="screen-reader-text">
                <span>Projektschlüssel</span>
            </legend>
            <label for="<?php echo $this->plugin_name; ?>-project_secret">
                <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-project_secret" name="<?php echo $this->plugin_name; ?>[project_secret]" value="<?php if(!empty($project_secret)) echo $project_secret; ?>"/>
            </label>
        </fieldset>

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>


    </form>

</div>