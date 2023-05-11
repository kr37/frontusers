<?php

namespace kr37\frontusers;

use Craft;
use craft\base\Plugin;
use craft\base\Model;
use craft\services\Plugins;
use craft\services\Fields;
use craft\events\PluginEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;

use kr37\frontusers\FUAuthenticated;
use kr37\frontusers\models\Settings;
use kr37\frontusers\variables\FrontusersVariable;

/**
 * Frontusers plugin
 *
 * @method static Frontusers getInstance()
 * @method Settings getSettings()
 * @author kr37 <rinzin@kr37.net>
 * @copyright kr37
 * @license MIT
 */
class Frontusers extends Plugin
{
    public static $plugin;
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
        ];
    }

    public function getVariableDefinition()
    {
        return new FrontusersVariable();
    }

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
        Craft::$app->view->registerTwigExtension(new FUAuthenticated());

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('Frontusers', FrontusersVariable::class);
            }
        );

    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('frontusers/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
    }
}
