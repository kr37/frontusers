<?php

namespace kr37\frontusers;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use kr37\frontusers\models\Settings;

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

    public function init()
    {
        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
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
