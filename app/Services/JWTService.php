<?php

namespace App\Services;

use Illuminate\Http\Request;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use Session;

class JWTService {
    const TOKEN_REPLACEMENT_IN_SECONDS = 600; # 10 minutes
    protected static $expires_in;
    protected static $access_token;
    protected static $expiresInTimestamp;
    protected static $account;
    protected static $apiClient;

    public function __construct()
    {
        $config = new Configuration();
        self::$apiClient = new ApiClient($config);
    }

    /**
     * Checker for the JWT token
     */
    protected function checkToken()
    {
        if (
            is_null(self::$access_token)
            || (time() +  self::TOKEN_REPLACEMENT_IN_SECONDS) > self::$expiresInTimestamp
        ) {
            $this->login();
        }
    }

    /**
     * DocuSign login handler
     */
    public function login()
    {
        self::$access_token = $this->configureJwtAuthorizationFlowByKey();

        if (!self::$access_token) {
            exit('Invalid JWT state');
        } else {

            self::$expiresInTimestamp = time() + self::$expires_in;

            if (is_null(self::$account)) {
                self::$account = self::$apiClient->getUserInfo(self::$access_token->getAccessToken());
            }

            $redirectUrl = route('docusign');

            $this->authCallback($redirectUrl);

        }
    }

    /**
     * Get JWT auth by RSA key
     */
    private function configureJwtAuthorizationFlowByKey()
    {
        self::$apiClient->getOAuth()->setOAuthBasePath($GLOBALS['JWT_CONFIG']['authorization_server']);
        $privateKey = file_get_contents(base_path().'/'.$GLOBALS['JWT_CONFIG']['private_key_file'], true);

        $scope = "signature impersonation";

        try {

            $response = self::$apiClient->requestJWTUserToken(
               getenv('DOCUSIGN_CLIENT_ID'),
               $GLOBALS['JWT_CONFIG']['ds_impersonated_user_id'],
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
        try {

            $_SESSION['ds_access_token'] = self::$access_token->getAccessToken();
            $_SESSION['ds_refresh_token'] = self::$access_token->getRefreshToken();
            $_SESSION['ds_expiration'] = time() + (self::$access_token->getExpiresIn() * 60); # expiration time.

            $_SESSION['ds_user_name'] = self::$account[0]->getName();
            $_SESSION['ds_user_email'] = self::$account[0]->getEmail();

            $account_info = self::$account[0]->getAccounts();
            $base_uri_suffix = '/restapi';

            $_SESSION['ds_account_id'] = $account_info[0]->getAccountId();
            $_SESSION['ds_account_name'] = $account_info[0]->getAccountName();
            $_SESSION['ds_base_path'] = $account_info[0]->getBaseUri() . $base_uri_suffix;

            Session::put('docusign_auth_code', self::$access_token->getAccessToken());
            Session::put('success', 'Docusign successfully connected');

            header('Location: '. $redirectUrl);

        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            exit($e->getMessage());
        }

    }

    /**
     * Set flash for the current user session
     * @param $msg string
     */
    public function flash(string $msg): void
    {
        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }
        array_push($_SESSION['flash'], $msg);
    }
}
