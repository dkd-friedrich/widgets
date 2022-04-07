<?php

declare(strict_types=1);
namespace FriendsOfTYPO3\Widgets;

use FriendsOfTYPO3\Widgets\Widgets\PageOverviewWidget;
use FriendsOfTYPO3\Widgets\Widgets\Provider\PagesWithoutDescriptionDataProvider;
use FriendsOfTYPO3\Widgets\Widgets\StatusReportWidget;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return function (ContainerConfigurator $configurator, ContainerBuilder $containerBuilder) {
    $services = $configurator->services();

        $services->set('widgets.dashboard.widget.statusReport')
            ->class(StatusReportWidget::class)
            ->arg('$view', new Reference('dashboard.views.widget'))
            ->arg('$buttonProvider', new Reference('FriendsOfTYPO3\Widgets\Widgets\Provider\StatusReportButtonProvider'))
            ->tag(
                'dashboard.widget',
                [
                    'identifier' => 'widgets-statusReport',
                    'groupNames' => 'systemInfo',
                    'title' => 'LLL:EXT:widgets/Resources/Private/Language/locallang.xlf:widgets.dashboard.widget.statusReport.title',
                    'description' => 'LLL:EXT:widgets/Resources/Private/Language/locallang.xlf:widgets.dashboard.widget.statusReport.description',
                    'iconIdentifier' => 'content-widget-list',
                    'height' => 'medium',
                    'width' => 'medium'
                ]
            )
        ;

        $services->set('widgets.dashboard.widget.pagesWithoutMetaDescription')
            ->class(PageOverviewWidget::class)
            ->arg('$dataProvider', new Reference('FriendsOfTYPO3\Widgets\Widgets\Provider\PagesWithoutDescriptionDataProvider'))
            ->arg('$view', new Reference('dashboard.views.widget'))
            ->arg('$buttonProvider', null)
            ->arg('$options', ['template' => 'Widget/PageWithoutMetaDescriptionWidget'])
            ->tag(
                'dashboard.widget',
                [
                    'identifier' => 'widgets-pagesWithoutMetaDescription',
                    'groupNames' => 'seo',
                    'title' => 'LLL:EXT:widgets/Resources/Private/Language/locallang.xlf:widgets.dashboard.widget.pagesWithoutMetaDescription.title',
                    'description' => 'LLL:EXT:widgets/Resources/Private/Language/locallang.xlf:widgets.dashboard.widget.pagesWithoutMetaDescription.description',
                    'iconIdentifier' => 'content-widget-list',
                    'height' => 'large',
                    'width' => 'medium'
                ]
            )
        ;
};
