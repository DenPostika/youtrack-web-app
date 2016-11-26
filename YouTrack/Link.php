<?php
namespace YouTrack;

/**
 * A class describing a youtrack link.
 *
 * @property string typeName
 * @method string getTypeName
 * @method string setTypename(string $value)
 * @property string typeInward
 * @method string getTypeInward
 * @method string setTypeInward(string $value)
 * @property string typeOutward
 * @method string getTypeOutward
 * @method string setTypeOutward(string $value)
 * @property string target
 * @method string getTarget
 * @method string setTarget(string $value)
 * @property string source
 * @method string getSource
 * @method string setSource(string $value)
 *
 * @link https://confluence.jetbrains.com/display/YTD65/Get+Links+of+an+Issue
 */
class Link extends BaseObject
{
    public function __construct(\SimpleXMLElement $xml = NULL, Connection $youtrack = NULL)
    {
        parent::__construct($xml, $youtrack);
    }
}
