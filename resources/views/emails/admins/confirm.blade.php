<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"> <!-- utf-8 works for most cases -->
            <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
                <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
                    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
                        <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

                        <!-- Web Font / @font-face : BEGIN -->
                        <!-- NOTE: If web fonts are not required, lines 9 - 26 can be safely removed. -->

                        <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
                        <!--[if mso]>
                            <style>
                                * {
                                    font-family: sans-serif !important;
                                }
                            </style>
                        <![endif]-->

                        <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
                        <!--[if !mso]><!-->
                        <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
                        <!--<![endif]-->

                        <!-- Web Font / @font-face : END -->

                        <!-- CSS Reset -->
                        <style>

                            /* What it does: Remove spaces around the email design added by some email clients. */
                            /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                            html,
                            body {
                                margin: 0 auto !important;
                                padding: 0 !important;
                                height: 100% !important;
                                width: 100% !important;
                            }

                            /* What it does: Stops email clients resizing small text. */
                            * {
                                -ms-text-size-adjust: 100%;
                                -webkit-text-size-adjust: 100%;
                            }

                            /* What is does: Centers email on Android 4.4 */
                            div[style*="margin: 16px 0"] {
                                margin:0 !important;
                            }

                            /* What it does: Stops Outlook from adding extra spacing to tables. */
                            table,
                            td {
                                mso-table-lspace: 0pt !important;
                                mso-table-rspace: 0pt !important;
                            }

                            /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
                            table {
                                border-spacing: 0 !important;
                                border-collapse: collapse !important;
                                table-layout: fixed !important;
                                margin: 0 auto !important;
                            }
                            table table table {
                                table-layout: auto;
                            }

                            /* What it does: Uses a better rendering method when resizing images in IE. */
                            img {
                                -ms-interpolation-mode:bicubic;
                            }

                            /* What it does: A work-around for iOS meddling in triggered links. */
                            .mobile-link--footer a,
                            a[x-apple-data-detectors] {
                                color:inherit !important;
                                text-decoration: underline !important;
                            }

                        </style>

                        <!-- Progressive Enhancements -->
                        <style>

                            /* What it does: Hover styles for buttons */
                            .button-td,
                            .button-a {
                                transition: all 100ms ease-in;
                            }
                            .button-td:hover,
                            .button-a:hover {
                                background: #555555 !important;
                                border-color: #555555 !important;
                            }

                        </style>

                        </head>
                        <body width="100%" bgcolor="#eee" style="margin: 0;">
                            <center style="width: 100%; background: #eee;">

                                <!-- Visually Hidden Preheader Text : BEGIN -->
                                <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
                                    (Optional) This text will appear in the inbox preview, but not the email body.
                                </div>
                                <!-- Visually Hidden Preheader Text : END -->

                                <!--
                                    Set the email width. Defined in two places:
                                    1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
                                    2. MSO tags for Desktop Windows Outlook enforce a 600px width.
                                -->
                                <div style="max-width: 600px; margin: auto;">
                                    <!--[if mso]>
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
                                    <tr>
                                    <td>
                                    <![endif]-->

                                    <!-- Email Header : BEGIN -->
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td style="padding: 20px 0; text-align: center">
                                                <img src="{{App::make('url')->to('/')}}/assets/global/images/logo.png" width="200" height="50" alt="alt_text" border="0" style="height: auto;  font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- Email Header : END -->

                                    <!-- Email Body : BEGIN -->
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">

                                        <!-- Hero Image, Flush : BEGIN -->
