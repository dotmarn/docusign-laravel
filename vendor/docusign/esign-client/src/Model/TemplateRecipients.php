<?php
/**
 * TemplateRecipients
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  DocuSign\eSign
 * @author   Swagger Codegen team <apihelp@docusign.com>
 * @license  The DocuSign PHP Client SDK is licensed under the MIT License.
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * DocuSign REST API
 *
 * The DocuSign REST API provides you with a powerful, convenient, and simple Web services API for interacting with DocuSign.
 *
 * OpenAPI spec version: v2.1
 * Contact: devcenter@docusign.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.21-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace DocuSign\eSign\Model;

use \ArrayAccess;
use DocuSign\eSign\ObjectSerializer;

/**
 * TemplateRecipients Class Doc Comment
 *
 * @category    Class
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team <apihelp@docusign.com>
 * @license     The DocuSign PHP Client SDK is licensed under the MIT License.
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class TemplateRecipients implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'templateRecipients';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'agents' => '\DocuSign\eSign\Model\Agent[]',
        'carbon_copies' => '\DocuSign\eSign\Model\CarbonCopy[]',
        'certified_deliveries' => '\DocuSign\eSign\Model\CertifiedDelivery[]',
        'current_routing_order' => '?string',
        'editors' => '\DocuSign\eSign\Model\Editor[]',
        'error_details' => '\DocuSign\eSign\Model\ErrorDetails',
        'in_person_signers' => '\DocuSign\eSign\Model\InPersonSigner[]',
        'intermediaries' => '\DocuSign\eSign\Model\Intermediary[]',
        'notaries' => '\DocuSign\eSign\Model\NotaryRecipient[]',
        'recipient_count' => '?string',
        'seals' => '\DocuSign\eSign\Model\SealSign[]',
        'signers' => '\DocuSign\eSign\Model\Signer[]',
        'witnesses' => '\DocuSign\eSign\Model\Witness[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'agents' => null,
        'carbon_copies' => null,
        'certified_deliveries' => null,
        'current_routing_order' => null,
        'editors' => null,
        'error_details' => null,
        'in_person_signers' => null,
        'intermediaries' => null,
        'notaries' => null,
        'recipient_count' => null,
        'seals' => null,
        'signers' => null,
        'witnesses' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'agents' => 'agents',
        'carbon_copies' => 'carbonCopies',
        'certified_deliveries' => 'certifiedDeliveries',
        'current_routing_order' => 'currentRoutingOrder',
        'editors' => 'editors',
        'error_details' => 'errorDetails',
        'in_person_signers' => 'inPersonSigners',
        'intermediaries' => 'intermediaries',
        'notaries' => 'notaries',
        'recipient_count' => 'recipientCount',
        'seals' => 'seals',
        'signers' => 'signers',
        'witnesses' => 'witnesses'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'agents' => 'setAgents',
        'carbon_copies' => 'setCarbonCopies',
        'certified_deliveries' => 'setCertifiedDeliveries',
        'current_routing_order' => 'setCurrentRoutingOrder',
        'editors' => 'setEditors',
        'error_details' => 'setErrorDetails',
        'in_person_signers' => 'setInPersonSigners',
        'intermediaries' => 'setIntermediaries',
        'notaries' => 'setNotaries',
        'recipient_count' => 'setRecipientCount',
        'seals' => 'setSeals',
        'signers' => 'setSigners',
        'witnesses' => 'setWitnesses'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'agents' => 'getAgents',
        'carbon_copies' => 'getCarbonCopies',
        'certified_deliveries' => 'getCertifiedDeliveries',
        'current_routing_order' => 'getCurrentRoutingOrder',
        'editors' => 'getEditors',
        'error_details' => 'getErrorDetails',
        'in_person_signers' => 'getInPersonSigners',
        'intermediaries' => 'getIntermediaries',
        'notaries' => 'getNotaries',
        'recipient_count' => 'getRecipientCount',
        'seals' => 'getSeals',
        'signers' => 'getSigners',
        'witnesses' => 'getWitnesses'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['agents'] = isset($data['agents']) ? $data['agents'] : null;
        $this->container['carbon_copies'] = isset($data['carbon_copies']) ? $data['carbon_copies'] : null;
        $this->container['certified_deliveries'] = isset($data['certified_deliveries']) ? $data['certified_deliveries'] : null;
        $this->container['current_routing_order'] = isset($data['current_routing_order']) ? $data['current_routing_order'] : null;
        $this->container['editors'] = isset($data['editors']) ? $data['editors'] : null;
        $this->container['error_details'] = isset($data['error_details']) ? $data['error_details'] : null;
        $this->container['in_person_signers'] = isset($data['in_person_signers']) ? $data['in_person_signers'] : null;
        $this->container['intermediaries'] = isset($data['intermediaries']) ? $data['intermediaries'] : null;
        $this->container['notaries'] = isset($data['notaries']) ? $data['notaries'] : null;
        $this->container['recipient_count'] = isset($data['recipient_count']) ? $data['recipient_count'] : null;
        $this->container['seals'] = isset($data['seals']) ? $data['seals'] : null;
        $this->container['signers'] = isset($data['signers']) ? $data['signers'] : null;
        $this->container['witnesses'] = isset($data['witnesses']) ? $data['witnesses'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets agents
     *
     * @return \DocuSign\eSign\Model\Agent[]
     */
    public function getAgents()
    {
        return $this->container['agents'];
    }

    /**
     * Sets agents
     *
     * @param \DocuSign\eSign\Model\Agent[] $agents A complex type defining the management and access rights of a recipient assigned assigned as an agent on the document.
     *
     * @return $this
     */
    public function setAgents($agents)
    {
        $this->container['agents'] = $agents;

        return $this;
    }

    /**
     * Gets carbon_copies
     *
     * @return \DocuSign\eSign\Model\CarbonCopy[]
     */
    public function getCarbonCopies()
    {
        return $this->container['carbon_copies'];
    }

    /**
     * Sets carbon_copies
     *
     * @param \DocuSign\eSign\Model\CarbonCopy[] $carbon_copies A complex type containing information about recipients who should receive a copy of the envelope, but does not need to sign it.
     *
     * @return $this
     */
    public function setCarbonCopies($carbon_copies)
    {
        $this->container['carbon_copies'] = $carbon_copies;

        return $this;
    }

    /**
     * Gets certified_deliveries
     *
     * @return \DocuSign\eSign\Model\CertifiedDelivery[]
     */
    public function getCertifiedDeliveries()
    {
        return $this->container['certified_deliveries'];
    }

    /**
     * Sets certified_deliveries
     *
     * @param \DocuSign\eSign\Model\CertifiedDelivery[] $certified_deliveries A complex type containing information on a recipient the must receive the completed documents for the envelope to be completed, but the recipient does not need to sign, initial, date, or add information to any of the documents.
     *
     * @return $this
     */
    public function setCertifiedDeliveries($certified_deliveries)
    {
        $this->container['certified_deliveries'] = $certified_deliveries;

        return $this;
    }

    /**
     * Gets current_routing_order
     *
     * @return ?string
     */
    public function getCurrentRoutingOrder()
    {
        return $this->container['current_routing_order'];
    }

    /**
     * Sets current_routing_order
     *
     * @param ?string $current_routing_order 
     *
     * @return $this
     */
    public function setCurrentRoutingOrder($current_routing_order)
    {
        $this->container['current_routing_order'] = $current_routing_order;

        return $this;
    }

    /**
     * Gets editors
     *
     * @return \DocuSign\eSign\Model\Editor[]
     */
    public function getEditors()
    {
        return $this->container['editors'];
    }

    /**
     * Sets editors
     *
     * @param \DocuSign\eSign\Model\Editor[] $editors 
     *
     * @return $this
     */
    public function setEditors($editors)
    {
        $this->container['editors'] = $editors;

        return $this;
    }

    /**
     * Gets error_details
     *
     * @return \DocuSign\eSign\Model\ErrorDetails
     */
    public function getErrorDetails()
    {
        return $this->container['error_details'];
    }

    /**
     * Sets error_details
     *
     * @param \DocuSign\eSign\Model\ErrorDetails $error_details error_details
     *
     * @return $this
     */
    public function setErrorDetails($error_details)
    {
        $this->container['error_details'] = $error_details;

        return $this;
    }

    /**
     * Gets in_person_signers
     *
     * @return \DocuSign\eSign\Model\InPersonSigner[]
     */
    public function getInPersonSigners()
    {
        return $this->container['in_person_signers'];
    }

    /**
     * Sets in_person_signers
     *
     * @param \DocuSign\eSign\Model\InPersonSigner[] $in_person_signers Specifies a signer that is in the same physical location as a DocuSign user who will act as a Signing Host for the transaction. The recipient added is the Signing Host and new separate Signer Name field appears after Sign in person is selected.
     *
     * @return $this
     */
    public function setInPersonSigners($in_person_signers)
    {
        $this->container['in_person_signers'] = $in_person_signers;

        return $this;
    }

    /**
     * Gets intermediaries
     *
     * @return \DocuSign\eSign\Model\Intermediary[]
     */
    public function getIntermediaries()
    {
        return $this->container['intermediaries'];
    }

    /**
     * Sets intermediaries
     *
     * @param \DocuSign\eSign\Model\Intermediary[] $intermediaries Identifies a recipient that can, but is not required to, add name and email information for recipients at the same or subsequent level in the routing order (until subsequent Agents, Editors or Intermediaries recipient types are added).
     *
     * @return $this
     */
    public function setIntermediaries($intermediaries)
    {
        $this->container['intermediaries'] = $intermediaries;

        return $this;
    }

    /**
     * Gets notaries
     *
     * @return \DocuSign\eSign\Model\NotaryRecipient[]
     */
    public function getNotaries()
    {
        return $this->container['notaries'];
    }

    /**
     * Sets notaries
     *
     * @param \DocuSign\eSign\Model\NotaryRecipient[] $notaries 
     *
     * @return $this
     */
    public function setNotaries($notaries)
    {
        $this->container['notaries'] = $notaries;

        return $this;
    }

    /**
     * Gets recipient_count
     *
     * @return ?string
     */
    public function getRecipientCount()
    {
        return $this->container['recipient_count'];
    }

    /**
     * Sets recipient_count
     *
     * @param ?string $recipient_count The list of recipient event statuses that will trigger Connect to send updates to the url. It can be a two-part list with:  * recipientEventStatusCode - The recipient status, this can be Sent, Delivered, Completed, Declined, AuthenticationFailed, and AutoResponded. * includeDocuments - When set to **true**, the envelope time zone information is included in the message.
     *
     * @return $this
     */
    public function setRecipientCount($recipient_count)
    {
        $this->container['recipient_count'] = $recipient_count;

        return $this;
    }

    /**
     * Gets seals
     *
     * @return \DocuSign\eSign\Model\SealSign[]
     */
    public function getSeals()
    {
        return $this->container['seals'];
    }

    /**
     * Sets seals
     *
     * @param \DocuSign\eSign\Model\SealSign[] $seals 
     *
     * @return $this
     */
    public function setSeals($seals)
    {
        $this->container['seals'] = $seals;

        return $this;
    }

    /**
     * Gets signers
     *
     * @return \DocuSign\eSign\Model\Signer[]
     */
    public function getSigners()
    {
        return $this->container['signers'];
    }

    /**
     * Sets signers
     *
     * @param \DocuSign\eSign\Model\Signer[] $signers A complex type containing information about the Signer recipient.
     *
     * @return $this
     */
    public function setSigners($signers)
    {
        $this->container['signers'] = $signers;

        return $this;
    }

    /**
     * Gets witnesses
     *
     * @return \DocuSign\eSign\Model\Witness[]
     */
    public function getWitnesses()
    {
        return $this->container['witnesses'];
    }

    /**
     * Sets witnesses
     *
     * @param \DocuSign\eSign\Model\Witness[] $witnesses 
     *
     * @return $this
     */
    public function setWitnesses($witnesses)
    {
        $this->container['witnesses'] = $witnesses;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

