<?php ?>
<!DOCTYPE html>
<html>
<!--
 // --------------------------------------------------------------------
 // For more information about Application Cache, read the following
 // article below:
 // http://www.html5rocks.com/en/tutorials/appcache/beginner/
 // --------------------------------------------------------------------
-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport"
  content="width=device-width, initial-scale=1.0, maximum-scale=1.0:, user-scalable=no">
<!--
Apple-Specific Meta Tag Keys
https://developer.apple.com/library/safari/documentation/AppleApplications/Reference/SafariHTMLRef/Articles/MetaTags.html#//apple_ref/doc/uid/TP40008193-SW2
minimal-ui
-->
<!-- // Safari iOS apps only -->
<!-- Sets whether a web application runs in full-screen mode -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Sets the style of the status bar for a web application -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<!-- // Chrome for Android -->
<meta name="mobile-web-app-capable" content="yes">
<title>Citizen Request</title>
<link rel="stylesheet" href="//code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css" />
<link rel="stylesheet" href="//js.arcgis.com/3.12compact/dijit/themes/claro/claro.css" />
<link rel="stylesheet" href="//js.arcgis.com/3.12compact/esri/css/esri.css" />
<style>
  /*
   * --------------------------------------------------------------------
   * The code within this style block would ideally go into an external
   * stylesheet such as:
   * <link rel="stylesheet" href="./css/app.css" />
   * --------------------------------------------------------------------
   */
  html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
  }

  #ui-map-page, #ui-map-content, #ui-map {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
  }

  #ui-settings-page {
    width: 100%;
    height: 100%;
    padding: 0;
  }

  #ui-settings-content {
    margin: 1.25em;
  }

  .esriSimpleSlider div {
    width: 1.125em;
    height: 1.125em;
    font-size: 1.875em;
    line-height: 0.9375em;
  }

  .esriSimpleSliderHorizontal.esriSimpleSliderBR {
    right: 0.3125em;
    bottom: 1.625em;
  }

  @media screen and (min-width: 768px) {
    .esriSimpleSliderHorizontal.esriSimpleSliderBR {
      bottom: 2.875em;
    }
  }

  .simpleGeocoder .esriGeocoderContainer {
    top: 1.25em;
    left: 0.625em;
    right: 0.625em;
    position: absolute;
    height: 3.75em;
    width: auto;
    font-size: 1em;
    line-height: 1.25em;
    z-index: 3;
  }

  @media (min-device-width: 22.5625em) {
    .simpleGeocoder .esriGeocoderContainer {
      width: 22.5em;
    }
  }

  @media screen and (min-width: 768px) {
    .simpleGeocoder .esriGeocoderContainer {
      margin: 0 auto;
    }
  }

  .simpleGeocoder .esriGeocoderIcon {
    width: 1.5em;
    height: 1.5em;
    margin-top: 0.375em;
    margin-bottom: 0;
  }

  .simpleGeocoder .esriGeocoder {
    background: #FFFFFF;
  }

  .simpleGeocoder .esriGeocoder:hover {
    background: #EEEEEE;
  }

  .simpleGeocoder .esriGeocoder input {
    font-family: HelveticaNeue-Light, Roboto, Helvetica, san-serif;
    line-height: 22px;
    font-size: 1.1875em;
    width: 10.3125em;
  }

  .simpleGeocoder .esriGeocoder .esriGeocoderSearch {
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2017.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%3Csvg%20version%3D%221.1%22%20id%3D%22normal%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%22-3%20-3%2020%2020%22%20enable-background%3D%22new%20-3%20-3%2020%2020%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cpath%20fill%3D%22%2357585A%22%20d%3D%22M10.7%2C9.1c0.7-1%2C1.1-2.3%2C1.1-3.6C11.8%2C1.9%2C9-1%2C5.4-1S-1%2C1.9-1%2C5.4s2.9%2C6.4%2C6.4%2C6.4c1.3%2C0%2C2.6-0.4%2C3.6-1.1%0A%09l4.3%2C4.3l1.7-1.6L10.7%2C9.1z%20M5.4%2C9.5c-2.3%2C0-4.1-1.8-4.1-4.1s1.8-4.1%2C4.1-4.1s4.1%2C1.8%2C4.1%2C4.1C9.5%2C7.7%2C7.7%2C9.5%2C5.4%2C9.5z%22%2F%3E%0A%3C%2Fsvg%3E%0A");
  }

  .simpleGeocoder .esriGeocoderHasValue .esriGeocoderReset {
    background: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2017.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%22-3%20-3%2020%2020%22%20enable-background%3D%22new%20-3%20-3%2020%2020%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cpolygon%20fill%3D%22%2357585A%22%20points%3D%2214%2C3%2011%2C0%207%2C4%203%2C0%200%2C3%204%2C7%200%2C11%203%2C14%207%2C10%2011%2C14%2014%2C11%2010%2C7%20%22%2F%3E%0A%3C%2Fsvg%3E%0A");
  }

  .LocateButton .zoomLocateButton {
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2017.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%22-3%20-3%2020%2020%22%20enable-background%3D%22new%20-3%20-3%2020%2020%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cpath%20fill%3D%22%2357585A%22%20d%3D%22M7-3C3.8-3%2C1.3-0.4%2C1.3%2C2.7C1.3%2C5.6%2C7%2C17%2C7%2C17s5.7-11.4%2C5.7-14.3C12.7-0.4%2C10.2-3%2C7-3z%20M7%2C5.6%0A%09c-1.6%2C0-2.9-1.3-2.9-2.9S5.4-0.1%2C7-0.1s2.9%2C1.3%2C2.9%2C2.9S8.6%2C5.6%2C7%2C5.6z%22%2F%3E%0A%3C%2Fsvg%3E%0A");
    background-size: 1.5625em;
    position: absolute;
    right: 0.3125em;
    bottom: 4.0625em;
    z-index: 3;
    background-color: #FFFFFF;
    border: 1px solid #57585A;
  }

  @media screen and (min-width: 768px) {
    .LocateButton .zoomLocateButton {
      bottom: 5.3125em;
    }
  }

  .LocateButton .zoomLocateButton:hover {
    background-size: 1.5625em;
    background-color: #EEEEEE;
    color: #4C4C4C;
  }

  .LocateButton .tracking {
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2017.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%22-3%20-3%2020%2020%22%20enable-background%3D%22new%20-3%20-3%2020%2020%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cg%20id%3D%22normal%22%20display%3D%22none%22%3E%0A%09%3Cpath%20display%3D%22inline%22%20fill%3D%22%2357585A%22%20d%3D%22M7-3C3.8-3%2C1.3-0.4%2C1.3%2C2.7C1.3%2C5.6%2C7%2C17%2C7%2C17s5.7-11.4%2C5.7-14.3C12.7-0.4%2C10.2-3%2C7-3z%0A%09%09%20M7%2C5.6c-1.6%2C0-2.9-1.3-2.9-2.9S5.4-0.1%2C7-0.1s2.9%2C1.3%2C2.9%2C2.9S8.6%2C5.6%2C7%2C5.6z%22%2F%3E%0A%3C%2Fg%3E%0A%3Cg%20id%3D%22hover%22%3E%0A%09%3Cpath%20fill%3D%22%23FFFFFF%22%20d%3D%22M7-3C3.8-3%2C1.3-0.4%2C1.3%2C2.7C1.3%2C5.6%2C7%2C17%2C7%2C17s5.7-11.4%2C5.7-14.3C12.7-0.4%2C10.2-3%2C7-3z%20M7%2C5.6%0A%09%09c-1.6%2C0-2.9-1.3-2.9-2.9S5.4-0.1%2C7-0.1s2.9%2C1.3%2C2.9%2C2.9S8.6%2C5.6%2C7%2C5.6z%22%2F%3E%0A%3C%2Fg%3E%0A%3C%2Fsvg%3E%0A");
    background-size: 1.5625em;
    background-color: #EEEEEE;
  }

  #ui-settings-button {
    z-index: 3;
    right: -15px;
    width: 1.875em;
    height: 1.875em;
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    padding: 0.125em;
    background-size: 1.5625em;
    background-repeat: no-repeat;
    background-position: center;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2017.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%220.04257%20-0.00098%2018%2016.95918%22%20enable-background%3D%22new%200.04257%20-0.00098%2018%2016.95918%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cpath%20id%3D%22normal%22%20fill%3D%22%2357585A%22%20d%3D%22M2.16709%2C3.20293h13.64494c0.59759%2C0%2C1.09558-0.49799%2C1.09558-1.09558%0A%09s-0.49799-1.09558-1.09558-1.09558H2.16709C1.5695%2C0.91217%2C1.07151%2C1.41016%2C1.07151%2C2.00775S1.5695%2C3.20293%2C2.16709%2C3.20293z%0A%09%20M15.91162%2C5.32674H2.16709c-0.59759%2C0-1.09558%2C0.49799-1.09558%2C1.09558S1.5695%2C7.5179%2C2.16709%2C7.5179h13.64494%0A%09c0.69719%2C0%2C1.19518-0.49799%2C1.19518-1.09558S16.50921%2C5.32674%2C15.91162%2C5.32674z%20M15.91162%2C9.57493H2.16709%0A%09c-0.59759%2C0-1.09558%2C0.49799-1.09558%2C1.09558c0%2C0.59759%2C0.49799%2C1.09558%2C1.09558%2C1.09558h13.64494%0A%09c0.59759%2C0%2C1.09558-0.49799%2C1.09558-1.09558C17.0072%2C10.07293%2C16.50921%2C9.57493%2C15.91162%2C9.57493z%20M15.94501%2C13.80961H2.20047%0A%09c-0.59759%2C0-1.09558%2C0.49799-1.09558%2C1.09558c0%2C0.59759%2C0.49799%2C1.09558%2C1.09558%2C1.09558h13.64494%0A%09c0.59759%2C0%2C1.09558-0.49799%2C1.09558-1.09558C17.04059%2C14.3076%2C16.5426%2C13.80961%2C15.94501%2C13.80961z%22%2F%3E%0A%3Cg%20id%3D%22hover%22%20display%3D%22none%22%3E%0A%09%3Cpath%20display%3D%22inline%22%20fill%3D%22%23FFFFFF%22%20d%3D%22M0.1%2C3.6h13.7c0.6%2C0%2C1.1-0.5%2C1.1-1.1s-0.5-1.1-1.1-1.1H0.1C-0.5%2C1.3-1%2C1.8-1%2C2.4%0A%09%09S-0.5%2C3.6%2C0.1%2C3.6z%20M13.9%2C5.9H0.1C-0.5%2C5.9-1%2C6.4-1%2C7s0.5%2C1.1%2C1.1%2C1.1h13.7C14.5%2C8.1%2C15%2C7.6%2C15%2C7S14.5%2C5.9%2C13.9%2C5.9z%20M13.9%2C10.4%0A%09%09H0.1c-0.6%2C0-1.1%2C0.5-1.1%2C1.1s0.5%2C1.1%2C1.1%2C1.1h13.7c0.6%2C0%2C1.1-0.5%2C1.1-1.1C15%2C10.9%2C14.5%2C10.4%2C13.9%2C10.4z%22%2F%3E%0A%3C%2Fg%3E%0A%3C%2Fsvg%3E%0A");
    background-color: #FFFFFF;
    border: 1px solid #57585A;
    border-radius: 0.3125em;
  }

  #ui-settings-button:hover {
    background-color: #EEEEEE;
    color: #4C4C4C;
  }

  .basemapOption:last-child {
    padding-bottom: 1.25em;
  }

  .basemapOptionSelected {
    background-color: #333333;
    color: #f6f6f6;
  }

  .basemapOptionNormal {
    background-color: #f6f6f6;
    color: #333333;
  }

  #ui-feature-templates-button {
    position: absolute;
    bottom: 6.0625em;
    right: 0.3125em;
    width: 1.875em;
    height: 1.875em;
    padding: 0.125em;
    z-index: 3;
    background-color: #FFFFFF;
    border: solid #57585A 0.0625em;
    border-radius: 5px;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2017.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%220%200%2014%2014%22%20enable-background%3D%22new%200%200%2014%2014%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cpath%20fill%3D%22%2357585A%22%20d%3D%22M1%2C10l-1%2C4l4-1l7-7L8%2C3L1%2C10z%20M11%2C0L9%2C2l3%2C3l2-2L11%2C0z%22%2F%3E%0A%3C%2Fsvg%3E%0A");
    background-size: 1.375em;
    background-position: center;
    background-repeat: no-repeat;
  }

  @media screen and (min-width: 768px) {
    #ui-feature-templates-button {
      bottom: 7.3125em;
    }
  }

  #ui-feature-templates-button:hover {
    background-repeat: no-repeat;
    width: 1.875em;
    height: 1.875em;
    background-size: 1.375em;
  }

  #ui-feature-templates-button:hover {
    background-color: #EEEEEE;
  }

  #ui-features-panel .ui-li-divider {
    padding-bottom: 0.5em;
  }

  #ui-features-panel ul {
    padding: 0.3125em 0.3125em;
  }

  #ui-features-panel li {
    padding: 0.3125em;
  }

  #inner-editor {
    width: 12.5em;
  }

  .esriAttributeInspector .atiLabel {
    padding-right: 0;
  }

  .esriAttributeInspector .dijitTextBox {
    border: solid #57585A 0.0625em;
    border-radius: 0.3125em;
    width: 13.75em;
  }

  .esriAttributeInspector textarea {
    background: transparent none;
  }

  .esriAttributeInspector .dijitButtonNode {
    border: 0.3125em solid #57585A;
  }

  .esriAttributeInspector .dijitButtonNode .ui-input-text {
    border-style: none;
  }

  .esriAttributeInspector .dijitButtonNode .dijitArrowButtonInner {
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22iso-8859-1%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2016.0.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20width%3D%2214px%22%20height%3D%2214px%22%20viewBox%3D%220%200%2014%2014%22%20style%3D%22enable-background%3Anew%200%200%2014%2014%3B%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cpolygon%20points%3D%2211.949%2C3.404%207%2C8.354%202.05%2C3.404%20-0.071%2C5.525%207%2C12.596%2014.07%2C5.525%20%22%2F%3E%0A%3C%2Fsvg%3E%0A");
    width: 1.875em;
  }

  .esriAttributeInspector .dijitArrowButtonContainer {
    padding: 0.125em;
  }

  .dijitInputContainer .ui-input-text {
    margin: 0 0.3125em;
    border-style: none;
  }

  .dijitInputContainer .dijitInputInner {
    padding-left: 0.3125em;
  }

  .dijitComboBoxMenuPopup .dijitComboBoxMenu {
    border: solid #57585A 0.0625em;
    border-radius: 0.3125em;
  }

  .dijitComboBoxMenu .dijitMenuItem {
    padding: 0.3125em 0.1875em;
  }

  .dijitComboBoxMenu .dijitMenuItemHover {
    color: #FFFFFF;
    background-color: #57585A;
    text-shadow: none;
  }

  .esriMobileNavigationBar {
    z-index: 3;
    background: #EEEEEE;
  }

  .esriMobileNavigationBar .esriMobileNavigationItem.right {
    padding-right: 0.3125em;
  }

  .esriMobileNavigationBar .esriMobileNavigationItem.right img {
    background-position: center;
    background-repeat: no-repeat;
    background-size: 1.25em;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2018.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%22-298%20390%2014%2014%22%20enable-background%3D%22new%20-298%20390%2014%2014%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cpolygon%20fill%3D%22%2357585A%22%20points%3D%22-289%2C397%20-289%2C390%20-293%2C390%20-293%2C397%20-298%2C397%20-291%2C404%20-284%2C397%20%22%2F%3E%0A%3C%2Fsvg%3E%0A");
  }

  .esriMobileNavigationBar .esriMobileNavigationItem.left {
    padding-left: 0.3125em;
  }

  .esriMobileNavigationBar .esriMobileNavigationItem.left img {
    background-position: center;
    background-repeat: no-repeat;
    background-size: 1.25em;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2018.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%22-298%20390%2014%2014%22%20enable-background%3D%22new%20-298%20390%2014%2014%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cpolygon%20fill%3D%22%2357585A%22%20points%3D%22-284%2C393%20-287%2C390%20-291%2C394%20-295%2C390%20-298%2C393%20-294%2C397%20-298%2C401%20-295%2C404%20-291%2C400%20-287%2C404%20%0A%09-284%2C401%20-288%2C397%20%22%2F%3E%0A%3C%2Fsvg%3E%0A");
  }

  .esriMobileNavigationBar .esriMobileNavigationItem.center {
    text-shadow: none;
    color: #4C4C4C;
  }

  .esriPopupMobile {
    box-shadow: none;
    -webkit-box-shadow: none;
  }

  .esriPopupMobile .titlePane {
    background: none repeat scroll 0 0 #FFFFFF;
    color: #57585A;
    border: 1px solid #57585A;
  }

  .esriPopupMobile .pointer.top {
    top: -11px;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2018.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%220%200%2024%2012%22%20enable-background%3D%22new%200%200%2024%2012%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cg%20id%3D%22pointer-bottom%22%20display%3D%22none%22%3E%0A%09%3Cg%20display%3D%22inline%22%3E%0A%09%09%3Cpolyline%20points%3D%220%2C-0.5%2011.48108%2C11.5%2024%2C-0.5%200%2C-0.5%20%09%09%22%2F%3E%0A%09%3C%2Fg%3E%0A%09%3Cg%20display%3D%22inline%22%3E%0A%09%09%3Cpolyline%20fill%3D%22%23FFFFFF%22%20stroke%3D%22%23333333%22%20stroke-miterlimit%3D%2210%22%20points%3D%220%2C-0.5%2011.48108%2C11.5%2024%2C-0.5%200%2C-0.5%20%09%09%22%2F%3E%0A%09%3C%2Fg%3E%0A%3C%2Fg%3E%0A%3Cg%20id%3D%22pointer-top%22%3E%0A%09%3Cg%3E%0A%09%09%3Cpolyline%20points%3D%2224%2C13.5%2012.51892%2C1.5%200%2C13.5%2024%2C13.5%20%09%09%22%2F%3E%0A%09%3C%2Fg%3E%0A%09%3Cg%3E%0A%09%09%3Cpolyline%20fill%3D%22%23FFFFFF%22%20stroke%3D%22%23333333%22%20stroke-miterlimit%3D%2210%22%20points%3D%2224%2C13.5%2012.51892%2C1.5%200%2C13.5%2024%2C13.5%20%09%09%22%2F%3E%0A%09%3C%2Fg%3E%0A%3C%2Fg%3E%0A%3C%2Fsvg%3E%0A");
  }

  .esriPopupMobile .titleButton.close {
    background-size: 2.1875em;
    background-position: center;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2017.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%220%200%2032%2032%22%20enable-background%3D%22new%200%200%2032%2032%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cg%20id%3D%22close-button%22%3E%0A%09%3Ccircle%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20cx%3D%2215.95833%22%20cy%3D%2215.58333%22%20r%3D%2213.25%22%2F%3E%0A%09%0A%09%09%3Cline%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20x1%3D%229.58333%22%20y1%3D%229.58333%22%20x2%3D%2222.45833%22%20y2%3D%2222.45833%22%2F%3E%0A%09%0A%09%09%3Cline%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20x1%3D%229.58333%22%20y1%3D%2222.45833%22%20x2%3D%2222.45833%22%20y2%3D%229.58333%22%2F%3E%0A%3C%2Fg%3E%0A%3C%2Fsvg%3E%0A");
  }

  .esriPopupMobile .titleButton.arrow {
    background-position: center;
    background-size: 2.1875em;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2018.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%220%200%2032%2032%22%20enable-background%3D%22new%200%200%2032%2032%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cg%20id%3D%22close-button%22%20display%3D%22none%22%3E%0A%09%3Ccircle%20display%3D%22inline%22%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20cx%3D%2216%22%20cy%3D%2215.6%22%20r%3D%2213.2%22%2F%3E%0A%09%0A%09%09%3Cline%20display%3D%22inline%22%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20x1%3D%229.6%22%20y1%3D%229.6%22%20x2%3D%2222.5%22%20y2%3D%2222.5%22%2F%3E%0A%09%0A%09%09%3Cline%20display%3D%22inline%22%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20x1%3D%229.6%22%20y1%3D%2222.5%22%20x2%3D%2222.5%22%20y2%3D%229.6%22%2F%3E%0A%3C%2Fg%3E%0A%3Cg%20id%3D%22arrow-right%22%3E%0A%09%3Ccircle%20display%3D%22none%22%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-miterlimit%3D%2210%22%20cx%3D%2216%22%20cy%3D%2215.6%22%20r%3D%2213.2%22%2F%3E%0A%09%3Cg%3E%0A%09%09%3Cline%20display%3D%22none%22%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-miterlimit%3D%2210%22%20x1%3D%2216%22%20y1%3D%2216%22%20x2%3D%2222.5%22%20y2%3D%2222.5%22%2F%3E%0A%09%09%3Cline%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20x1%3D%2220%22%20y1%3D%2215.5%22%20x2%3D%2212%22%20y2%3D%227.6%22%2F%3E%0A%09%09%3Cline%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20x1%3D%2211.8%22%20y1%3D%2223.5%22%20x2%3D%2220.4%22%20y2%3D%2214.7%22%2F%3E%0A%09%09%3Cline%20display%3D%22none%22%20fill%3D%22none%22%20stroke%3D%22%2357585A%22%20stroke-miterlimit%3D%2210%22%20x1%3D%2222.5%22%20y1%3D%229.6%22%20x2%3D%2216%22%20y2%3D%2216%22%2F%3E%0A%09%3C%2Fg%3E%0A%3C%2Fg%3E%0A%3C%2Fsvg%3E%0A");
  }

  .esriPopupMobile .pointer.bottom {
    bottom: -11px;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22utf-8%22%3F%3E%0A%3C%21--%20Generator%3A%20Adobe%20Illustrator%2018.1.0%2C%20SVG%20Export%20Plug-In%20.%20SVG%20Version%3A%206.00%20Build%200%29%20%20--%3E%0A%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0A%09%20viewBox%3D%220%200%2024%2012%22%20enable-background%3D%22new%200%200%2024%2012%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cg%20id%3D%22pointer-bottom%22%3E%0A%09%3Cg%3E%0A%09%09%3Cpolyline%20points%3D%220%2C-0.5%2011.48108%2C11.5%2024%2C-0.5%200%2C-0.5%20%09%09%22%2F%3E%0A%09%3C%2Fg%3E%0A%09%3Cg%3E%0A%09%09%3Cpolyline%20fill%3D%22%23FFFFFF%22%20stroke%3D%22%23333333%22%20stroke-miterlimit%3D%2210%22%20points%3D%220%2C-0.5%2011.48108%2C11.5%2024%2C-0.5%200%2C-0.5%20%09%09%22%2F%3E%0A%09%3C%2Fg%3E%0A%3C%2Fg%3E%0A%3Cg%20id%3D%22pointer-top%22%20display%3D%22none%22%3E%0A%09%3Cg%20display%3D%22inline%22%3E%0A%09%09%3Cpolyline%20points%3D%2224%2C13%2012.51892%2C1%200%2C13%2024%2C13%20%09%09%22%2F%3E%0A%09%3C%2Fg%3E%0A%09%3Cg%20display%3D%22inline%22%3E%0A%09%09%3Cpolyline%20fill%3D%22%23FFFFFF%22%20stroke%3D%22%23333333%22%20stroke-width%3D%222%22%20stroke-miterlimit%3D%2210%22%20points%3D%2224%2C13%2012.51892%2C1%200%2C13%2024%2C13%20%09%09%22%2F%3E%0A%09%3C%2Fg%3E%0A%3C%2Fg%3E%0A%3C%2Fsvg%3E%0A");
  }

  .esriMobileInfoView .esriMobileInfoViewSection {
    margin: 0.375em;
    padding: 0.375em;
    border: solid 2px #57585A;
    background-color: rgba(255, 255, 255, 0.75);
    -webkit-border-radius: 10px;
    -webkit-box-sizing: border-box;
  }

  .esriMobileInfoViewItem {
    margin: 0px;
    padding-top: 0.5em;
    padding-left: 0.5em;
    color: #262626;
  }

  .infoTemplateContentRowLabel {
    font-weight: bold;
    line-height: 2em;
    vertical-align: middle;
    width: 5em;
    display: inline-block;
  }

  .infoTemplateContentRowItem {
    line-height: 2em;
    padding-left: 0.5em;
    vertical-align: middle;
  }
  
