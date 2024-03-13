<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Privatization\Rector\ClassMethod\PrivatizeFinalClassMethodRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->importNames(false);
    $rectorConfig->paths([
        __DIR__.'/app',
        __DIR__.'/bootstrap',
        __DIR__.'/config',
        __DIR__.'/database',
        __DIR__.'/public',
        __DIR__.'/resources',
        __DIR__.'/tests',
    ]);

    // Specify a path that works locally as well as on CI job runners.
    $rectorConfig->cacheDirectory('./cache/rector');

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
        SetList::CODE_QUALITY,
        SetList::PRIVATIZATION,
    ]);

    $rectorConfig->rule(\Rector\Php55\Rector\String_\StringClassNameToClassConstantRector::class);
    $rectorConfig->rule(\Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector::class);
    $rectorConfig->rule(\Rector\CodingStyle\Rector\ClassMethod\MakeInheritedMethodVisibilitySameAsParentRector::class);

    $rectorConfig->skip([
        __DIR__.'/bootstrap/cache',
        __DIR__.'/database/migrations',

        // file-specific to replace @noRector individual cases
        __DIR__.'/tests/Factories/Factory.php', // to prevent removing "static" PHPDoc @return block needed for some readon by Psalm

        // PHP_81
        \Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector::class, // ATM, we do not want to make constants final in final classes (do not duplicate final keyword), see https://github.com/rectorphp/rector/issues/6583#issuecomment-992661858
        \Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector::class, // It treats strings as nullable strings and for this reason adds some extra casting
        \Rector\Php81\Rector\Array_\FirstClassCallableRector::class, // It breaks Laravel routes to something like: Route::get('profile', (new \App\Http\Controllers\Auth\OauthProfileController())->show(...))

        // PHP_80
        \Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector::class, // this is currently optional
        \Rector\Php80\Rector\FunctionLike\UnionTypesRector::class => [ // temp, need to do some work and test changes, especially with middleware: some PHPDoc info can be not reliable
            __DIR__.'/**/Middleware/*', // just skip rule on specific fnmatch
        ],

        // PHP_74
        \Rector\Php74\Rector\LNumber\AddLiteralSeparatorToNumberRector::class, // we format numbers by our rules (e.g. currencies)
        \Rector\Php74\Rector\Property\TypedPropertyRector::class, // It typify Eloquent properties like $table, Nova’s $model, that leads to 500 error.
        \Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector::class, // it may make code less readable in some cases

        // TYPE_DECLARATION_STRICT
        \Rector\TypeDeclaration\Rector\Closure\AddClosureReturnTypeRector::class, // Good to have, but we can make it optional also
        \Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector::class, // Good to have, but we can make it optional also
        \Rector\TypeDeclaration\Rector\ClassMethod\ArrayShapeFromConstantArrayReturnRector::class, // Array shape is not flexible enough.

        // TYPE_DECLARATION
        \Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector::class, // not always needed (to reduce visual noise)
        \Rector\TypeDeclaration\Rector\FunctionLike\ReturnTypeDeclarationRector::class, // Changes some return types from interfaces to more concrete implementations, eloquent builder to Database\Query\Builder, HasOne to Builder, etc.
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector::class, // ANot always needed to use return type hint on anonymous functions.
        \Rector\TypeDeclaration\Rector\ClassMethod\AddArrayParamDocTypeRector::class, // Adds return type from PHPDoc to native PHP and thus breaks Laravel Feature tests where \Illuminate\Testing\TestResponse returned
        \Rector\TypeDeclaration\Rector\FunctionLike\ParamTypeDeclarationRector::class, // Adds to concrete types that we don’t need in some cases e.g. abstract public function sendNow(\App\Models\Notification\MessageQueueEmail|\App\Models\Notification\MessageQueuePostcard|\App\Models\Notification\MessageQueueSms $message)
        \Rector\TypeDeclaration\Rector\ClassMethod\AddArrayReturnDocTypeRector::class, // Adds too concrete return types
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector::class => [ // do not change tests that uses markTestSkipped()
            __DIR__.'/tests/*', // just skip rule on specific fnmatch
        ],
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector::class => [
            __DIR__.'/**/Middleware/*', // There is no reason to make that more such unreadable
        ],

        // CODE_QUALITY
        \Rector\CodeQuality\Rector\Array_\CallableThisArrayToAnonymousFunctionRector::class, // Changes Laravel routes
        \Rector\CodeQuality\Rector\ClassMethod\DateTimeToDateTimeInterfaceRector::class, // converts Carbon to \DateTimeInterface
        \Rector\CodeQuality\Rector\PropertyFetch\ExplicitMethodCallOverMagicGetSetRector::class, // it changes property access to getters (that are deprecated). We can enable this rector back after removing all deprecated setters and getters.
        \Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector::class, // it decreases readability in some cases by adding negative check ($member === null vs !$member instanceof Member)
        \Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector::class, // This decreased readability
        CompleteDynamicPropertiesRector::class, // it adds dynamic properties to classes that are not dynamic

        // CODING_STYLE
        \Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector::class => [ // Laravel uses if ($state instanceof Closure && $state) { $state = $state->bindTo($this); } that leads to ErrorException for static closures
            __DIR__.'*/tests/Factories*', // just skip rule on specific fnmatch
        ],
        \Rector\CodingStyle\Rector\Closure\StaticClosureRector::class => [ // Laravel uses if ($state instanceof Closure && $state) { $state = $state->bindTo($this); } that leads to ErrorException for static closures
            __DIR__.'*/tests/Factories*', // just skip rule on specific fnmatch
        ],
        \Rector\CodingStyle\Rector\ClassConst\VarConstantCommentRector::class,
        \Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector::class,
        \Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector::class, // Fails for currency strings like: "Earn $$bootcampCommissionAmount
        \Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector::class, // Too much space in some cases (method -> space -> set attr)
        \Rector\CodingStyle\Rector\ClassMethod\NewlineBeforeNewAssignSetRector::class, // No need it in tests
        \Rector\CodingStyle\Rector\FuncCall\CountArrayToEmptyArrayComparisonRector::class, // Converts count($problems) > 0 to $problems !== [] what is less readable
        \Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector::class, // see https://github.com/rectorphp/rector-src/pull/2220
        \Rector\CodingStyle\Rector\FuncCall\ConsistentPregDelimiterRector::class, // wrong: preg_replace("/(<(img|iframe)[^>]*\s)src(=[\"'].*[\"'].*)/U",   TO    preg_replace("#(<(img|iframe)[^>]*\s)src(=["'].*["'].*)#U",

        // SetList::PRIVATIZATION
        \Rector\Privatization\Rector\Property\ChangeReadOnlyPropertyWithDefaultValueToConstantRector::class, // Creates constants with bad names.
        \Rector\Privatization\Rector\Property\PrivatizeFinalClassPropertyRector::class, // breaks magic for protected array $validationRules = [] .... or not? Please test it :)
        \Rector\Privatization\Rector\Class_\ChangeReadOnlyVariableWithDefaultValueToConstantRector::class, // Creates constants with bad names.
        \Rector\Privatization\Rector\MethodCall\PrivatizeLocalGetterToPropertyRector::class, // sometimes we need a getter, especially if getter required by interface.
        PrivatizeFinalClassMethodRector::class,

        // Laravel
        // For more rectors {@see https://github.com/driftingly/rector-laravel/blob/main/docs/rector_rules_overview.md}
        \RectorLaravel\Rector\Assign\CallOnAppArrayAccessToStandaloneAssignRector::class,
        \RectorLaravel\Rector\MethodCall\ChangeQueryWhereDateValueWithCarbonRector::class,
        \RectorLaravel\Rector\ClassMethod\AddGenericReturnTypeToRelationsRector::class,
    ]);
};
