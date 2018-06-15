<?php

use GisApp\Helpers;

require_once("admin/class.Helpers.php");
require_once("admin/settings.php");
require 'vendor/autoload.php';

function goMobile($lang) {
 ?><!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <!--        <title>Mobile Viewer</title>-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

        <link rel="apple-touch-icon" href="client_mobile/img/app_icon.png"/>
        <link rel="icon" href="favicon.ico" />

        <script type="text/javascript" src="client_common/load.php"></script>

        <!-- jQuery -->
        <script src="client_mobile/lib/jquery/jquery-1.9.1.min.js"></script>

        <!-- jQuery UI for reorder layers -->
        <script src="client_mobile/lib/jquery/jquery-ui-1.9.2.custom.min.js"></script>
        <!-- Download jQuery UI Touch Punch Plugin from http://touchpunch.furf.com -->
        <!-- is used for sortable Lists like the one for Reorder layers -->
        <script src="client_mobile/lib/jquery/jquery.ui.touch-punch.min.js"></script>

        <!-- jQuery Mobile -->
        <script src="client_mobile/lib/jquery/jquery.mobile-1.3.2.min.js"></script>
        <script src="client_mobile/src/jquery.mobile.collapsible.groupcheckbox.js"></script>
        <link rel="stylesheet" href="client_mobile/lib/jquery/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet" href="client_mobile/lib/jquery/jquery-mobile-red-buttons.css" />

        <!-- Proj4js -->
        <script type="text/javascript" src="client_mobile/lib/proj4js/proj4.js"></script>

        <!-- OpenLayers 3 -->
        <script src="client_mobile/lib/ol3/ol.js?v=4.6.5a"></script>
<!--        <script src="client_mobile/lib/ol3/ol-debug.js?v=4.6.5a"></script>-->
        <link rel="stylesheet" href="client_mobile/lib/ol3/ol.css?v=4.6.5" />

        <script type="text/javascript" src="client_mobile/eqwc_mobile_load.php"></script>

        <link rel="stylesheet" type="text/css" href="client_mobile/src/viewer.css?v=20180523" />
        <link rel="stylesheet" type="text/css" href="client_mobile/src/custom.css?v=20180502" />
    </head>
    <body>
    <div data-role="page" id="mappage" data-theme="c">

        <div data-role="content">
            <div id="map">
                <a href="#" id="btnCompass" data-role="button" data-inline="true" data-icon="compass" data-iconpos="notext"></a>
                <a href="#" id="btnLocation" data-role="button" data-inline="true" data-icon="location_off" data-iconpos="notext"></a>
                <a href="#panelSearch" id="btnSearching" data-role="button" data-inline="true" data-icon="searching" data-iconpos="notext"></a>
                <a href="#panelLayer" id="btnLayers" data-role="button" data-inline="true" data-icon="layers" data-iconpos="notext"></a>
                <a href="#panelProperties" id="btnProperties" data-role="button" data-inline="true" data-icon="properties" data-iconpos="notext"></a>
                <a href="#" id="btnInfo" data-role="button" data-icon="loc_info" data-iconpos="notext"></a>
                <a href="#" style="display:none" id="btnAdd" data-role="button" data-icon="add" data-iconpos="notext" data-rel="dialog" class="ui-disabled"></a>
            </div>
            <div id="locationPanel" class="ui-popup-container">Test</div>
        </div>

        <div data-role="panel" id="panelProperties" data-position="right" data-display="overlay">
            <div class="panel-content">
                <div data-role="navbar">
                    <ul>
                        <li><a id="buttonPropertiesMap" href="#panelPropertiesMap">Map</a></li>
                        <li><a id="buttonPropertiesEditor" style="display:none" href="#panelPropertiesEditor">Editor</a></li>
                    </ul>
                </div>
                <div id="panelPropertiesMap">
                    <div id="properties" class="scrollable">
                        <div data-role="fieldcontain">
                            <label for="switchFollow">Kartennachf&uuml;hrung</label>
                            <select id="switchFollow" name="switchFollow" data-role="slider">
                                <option value="off">Aus</option>
                                <option value="on">Ein</option>
                            </select>
                        </div>
                        <div data-role="fieldcontain">
                            <label for="switchOrientation">Kartenausrichtung</label>
                            <select id="switchOrientation" name="switchOrientation" data-role="slider">
                                <option value="off">Aus</option>
                                <option value="on">Ein</option>
                            </select>
                        </div>
                        <div data-role="fieldcontain">
                            <label for="switchScale">Massstabsbalken</label>
                            <select id="switchScale" name="switchScale" data-role="slider">
                                <option value="off">Aus</option>
                                <option value="on">Ein</option>
                            </select>
                        </div>
                        <!--                    <a href="#dlgAbout" id="buttonLogo" class="btn-icon-text" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-icon="logo">Impressum</a>-->

                        <!--                    <div data-role="popup" id="dlgAbout" class="ui-corner-all" data-theme="c" data-overlay-theme="a">-->
                        <!--                        <div data-role="header" data-theme="c" class="ui-corner-top">-->
                        <!--                            <h1>Impressum</h1>-->
                        <!--                        </div>-->
                        <!--                        <div id="aboutContent" data-role="content" data-theme="c" class="ui-corner-bottom ui-content"></div>-->
                        <!--                    </div>-->
                        <!---->
                        <!--                    <div>-->
                        <!--                        <a href="#" id="buttonShare" data-role="button" data-inline="true">Share</a>-->
                        <!--                    </div>-->
                    </div>
                </div>
                <div id="panelPropertiesEditor"></div>
            </div>
        </div>

        <div data-role="panel" id="panelLayer" data-position="left" data-display="overlay">
            <div class="panel-content">
                <div data-role="navbar">
                    <ul>
                        <li><a id="buttonLayerAll" href="#panelLayerAll">Ebenen1</a></li>
                        <li><a id="buttonLayerOrder" href="#panelLayerOrder">Reihenfolge1</a></li>
                        <li><a id="buttonTopics" href="#panelTopics">Project</a></li>
                    </ul>
                </div>
                <div id="panelTopics" class="scrollable">
                    <div id="topicMain"></div>
                    <div>
                        <a href="#" id="buttonSignOut" data-role="button" data-inline="true">Logout</a>
                    </div>
                </div>
                <div id="panelLayerAll" class="scrollable"></div>
                <div id="panelLayerOrder">
                    <div data-role="controlgroup">
                        <ul id="listOrder" data-role="listview" data-inset="true"></ul>
                    </div>
                    <label for="sliderTransparency">Transparenz</label>
                    <input type="range" name="sliderTransparency" id="sliderTransparency" value="0" min="0" max="100"
                           data-highlight="true">
                </div>
            </div>
        </div>

        <div data-role="panel" id="panelFeatureInfo" data-position="left" data-display="overlay">
            <div class="panel-content">
                <b>Informationen</b>
                <div id="featureInfoResults" class="scrollable"></div>
            </div>
        </div>

        <div data-role="panel" id="panelSearch" data-position="right" data-display="overlay">
            <div class="panel-content">
                <b>Adresssuche</b>
                <form id="searchForm" action=".">
                    <input id="searchInput" type="search" name="search" value="">
                </form>
                <div id="searchResults" hidden>
                    <b>Suchresultat</b>
                    <ul id="searchResultsList" data-role="listview" class="scrollable"></ul>
                </div>
            </div>
        </div>

    </div>

    </body>
    </html>


<?php
}

