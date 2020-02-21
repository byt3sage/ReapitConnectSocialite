<?php

namespace JaeTooleDev\ReapitConnectSocialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class Provider extends AbstractProvider implements ProviderInterface
{

    /**
     * {@inheritDoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://dev.connect.reapit.cloud/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://dev.connect.reapit.cloud/token';
    }

    public function getAccessToken($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'body' => $this->getTokenFields($code)
        ]);

        return $this->parseAccessToken($response->getBody());
    }

    protected function getTokenFields($code)
    {
        return [
            'client_id' => $this->clientId,
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->redirectUrl,
        ];
    }

    protected function getUserByToken($token)
    {
        // dd($token);
        $response = $this->getHttpClient()->get('https://dev.connect.reapit.cloud/oauth2/userInfo', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ]
        ]);
        // dd($response->getBody()->getContents());
        return json_decode($response->getBody(), true);
    }

    protected function formatScopes(array $scopes, $scopeSeperator)
    {
        return implode($scopeSeperator, $scopes);
    }

    protected function mapUserToObject(array $user) {
        return (new User)->setRaw($user)->map([
            'name' => $user['name'],
            'email' => $user['username']
        ]);
    }
}