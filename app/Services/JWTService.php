<?php

namespace App\Services;

use Illuminate\Http\Request;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use Session;

class JWTService {
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

        $this->expiresInTimestamp = time() + $this->expires_in;

        if (is_null($this->account)) {
            $this->account = $this->apiClient->getUserInfo($this->access_token->getAccessToken());
        }

        $redirectUrl = route('docusign');

        $this->authCallback($redirectUrl);

    }

    /**
     * Get JWT auth by RSA key
     */
    private function configureJwtAuthorizationFlowByKey()
    {
        $this->apiClient->getOAuth()->setOAuthBasePath(getenv('DOCUSIGN_AUTHORIZATION_SERVER'));
        $privateKey = file_get_contents(base_path().'/'.getenv('DOCUSIGN_PRIVATE_KEY'), true);

        $scope = "signature impersonation";

        try {

            $response = $this->apiClient->requestJWTUserToken(
               getenv('DOCUSIGN_CLIENT_ID'),
               getenv('DOCUSIGN_IMPERSONATED_USER_ID'),
               $privateKey,
               $scope,
            );

            return $response[0];    //code...

        } catch (\Throwable $th) {
            // we found consent_required in the response body meaning first time consent is needed
            if (strpos($th->getMessage(), "consent_required") !== false) {
                $_SESSION['consent_set'] = true;
                $authorizationURL = 'https://account-d.docusign.com/oauth/auth?' . http_build_query([
                    'scope'         => $jwt_scope,
                    'redirect_uri'  => route('docusign.callback'),
                    'client_id'     => getenv('DOCUSIGN_CLIENT_ID'),
                    'state'         => $_SESSION['oauth2state'],
                    'response_type' => 'code'
                ]);
                header('Location: ' . $authorizationURL);
                exit();
            }
        }
    }


    /**
     * DocuSign login handler
     * @param $redirectUrl
     */
    function authCallback($redirectUrl): void
    {
        if (!$this->access_token) {
            exit('Invalid JWT state');
        } else {
            try {

                // $_SESSION['ds_access_token'] = $this->access_token->getAccessToken();
                // $_SESSION['ds_refresh_token'] = $this->access_token->getRefreshToken();
                // $_SESSION['ds_expiration'] = time() + ($this->access_token->getExpiresIn() * 60); # expiration time.

                // $_SESSION['ds_user_name'] = $this->account[0]->getName();
                // $_SESSION['ds_user_email'] = $this->account[0]->getEmail();

                // $account_info = $this->account[0]->getAccounts();
                // $base_uri_suffix = '/restapi';

                // $_SESSION['ds_account_id'] = $account_info[0]->getAccountId();
                // $_SESSION['ds_account_name'] = $account_info[0]->getAccountName();
                // $_SESSION['ds_base_path'] = $account_info[0]->getBaseUri() . $base_uri_suffix;

                Session::put('docusign_auth_code', $this->access_token->getAccessToken());
                Session::put('success', 'Docusign successfully connected');

                header('Location: '. $redirectUrl);

            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                exit($e->getMessage());
            }

        }

    }

}
