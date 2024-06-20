<?php

require_once __DIR__ . '/../Config.class.php';

class ImgurService {

    private $clientId;

    public function __construct() {
        $this->clientId = Config::IMGUR_CLIENT_ID();
    }

    public function uploadImageAsync($imageData) {
        $url = 'https://api.imgur.com/3/image';

        $headers = [
            'Authorization: Client-ID ' . $this->clientId
        ];

        $postData = [
            'image' => new \CURLFile($imageData)
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false || $httpCode != 200) {
            echo 'Upload failed: ' . curl_error($ch);
            curl_close($ch);
            return [null, null];
        }

        $data = json_decode($response, true);
        curl_close($ch);

        $imageUrl = isset($data['data']['link']) ? $data['data']['link'] : null;
        $deleteHash = isset($data['data']['deletehash']) ? $data['data']['deletehash'] : null;

        return [$imageUrl, $deleteHash];
    }

    public function deleteImageAsync($deleteHash) {
        $url = "https://api.imgur.com/3/image/{$deleteHash}";

        $headers = [
            'Authorization: Client-ID ' . $this->clientId
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode === 200;
    }
}

