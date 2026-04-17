<?php
/**
 * Handler unifié pour les formulaires du site E-Digital.
 *
 * Endpoints supportés (via le paramètre POST `form_type`) :
 *  - contact    : formulaire de contact (contact.html)
 *  - newsletter : formulaire d'inscription newsletter (footer)
 *
 * Destinataire principal : com1@e-digital.fr
 * Copie (CC)             : jhouedanou@gmail.com
 */

// --- CORS / Méthode ---------------------------------------------------------
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

// --- Configuration ----------------------------------------------------------
$TO    = 'com1@e-digital.fr';
$CC    = 'jhouedanou@gmail.com';
$FROM  = 'no-reply@e-digital.fr';

// --- Utilitaires ------------------------------------------------------------
function clean($v)
{
    return trim(strip_tags((string) $v));
}

function sendMail($to, $subject, $body, $cc, $from)
{
    $headers   = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: E-Digital <' . $from . '>';
    $headers[] = 'Reply-To: ' . $from;
    if ($cc) {
        $headers[] = 'Cc: ' . $cc;
    }

    return @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, implode("\r\n", $headers));
}

// --- Dispatcher -------------------------------------------------------------
$formType = $_POST['form_type'] ?? 'contact';

if ($formType === 'newsletter') {
    // -------------------- NEWSLETTER ---------------------------------------
    $email = clean($_POST['EMAIL'] ?? $_POST['email'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Adresse e-mail invalide.']);
        exit;
    }

    $subject = '[E-Digital] Nouvelle inscription newsletter';
    $body    = '<h2>Nouvelle inscription à la newsletter</h2>'
             . '<p><strong>Email :</strong> ' . htmlspecialchars($email) . '</p>'
             . '<p><em>Date : ' . date('d/m/Y H:i:s') . '</em></p>';

    $sent = sendMail($TO, $subject, $body, $CC, $FROM);

    echo json_encode([
        'success' => $sent,
        'message' => $sent ? 'Merci pour votre inscription !' : 'Impossible d’envoyer l’e-mail, réessayez plus tard.',
    ]);
    exit;
}

// -------------------- CONTACT ----------------------------------------------
$data = [
    'firstname'   => clean($_POST['firstname']   ?? ''),
    'lastname'    => clean($_POST['lastname']    ?? ''),
    'email'       => clean($_POST['email']       ?? ''),
    'phone'       => clean($_POST['phone']       ?? ''),
    'company'     => clean($_POST['company']     ?? ''),
    'url'         => clean($_POST['url']         ?? ''),
    'service'     => clean($_POST['service']     ?? ''),
    'description' => clean($_POST['description'] ?? ''),
    'budget'      => clean($_POST['budget']      ?? ''),
    'delay'       => clean($_POST['delay']       ?? ''),
    'source'      => clean($_POST['source']      ?? ''),
    'rgpd'        => isset($_POST['rgpd']) ? 'Oui' : 'Non',
];

// Validation minimale
$required = ['firstname', 'lastname', 'email', 'phone', 'company', 'service', 'description', 'budget'];
foreach ($required as $field) {
    if ($data[$field] === '') {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Champ manquant : ' . $field]);
        exit;
    }
}

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Adresse e-mail invalide.']);
    exit;
}

$subject = '[E-Digital] Nouvelle demande de devis — ' . $data['firstname'] . ' ' . $data['lastname'];

$rows = '';
foreach ($data as $key => $value) {
    $rows .= '<tr><th style="text-align:left;padding:6px 12px;background:#f5f5f5;">'
          . htmlspecialchars(ucfirst($key))
          . '</th><td style="padding:6px 12px;">'
          . nl2br(htmlspecialchars($value))
          . '</td></tr>';
}

$body = '<h2>Nouvelle demande de devis</h2>'
      . '<table cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse;font-family:Arial,sans-serif;">'
      . $rows
      . '</table>'
      . '<p><em>Date : ' . date('d/m/Y H:i:s') . '</em></p>';

$sent = sendMail($TO, $subject, $body, $CC, $FROM);

echo json_encode([
    'success' => $sent,
    'message' => $sent
        ? 'Merci, nous revenons vers vous rapidement !'
        : 'Impossible d’envoyer votre demande, réessayez plus tard.',
]);
