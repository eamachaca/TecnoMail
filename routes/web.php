<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('deito', function () {
    $hostname = '{200.87.51.3/pop3/notls}INBOX';
    $username = 'grupo18sc';
    $password = 'grupo18grupo18';
    $inbox = imap_open($hostname, $username, $password) or die('Ha fallado la conexión: ' . imap_last_error());
    $emails = imap_search($inbox, 'ALL');
    if (!$emails) {

        $emails = [];
    }
    $dotero = [];
    foreach ($emails as $email_number) {
        $overview = imap_fetch_overview($inbox, $email_number, 0);
        $structure = imap_fetchstructure($inbox, $email_number);
        $message = null;
        if ($structure->subtype === 'ALTERNATIVE')
            $message = imap_fetchbody($inbox, $email_number, 2);
        else
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
            } // for($i = 0; $i < count($structure->parts); $i++)
        } // if(isset($structure->parts) && count($structure->parts))
        $dotero[] = [$overview, $message, $structure, $overview[0]->subject, filter_var($overview[0]->to,FILTER_VALIDATE_EMAIL), $overview[0]->from];//$overview[0];
        imap_delete($inbox, $email_number);
    }
    //imap_expunge($inbox);
    imap_close($inbox);
    dd($dotero);

});
Auth::routes();
Route::get('home', [
    'as' => 'home',
    'uses' => 'HomeController@index'
])->middleware('auth');
//Route::get('/home', 'HomeController@index')->name('home');

/*// Authentication routes...
Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as' => 'login-post',
    'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);
// Registration routes...
Route::get('register', [
    'as' => 'register',
    'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
    'as' => 'register-post',
    'uses' => 'Auth\RegisterController@register'
]);
Route::get('password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'Auth\ResetPasswordController@showResetForm'
]);
Route::get('password/reset', [
    'as' => 'password.request',
    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
    'as' => 'password.reset-post',
    'uses' => 'Auth\ResetPasswordController@reset'
]);
*/