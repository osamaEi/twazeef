<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('auth.password_reset_subject') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .message {
            margin-bottom: 30px;
            font-size: 16px;
            color: #555;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }
        .button:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        .info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            color: #0c5460;
        }
        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 0;
            }
            .header, .content, .footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name', 'Laravel') }}</h1>
        </div>
        
        <div class="content">
            <div class="message">
                <p>{{ __('auth.hello') }},</p>
                
                <p>{{ __('auth.password_reset_request_received') }}</p>
                
                <p>{{ __('auth.password_reset_click_button') }}</p>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">
                    {{ __('auth.reset_password') }}
                </a>
            </div>
            
            <div class="warning">
                <strong>{{ __('auth.important') }}:</strong> {{ __('auth.password_reset_expires_in_24_hours') }}
            </div>
            
            <div class="info">
                <p>{{ __('auth.password_reset_not_requested') }}</p>
            </div>
            
            <div class="message">
                <p>{{ __('auth.regards') }},<br>
                <strong>{{ config('app.name', 'Laravel') }}</strong></p>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. {{ __('auth.all_rights_reserved') }}</p>
        </div>
    </div>
</body>
</html>