<!--                                        <tr>
                                            <td bgcolor="#ffffff">
                                                <img src="{{App::make('url')->to('/')}}/assets/global/images/header-mail-A.jpg" width="600" height="" alt="alt_text" border="0" align="center" style="width: 100%; max-width: 600px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                            </td>
                                        </tr>-->
                                        <!-- Hero Image, Flush : END -->

                                        <!-- 1 Column Text + Button : BEGIN -->
                                        <tr>
                                            <td bgcolor="#ffffff">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="padding: 20px 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                            <h2 class="collapse" style="margin: 0;padding: 0;color: #0b86e1; text-align:center;">
                                                                Admin Account
                                                            </h2>
                                                            <br><br>

                                                                    <h4>Welcome, {{Request::input('username')}} </h4>
                                                                    <!--                                                                    PhuNations is your destination for party & events organizations . We would like to help bringing happiness to people lifes, celebrate your happy  moments without the hassle of organization . Have access to a number of professional service providers and through a party like never before-->
                                                                    </td>
                                                                    </tr>
                                                                    </table>
                                                                    </td>
                                                                    </tr>
                                                                    <!-- 1 Column Text + Button : BEGIN -->

                                                                    <!-- 2 Even Columns : BEGIN -->
                                                                    <tr>
                                                                        <td bgcolor="#13CF6C" align="center" height="100%" valign="top" width="100%" style="padding:20px 0; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #fff;">
                                                                            <p style="font-size: 17px;">
                                                                                Here is the Account Information {{env("SITE_NAME")}}
                                                                            </p>
                                                                            <table  cellpadding="10" cellspacing="0" >
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td  align="right" >
                                                                                            Email
                                                                                        </td>
                                                                                        <td align="left" >
                                                                                            {{Request::input('email')}}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td  align="right">
                                                                                            Password
                                                                                        </td>
                                                                                        <td align="left"> {{Request::input('password')}} </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- Two Even Columns : END -->

                                                                    <!--  Column Text + Button : link -->
                                                                    <tr>
                                                                        <td bgcolor="#ffffff">
                                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                                <tr>
                                                                                    <td style="padding: 20px 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                                                        <p style="text-align:center;">
                                                                                            Click on the button to login
                                                                                        </p>

                                                                                        <!-- Button : Begin -->
                                                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;">
                                                                                            <tr>
                                                                                                <td style="border-radius: 3px; background: #0b86e1; text-align: center;" class="button-td">
                                                                                                    <a href="{{App::make('url')->to('/')}}/admin" style="background: #0b86e1; border: 15px solid #0b86e1; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff">Login Now</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                    </a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <!-- Button : END -->
                                                                                        <br/>
                                                                                        <br/>

                                                                                        <p style="color: #ccc;">Or you can copy the link below on your browser<br/>
                                                                                            <a href="{{App::make('url')->to('/')}}/admin">{{App::make("url")->to('/')}}/admin</a>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <!--  Column Text + Button : link -->

                                                                    <!-- Clear Spacer : BEGIN -->
                                                                    <tr>
                                                                        <td height="40" style="font-size: 0; line-height: 0;">
                                                                            &nbsp;
                                                                        </td>
                                                                    </tr>
                                                                    <!-- Clear Spacer : END -->

                                                                    <!-- 1 Column Text + Button : BEGIN -->
                                                                    <tr>
                                                                        <td bgcolor="#ffffff">
                                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                                <tr>
                                                                                    <td style="padding: 40px; font-family: sans-serif; font-size: 12px; mso-height-rule: exactly; line-height: 20px; color: #ddd;">
                                                                                        AMIT, Association Of Management and Information Technology, is a rapidly growing company which was established in Egypt from 2011 specialized Computer Science, IT and Engineering related sciences. AMIT is an integration of a group of experienced staff, which provides the work in its ideal shape and meets the highest customer satisfaction
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- 1 Column Text + Button : BEGIN -->

                                                                    </table>
                                                                    <!-- Email Body : END -->

                                                                    <!-- Email Footer : BEGIN -->
                                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;">
                                                                        <tr>
                                                                            <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;">
                                                                                <webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion>
                                                                                <br><br>
                                                                                        Amit-Learning<br><span class="mobile-link--footer">El Salam Tower, Cornish El Maadi, next to El Salam International Hospital، 2nd Floor، Athar an Nabi, Maadi، Cairo Governorate, Egypt</span><br><span class="mobile-link--footer">(123) 456-7890</span>
                                                                                                <br><br>
                                                                                                        <!--<unsubscribe style="color:#888888; text-decoration:underline;">unsubscribe</unsubscribe>-->
                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        </table>
                                                                                                        <!-- Email Footer : END -->

                                                                                                        <!--[if mso]>
                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        </table>
                                                                                                        <![endif]-->
                                                                                                        </div>
                                                                                                        </center>
                                                                                                        </body>
                                                                                                        </html>
