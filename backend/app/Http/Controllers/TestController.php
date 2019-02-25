<?php


namespace App\Http\Controllers;

use Carbon\Carbon;

class TestController extends Controller
{

    protected $cryptoCurrencyApi = "http://api.coindog.com/api/v1/currency/ranks";
    protected $legalCurrencyApi = "https://tw.rter.info/capi.php";

    protected $cryptoCurrency = ['EOS', 'ETH'];
    protected $legalCurrency = ['USD', 'CNY', 'TWD'];

    public function currencies() {
        return [
            'crypto' => $this->fetchCryptoCurrency(),
            'legal' => $this->fetchLegalCurrency(),
        ];
    }

    public function fetchCryptoCurrency() {
        $content = file_get_contents($this->cryptoCurrencyApi);
        $content = json_decode($content, true);
        $content = array_column($content, null, 'currency');

        $currencies = collect($this->cryptoCurrency)
            ->map(function($c) use ($content) {
                $currencyInfo = $content[strtoupper($c)];
                $currencyInfo['updateTime'] = Carbon::createFromTimestampMs($currencyInfo['updateTime'])->format('Y-m-d H:m:s');
                return [
                    'currency' => $currencyInfo['currency'],
                    'exrate' => $currencyInfo['price'],
                    'updated_at' => $currencyInfo['updateTime']
                ];
            })->mapWithKeys(function($c, $k) {
                return [$c['currency'] => $c];
            });

        return $currencies;
    }

    public function fetchLegalCurrency() {
        $USD = "USD";
        $content = file_get_contents($this->legalCurrencyApi);
        $content = collect(json_decode($content, true));

        $currencies = $content
            ->filter(function($c, $k) use ($USD) {
                return substr($k, 0, strlen($USD)) === $USD && in_array(explode($USD, $k)[1], $this->legalCurrency);
            })
            ->mapWithKeys(function($c, $k) use ($USD) {
                $currency = explode($USD, $k)[1];
                return [
                    $currency => [
                        'currency' => $currency,
                        'exrate' => $c["Exrate"],
                        'updated_at' => $c['UTC']
                    ]
                ];
            });
        return $currencies;
    }

}
