<?php


function user() {
    return \Auth::user();
}

function to_datetime($time = null) {
    if (!$time) $time = time();
    if (!is_numeric($time)) $time = strtotime($time);
    return date('Y-m-d H:i:s', $time);
}


function notify_admin($message, $only_prod = false) {
    if (config('app.env') != 'production' && $only_prod) return 0;

    $url = "https://echo.gufoe.it/PnwDXj1PCx?".http_build_query([
      'msg' => $message,
    ]);

    $bytes = @file_get_contents($url) ? 'ok' : 'fail';
    \Log::debug("Contacted admin on url [res=$bytes]: ".substr($url, 0, 20)."...");

    return $bytes;
}


function validate($data, $rules, $messages = []) {
    $validator = \Validator::make($data, $rules, $messages);
    if ($validator->fails()) {
        throw new Illuminate\Validation\ValidationException('Errore di validazione', $validator->errors());
    }
}

function http_token() {
    $header = request()->header('Authorization') ?: request('__auth_token');
    if (!preg_match('/^(bearer )?(.+)$/i', $header, $matches)) {
        return null;
    }
    return $matches[2];
}