.panelBottom {
    background-color: #000;
    position: absolute;
    width: 100%;
    height: 70px;
    left: 0;
    bottom: 0;
    display: inline;
}

.panelBottom img {
	width:40px;
	height:40px;
}

element.style {
}
.panelNav {
width: 44px;
height: 70px;
float: left;
}

.panelTab {
float: left;
width: 100%;
height: 70px;
overflow: hidden;
text-align: center;
display: block;
}

.panelTitle {
color: #fff;
width: 150px;
height: 70px;
text-align: center;
float: left;
cursor: pointer;
color: #fff;
font-size: 9pt;
}
</style>
</head>
<body>
<!--
// ----------------------------------------------------
// Main page
// ----------------------------------------------------
-->
<div data-role="page" id="ui-map-page" data-theme="a">
  <!-- content -->
  <div id="ui-map-content" data-theme="a">
    <div id="ui-map"></div>
      <div id="ui-dijit-geocoder"></div>
      <div id="ui-dijit-locatebutton"></div>
      <a id="ui-settings-button" href="#ui-settings-panel" class="SettingsButton ui-btn"></a>
      <a id="ui-feature-templates-button" href="#ui-features-panel" data-rel="popup"
        class="ui-btn" data-transition="pop"></a>
    </div>

    <!-- psuedo feature template picker panel -->
    <div data-role="popup" id="ui-features-panel" data-theme="a">
      <ul id="ui-feature-list" data-role="listview" data-inset="true"></ul>
    </div>

    <!-- collector feedback -->
    <div data-role="popup" id="ui-collection-prompt" data-theme="a" class="ui-content"
      data-position-to="#ui-feature-templates-button">
      <p>Click the map to report an incident.</p>
    </div>
    <!-- settings panel -->
    <div data-role="panel" id="ui-settings-panel" data-theme="a" data-position="right" data-display="push"
      data-position-fixed="true">
      <ul data-role="listview">
        <li data-role="list-divider">Map Options</li>
        <li class="basemapOption "><a class="ui-btn ui-btn-icon-custom" data-basemapname="topo">Topographic</a></li>
        <li class="basemapOption"><a class="ui-btn ui-btn-icon-custom" data-basemapname="streets">Streets</a></li>
        <li class="basemapOption"><a class="ui-btn ui-btn-icon-custom" data-basemapname="hybrid">Satellite</a></li>
        <li class="basemapOption"><a class="ui-btn ui-btn-icon-custom" data-basemapname="gray">Gray</a></li>
        <li class="basemapOption"><a class="ui-btn ui-btn-icon-custom" data-basemapname="oceans">Oceans</a></li>
        <li class="basemapOption"><a class="ui-btn ui-btn-icon-custom" data-basemapname="national-geographic">National
          Geographic</a></li>
        <li data-role="list-divider">Other</li>
        <li data-icon="false"><a href="#ui-about-page" class="ui-btn" data-role="button">About</a></li>
        <li data-icon="false"><a href="#ui-feedback-page" class="ui-btn" data-role="button">Feedback</a></li>
        <li data-icon="false"><a href="#" id="ui-home-button" class="ui-btn">Reset map</a></li>
      </ul>
    </div>
