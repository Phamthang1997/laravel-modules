@include('administrator::email.components.header', ['title' =>'Password is changed'])
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
                                        You have password was just changed.</h1>
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
                @include('administrator::email.components.footer')
            </table>
        </td>
    </tr>
</table>
</body>
</html>