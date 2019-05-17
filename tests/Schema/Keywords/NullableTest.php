<?php

declare(strict_types=1);

namespace OpenAPIValidationTests\Schema\Keywords;

use OpenAPIValidation\Schema\Exception\ValidationKeywordFailed;
use OpenAPIValidation\Schema\Validator;
use OpenAPIValidationTests\Schema\SchemaValidatorTest;

final class NullableTest extends SchemaValidatorTest
{
    public function test_it_validates_nullable_green() : void
    {
        $spec = <<<SPEC
schema:
    type: string
    nullable: true
SPEC;

        $schema = $this->loadRawSchema($spec);
        $data   = null;

        (new Validator($schema, $data))->validate();
        $this->addToAssertionCount(1);
    }

    public function test_it_validates_nullable_red() : void
    {
        $spec = <<<SPEC
schema:
    type: string
SPEC;

        $schema = $this->loadRawSchema($spec);
        $data   = null;

        try {
            (new Validator($schema, $data))->validate();
        } catch (ValidationKeywordFailed $e) {
            $this->assertEquals('nullable', $e->keyword());
        }
    }
}
