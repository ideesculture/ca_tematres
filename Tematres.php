<?php
/** ---------------------------------------------------------------------
 * app/lib/core/Plugins/InformationService/Tematres.php :
 * ----------------------------------------------------------------------
 * Tematres InformationService by Gautier Michelin (idéesculture) 2018
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2015 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This source code is free and modifiable under the terms of
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * @package CollectiveAccess
 * @subpackage InformationService
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */

require_once __CA_LIB_DIR__ . "/core/Plugins/IWLPlugInformationService.php";
require_once __CA_LIB_DIR__ . "/core/Plugins/InformationService/BaseInformationServicePlugin.php";

global $g_information_service_settings_Tematres;
$g_information_service_settings_Tematres = array(
    'url' => array(
        'formatType'  => FT_TEXT,
        'displayType' => DT_FIELD,
        'default'     => 'https://ihoes.ideesculture.fr/tematres/vocab',
        'width'       => 90, 'height' => 1,
        'label'       => _t('Tematres service URL'),
        'description' => _t('URL of services.php to the specific vocabulary dir of Tematres. DO NOT include trailing slash index.php or services.php, only base address to the dir containing index.php.'),
    ),
);

class WLPlugInformationServiceTematres Extends BaseInformationServicePlugin Implements IWLPlugInformationService {
    # ------------------------------------------------
    static $s_settings;
    # ------------------------------------------------
    /**
     *
     */
    public function __construct() {
        global $g_information_service_settings_Tematres;

        WLPlugInformationServiceTematres::$s_settings = $g_information_service_settings_Tematres;
        parent::__construct();
        $this->info['NAME'] = 'Tematres';

        $this->description = _t('Provides access to Tematres');
    }
    # ------------------------------------------------
    /**
     * Get all settings settings defined by this plugin as an array
     *
     * @return array
     */
    public function getAvailableSettings() {
        return WLPlugInformationServiceTematres::$s_settings;
    }
    # ------------------------------------------------
    # Data
    # ------------------------------------------------
    /**
     * Perform lookup on Tematres-based data service
     *
     * @param array $pa_settings Plugin settings values
     * @param string $ps_search The expression with which to query the remote data service
     * @param array $pa_options Lookup options (none defined yet)
     * @return array
     */
    public function lookup($pa_settings, $ps_search, $pa_options = null) {

        // support passing full tematres URLs
        //if(isURL($ps_search)) { $ps_search = self::getPageTitleFromURI($ps_search); }
        $vs_url = caGetOption('url', $pa_settings, 'https://ihoes.ideesculture.fr/tematres/vocab');

        // readable version of get parameters
        $va_get_params = array(
            'task'   => 'search', // use search service as generator for page service
            'arg'    => urlencode($ps_search),
            'output' => 'json',
        );

        $vs_content = caQueryExternalWebservice(
            $vs_url = $vs_url . "/services.php/?" . caConcatGetParams($va_get_params)
        );

        $va_content = @json_decode($vs_content, true);
        if (!is_array($va_content) || !isset($va_content['result']) || !is_array($va_content['result']) || !sizeof($va_content['result'])) {return array();}

        // the top two levels are 'result' and 'resume'
        $va_results = $va_content['result'];
        $va_return  = array();

        foreach ($va_results as $va_result) {
            $va_return['results'][] = array(
                'label' => $va_result['term_id'] . " – " . $va_result['string'],
                'url'   => $vs_url . "/index.php?tema=" . $va_result['term_id'],
                'idno'  => $va_result['term_id'] * 1,
            );
        }

        return $va_return;
    }
    # ------------------------------------------------
    /**
     * Fetch details about a specific item from a Iconclass-based data service for "more info" panel
     *
     * @param array $pa_settings Plugin settings values
     * @param string $ps_url The URL originally returned by the data service uniquely identifying the item
     * @return array An array of data from the data server defining the item.
     */
    public function getExtendedInformation($pa_settings, $ps_url) {
        $vs_display = "<p><a href='$ps_url' target='_blank'>$ps_url</a></p>";

        return array('display' => $vs_display);
    }
}
