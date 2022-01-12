<?php
/**
 * SettingsMetadata
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
 * SettingsMetadata Class Doc Comment
 *
 * @category    Class
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team <apihelp@docusign.com>
 * @license     The DocuSign PHP Client SDK is licensed under the MIT License.
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class SettingsMetadata implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'settingsMetadata';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'is21_cfr_part11' => '?string',
        'options' => '?string[]',
        'rights' => '?string',
        'ui_hint' => '?string',
        'ui_order' => '?string',
        'ui_type' => '?string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'is21_cfr_part11' => null,
        'options' => null,
        'rights' => null,
        'ui_hint' => null,
        'ui_order' => null,
        'ui_type' => null
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
        'is21_cfr_part11' => 'is21CFRPart11',
        'options' => 'options',
        'rights' => 'rights',
        'ui_hint' => 'uiHint',
        'ui_order' => 'uiOrder',
        'ui_type' => 'uiType'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'is21_cfr_part11' => 'setIs21CfrPart11',
        'options' => 'setOptions',
        'rights' => 'setRights',
        'ui_hint' => 'setUiHint',
        'ui_order' => 'setUiOrder',
        'ui_type' => 'setUiType'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'is21_cfr_part11' => 'getIs21CfrPart11',
        'options' => 'getOptions',
        'rights' => 'getRights',
        'ui_hint' => 'getUiHint',
        'ui_order' => 'getUiOrder',
        'ui_type' => 'getUiType'
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
        $this->container['is21_cfr_part11'] = isset($data['is21_cfr_part11']) ? $data['is21_cfr_part11'] : null;
        $this->container['options'] = isset($data['options']) ? $data['options'] : null;
        $this->container['rights'] = isset($data['rights']) ? $data['rights'] : null;
        $this->container['ui_hint'] = isset($data['ui_hint']) ? $data['ui_hint'] : null;
        $this->container['ui_order'] = isset($data['ui_order']) ? $data['ui_order'] : null;
        $this->container['ui_type'] = isset($data['ui_type']) ? $data['ui_type'] : null;
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
     * Gets is21_cfr_part11
     *
     * @return ?string
     */
    public function getIs21CfrPart11()
    {
        return $this->container['is21_cfr_part11'];
    }

    /**
     * Sets is21_cfr_part11
     *
     * @param ?string $is21_cfr_part11 When set to **true**, indicates that this module is enabled on the account.
     *
     * @return $this
     */
    public function setIs21CfrPart11($is21_cfr_part11)
    {
        $this->container['is21_cfr_part11'] = $is21_cfr_part11;

        return $this;
    }

    /**
     * Gets options
     *
     * @return ?string[]
     */
    public function getOptions()
    {
        return $this->container['options'];
    }

    /**
     * Sets options
     *
     * @param ?string[] $options 
     *
     * @return $this
     */
    public function setOptions($options)
    {
        $this->container['options'] = $options;

        return $this;
    }

    /**
     * Gets rights
     *
     * @return ?string
     */
    public function getRights()
    {
        return $this->container['rights'];
    }

    /**
     * Sets rights
     *
     * @param ?string $rights 
     *
     * @return $this
     */
    public function setRights($rights)
    {
        $this->container['rights'] = $rights;

        return $this;
    }

    /**
     * Gets ui_hint
     *
     * @return ?string
     */
    public function getUiHint()
    {
        return $this->container['ui_hint'];
    }

    /**
     * Sets ui_hint
     *
     * @param ?string $ui_hint 
     *
     * @return $this
     */
    public function setUiHint($ui_hint)
    {
        $this->container['ui_hint'] = $ui_hint;

        return $this;
    }

    /**
     * Gets ui_order
     *
     * @return ?string
     */
    public function getUiOrder()
    {
        return $this->container['ui_order'];
    }

    /**
     * Sets ui_order
     *
     * @param ?string $ui_order 
     *
     * @return $this
     */
    public function setUiOrder($ui_order)
    {
        $this->container['ui_order'] = $ui_order;

        return $this;
    }

    /**
     * Gets ui_type
     *
     * @return ?string
     */
    public function getUiType()
    {
        return $this->container['ui_type'];
    }

    /**
     * Sets ui_type
     *
     * @param ?string $ui_type 
     *
     * @return $this
     */
    public function setUiType($ui_type)
    {
        $this->container['ui_type'] = $ui_type;

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

