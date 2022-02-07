<?php

namespace App\Services;

use Illuminate\Http\Request;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use Session;

class JWTApiService {
    const TOKEN_REPLACEMENT_IN_SECONDS = 600; # 10 minutes
    protected $expires_in;
    protected $access_token;
    protected $expiresInTimestamp;
    protected $account;
    protected $apiClient;

    public function __construct()
    {
        $config = new Configuration();
        $this->apiClient = new ApiClient($config);
    }

    /**
     * Checker for the JWT token
     */
    protected function checkToken()
    {
        if (
            is_null($this->access_token)
            || (time() +  self::TOKEN_REPLACEMENT_IN_SECONDS) > $this->expiresInTimestamp
        ) {
            $this->login();
        }
    }

    /**
     * DocuSign login handler
     */
    public function login()
    {
        $this->access_token = $this->configureJwtAuthorizationFlowByKey();

        if ($this->access_token) {
            return $this->access_token->getAccessToken();
        } else{
            return "error";
        }

    }

    /**
     * Get JWT auth by RSA key
     */
    private function configureJwtAuthorizationFlowByKey()
    {
        $this->apiClient->getOAuth()->setOAuthBasePath(getenv('DOCUSIGN_AUTHORIZATION_SERVER'));
        $privateKey = file_get_contents(base_path().'/'.getenv('DOCUSIGN_PRIVATE_KEY'), true);

        $scope = "signature impersonation";

        $response = $this->apiClient->requestJWTUserToken(
           getenv('DOCUSIGN_CLIENT_ID'),
           getenv('DOCUSIGN_IMPERSONATED_USER_ID'),
           $privateKey,
           $scope,
        );

        return $response[0];    //code...

    }

}
