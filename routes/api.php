<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('read', function () {
    $hostname = '{200.87.51.3/pop3/notls}INBOX';
    $username = 'grupo18sc';
    $password = 'grupo18grupo18';
    $inbox = imap_open($hostname, $username, $password) or die('Ha fallado la conexión: ' . imap_last_error());
    $emails = imap_search($inbox, 'ALL');
    if (is_array($emails)) {
        $dotero = [];
        foreach ($emails as $email_number) {
            $overview = imap_fetch_overview($inbox, $email_number, 0);
            $structure = imap_fetchstructure($inbox, $email_number);
            $message = null;
            switch ($structure->subtype) {
                case 'ALTERNATIVE': {
                    $message = imap_fetchbody($inbox, $email_number, 2);
                    break;
                }
                case 'REPORT': {
                    $message = imap_fetchbody($inbox, $email_number, 1);
                    break;
                }
                default: {
                    $message = imap_fetchbody($inbox, $email_number, 1.2);
                    break;
                }
            }
            $message = imap_fetchbody($inbox, $email_number, 1.2);
            $attachments = array();
            if (isset($structure->parts) && count($structure->parts)) {
                for ($i = 0; $i < count($structure->parts); $i++) {
                    $attachments[$i] = array(
                        'is_attachment' => false,
                        'filename' => '',
                        'name' => '',
                        'attachment' => '');

                    if ($structure->parts[$i]->ifdparameters) {
                        foreach ($structure->parts[$i]->dparameters as $object) {
                            if (strtolower($object->attribute) == 'filename') {
                                $attachments[$i]['is_attachment'] = true;
                                $attachments[$i]['filename'] = $object->value;
                            }
                        }
                    }

                    if ($structure->parts[$i]->ifparameters) {
                        foreach ($structure->parts[$i]->parameters as $object) {
                            if (strtolower($object->attribute) == 'name') {
                                $attachments[$i]['is_attachment'] = true;
                                $attachments[$i]['name'] = $object->value;
                            }
                        }
                    }

                    if ($attachments[$i]['is_attachment']) {
                        $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i + 1);
                        if ($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                            $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                        } elseif ($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                            $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                        }
                    }
                    if (count($attachments) != 0) {
                        foreach ($attachments as $at) {
                            if ($at['is_attachment'] == 1) {
                                file_put_contents('loco/' . $at['filename'], $at['attachment']);
                            }
                        }
                    }
                } // ENDfor($i = 0; $i < count($structure->parts); $i++)
            } // ENDif(isset($structure->parts) && count($structure->parts))
            $html = new \DOMDocument('1.0', 'ISO-8859-1');
            @$html->loadHTML($message);
            imap_delete($inbox, $email_number);
        }
        imap_expunge($inbox);
        imap_close($inbox);
    }
    return 'Termino';
});