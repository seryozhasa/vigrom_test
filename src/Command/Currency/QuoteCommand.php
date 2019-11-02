<?php

declare(strict_types=1);

namespace App\Command\Currency;

use App\Service\Currency\Quote\Quote;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QuoteCommand extends Command
{
    private $service;

    public function __construct(Quote $service)
    {
        $this->service = $service;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('currency:quote:update')
            ->setDescription('Quote update');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->service->update();

        $output->writeln('<info>Done!</info>');
    }
}
