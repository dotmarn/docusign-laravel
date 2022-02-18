<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\JWTApiService;
use App\Http\Controllers\Controller;
use App\Services\SignatureClientService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;

class DocusignController extends Controller
{
    protected $jwtService;
    protected $clientService;
    protected $token;
    private $args;
    private $x_axis;
    private $y_axis;
    private $file_path;
    private $signer_name;
    private $signer_email;
    private $anchor;
    private $access_token;

    private $rules = [
        'signer_name' => ['required', 'string'],
        'signer_email' => ['required', 'string', 'email'],
        'document' => ['required', 'mimes:pdf'],
        'signature_anchor' => ['required', 'string'],
        'position' => ['required', 'string']
    ];

    private $doc = [
        'document_id' => ['required', 'string'],
        'envelope_id' => ['required', 'string']
    ];

    public function __construct()
    {
        $this->jwtService = new JWTApiService();
    }

    public function signDocumentViaEmail(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Some fields are missing',
                'data' => $validator->errors()
            ], 422);
        }

        $file = $request->file('document');
        $this->file_path = $file->store('documents', 'public');
        $this->access_token = $this->connectToDocusign();

        $this->setOptions($request);

        $this->args = $this->getTemplateArgs();

        return $this->worker();
    }

    public function connectToDocusign()
    {
        $access_token = $this->jwtService->login();
        return $access_token;
    }

    public function worker()
    {
        $envelope_definition = $this->make_envelope($this->args["envelope_args"]);
        $this->clientService = new SignatureClientService($this->args);
        $envelope_api = $this->clientService->getEnvelopeApi();

        try {
            $results = $envelope_api->createEnvelope($this->args['account_id'], $envelope_definition);
            $data['envelope_id'] = $results->getEnvelopeId();

            return response()->json([
                'status' => true,
                'message' => "Document signing initiated successfully",
                'data' => $data
            ], 200);

        } catch (ApiException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 400);
        }

    }


    private function make_envelope(array $args): EnvelopeDefinition
    {
        # Create the envelope definition
        $envelope_definition = new EnvelopeDefinition([
           'email_subject' => 'Please sign this document'
        ]);

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $content_bytes = file_get_contents(asset('storage/'.$this->file_path),false, stream_context_create($arrContextOptions));

        $base64_file_content = base64_encode($content_bytes);

        # Create the document model
        $document = new \DocuSign\eSign\Model\Document([# create the DocuSign document object
            'document_base64' => $base64_file_content,
            'name' => 'Example document', # can be different from actual file name
            'file_extension' => 'pdf', # many different document types are accepted
            'document_id' => 1, # a label used to reference the doc
        ]);

        # The order in the docs array determines the order in the envelope
        $envelope_definition->setDocuments([$document]);

        # Create the signer recipient model
        $signer = new \DocuSign\eSign\Model\Signer([
            'email' => $this->signer_email,
            'name' => $this->signer_name,
            'recipient_id' => "1",
            'routing_order' => "1"
        ]);

        $sign_here = new \DocuSign\eSign\Model\SignHere([
            'anchor_string' => $this->anchor,
            'anchor_units' => 'pixels',
            'anchor_y_offset' => $this->y_axis,
            'anchor_x_offset' => $this->x_axis
        ]);


        # Add the tabs model (including the sign_here tabs) to the signer
        # The Tabs object wants arrays of the different field/tab types
        $signer->setTabs(new \DocuSign\eSign\Model\Tabs([
            'sign_here_tabs' => [$sign_here]
        ]));

        # Add the recipients to the envelope object
        $recipients = new \DocuSign\eSign\Model\Recipients([
            'signers' => [$signer]
        ]);

        $envelope_definition->setRecipients($recipients);

        $envelope_definition->setStatus($args["status"]);

        return $envelope_definition;
    }

    private function getTemplateArgs() : array
    {
        $envelope_args = [
            'cc_email' => 'ridwan@seamlesshr.com',
            'cc_name' => '',
            'status' => 'sent'
        ];

        $args = [
            'account_id' => env('DOCUSIGN_ACCOUNT_ID'),
            'base_path' => env('DOCUSIGN_BASE_URL'),
            'ds_access_token' => $this->access_token,
            'envelope_args' => $envelope_args
        ];

        return $args;

    }

    private function setOptions($request)
    {
        $this->anchor = $request->signature_anchor;
        $this->signer_name = $request->signer_name;
        $this->signer_email = $request->signer_email;

        switch ($request->position) {
            case 'above':
                $this->y_axis = "-5";
                $this->x_axis = null;
                break;
            case 'left':
                $this->y_axis = null;
                $this->x_axis = "30";
                break;
            case 'right':
                $this->y_axis = null;
                $this->x_axis = "30";
                break;
            default:
                $this->y_axis = null;
                $this->x_axis = null;
                break;
        }

    }

    public function fetchDocument(Request $request)
    {
        $validator = Validator::make($request->all(), $this->doc);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Some fields are missing',
                'data' => $validator->errors()
            ], 422);
        }

        $this->access_token = $this->connectToDocusign();

        $args = [
            'ds_access_token' => $this->access_token,
        ];

        $this->clientService = new SignatureClientService($args);
        $account_id = getenv('DOCUSIGN_ACCOUNT_ID');

        $envelope_api = $this->clientService->getEnvelopeApi();
        // get envelope info first
        try {
            $info = $envelope_api->getEnvelope($account_id, $request->envelope_id);
            if ($info && ($info["status"] == "completed")) {
                $temp_file = $envelope_api->getDocument($account_id,  $request->document_id, $request->envelope_id);
                 // fetch documents
                 $documents = $envelope_api->listDocuments($account_id, $signing_request->envelope_id);

                 $args['documents'] = $documents ? $documents : [];
                 // get the splfl
                 $actual_file = $envelope_api->getDocument($account_id,  $signing_request->document_id, $signing_request->envelope_id);

                 $doc_item = false;

                 foreach ($args['documents']['envelope_documents'] as $item) {
                     if ($item['document_id'] == $signing_request->document_id) {
                         $doc_item = $item;
                         break;
                     }
                 }

                 $doc_name = $doc_item['name'];
                 $has_pdf_suffix = strtoupper(substr($doc_name, -4)) == '.PDF';
                 $pdf_file = $has_pdf_suffix;

                 if ($doc_item["type"] == "content" || ($doc_item["type"] == "summary" && ! $has_pdf_suffix)) {
                     $doc_name .= ".pdf";
                     $pdf_file = true;
                 }

                 if ($doc_item["type"] == "zip") {
                     $doc_name .= ".zip";
                 }

                 if ($pdf_file) {
                     $mimetype = 'application/pdf';
                 } elseif ($doc_item["type"] == 'zip') {
                     $mimetype = 'application/zip';
                 } else {
                     $mimetype = 'application/octet-stream';
                 }

                 header("Content-Type: {$mimetype}");
                 header("Content-Disposition: attachment; filename=\"{$doc_name}\"");
                 ob_clean();
                 flush();

                 $file_path = $actual_file->getPathname();

                 $pdf = file_get_contents($file_path);

                 $path = 'uploads/signed-documents/'.$doc_name;

                 Storage::disk('public')->put($path, $pdf);

                 $data = (object)[
                     "envelope_id" => $signing_request->envelope_id,
                     "recipient" => (object) [
                         "email" => $signing_request->recipient_email,
                         "full_name" => $signing_request->recipient_full_name
                     ],
                     "esignature_subscriber" => (object) [

                     ],
                     "path" => $path
                 ];

                 return AppUtils::setResponse(
                     Response::HTTP_OK,
                     $data,
                     "Signed document retrieved successfully."
                 );
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Document has not been signed',
                    'data' => null
                ], 422);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function webhook(Request $request)
    {
        dd($request);
    }

}