</div>



<div id="panelBottom" class="panelBottom">
			
    <!-- Panel Tabs -->
	<div id="panelTab" class="panelTab" style="width: 900px">

	<div id="tab_0" class="panelTitle">
	<img src="http://www.iconexperience.com/_img/m_collection_png/512x512/plain/clock_history.png"><br>Culture &amp; Entertainment
	</div>
	
	<div id="tab_1" class="panelTitle">
	<img src="http://www.iconexperience.com/_img/m_collection_png/512x512/plain/clock_history.png"><br>Neighborhood Development
	</div>
	
	<div id="tab_2" class="panelTitle">
	<img src="http://www.iconexperience.com/_img/m_collection_png/512x512/plain/clock_history.png"><br>Infrastructure &amp; Transportation
	</div>
	
	<div id="tab_3" class="panelTitle">
	<img src="http://www.iconexperience.com/_img/m_collection_png/512x512/plain/clock_history.png"><br>Parks
	</div>
	
	<div id="tab_4" class="panelTitle">
	<img src="http://www.iconexperience.com/_img/m_collection_png/512x512/plain/clock_history.png"><br>Waterfront
	</div>
	
	<div id="tab_5" class="panelTitle">
	<img src="http://www.iconexperience.com/_img/m_collection_png/512x512/plain/clock_history.png"><br>NYC Markets
	</div>
			
