@include('administrator::email.components.header', ['title' =>'Forgot password'])
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0; background-color: #f2f3f8;" leftmargin="0">
<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
    <tr>
        <td>
            <table style="max-width:670px;  margin:0 auto;" width="100%" border="0"
                   align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="{{ route('management.index') }}" title="logo" target="_blank">
                            <img width="60" src="{{ asset('administration/assets/image/spot-illustrations/22_2.png') }}" title="logo" alt="logo">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                               style="max-width:670px; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding:0 35px;">
                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">
                                        You have requested to reset your password</h1>
                                    <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:400px;"></span>
                                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        We cannot simply send you your old password. A unique link to reset your
                                        password has been generated for you. To reset your password, click the
                                        following link and follow the instructions.
                                    </p>
                                    <a href="{{ $url }}"
                                       style="background:#3874ff;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                        Password</a>

                                    <span style="display:inline-block; vertical-align:middle; border-bottom:1px solid #cecece; width:600px; margin: 35px 0 0;"></span>
                                    <p style="color:#455056; font-size:15px;line-height:24px;">
                                        Button not working? Try pasting this URL into your browser:
                                    </p>
                                    <a href="{{ $url }}" rel="noopener" target="_blank" style="text-decoration:none; color: #00A3FF">
                                        {{ $url }}
                                    </a>
                                    <p style="color:#455056; font-size:15px;line-height:24px; margin: 20px 0 0;">
                                        If you have any questions, just reply to this email—we're always happy to help out.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                @include('administrator::email.components.footer')
            </table>
        </td>
    </tr>
</table>
</body>
</html>