<?php

namespace Rahweb\CmsAssistant\Core;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class API
{
    public static function get(string $uri, array $queryParam = [], $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        $fullUrl = sprintf("%s%s?%s", config('cms-assistant.api-base-url'), $uri, http_build_query($queryParam));
        curl_setopt($curl, CURLOPT_URL, $fullUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode == Response::HTTP_SERVICE_UNAVAILABLE) {
            //TODO: Include UPDATING view
        }
        curl_close($curl);

        return self::parseData($response);
    }

    public static function put(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, sprintf("%s%s", config('cms-assistant.api-base-url'), $uri));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));
        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function post(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, sprintf("%s%s", config('cms-assistant.api-base-url'), $uri));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));
        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function patch(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,  sprintf("%s%s", config('cms-assistant.api-base-url'), $uri));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));

        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function delete(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, sprintf("%s%s", config('cms-assistant.api-base-url'), $uri));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));
        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function parseData($response): Collection
    {
        $data = json_decode($response ?? '', true);

        return collect([
            'success' => $response['success'] ?? false,
            'data' => $data,
            'message' => (string)$response['message'] ?? null,
        ]);
    }

    private static function handleHeaders(array $headers): array
    {
        foreach ($headers as $key => $header) {
            if (str_contains(strtolower($header), 'authorization: bearer')) {
                unset($headers[$key]);
            }
        }

        $version = \Composer\InstalledVersions::getVersion('ra');
        $cookies = self::mergeCookies();

        $headerData = [
//            'Api-Key: ' . $GLOBALS['apikey'],
            'Content-Type: application/json',
            'REAL-HTTP-CLIENT-IP: ' . get_ip(),
            'REAL-HTTP-CLIENT-AGENT: ' . $_SERVER['HTTP_USER_AGENT'] ?? '',
            'REAL-HTTP-CLIENT-REFERRER: ' . ($_SERVER['HTTP_REFERER'] ?? ''),
//            'Authorization: Bearer ' . User::getToken(),
            "Cookie: $cookies",
//            'LSPWEB-SDK-VERSION: ' . $version
        ];

        return array_merge($headerData, $headers);
    }

    public static function mergeCookies(): string
    {
        $str = '';
        foreach ($_COOKIE as $key => $value) {
            $str .= "$key=$value;";
        }
        return $str;
    }
}