</div>
			
			<!-- Panel Logo -->
			<div id="panelLogo" class="panelLogo" style="position: absolute; bottom: 0px; right: 0px">
				<img src="images/logo.png" alt="">
			</div>
				
		</div>

<!-- psuedo attribute inspector dialog page-->
<div data-role="page" id="ui-attributes-page" data-theme="a">
  <!-- header -->
  <div data-role="header" data-nobackbtn="true">
    <h1>Collect</h1>
  </div>
  <div class="ui-content" data-inset="true">
    <div>
      <div id="currentAddress"></div>
    </div>
  <div id="ui-attributes-container"></div>
    <a href="#ui-map-page" data-role="button">Finish</a>
  </div>
</div>

<!-- about page -->
<div data-role="page" id="ui-about-page" data-theme="a">
  <!-- content -->
  <div class="ui-content" data-theme="a">
    <h2>About this application</h2>
    <div class="ui-body">
      The mobile citizen request sample was designed to showcase
      a simple focused JavaScript mobile application where individuals
      may easily report incidents in their community using just theirweb browser.
    </div>
    <a href="#ui-map-page" data-role="button" class="ui-btn">Close</a>
  </div>
</div>

<!-- Feedback page -->
<div data-role="page" id="ui-feedback-page" data-theme="a">
  <!-- content -->
  <div class="ui-content" data-theme="a">
    <h2>Send Feedback about this application</h2>
    <div class="ui-body">
      <!-- <form action="" method="post" data-transition="none" -->
      <div class="ui-field-contain">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="" required />
      </div>
      <div class="ui-field-contain">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="" required />
      </div>
      <div class="ui-field-contain">
        <label for="comments">Comments:</label>
        <textarea cols="40" rows="8" name="comments" id="comments"></textarea>
      </div>
      <div class="ui-field-contain">
        <label for="contacted">Can we contact you?</label>
        <select name="contacted" id="contacted" data-role="slider">
          <option value="no">No</option>
          <option value="yes">Yes</option>
        </select>
      </div>
      <a href="#ui-map-page" data-role="button" class="ui-btn">Close</a>
      <!-- <input type="submit" value="Send" data-theme="a" -->
      <!-- </form> -->
    </div>
  </div>
