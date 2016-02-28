<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="skudler-settings" class="wrap">
    <h2>Skudler Settings</h2>

    <div class="form-block">
        <form method="post">
            <?php settings_fields('skudler-group'); ?>
            <?php do_settings_sections('skudler-group'); ?>
            <table class="form-table">
                <h3>API Settings</h3>
                <form method="post">
                    <input type="hidden" name="api" value="1">
                    <input type="hidden" name="api_action" value="checkCredential">
                    <input type="submit" class="button button-primary checkApi" value="Check credentials">
                </form>
                <hr>
                <tr valign="top">
                    <?php if ($apiStatus) { ?>
                        Your credentials are correct
                    <?php } ?>
                </tr>

                <tr valign="top">
                    <th scope="row">API Key</th>
                    <td><input type="text" name="skudler_api_key" value="<?php echo $options['skudler_api_key']; ?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row">API Token</th>
                    <td><input type="text" name="skudler_api_token" value="<?php echo $options['skudler_api_token']; ?>"/></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>

    <div class="form-block">
        <form method="post">
            <?php settings_fields('skudler-group'); ?>
            <?php do_settings_sections('skudler-group'); ?>
            <h3>Information</h3>
            <hr>
            <table class="form-table">

                <tr valign="top">
                    <th scope="row">Enabled the plugin</th>
                    <td>
                        <input type="hidden" name="skudler_enabled" value="0">
                        <input type="checkbox" name="skudler_enabled" <?php if($options['skudler_enabled']) echo ' checked'; ?>>
                    </td>
                </tr>

                <?php if($apiStatus) { ?>

                    <script type="text/javascript">
                        siteId = '<?php echo $options['skudler_site_id'];?>';
                    </script>
                    <?php if(is_array($sites)){ ?>
                        <tr valign="top" id="siteFields">
                            <th scope="row">Site ID</th>
                            <td>
                                <select name="skudler_site_id">
                                    <?php foreach($sites as $site){ ?>
                                        <option value="<?php echo $site->_id;?>"<?php if($options['skudler_site_id'] == $site->_id) echo ' selected'; ?>><?php echo $site->name;?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    <?php } ?>

                    <?php if($events){ ?>

                        <tr id="eventsLocked" style="display: none;">
                            <td colspan="2">You changed the site ID, please save to fetch correct events.</td>
                        </tr>

                        <tbody id="eventsSetting">

                            <tr valign="top" id="registerEnableFields">
                                <th scope="row">Enabled register event</th>
                                <td>
                                    <input type="hidden" name="skudler_register_status" value="0">
                                    <input type="checkbox" name="skudler_register_status" <?php if($options['skudler_register_status']) echo ' checked'; ?>>
                                </td>
                            </tr>

                            <tr valign="top" id="registerEventFields">
                                <th scope="row">Register Event</th>
                                <td>
                                    <select name="skudler_register_event">
                                        <?php foreach($events as $event){ ?>
                                            <option value="<?php echo $event->_id;?>"<?php if($options['skudler_register_event'] == $event->_id) echo ' selected'; ?>><?php echo $event->name;?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr valign="top" id="loginEnableFields">
                                <th scope="row">Enabled login event</th>
                                <td>
                                    <input type="hidden" name="skudler_login_status">
                                    <input type="checkbox" name="skudler_login_status" <?php if($options['skudler_login_status']) echo ' checked'; ?>>
                                </td>
                            </tr>

                            <tr valign="top" id="loginEventFields">
                                <th scope="row">Login Event</th>
                                <td>
                                    <select name="skudler_login_event">
                                        <?php foreach($events as $event){ ?>
                                            <option value="<?php echo $event->_id;?>"<?php if($options['skudler_login_event'] == $event->_id) echo ' selected'; ?>><?php echo $event->name;?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                        </tbody>

                    <?php } ?>
                <?php } ?>

            </table>
            <?php submit_button(); ?>
        </form>
    </div>
</div>