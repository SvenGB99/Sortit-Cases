<?php
namespace YOOtheme\GraphQL\Type\Definition;

use YOOtheme\GraphQL\Error\Error;
use YOOtheme\GraphQL\Language\AST\IntValueNode;
use YOOtheme\GraphQL\Language\AST\Node;
use YOOtheme\GraphQL\Language\AST\StringValueNode;
use YOOtheme\GraphQL\Utils\Utils;

/**
 * Class IDType
 * @package GraphQL\Type\Definition
 */
class IDType extends ScalarType
{
    /**
     * @var string
     */
    public $name = 'ID';

    /**
     * @var string
     */
    public $description =
'The `ID` scalar type represents a unique identifier, often used to
refetch an object or as key for a cache. The ID type appears in a JSON
response as a String; however, it is not intended to be human-readable.
When expected as an input type, any string (such as `"4"`) or integer
(such as `4`) input value will be accepted as an ID.';

    /**
     * @param mixed $value
     * @return string
     * @throws Error
     */
    public function serialize($value)
    {
        if ($value === true) {
            return 'true';
        }
        if ($value === false) {
            return 'false';
        }
        if ($value === null) {
            return 'null';
        }
        if (!is_scalar($value) && (!is_object($value) || !method_exists($value, '__toString'))) {
            throw new Error("ID type cannot represent non scalar value: " . Utils::printSafe($value));
        }
        return (string) $value;
    }

    /**
     * @param mixed $value
     * @return string
     * @throws Error
     */
    public function parseValue($value)
    {
        if (is_string($value) || is_int($value)) {
            return (string) $value;
        }

        throw new Error("Cannot represent value as ID: " . Utils::printSafe($value));
    }

    /**
     * @param Node $valueNode
     * @param array|null $variables
     * @return null|string
     * @throws \Exception
     */
    public function parseLiteral($valueNode, array $variables = null)
    {
        if ($valueNode instanceof StringValueNode || $valueNode instanceof IntValueNode) {
            return $valueNode->value;
        }

        // Intentionally without message, as all information already in wrapped Exception
        throw new \Exception();
    }
}
