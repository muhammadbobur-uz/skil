
<?php
require_once '../config.php';

$token = new security();

define('TOKEN', $token->token);

function bot($method, $datas = []) {
    $url = "https://api.telegram.org/bot" . TOKEN . "/$method";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$name = $messages->from->first_name;
$message_id = $message->message_id;
$text = $message->text;
$data = $update->callback_query->data;
$contact = $messages->contact->phone_number;
$location = $messages->location->longitude;

$t1 = "\u{1F1FA}\u{1F1FF}" . " Ўзбекча";
$t2 = "\u{1F1F7}\u{1F1FA}" . " Руский";
$t3 = "\u{1F1FA}\u{1F1FF}" . " O'zbekcha";
$til = json_encode(
        array(
            'keyboard' => array([$t1], [$t2], [$t3]),
            'resize_keyboard' => true,
            'one_time_keyboard' => true,
            'selective' => true,
        ));

$tel = "\u{1F4F1}" . " Raqam yuborish";
$back = "\u{1F1FA}\u{1F1FF}" . " Tilni o'zagrtirish " . "\u{1F1F7}\u{1F1FA}";

$replyMarkup3 = [
    'keyboard' => [[['text' => $tel, 'request_contact' => true,], ['text' => $back, 'request_contact' => false,]]],
    'resize_keyboard' => true,
    'one_time_keyboard' => true,
];
$encodeMarkup = json_encode($replyMarkup3);

if ($text == "/start") {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'parse_mode' => 'markdown',
        'text' => "*Ассалому алайкум! Келинг, аввал хизмат кўрсатиш тилини танлаб олайлик.
                              \n\n Assalomu alaykum ! Keling, avval xizmat ko'rsatish tilini tanlab olaylik.
                              \n\n Здраствуйте! Давайте для начала выбераем язык обслуживаниия.*",
        'reply_markup' => $til,
    ]);
}

if ($text == $t1) {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'parse_mode' => 'markdown',
        'text' => "Телефон ра?амингизни *+998(--) --- -- -- *\nшаклда юборинг, ёки " . "\u{1F4F2}" . " Ра?ам юбориш\nтугмасини босинг",
        'reply_markup' => $encodeMarkup,
        'text' => 'keyin nima qilamiz',
    ]);
}
if ($text == $t2) {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'parse_mode' => 'markdown',
        'text' => "Телефон ра?амингизни *+998(--) --- -- -- *\nшаклда юборинг, ёки " . "\u{1F4F2}" . " Ра?ам юбориш\nтугмасини босинг",
        'reply_markup' => $encodeMarkup,
    ]);
}

if ($text == $t3) {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'parse_mode' => 'markdown',
        'text' => "Telefon raqamingizni *+998(--) --- -- -- *\nshaklda yuboring, yoki " . "\u{1F4F2}" . " Raqam yuborish\ntugmasini bosing:",
        'reply_markup' => $encodeMarkup,
    ]);
}

if ($text == $back) {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'parse_mode' => 'markdown',
        'text' => "*Qaytadan tilni tanlang..*",
        'reply_markup' => $til,
    ]);
}
?>
