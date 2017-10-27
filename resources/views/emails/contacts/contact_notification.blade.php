<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- If you delete this meta tag, Half Life 3 will never be released. -->
        <meta name="viewport" content="width=device-width" />

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>COntact Us Message</title>

        <!--    <link rel="stylesheet" type="text/css" href="stylesheets/email.css" />-->

    </head>

    <body bgcolor="#FFFFFF" style="-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none; width: 100%!important; height: 100%;">
        <style>
            @import url("http://fonts.googleapis.com/earlyaccess/droidarabickufi.css");
            * {
                font-family: 'Droid Arabic Kufi', serif !important;
            }
        </style>
        <!-- HEADER -->
        <table class="head-wrap" bgcolor="#fff" style=" width: 100%;border-bottom: 1px solid #000;">
            <tr>
                <td></td>
                <td class="header container" style="display: block!important;max-width: 600px!important;margin: 0 auto!important;clear: both!important;">

                    <div class="content" style="padding: 15px;max-width: 600px;margin: 0 auto;display: block;">
                        <table bgcolor="#fff">
                            <tr>
                                <td><img width="250px" src="http://52.24.129.149/books-backend/assets/admin/img/logo@2x.png" /></td>

                            </tr>
                            <tr>
                                <td align="right">
                                    <h4 class="collapse" style="margin: 0;padding: 0;color: #2ba6cb;">
                                      Conatct us Message
                                    </h4>
                                </td>
                            </tr>
                        </table>
                    </div>

                </td>
                <td></td>
            </tr>
        </table>
        <!-- /HEADER -->

        <!-- BODY -->
        <table class="body-wrap" style="width: 100%;">
            <tr>
                <td></td>
                <td class="container" bgcolor="#FFFFFF" style="display: block!important;max-width: 600px!important;margin: 0 auto!important; clear: both!important;">

                    <div class="content" style="padding: 15px;max-width: 600px;margin: 0 auto;display: block;">
                        <table>
                            <tr>
                                <td>
                                    <h3>Wellcome, {{Request::input('name')}} </h3>

                                    <p class="lead" style="font-size: 17px;">
                                        The Message Body is:
                                    </p>
                                    <!-- social & contact -->
                                    <table border="1" cellpadding="10" cellspacing="0" width="100%">
                                        <tbody>

                                            <tr>
                                                <td style="padding-left: 10px;" align="left" width="23%">
                                                    Name
                                                </td>
                                                <td align="center" width="54%">
                                                    {{Request::input('name')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 10px;" align="left" width="23%">
                                                    Email
                                                </td>
                                                <td align="center" width="54%">
                                                    {{Request::input('email')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 10px;" align="left" width="23%">
                                                    Phone
                                                </td>
                                                <td align="center" width="54%">
                                                    {{Request::input('phone')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 10px;" align="left" width="23%">
                                                   Title
                                                </td>
                                                <td align="center" width="54%">
                                                    {{Request::input('subject')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 10px;" align="left" width="23%">
                                                    Message
                                                </td>
                                                <td align="center" width="54%">
                                                    {{Request::input('message')}}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!-- /social & contact -->
                                    <br/>
                                    <p>
                                      To Access the Admin Panel click on the link  below
                                    </p>
                                    <p>
                                        <a href="{{App::make('url')->to('/')}}/admin">{{App::make("url")->to('/')}}/admin</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /content -->

                </td>
                <td></td>
            </tr>
        </table>
        <!-- /BODY -->

        <!-- FOOTER -->
        <table class="footer-wrap" style="width: 100%;clear: both!important;background-color: #2ba6cb;">
            <tr>
                <td></td>
                <td class="container" style="display: block!important;max-width: 600px!important;margin: 0 auto!important; clear: both!important;">

                    <!-- content -->
                    <div class="content" style="padding: 15px;max-width: 600px;margin: 0 auto;display: block;">
                        <table>
                            <tr>
                                <td align="center">
                                    <p style="text-align: center;">
                                        <a href="{{App::make('url')->to('/')}}/admin" style="color: #FFFFFF;">{{env("SITE_NAME")}}</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /content -->
                </td>
                <td></td>
            </tr>
        </table>
        <!-- /FOOTER -->
    </body>
</html>