</div>
<!--
// --------------------------------------------------------------------
// Load the JavaScript
// --------------------------------------------------------------------
-->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
<script src="//js.arcgis.com/3.12compact/"></script>
<!--
// --------------------------------------------------------------------
//
// The code within this script block would ideally go into an external
// file such as:
// <script src="./js/app.js"></script>
// --------------------------------------------------------------------
-->
<script>
  jQuery.fn.exists = function (){
    return jQuery(this).length > 0;
  };

  // --------------------------------------------------------------------
  // Main function that will be called at the bottom of the page to
  // initialize and start the application lifecycle
  // --------------------------------------------------------------------
  function applicationInitialize(){
    var appGlobals = {
      map: null,
      collectMode: false,
      citizenRequestLayer: null,
      locator: null,
      locatorURL: "//geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer",
      citizenRequestLayerURL: "//sampleserver5.arcgisonline.com/ArcGIS/rest/services/LocalGovernment/CitizenRequests/FeatureServer/0",
      center: [-74.0059, 40.7127]
    };

    $.mobile.pagecontainer({ defaults: true });

    $.mobile.pagecontainer({
      create: function (event, ui){
        // ----------------------------------------------------
        // Invoke function to initialize the code for the
        // ArcGIS API for JavaScript
        // ----------------------------------------------------
        $(".ui-loader").show();
        initializeEsriJS();
      }
    });

    function initializeEsriJS(){
      require([
          "dojo/_base/array",
          "dojo/_base/lang",
          "dojo/dom-construct",
          "dojo/on",
          "dojo/parser",
          "dojo/query!css3",
          "esri/Color",
          "esri/config",
          "esri/dijit/AttributeInspector",
          "esri/dijit/Geocoder",
          "esri/dijit/HomeButton",
          "esri/dijit/LocateButton",
          "esri/dijit/PopupMobile",
          "esri/geometry/webMercatorUtils",
          "esri/graphic",
          "esri/InfoTemplate",
          "esri/layers/FeatureLayer",
          "esri/map",
          "esri/symbols/SimpleLineSymbol",
          "esri/symbols/SimpleMarkerSymbol",
          "esri/tasks/locator",
          "esri/tasks/query", "dojo/domReady!"
        ], function (array, lang, domConstruct, on, parser, query, Color, esriConfig, AttributeInspector, Geocoder,
          HomeButton, LocateButton, PopupMobile, webMercatorUtils, Graphic, InfoTemplate, FeatureLayer, Map,
          SimpleLineSymbol, SimpleMarkerSymbol, Locator, Query){

          parser.parse();
          // ----------------------------------------------------
          // This sample requires a proxy page to handle
          // communications with the ArcGIS Server services. You
          // will need to replace the url below with the location
          // of a proxy on your machine. See the
          // "Using the proxy page" help topic for details on
          // setting up a proxy page.
          // ----------------------------------------------------
          esriConfig.defaults.io.proxyUrl = "/proxy/proxy.php";

          // ----------------------------------------------------
          // Create the symbology for the selected feature,
          // when a Popup opens
          // ----------------------------------------------------
          var slsHighlightSymbol = new SimpleLineSymbol(SimpleLineSymbol.STYLE_SOLID, new Color([38, 38, 38, 0.7]), 2);
          var sms = new SimpleMarkerSymbol();
          sms.setPath("M21.5,21.5h-18v-18h18V21.5z M12.5,3V0 M12.5,25v-3 M25,12.5h-3M3,12.5H0");
          sms.setSize(45);
          sms.setOutline(slsHighlightSymbol);
          var infoWindowPopup = new PopupMobile({markerSymbol: sms}, domConstruct.create("div"));

          // ----------------------------------------------------
          // Dictionary objects to provide domain value lookup for fields in popups
          // ----------------------------------------------------
          var severityFieldDomainCodedValuesDict = {};
          var requestTypeFieldDomainCodedValuesDict = {};

          // ----------------------------------------------------
          // InfoTemplate for the FeatureLayer
          // ----------------------------------------------------
          var featureLayerInfoTemplate = new InfoTemplate();
          featureLayerInfoTemplate.setTitle("<b>Request ${objectid:formatRequestID}</b>");
          var infoTemplateContent = "<span class=\"infoTemplateContentRowLabel\">Date:</span><span class=\"infoTemplateContentRowItem\">${requestdate:DateFormat}</span><br>" +
            "<span class=\"infoTemplateContentRowLabel\">Phone:</span><span class=\"infoTemplateContentRowItem\">${phone:formatPhoneNumber}</span><br>" +
            "<span class=\"infoTemplateContentRowLabel\">Name:</span><span class=\"infoTemplateContentRowItem\">${name}</span><br>" +
            "<span class=\"infoTemplateContentRowLabel\">Severity:</span><span class=\"infoTemplateContentRowItem\">${severity:severityDomainLookup}</span><br>" +
            "<span class=\"infoTemplateContentRowLabel\">Type:</span><span class=\"infoTemplateContentRowItem\">${requesttype:requestTypeDomainLookup}</span><br>" +
            "<span class=\"infoTemplateContentRowLabel\">Comments:</span><span class=\"infoTemplateContentRowItem\">${comment}</span>";
          featureLayerInfoTemplate.setContent(infoTemplateContent);

          // ----------------------------------------------------
          // Formatting functions for infoTemplate
          // ----------------------------------------------------
          severityDomainLookup = function (value, key, data){
            return severityFieldDomainCodedValuesDict[value];
          };
          requestTypeDomainLookup = function (value, key, data){
            return requestTypeFieldDomainCodedValuesDict[value];
          };

          formatRequestID = function (value, key, data){
            var searchText = new String(value);
            var formattedString = searchText.replace(/(\d)(?=(\d\d\d)+(?!\d))/gm, "$1,");
            return formattedString;
          };
          formatPhoneNumber = function (value, key, data){
            return "<a href=\"tel:" + data.phone + "\">" + data.phone + "</a>";
          }

          // ----------------------------------------------------
          // Initialize the main User Interface components
          // ----------------------------------------------------
          appGlobals.map = new Map("ui-map", {
            sliderOrientation: "horizontal",
            sliderPosition: "bottom-right",
            basemap: "topo",
            center: appGlobals.center,
            zoom: 13,
            sliderStyle: "small",
            infoWindow: infoWindowPopup
          });

          appGlobals.locator = new Locator(appGlobals.locatorURL);

          var geocoder = new Geocoder({
            arcgisGeocoder: {
              placeholder: "Search "
            },
            map: appGlobals.map
          }, "ui-dijit-geocoder");

          var geoLocate = new LocateButton({
            map: appGlobals.map
          }, "ui-dijit-locatebutton");

          var homeButton = new HomeButton({
            map: appGlobals.map
          }, "ui-home-button-hidden");

          // ----------------------------------------------------
          // Initialize the FeatureLayer, LayerInfo, and
          // AttributeInspector
          // ----------------------------------------------------
          appGlobals.citizenRequestLayer = new FeatureLayer(appGlobals.citizenRequestLayerURL,
            {mode: FeatureLayer.MODE_ONEDEMAND,
              infoTemplate: featureLayerInfoTemplate,
              outFields: ["*"]
            });

          var layerInfoArray = [
            {
              "featureLayer": appGlobals.citizenRequestLayer,
              "showAttachments": false,
              "showDeleteButton": false,
              "isEditable": true,
              "fieldInfos": [
                {
                  "fieldName": "requesttype",
                  "label": "Type",
                  "isEditable": true
                },
                {
                  "fieldName": "name",
                  "label": "Name",
                  "isEditable": true
                },
                {
                  "fieldName": "phone",
                  "label": "Phone",
                  "isEditable": true
                },
                {
                  "fieldName": "email",
                  "label": "Email",
                  "isEditable": true
                },
                {
                  "fieldName": "comment",
                  "label": "Comments",
                  "isEditable": true,
                  "stringFieldOption": AttributeInspector.STRING_FIELD_OPTION_TEXTAREA
                }
              ]
            }
          ];

          var attributeInspector = new AttributeInspector({
            layerInfos: layerInfoArray
          }, "ui-attributes-container");

          // ----------------------------------------------------
          // Returns the Feature Template given the Coded Value
          // ----------------------------------------------------
          function getFeatureTemplateFromCodedValueByName(item){
            var returnType = null;
            $.each(appGlobals.citizenRequestLayer.types, function (index, type){
              if (type.name === item) {
                returnType = type.templates[0];
              }
            });
            return returnType;
          }

          // ----------------------------------------------------
          // Initializes event handler for map and prepares the
          // FeatureTemplate
          // ----------------------------------------------------
          function addCitizenRequestFeature(item){
            $("#ui-collection-prompt").popup("open");
            var citizenRequestFeatureTemplate = getFeatureTemplateFromCodedValueByName(item);

            var mapClickEventHandler = on(appGlobals.map, "click", function (event){
              //only capture one click
              mapClickEventHandler.remove();
              // set back to false, since the map has been clicked on.
              appGlobals.collectMode = false;

              var currentDate = new Date();
              //  citizenRequestFeatureTemplate.prototype.attributes);
              var newAttributes = lang.mixin({}, citizenRequestFeatureTemplate.prototype.attributes);
              newAttributes.requestdate = Date.UTC(currentDate.getUTCFullYear(), currentDate.getUTCMonth(),
                currentDate.getUTCDate(), currentDate.getUTCHours(), currentDate.getUTCMinutes(),
                currentDate.getUTCSeconds(), 0);
              var newGraphic = new Graphic(event.mapPoint, null, newAttributes);
              // ----------------------------------------------------
              // Creates the new feature in the citizen request
              // FeatureLayer
              // ----------------------------------------------------
              appGlobals.citizenRequestLayer.applyEdits([newGraphic], null, null, function (adds){
                var query = new Query();
                var res = adds[0];
                query.objectIds = [res.objectId];
                // ----------------------------------------------------
                // Query the citizen request FeatureLayer for the
                // Graphic that was just added, well use its geometry
                // to lookup the address at that location
                // ----------------------------------------------------
                appGlobals.citizenRequestLayer.queryFeatures(query, function (result){
                  if (result.features.length > 0) {
                    var currentFeature = result.features[0];
                    var currentFeatureLocation = webMercatorUtils.webMercatorToGeographic(currentFeature.geometry);
                    // ----------------------------------------------------
                    // Convert the feature's location to a real world
                    // address using ArcGIS.com locator service
                    // ----------------------------------------------------
                    appGlobals.locator.locationToAddress(currentFeatureLocation, 100, function (candidate){
                      var address = [];
                      var displayAddress;
                      if (candidate.address) {
                        if (candidate.address.Address) {
                          address.push(candidate.address.Address);
                        }
                        if (candidate.address.City) {
                          address.push(candidate.address.City + ",");
                        }
                        if (candidate.address.Region) {
                          address.push(candidate.address.Region);
                        }
                        if (candidate.address.Postal) {
                          address.push(candidate.address.Postal);
                        }
                        displayAddress = address.join(" ");
                      }
                      else {
                        displayAddress = "No address for this location";
                      }
                      // ----------------------------------------------------
                      // Tell jQuery Mobile to navigate to the page containing
                      // the AttributeInspector
                      // ----------------------------------------------------
                      $.mobile.changePage("#ui-attributes-page", null, true, true);
                      //display the geocoded address on the attribute dialog.
                      $("#currentAddress")[0].textContent = displayAddress;
                    }, function (error){
                      console.warn("Unable to find address, maybe there are no streets at this location",
                        error.details[0]);
                      // ----------------------------------------------------
                      // Tell jQuery Mobile to navigate to the page containing
                      // the AttributeInspector
                      // ----------------------------------------------------
                      $.mobile.changePage("#ui-attributes-page", null, true, true);
                      //display the geocode error on the attribute dialog.
                      $("#currentAddress")[0].textContent = error.details[0];
                    });
                  }
                  else {
                    console.warn("Unable to locate the feature that was just collected.");
                  }
                });
              }, function (error){
                // do some great error catching
                console.error(JSON.stringify(error));
              });
            });

          }

          function layersAddResultEventHandler(event){
            var layersArray = event.layers;

            $.each(layersArray, function (index, value){
              var currentLayer = value.layer;
              if (currentLayer.hasOwnProperty("renderer")) {
                var renderer = currentLayer.renderer;
                if (renderer.hasOwnProperty("infos")) {
                  var infos = renderer.infos;
                  // ----------------------------------------------------
                  // unordered list in parent div ui-features-panel
                  // ----------------------------------------------------
                  $("#ui-feature-list").append("<li data-role=\"list-divider\" class=\"ui-li-divider ui-bar-inherit ui-first-child\">Report an issue</li>");
                  $.each(infos, function (j, info){
                    severityFieldDomainCodedValuesDict[info.value] = info.label;
                    // ----------------------------------------------------
                    // Initialize an event handler for the list item click
                    // ----------------------------------------------------
                    var listItem = $("<li/>").on("click", function (event){
                      appGlobals.map.setMapCursor("pointer");
                      // ----------------------------------------------------
                      // wire the click event to call addCitizenRequestFeature
                      // ----------------------------------------------------
                      addCitizenRequestFeature(info.label);
                      appGlobals.collectMode = true;
                    });
                    listItem.attr("data-theme", "a");
                    var listContent = [];
                    listContent.push("<a href=\"#ui-map-page\" class=\"ui-btn ui-btn-icon-right ui-icon-plus\">" + info.label + "</a>");
                    listItem.append(listContent.join(""));
                    // ----------------------------------------------------
                    // unordered list in parent div ui-features-panel
                    // ----------------------------------------------------
                    $("#ui-feature-list").append(listItem);
                  });
                }
              }
            });
          }

          function initializeEventHandlers(){
            on(appGlobals.map, "load", function (event){
              appGlobals.map.infoWindow.resize(185, 100);
              on(appGlobals.map, "layers-add-result", layersAddResultEventHandler);
            });

            on(appGlobals.citizenRequestLayer, "error", function (event){
              console.error("citizenRequestLayer failed to load.", JSON.stringify(event.error));
              $(".ui-loader").hide();
            });

            on(appGlobals.citizenRequestLayer, "load", function (event){
                var featureLayerTemplates = appGlobals.citizenRequestLayer.templates;
                if (appGlobals.citizenRequestLayer.hasOwnProperty("fields")) {
                  var fieldsArray = appGlobals.citizenRequestLayer.fields;
                  array.forEach(fieldsArray, function (field, i){
                    if (field.name === "severity") {
                      if (field.hasOwnProperty("domain")) {
                        if (field.domain.hasOwnProperty("codedValues")) {
                          var codedValuesArray0 = field.domain.codedValues;
                          array.forEach(codedValuesArray0, function (codedValue){
                            severityFieldDomainCodedValuesDict[codedValue.code] = codedValue.name;

                          });
                        }
                      }
                    }
                    if (field.name === "requesttype") {
                      if (field.hasOwnProperty("domain")) {
                        if (field.domain.hasOwnProperty("codedValues")) {
                          var codedValuesArray1 = field.domain.codedValues;
                          array.forEach(codedValuesArray1, function (codedValue){
                            requestTypeFieldDomainCodedValuesDict[codedValue.code] = codedValue.name;

                          });
                        }
                      }
                    }
                  });
                }
                else {
                  console.error("Unable to find property fields in: ", JSON.stringify(appGlobals.citizenRequestLayer));
                }
                $(".ui-loader").hide();
              }
            );

            on(appGlobals.citizenRequestLayer, "click", function (event){
              appGlobals.map.infoWindow.setFeatures([event.graphic]);
            });

            on(attributeInspector, "attribute-change", function (event){
              var feature = event.feature;
              if (event.fieldName && event.fieldValue) {
                feature.attributes[event.fieldName] = event.fieldValue;
                feature.getLayer().applyEdits(null, [feature], null);
              }
              else {
                feature.getLayer().applyEdits(null, [feature], null);
              }
            });

            on(geoLocate, "locate", function (event){
              var coords = event.position.coords;
            });

            on(infoWindowPopup, "show", function (event){
              if ($("*.esriMobileNavigationItem.left > img[src]").exists()) {
                $("*.esriMobileNavigationItem.left > img").removeAttr("src");
              }
              if ($("*.esriMobileNavigationItem.right > img[src]").exists) {
                $("*.esriMobileNavigationItem.right > img").removeAttr("src");
              }
            });

            geocoder.startup();
            geoLocate.startup();
            homeButton.startup();

            $("#ui-home-button").click(function (){
              homeButton.home();
              $("#ui-settings-panel").panel("close");
            });

            $(".basemapOption").click(swapBasemap);

            $("#ui-features-panel").on("popupafteropen", function (event, ui){
              $("#ui-features-panel").on("popupafterclose", function (event, ui){
                if (appGlobals.collectMode) {
                  $("#ui-collection-prompt").show();
                }
                else {
                  $("#ui-collection-prompt").hide();
                }
                setTimeout(function (){
                  $("#ui-collection-prompt").popup("open");
                }, 15);
              });
            });

            $("#ui-collection-prompt").on("popupafteropen", function (event, ui){
              setTimeout(function (){
                $("#ui-collection-prompt").popup("close");
              }, 1200);
            });
          }

          // ----------------------------------------------------
          // Initialize Event Handlers and add the citizen request
          // layer to the map
          // ----------------------------------------------------
          initializeEventHandlers();
          appGlobals.map.addLayers([appGlobals.citizenRequestLayer]);

        }
      ); // end require / function
    }

    function swapBasemap(event){
      var _basemapName = event.target.dataset.basemapname;
      appGlobals.map.setBasemap(_basemapName);
      $("#ui-settings-panel").panel("close");
    }
  }
  // --------------------------------------------------------------------
  // Begin the sequence by calling the initialization function
  // --------------------------------------------------------------------
  $(function (){
    applicationInitialize();
  });
</script>
</body>
</html>