$server_os = php_uname('s');
$def_lang = strtolower(filter_input(INPUT_GET,'lang',FILTER_SANITIZE_STRING));
$mobile = strtolower(filter_input(INPUT_GET,'mobile',FILTER_SANITIZE_STRING));

session_start();

$client_path = Helpers::getClientPath();

if($def_lang>'') {
    $lang_fn = $client_path . 'admin/languages/' . $def_lang . '.js';
    if(!(file_exists($lang_fn))) {
        $def_lang = defined('DEFAULT_LANG') ? DEFAULT_LANG : 'en';
    }
}
else {
    if (isset($_SESSION['lang'])){
        $def_lang = $_SESSION['lang'];
    }
    else {
        $def_lang = defined('DEFAULT_LANG') ? DEFAULT_LANG : 'en';
    }
}

$_SESSION['lang'] = $def_lang;
$_SESSION['client_path'] = $client_path;

$detect = new Mobile_Detect;
// Exclude tablets.
if( $detect->isMobile() && !$detect->isTablet() ){
    $mobile='on';
}

if (Helpers::isValidUserProj(Helpers::getMapFromUrl())) {

    $edit = Helpers::checkModulexist("editing");
    $google = Helpers::loadGoogle();

	//OK open application
    if($mobile=='on') {
        goMobile($def_lang);
    }
    else {
            ?><!DOCTYPE html>
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
                <meta name="apple-mobile-web-app-capable" content="yes">
                <title></title>
                <link rel="stylesheet" type="text/css" href="client/site/libs/ext/resources/css/ext-all-notheme.css"/>
                <link rel="stylesheet" type="text/css" href="client/site/libs/ext/resources/css/xtheme-blue.css"/>
                <link rel="stylesheet" type="text/css" href="client/site/libs/ext/ux/css/ux-all.css?v=20180219"/>
                <link rel="stylesheet" type="text/css" href="client/site/css/TriStateTreeAndCheckbox.css"/>
                <link rel="stylesheet" type="text/css" href="client/site/css/ThemeSwitcherDataView.css"/>
                <link rel="stylesheet" type="text/css" href="client/site/css/popup.css?v=20171108"/>
                <link rel="stylesheet" type="text/css" href="client/site/css/layerOrderTab.css"/>
                <link rel="stylesheet" type="text/css" href="client/site/css/contextMenu.css?v=20180320"/>

                <?php if ($edit) {
                    echo '<link rel="stylesheet" type="text/css" href="plugins/editing/theme/geosilk/geosilk.css?v=20180603"/>';
                }?>

                <script type="text/javascript" src="client_common/load.php"></script>

                <?php if ($google) {
                    $key = (defined('GOOGLE_MAPS_KEY') && GOOGLE_MAPS_KEY != 'your_key') ? '&key='.GOOGLE_MAPS_KEY : null;
                    echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3'.$key.'"></script>';
                }?>

                <script type="text/javascript" src="client/site/libs/ext/adapter/ext/ext-base.js"></script>
                <script type="text/javascript" src="client/site/libs/ext/ext-all.js"></script>
                <script type="text/javascript" src="client/site/libs/ext/ux/ux-all.js?v=20180215"></script>

                <script type="text/javascript" src="client/site/libs/proj4js/proj4js-compressed.js"></script>
                <script type="text/javascript" src="client/site/libs/openlayers/OpenLayers.js?v=20171213"></script>

<!--                FOR DEBUGGING-->
<!--                <script type="text/javascript" src="client/site/libs/openlayers/OpenLayers_debug.js"></script>-->
<!--                <script type="text/javascript" src="../ol2/lib/OpenLayers/Control/LayerSwitcher.js"></script>-->


                <script type="text/javascript" src="client/site/libs/geoext/script/GeoExt.js?v=20160303"></script>
                <!--                DEBUG-->
<!--                <script type="text/javascript" src="../geoext/lib/GeoExt.js"></script>-->

                <script type="text/javascript" src="client/eqwc_load.php"></script>


<!--                DEBUG remove editor.js before-->
<!--                <script type="text/javascript" src="plugins/editing/editor_debug.js"></script>-->

                <style type="text/css">
                    #dpiDetection {
                        height: 1in;
                        left: -100%;
                        position: absolute;
                        top: -100%;
                        width: 1in;
                    }

                    #panel_header_title {
                        float: left;
                        font-size: 20px;
                    }

                    #panel_header_link {
                        float: left;
                    }

                    #panel_header_terms_of_use {
                        float: right;
                        font-weight: normal;
                    }

                    #panel_header_user {
                        float: right;
                        font-weight: bold;
                    }

                    .olTileImage.olImageLoadError {
                        display: none !important;
                    }

                    div.olMap {
                        z-index: 0;
                        padding: 0 !important;
                        margin: 0 !important;
                        cursor: default;
                        -ms-touch-action: none;
                        touch-action: none;
                    }

                </style>
            </head>
            <body>
            <!-- this empty div is used for dpi-detection - do not remove it -->
            <div id="dpiDetection"></div>
            </body>
            </html>
        <?php
        }
}

