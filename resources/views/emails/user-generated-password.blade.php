<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Your Account Credentials</title>
    <style>
        @media only screen and (max-width: 620px) {
            table.body h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table.body p,
            table.body ul,
            table.body ol,
            table.body td,
            table.body span,
            table.body a {
                font-size: 16px !important;
            }

            table.body .wrapper,
            table.body .article {
                padding: 10px !important;
            }

            table.body .content {
                padding: 0 !important;
            }

            table.body .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table.body .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table.body .btn table {
                width: 100% !important;
            }

            table.body .btn a {
                width: 100% !important;
            }

            table.body .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }

            .btn-primary table td:hover {
                background-color: #3a76f8 !important;
            }

            .btn-primary a:hover {
                background-color: #3a76f8 !important;
                border-color: #3a76f8 !important;
            }
        }
    </style>
</head>
<body style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Your {{ $tenant ? $tenant->name : 'HospiBill' }} account has been created with temporary access credentials.</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
        <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
            <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
                <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                                            <div style="text-align: center; margin-bottom: 20px;">
                                                <h1 style="color: #3869D4; font-size: 35px; font-weight: bold; margin: 0; margin-bottom: 15px;">Welcome to {{ $tenant ? $tenant->name : 'HospiBill' }}!</h1>
                                                <p style="color: #718096; font-size: 16px; margin-bottom: 30px;">Your account has been created</p>
                                            </div>
                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Hello {{ $user->name }},</p>
                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Your account has been created in the {{ $tenant ? $tenant->name : 'HospiBill' }} system. Below are your temporary credentials to access the system.</p>
                                            
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="credentials" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; margin-bottom: 20px; background-color: #f8fafc; border-radius: 5px; padding: 15px;" width="100%">
                                                <tr>
                                                    <td style="font-family: sans-serif;">
                                                        <h3 style="color: #2d3748; font-size: 18px; font-weight: bold; margin-top: 0;">Your Account Details</h3>
                                                        <p style="margin-top: 5px; margin-bottom: 5px;"><strong style="color: #4a5568;">Email:</strong> {{ $user->email }}</p>
                                                        <p style="margin-top: 5px; margin-bottom: 5px;"><strong style="color: #4a5568;">Temporary Password:</strong> {{ $password }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                            <!-- Domain information -->
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="credentials" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; margin-bottom: 20px; background-color: #eef2ff; border-radius: 5px; padding: 15px;" width="100%">
                                                <tr>
                                                    <td style="font-family: sans-serif;">
                                                        <h3 style="color: #2d3748; font-size: 18px; font-weight: bold; margin-top: 0;">Access Information</h3>
                                                        <p style="margin-top: 5px; margin-bottom: 5px;"><strong style="color: #4a5568;">Domain:</strong> {{ $domain }}</p>
                                                        <p style="margin-top: 5px; margin-bottom: 5px;"><strong style="color: #4a5568;">Login URL:</strong> <a href="https://{{ $domain }}/login" target="_blank">https://{{ $domain }}/login</a></p>
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3869D4; border-radius: 5px; text-align: center;" valign="top" bgcolor="#3869D4" align="center">
                                                                            <a href="https://{{ $domain }}/login" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3869D4; border: solid 1px #3869D4; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3869D4;">Login to Your Account</a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                            <div style="background-color: #fff8dc; border-left: 4px solid #ffd700; padding: 10px; margin-bottom: 20px;">
                                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0;"><strong>Security Notice:</strong> For your security, please change your password immediately after logging in for the first time.</p>
                                            </div>
                                            
                                            <h3 style="color: #2d3748; font-size: 18px; font-weight: bold; margin-top: 30px;">Account Security Tips</h3>
                                            <ul style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; padding-left: 20px;">
                                                <li style="margin-bottom: 10px;">Create a strong password that includes uppercase letters, lowercase letters, numbers, and special characters</li>
                                                <li style="margin-bottom: 10px;">Never share your password with anyone</li>
                                                <li style="margin-bottom: 10px;">Always log out when you're done using the system</li>
                                                <li style="margin-bottom: 10px;">Report any suspicious activity immediately</li>
                                            </ul>
                                            
                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-top: 30px; margin-bottom: 15px;">If you have any questions or need assistance, please contact your administrator.</p>
                                            
                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Best regards,<br>The {{ $tenant ? $tenant->name : 'HospiBill' }} Team</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->

                    <!-- START FOOTER -->
                    <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                            <tr>
                                <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">© {{ date('Y') }} {{ $tenant ? $tenant->name : 'HospiBill' }}. All rights reserved.</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- END FOOTER -->

                </div>
            </td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        </tr>
    </table>
</body>
</html>
