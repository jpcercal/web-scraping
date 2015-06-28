<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Command;

use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use Cekurte\WebScrapingBundle\DataMapper\GenericDataMapper;
use Cekurte\WebScrapingBundle\Entity\Outlet;
use Cekurte\WebScrapingBundle\Service\WebScrapingArticle;
use Cekurte\WebScrapingBundle\Service\WebScrapingFeed;
use Cekurte\WebScrapingBundle\Service\WebScrapingOutlet;
use Cekurte\WebScrapingBundle\Template\Core\ArticleTemplateInterface;
use Cekurte\WebScrapingBundle\Template\Core\OutletTemplateInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Synchronize articles command
 *
 * @author  João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
class SynchronizeArticlesCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('cekurte:webscraping:sync')
            ->setDescription('Synchronize the articles.')
        ;
    }

    /**
     * @param  string $resource
     *
     * @return ResourceManagerInterface
     */
    protected function getResourceManager($resource)
    {
        return $this->getContainer()->get(sprintf('cekurte_webscraping.resource.%s', strtolower($resource)));
    }

    /**
     * @param  OutputInterface $output
     * @return array
     */
    protected function getOutlets(OutputInterface $output)
    {
        $resources = $this->getResourceManager('outlet')->findResources(array());

        if (empty($resources)) {
            $output->writeln('<error>[!] %s - No records (Outlet) found ...</error>', date('Y-m-d H:i:s'));
            return array();
        } else {
            $output->writeln(sprintf(
                '<info>[+] %s - %d outlet(s) found ...</info>',
                date('Y-m-d H:i:s'),
                count($resources)
            ));
        }

        return $resources;
    }

    /**
     * @param  Outlet          $outlet
     * @param  OutputInterface $output
     *
     * @return OutletTemplateInterface
     */
    protected function getOutletTemplate(Outlet $outlet, OutputInterface $output)
    {
        $output->writeln(sprintf(
            '<comment>[+] %s - Getting template to synchronize the data from outlet #%d "%s" ...</comment>',
            date('Y-m-d H:i:s'),
            $outlet->getId(),
            $outlet->getName()
        ));

        return (new WebScrapingOutlet($outlet))->getOutletTemplate();
    }

    /**
     * @param  Outlet          $outlet
     * @param  OutputInterface $output
     * @return array
     */
    protected function getFeedEntries(Outlet $outlet, OutputInterface $output)
    {
        $output->writeln(sprintf(
            '<comment>[+] %s - Importing RSS feed entries from outlet #%d "%s" ...</comment>',
            date('Y-m-d H:i:s'),
            $outlet->getId(),
            $outlet->getName()
        ));

        $entries = (new WebScrapingFeed($outlet))->getEntries();

        if (empty($entries)) {
            $output->writeln(sprintf(
                '<error>[!] %s - RSS Feed was imported with no entries ...</error>',
                date('Y-m-d H:i:s')
            ));
        } else {
            $output->writeln(sprintf(
                '<info>[+] %s - RSS Feed was imported with %d entries ...</info>',
                date('Y-m-d H:i:s'),
                count($entries)
            ));
        }

        return $entries;
    }

    /**
     * @param  Outlet          $outlet
     * @param  OutputInterface $output
     * @return array
     */
    protected function getArticles(Outlet $outlet, OutputInterface $output)
    {
        $output->writeln(sprintf(
            '<comment>[+] %s - Importing Articles from feed entries ...</comment>',
            date('Y-m-d H:i:s')
        ));

        $entries = $this->getFeedEntries($outlet, $output);

        $articles = (new WebScrapingArticle($outlet, $entries))->getArticles();

        if (empty($articles)) {
            $output->writeln(sprintf(
                '<error>[!] %s - The articles was imported with no entries ...</error>',
                date('Y-m-d H:i:s')
            ));
        } else {
            $output->writeln(sprintf(
                '<info>[+] %s - The articles was imported with %d entries ...</info>',
                date('Y-m-d H:i:s'),
                count($articles)
            ));
        }

        return $articles;
    }

    /**
     * @param  ArticleTemplateInterface $articleTemplate
     * @param  OutletTemplateInterface  $outletTemplate
     * @param  OutputInterface          $output
     *
     * @return bool
     */
    protected function processArticleTemplateAndSaveData(
        ArticleTemplateInterface $articleTemplate,
        OutletTemplateInterface  $outletTemplate,
        OutputInterface          $output
    ) {
        $output->writeln(sprintf(
            '<comment>[+] %s - Synchronizing the article "%s" posted by "%s" at "%s" ...</comment>',
            date('Y-m-d H:i:s'),
            $articleTemplate->getTitle(),
            $articleTemplate->getAuthor()->getName(),
            $articleTemplate->getPublicationDate()->format('Y-m-d')
        ));

        $dataMapper = new GenericDataMapper(
            $articleTemplate,
            $outletTemplate,
            $this->getResourceManager('article'),
            $this->getResourceManager('author'),
            $this->getResourceManager('outlet')
        );

        $resourceId = $dataMapper->save();

        if ($resourceId !== false) {
            $output->writeln(sprintf(
                '<info>[+] %s - The article #%d was synchronized with successfully ...</info>',
                date('Y-m-d H:i:s'),
                $resourceId
            ));
        } else {
            $output->writeln(sprintf(
                '<error>[+] %s - The article was not synchronized ...</error>',
                date('Y-m-d H:i:s')
            ));
        }

        return $resourceId;
    }

    /**
     * Execute the command's
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<comment>[+] %s - Starting the synchronize process ...</comment>', date('Y-m-d H:i:s')));

        $outlets = $this->getOutlets($output);

        foreach ($outlets as $outlet) {

            $outletTemplate = $this->getOutletTemplate($outlet, $output);

            $articles = $this->getArticles($outlet, $output);

            foreach ($articles as $articleTemplate) {

                try {
                    $this->processArticleTemplateAndSaveData($articleTemplate, $outletTemplate, $output);
                } catch (\Exception $e) {

                    $output->writeln(sprintf(
                        '<error>[!] %s - %s #%d: "%s"</error>',
                        date('Y-m-d H:i:s'),
                        get_class($e),
                        $e->getCode(),
                        $e->getMessage()
                    ));

                    continue;
                }
            }
        }

        $output->writeln(sprintf(
            '<info>[+] %s - Process completed with successfully ...</info>',
            date('Y-m-d H:i:s')
        ));
    }
}
