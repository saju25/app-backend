{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform</title>
</head>
<body>
    <h1>Welcome, {{ $fullname }}!</h1>
    <p> Voici votre code OTP pour accéder à votre compte :</p>
    <p><strong>{{ $otp_code }}</strong></p>
    <p>Ce code est valable pour une durée limitée. Ne le partagez avec personne.

        Si vous n'avez pas demandé ce code, veuillez ignorer cet email.
        </p>
</body>
</html>
 --}}
 <!DOCTYPE html>
 <html>
 <head>
     <title>Votre Code OTP</title>
 </head>
 <body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
     <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px;">
         <tr>
             <td align="center">
                 <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                     <!-- Header Section -->
                     <tr>
                         <td style="background-color: #8dd3f4; padding: 15px; font-size: 20px; font-weight: bold; color: #ffffff; display: flex; justify-content: center;align-items: center;">
                             <span style="font-size: 24px;"> <img src="https://medocciapp.online/assets/img/icon-logo-loding.png" alt="" width="100px" height="50px"></span style="  margin-left:10px ;"> Votre Application de Livraison de Médicaments
                         </td>
                     </tr>
                     
                     <!-- Body Content -->
                     <tr>
                         <td style="padding: 20px;">
                             <h2 style="color: #27ae60; margin: 0;">Votre Code OTP</h2>
                             <p style="font-size: 16px; color: #333;">{{ $fullname }},</p>
                             <p style="font-size: 16px; color: #333;">Voici votre code OTP pour accéder à votre compte :</p>
                             <p style="font-size: 28px; font-weight: bold; color: #6ab9e8; text-align: center;">{{ $otp_code }}</p>
                             <p style="font-size: 14px; color: #555;">Ce code est valable pour une durée limitée. Ne le partagez avec personne.</p>
                             <p style="font-size: 14px; color: #555;">Si vous n'avez pas demandé ce code, veuillez ignorer cet email.</p>
                         </td>
                     </tr>
                     
                     <!-- Footer Section -->
                     <tr>
                         <td style="background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; color: #777;">
                             <p style="margin: 0;"> @ Votre Application de Livraison de Médicaments. Tous droits réservés.</p>
                             <p style="margin: 5px 0;">
                                 <a href="#" style="color: #27ae60; text-decoration: none;">Politique de confidentialité</a> |
                                 <a href="#" style="color: #27ae60; text-decoration: none;">Contactez-nous</a>
                             </p>
                         </td>
                     </tr>
                 </table>
             </td>
         </tr>
     </table>
 </body>
 </html>
 