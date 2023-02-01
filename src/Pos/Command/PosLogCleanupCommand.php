<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPal\Pos\Command;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\System\SalesChannel\SalesChannelEntity;
use Swag\PayPal\Pos\Run\Administration\LogCleaner;
use Symfony\Component\Console\Output\OutputInterface;

class PosLogCleanupCommand extends AbstractPosCommand
{
    protected static $defaultName = 'swag:paypal:pos:log:cleanup';

    protected static $defaultDescription = 'Cleanup Zettle sync log';

    private LogCleaner $logCleaner;

    public function __construct(
        EntityRepository $salesChannelRepository,
        LogCleaner $logCleaner
    ) {
        parent::__construct($salesChannelRepository);
        $this->logCleaner = $logCleaner;
    }

    protected function executeForSalesChannel(SalesChannelEntity $salesChannel, OutputInterface $output, Context $context): void
    {
        $this->logCleaner->cleanUpLog($salesChannel->getId(), $context);
    }

    protected function useInactiveSalesChannels(): bool
    {
        return true;
    }
}
