<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- If you delete this meta tag, Half Life 3 will never be released. -->
        <meta name="viewport" content="width=device-width" />

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>
            تم رفض كتاب
        </title>

        <!--    <link rel="stylesheet" type="text/css" href="stylesheets/email.css" />-->

    </head>

    <body bgcolor="#FFFFFF" style="direction: rtl; -webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none; width: 100%!important; height: 100%;">
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
                                <td><img width="250px" src="{{App::make("url")->to('/')}}/assets/admin/img/logo@2x.png" /></td>

                            </tr>
                            <tr>
                                <td align="right">
                                    <h4 class="collapse" style="margin: 0;padding: 0;color: #2ba6cb;">
                                        تم رفض كتاب
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
                                    <p class="lead" style="font-size: 17px;">
                                        لقد تم رفض كتاب بعنوان
                                        ({{$title}})
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if(@Request::input('message')):
                                    <p class="lead" style="font-size: 17px;">
                                        Reason: 
                                        ({{Request::input('message')}})
                                    </p>
                                    @endif
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
                                        <a href="{{App::make("url")->to('/')}}" style="color: #FFFFFF;">{{env("SITE_NAME")}}</a>
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