else {
	//no session, open login panel
	?>
	<!DOCTYPE html>
	<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
		<link rel="stylesheet" type="text/css" href="client/site/libs/ext/resources/css/ext-all.css"/>
		<link rel="stylesheet" type="text/css" href="admin/logindialog/css/overrides.css" />
        <link rel="stylesheet" type="text/css" href="admin/logindialog/css/flags.css" />
        <link rel="stylesheet" type="text/css" href="admin/logindialog/css/virtualkeyboard.css" />
   		
		<script type="text/javascript" src="client/site/libs/ext/adapter/ext/ext-base.js"></script>
		<script type="text/javascript" src="client/site/libs/ext/ext-all.js"></script>
        
		<script type="text/javascript">
			//bind PHP --> JS
			GLOBAL_LANG = '<?php echo $def_lang?>';
		</script>
		
        <script type="text/javascript" src="admin/languages/<?php echo $def_lang?>.js?v=1.1.3"></script>
        <script type="text/javascript" src="admin/languages/_lang.js?v=20150819"></script>
		<script type="text/javascript" src="admin/logindialog/js/overrides.js"></script>

        <script type="text/javascript" src="admin/logindialog/js/virtualkeyboard.js"></script>
        <script type="text/javascript" src="admin/logindialog/js/plugins/virtualkeyboard.js"></script>
        <script type="text/javascript" src="admin/logindialog/js/Ext.ux.Crypto.SHA1.js"></script>
        <script type="text/javascript" src="admin/logindialog/js/Ext.ux.form.IconCombo.js"></script>
		<script type="text/javascript" src="admin/logindialog/js/Ext.ux.form.LoginDialog.js?v=20170313"></script>
		<script type="text/javascript" src="client_common/settings.js"></script>
        <script type="text/javascript" src="admin/logindialog/js/login.js?v=20170313"></script>
				
		</head>
		<body></body>
	</html>
	<?php
}
?>

