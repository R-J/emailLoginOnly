<?php
$PluginInfo['emailLoginOnly'] = [
    'Name' => 'Email Login Only',
    'Description' => 'Forces users to login with their mail address',
    'Version' => '0.0.1',
    'RequiredApplications' => ['Vanilla' => '>= 2.3'], // TODO: check current Vanilla version
    'SettingsPermission' => 'Garden.Settings.Manage',
    'SettingsUrl' => '/dashboard/settings/emailloginonly',
    // 'RegisterPermissions' => ['emailloginonly.Add'],
    'MobileFriendly' => true,
    'HasLocale' => true,
    'Author' => 'Robin Jurinka',
    'AuthorUrl' => 'https://open.vanillaforums.com/profile/r_j',
    'License' => 'MIT'
];

class EmailLoginOnlyPlugin extends Gdn_Plugin {
    public function setup() {
        saveToConfig('Garden.Registration.EmailUnique', true);
        // Add some code which searches for duplicate mail addresses!
    }

    public function entryController_signIn_handler($sender, $args) {
        Gdn::locale()->setTranslation(
            'Email/Username',
            t('Email')
        );
        if ($sender->Form->isPostBack()) {
            $sender->Form->validateRule('Email', 'ValidateEmail');
        }
    }
}
